module.exports = (function (rolePermis) {

    var corePrefix            = 'RAIsoft admin', i,
        rolePermisWrapper    = null,
        newRolePermisModal    = null,
        editRolePermisModal   = null,
        deleteRolePermisModal = null;

    /**
     * Prepare rolePermis for creating|editing|deleting
     * @private
     */
    function prepareRolePermis_() {

        rolePermisWrapper = document.getElementById('rolePermis');

        var rolePermisNewBtn = document.getElementById('js-add-role-permis');

        rolePermisNewBtn.addEventListener('click', openNewRolePermisModal_);

        var editRolePermis = document.getElementsByClassName('js-edit-role-permis');

        for (i = 0; i < editRolePermis.length; i++) {

            editRolePermis[i].addEventListener('click', openEditRolePermisModal_);

        }

        var deleteRolePermis = document.getElementsByClassName('js-delete-role-permis');

        for (i = 0; i < deleteRolePermis.length; i++) {

            deleteRolePermis[i].addEventListener('click', openDeleteRolePermisModal_);

        }

    }

    function createNewRolePermis_() {

        var form             = document.getElementById('newRolePermisForm'),
            formData         = new FormData(),
            role             = document.getElementById('newRolePermisFormRole').value,
            permissionsBlock = document.getElementById('newRolePermisFormPermission').querySelectorAll('.checkbox:checked'),
            permissions      = [];

        for (i = 0; i < permissionsBlock.length; i++) {

            permissions.push(permissionsBlock[i].id.split('_')[2]);

        }

        formData.append('role', role);
        formData.append('permissions', JSON.stringify(permissions));
        formData.append('csrf', document.getElementById('csrf').value);

        var ajaxData = {
            url: '/admin/rolepermis/add',
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

                if ( parseInt(response.code) === 123) {

                    var element = raisoft.draw.node('LI', 'p-b-5');

                    element.innerHTML =
                        '<span class="role-permis-role" data-role="' + role + '">' + response.roleName +'</span>' +
                        '<button role="button" class="js-edit-role-permis" data-role="' + role  + '" data-permissions=\'' + JSON.stringify(permissions) + '\'><i class="fa fa-edit m-l-5 text-brand" aria-hidden="true"></i></button>' +
                        '<button role="button" class="js-delete-role-permis" data-role="' + role + '"><i class="fa fa-trash m-l-5 text-danger" aria-hidden="true"></i></button>' +
                        '<ul>' + response.permissionsStr + '</ul>';

                    rolePermisWrapper.appendChild(element);
                    element.getElementsByClassName('js-edit-role-permis')[0].addEventListener('click', openEditRolePermisModal_);
                    element.getElementsByClassName('js-delete-role-permis')[0].addEventListener('click', openDeleteRolePermisModal_);

                    newRolePermisModal.close();
                    newRolePermisModal = null;

                }

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on crating new role-permis', 'error', corePrefix, callbacks);
                form.classList.remove('loading');

            }
        };

        raisoft.ajax.send(ajaxData);

    }

    function updateRolePermis_() {

        var form     = document.getElementById('editRolePermisForm'),
            formData = new FormData(),
            role     = document.getElementById('editRolePermisForm').dataset.role,
            permissionsBlock = document.getElementById('editRolePermisForm').querySelectorAll('.checkbox:checked'),
            permissions      = [];

        for (i = 0; i < permissionsBlock.length; i++) {

            permissions.push(permissionsBlock[i].id.split('_')[2]);

        }

        formData.append('role', role);
        formData.append('permissions', JSON.stringify(permissions));
        formData.append('csrf', document.getElementById('csrf').value);


        var ajaxData = {
            url: '/admin/rolepermis/update',
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

                if ( parseInt(response.code) === 124) {

                    var element = document.querySelector('[data-role="' + role  + '"]').parentNode;

                    element.innerHTML =
                        '<span class="role-permis-role" data-role="' + role + '">' + response.roleName +'</span>' +
                        '<button role="button" class="js-edit-role-permis" data-role="' + role  + '" data-permissions=\'' + JSON.stringify(permissions) + '\'><i class="fa fa-edit m-l-5 text-brand" aria-hidden="true"></i></button>' +
                        '<button role="button" class="js-delete-role-permis" data-role="' + role + '"><i class="fa fa-trash m-l-5 text-danger" aria-hidden="true"></i></button>' +
                        '<ul>' + response.permissionsStr + '</ul>';

                    element.getElementsByClassName('js-edit-role-permis')[0].addEventListener('click', openEditRolePermisModal_);
                    element.getElementsByClassName('js-delete-role-permis')[0].addEventListener('click', openDeleteRolePermisModal_);

                    editRolePermisModal.close();
                    editRolePermisModal = null;

                }

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on updating role-permis form', 'error', corePrefix, callbacks);
                form.classList.remove('loading');

            }
        };

        raisoft.ajax.send(ajaxData);

    }

    function deleteRolePermis_() {

        var form     = document.getElementById('deleteRolePermisForm'),
            formData = new FormData(),
            role     = form.dataset.role;

        formData.append('role', role);
        formData.append('csrf', document.getElementById('csrf').value);

        var ajaxData = {
            url: '/admin/rolepermis/delete',
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

                if ( parseInt(response.code) === 125) {

                    var element = document.querySelector('[data-role="' + role  + '"]').parentNode;

                    element.getElementsByClassName('js-edit-role-permis')[0].removeEventListener('click', openEditRolePermisModal_);
                    element.getElementsByClassName('js-delete-role-permis')[0].removeEventListener('click', openDeleteRolePermisModal_);
                    element.remove();

                    deleteRolePermisModal.close();
                    deleteRolePermisModal= null;

                }

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on deleting role-permis form', 'error', corePrefix, callbacks);
                form.classList.remove('loading');

            }
        };

        raisoft.ajax.send(ajaxData);

    }

    function openNewRolePermisModal_() {

        if (newRolePermisModal === null) {

            newRolePermisModal = raisoft.notification.notify({
                type: 'confirm',
                message: '<div id="newRolePermisForm" class="text-left">' +
                '<h2 class="text-center">Новая связь роли и прав доступа</h2>'+
                '<div class="form-group">' +
                '<label for="newRolePermisFormRole" class="form-group__label">Выберите роль</label> ' +
                '<select name="newRolePermisFormRole" id="newRolePermisFormRole" class="form-group__control">' +
                    getRolesAsSelectOptions_() +
                '</select>' +
                '</div>' +
                '<div id="newRolePermisFormPermission" class="form-group">' +
                '<label class="form-group__label">Выберите права доступа</label> ' +
                    getPermissionsAsInputCheckbox_() +
                '</div>' +
                '</div>',
                showCancelButton: true,
                validation: true,
                confirmText: 'Создать',
                confirm: createNewRolePermis_,
                cancel: function () {

                    newRolePermisModal = null;

                }
            });

        }

    }

    function openEditRolePermisModal_() {

        if (editRolePermisModal === null) {


            var role        = this.dataset.role,
                permissions = JSON.parse(this.dataset.permissions);


            editRolePermisModal = raisoft.notification.notify({
                type: 'confirm',
                message: '<div id="editRolePermisForm" data-role="' + role + '">' +
                '<h2>Редактировать связь роли и права доступа</h2>'+
                '<div class="form-group text-left">' +
                '<div class="form-group">' +
                '<label class="form-group__label">Выберите права доступа</label> ' +
                    getPermissionsAsInputCheckbox_() +
                '</div>' +
                '</div>' +
                '</div>',
                showCancelButton: true,
                validation: true,
                confirmText: 'Изменить',
                confirm: updateRolePermis_,
                cancel: function () {

                    editRolePermisModal = null;

                }
            });

            for (i = 0; i < permissions.length; i++) {

                document.getElementById('modal_permission_' + permissions[i]).checked = 'checked';

            }


        }

    }

    function openDeleteRolePermisModal_() {

        if (deleteRolePermisModal === null) {

            var role   = this.dataset.role;

            deleteRolePermisModal = raisoft.notification.notify({
                type: 'confirm',
                message:    '<div id="deleteRolePermisForm" data-role="' + role + '">' +
                '<h2>Удалить связь роли и права доступа</h2>'+
                '<p>Удалив право доступа, Вы не сможете его восстановить</p>'+
                '</div>',
                showCancelButton: true,
                validation: true,
                confirmText: 'Удалить',
                confirm: deleteRolePermis_,
                cancel: function () {

                    deleteRolePermisModal = null;

                }
            });

        }

    }


    /**
     * Get roles as select options for creating new relation
     * @returns {string}
     * @private
     */
    function getRolesAsSelectOptions_() {

        var roleBlocks = document.getElementsByClassName('role-name'),
            str = '';

        for (i = 0; i < roleBlocks.length; i++) {

            str += '<option value="' + roleBlocks[i].dataset.id + '">' + roleBlocks[i].textContent + '</option>';

        }

        return str;

    }


    /**
     * Get permissions as input checkbox for creating new relation
     * @returns {string}
     * @private
     */
    function getPermissionsAsInputCheckbox_() {

        var permissionBlocks = document.getElementsByClassName('permission-name'),
            str = '';

        for (i = 0; i < permissionBlocks.length; i++) {

            str += '<p><input type="checkbox" id="modal_permission_' + permissionBlocks[i].dataset.id + '" class="checkbox" ><label for="modal_permission_' + permissionBlocks[i].dataset.id + '" class="checkbox-label">' + permissionBlocks[i].textContent + '</label></p>';

        }

        return str;

    }


    rolePermis.init = function () {

        prepareRolePermis_();

    };

    return rolePermis;

})({});