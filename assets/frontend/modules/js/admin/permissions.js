module.exports = (function (permissions) {

    var corePrefix            = 'RAIsoft admin', i,
        permissionsWrapper    = null,
        newPermissionModal    = null,
        editPermissionModal   = null,
        deletePermissionModal = null;

    /**
     * Prepare permissions for creating|editing|deleting
     * @private
     */
    function preparePermissions_() {

        permissionsWrapper = document.getElementById('permissions');

        var permissionNewBtn = document.getElementById('js-add-permission');

        permissionNewBtn.addEventListener('click', openNewPermissionModal_);

        var editPermissions = document.getElementsByClassName('js-edit-permission');

        for (i = 0; i < editPermissions.length; i++) {

            editPermissions[i].addEventListener('click', openEditPermissionModal_);

        }

        var deletePermissions = document.getElementsByClassName('js-delete-permission');

        for (i = 0; i < deletePermissions.length; i++) {

            deletePermissions[i].addEventListener('click', openDeletePermissionModal_);

        }

    }

    function createNewPermission_() {

        var form     = document.getElementById('newPermissionForm'),
            formData = new FormData(),
            name     = document.getElementById('newPermissionFormName').value;

        formData.append('name', name);

        var ajaxData = {
            url: '/admin/permission/add',
            type: 'POST',
            data: formData,
            beforeSend: function () {

                form.classList.add('loading');

            },
            success: function (response) {

                response = JSON.parse(response);
                raisoft.core.log(response.message, response.status, corePrefix);
                form.classList.remove('loading');

                raisoft.notification.notify({
                    type: response.status,
                    message: response.message
                });

                if ( parseInt(response.code) === 111) {

                    var element = raisoft.draw.node('LI', 'p-b-5');

                    element.innerHTML = '<span class="permission-name" data-id="' + response.id + '" >' + name + '</span>'+
                        '<button role="button" class="js-edit-permission" data-id="' + response.id + '" data-name="' + name+ '"><i class="fa fa-edit m-l-5 text-brand" aria-hidden="true"></i></button>' +
                        '<button role="button" class="js-delete-permission" data-id="' + response.id + '"><i class="fa fa-trash m-l-5 text-danger" aria-hidden="true"></i></button>';

                    permissionsWrapper.appendChild(element);
                    element.getElementsByClassName('js-edit-permission')[0].addEventListener('click', openEditPermissionModal_);
                    element.getElementsByClassName('js-delete-permission')[0].addEventListener('click', openDeletePermissionModal_);

                    newPermissionModal.close();
                    newPermissionModal = null;

                }

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on crating new permission', 'error', corePrefix, callbacks);
                form.classList.remove('loading');

            }
        };

        raisoft.ajax.send(ajaxData);

    }

    function updatePermission_() {

        var form     = document.getElementById('editPermissionForm'),
            formData = new FormData(),
            name     = document.getElementById('editPermissionFormName').value,
            id       = document.getElementById('editPermissionFormName').dataset.id;

        formData.append('name', name);
        formData.append('id', id);

        var ajaxData = {
            url: '/admin/permission/update',
            type: 'POST',
            data: formData,
            beforeSend: function () {

                form.classList.add('loading');

            },
            success: function (response) {

                response = JSON.parse(response);
                raisoft.core.log(response.message, response.status, corePrefix);
                form.classList.remove('loading');

                raisoft.notification.notify({
                    type: response.status,
                    message: response.message
                });

                if ( parseInt(response.code) === 113) {

                    var element = document.querySelector('.permission-name[data-id="' + id + '"]');

                    element.textContent = name;
                    editPermissionModal.close();
                    editPermissionModal = null;

                }

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on updating permission form', 'error', corePrefix, callbacks);
                form.classList.remove('loading');

            }
        };

        raisoft.ajax.send(ajaxData);

    }

    function deletePermission_() {

        var form     = document.getElementById('deletePermissionForm'),
            formData = new FormData(),
            id       = form.dataset.id;

        formData.append('id', id);

        var ajaxData = {
            url: '/admin/permission/delete',
            type: 'POST',
            data: formData,
            beforeSend: function () {

                form.classList.add('loading');

            },
            success: function (response) {

                response = JSON.parse(response);
                raisoft.core.log(response.message, response.status, corePrefix);
                form.classList.remove('loading');

                raisoft.notification.notify({
                    type: response.status,
                    message: response.message
                });

                if ( parseInt(response.code) === 114) {

                    var element = document.querySelector('.permission-name[data-id="' + id + '"]');

                    element.parentNode.getElementsByClassName('js-edit-permission')[0].removeEventListener('click', openEditPermissionModal_);
                    element.parentNode.getElementsByClassName('js-delete-permission')[0].removeEventListener('click', openDeletePermissionModal_);
                    element.parentNode.remove();

                    deletePermissionModal.close();
                    deletePermissionModal= null;

                }

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on deleting permission form', 'error', corePrefix, callbacks);
                form.classList.remove('loading');

            }
        };

        raisoft.ajax.send(ajaxData);

    }

    function openNewPermissionModal_() {

        if (newPermissionModal === null) {

            newPermissionModal = raisoft.notification.notify({
                type: 'confirm',
                message: '<div id="newPermissionForm">' +
                '<h2>Новое право доступа</h2>'+
                '<div class="form-group">' +
                '<input id="newPermissionFormName" class="form-group__control" type="text" placeholder="Введите название права доступа">' +
                '</div>' +
                '</div>',
                showCancelButton: true,
                validation: true,
                confirmText: 'Создать',
                confirm: createNewPermission_,
                cancel: function () {

                    newPermissionModal = null;

                }
            });

        }

    }

    function openEditPermissionModal_() {

        if (editPermissionModal === null) {

            var id   = this.dataset.id,
                name = this.dataset.name;

            editPermissionModal = raisoft.notification.notify({
                type: 'confirm',
                message:    '<div id="editPermissionForm">' +
                '<h2>Редактировать право доступа</h2>'+
                '<div class="form-group">' +
                '<input id="editPermissionFormName" class="form-group__control" data-id="' + id +'" value="' + name + '">' +
                '</div>' +
                '</div>',
                showCancelButton: true,
                validation: true,
                confirmText: 'Изменить',
                confirm: updatePermission_,
                cancel: function () {

                    editPermissionModal = null;

                }
            });

        }

    }

    function openDeletePermissionModal_() {

        if (deletePermissionModal === null) {

            var id   = this.dataset.id;

            deletePermissionModal = raisoft.notification.notify({
                type: 'confirm',
                message:    '<div id="deletePermissionForm" data-id="' + id + '">' +
                '<h2>Удалить право доступа</h2>'+
                '<p>Удалив право доступа, Вы не сможете его восстановить</p>'+
                '</div>',
                showCancelButton: true,
                validation: true,
                confirmText: 'Удалить',
                confirm: deletePermission_,
                cancel: function () {

                    deletePermissionModal = null;

                }
            });

        }

    }


    permissions.init = function () {

        preparePermissions_();

    };

    return permissions;

})({});