module.exports = (function (roles) {

    var corePrefix      = 'RAIsoft admin', i,
        rolesWrapper    = null,
        newRoleModal    = null,
        editRoleModal   = null,
        deleteRoleModal = null;

    /**
     * Prepare roles for creating|editing|removing
     * @private
     */
    function prepareRoles_() {

        rolesWrapper = document.getElementById('roles');

        var roleNewBtn = document.getElementById('js-add-role');

        roleNewBtn.addEventListener('click', openNewRoleModal_);

        var editRoles = document.getElementsByClassName('js-edit-role');

        for (i = 0; i < editRoles.length; i++) {

            editRoles[i].addEventListener('click', openEditRoleModal_);

        }

        var deleteRoles = document.getElementsByClassName('js-delete-role');

        for (i = 0; i < deleteRoles.length; i++) {

            deleteRoles[i].addEventListener('click', openDeleteRoleModal_);

        }

    }

    function createNewRole_() {

        var form     = document.getElementById('newRoleForm'),
            formData = new FormData(),
            name     = document.getElementById('newRoleFormName').value;

        formData.append('name', name);

        var ajaxData = {
            url: '/admin/role/add',
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

                if ( parseInt(response.code) === 101) {

                    var element = raisoft.draw.node('LI', 'p-b-5');

                    element.innerHTML = '<span class="role-name" data-id="' + response.id + '" >' + name + '</span>'+
                        '<button role="button" class="js-edit-role" data-id="' + response.id + '" data-name="' + name+ '"><i class="fa fa-edit m-l-5 text-brand" aria-hidden="true"></i></button>' +
                        '<button role="button" class="js-delete-role" data-id="' + response.id + '"><i class="fa fa-trash m-l-5 text-danger" aria-hidden="true"></i></button>';

                    rolesWrapper.appendChild(element);
                    element.getElementsByClassName('js-edit-role')[0].addEventListener('click', openEditRoleModal_);
                    element.getElementsByClassName('js-delete-role')[0].addEventListener('click', openDeleteRoleModal_);

                    newRoleModal.close();
                    newRoleModal = null;

                }

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on crating new role', 'error', corePrefix, callbacks);
                form.classList.remove('loading');

            }
        };

        raisoft.ajax.send(ajaxData);

    }

    function updateRole_() {

        var form     = document.getElementById('editRoleForm'),
            formData = new FormData(),
            name     = document.getElementById('editRoleFormName').value,
            id       = document.getElementById('editRoleFormName').dataset.id;

        formData.append('name', name);
        formData.append('id', id);

        var ajaxData = {
            url: '/admin/role/update',
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

                if ( parseInt(response.code) === 103) {

                    var element = document.querySelector('.role-name[data-id="' + id + '"]');

                    element.textContent = name;
                    editRoleModal.close();
                    editRoleModal = null;

                }

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on updating role form', 'error', corePrefix, callbacks);
                form.classList.remove('loading');

            }
        };

        raisoft.ajax.send(ajaxData);

    }

    function deleteRole_() {

        var form     = document.getElementById('deleteRoleForm'),
            formData = new FormData(),
            id       = form.dataset.id;

        formData.append('id', id);

        var ajaxData = {
            url: '/admin/role/delete',
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

                if ( parseInt(response.code) === 104) {

                    var element = document.querySelector('.role-name[data-id="' + id + '"]');

                    element.parentNode.remove();
                    deleteRoleModal.close();
                    deleteRoleModal= null;

                }

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on deleting role form', 'error', corePrefix, callbacks);
                form.classList.remove('loading');

            }
        };

        raisoft.ajax.send(ajaxData);

    }

    function openNewRoleModal_() {

        newRoleModal = raisoft.notification.notify({
            type: 'confirm',
            message:    '<div id="newRoleForm">' +
            '<h2>Новая роль</h2>'+
            '<div class="form-group">' +
            '<input id="newRoleFormName" class="form-group__control" type="text" placeholder="Введите название роли">' +
            '</div>' +
            '</div>',
            showCancelButton: true,
            validation: true,
            confirmText: 'Создать',
            confirm: createNewRole_
        });

    }

    function openEditRoleModal_() {

        var id   = this.dataset.id,
            name = this.dataset.name;

        editRoleModal = raisoft.notification.notify({
            type: 'confirm',
            message:    '<div id="editRoleForm">' +
            '<h2>Редактировать роль</h2>'+
            '<div class="form-group">' +
            '<input id="editRoleFormName" class="form-group__control" data-id="' + id +'" value="' + name + '">' +
            '</div>' +
            '</div>',
            showCancelButton: true,
            validation: true,
            confirmText: 'Изменить',
            confirm: updateRole_
        });

    }

    function openDeleteRoleModal_() {

        var id   = this.dataset.id;

        deleteRoleModal = raisoft.notification.notify({
            type: 'confirm',
            message:    '<div id="deleteRoleForm" data-id="' + id + '">' +
            '<h2>Удалить роль</h2>'+
            '<p>Удалив роль, Вы не сможете её восстановить</p>'+
            '</div>',
            showCancelButton: true,
            validation: true,
            confirmText: 'Удалить',
            confirm: deleteRole_
        });

    }


    roles.init = function () {

        prepareRoles_();

    };

    return roles;

})({});