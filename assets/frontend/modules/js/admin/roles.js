module.exports = (function (roles) {

    var corePrefix   = 'RAIcare admin', i,
        roleID       = null,
        rolesWrapper = null;

    roles.openmodal = function (element) {

        roleID       = element.dataset.pk;
        rolesWrapper = element.parentNode;

        var rolename = element.dataset.rolename,
            selectedPermissions = JSON.parse(element.dataset.permissions);

        raicare.modal.create({
            id: 'updateRoleModal',
            header: 'Изменить права доступа роли: ' + rolename,
            body:
            '<fieldset>'+
            '<div class="form-group">'+
            '<label for="updateRoleName" class="form-group__label">Название роли</label>'+
            '<input type="text" id="updateRoleName" class="form-group__control" maxlength="128" value="' + rolename + '">'+
            '</div>'+
            '</fieldset>'+
            '<fieldset id="updatePermissions" class="m-b-0">'+
            '<div class="form-group">'+
                getPermissions_(selectedPermissions) +
            '</div>'+
            '</fieldset>',

            footer:
            '<button type="button" class="btn btn--default" data-close="modal">Отмена</button>'+
            '<button onclick="admin.roles.updaterole()" type="button" class="btn btn--brand">Изменить</button>'
        });

    };


    roles.updaterole = function () {

        var form             = document.getElementById('updateRoleModal'),
            formData         = new FormData(),
            permissionsBlock = document.getElementById('updatePermissions').querySelectorAll('.checkbox:checked'),
            permissions      = [],
            permis           = [];

        for (i = 0; i < permissionsBlock.length; i++) {

            permissions.push(permissionsBlock[i].id.split('_')[1]);
            permis.push({
                id: permissionsBlock[i].id.split('_')[1],
                name: permissionsBlock[i].value
            });

        }

        formData.append('role', roleID);
        formData.append('name', document.getElementById('updateRoleName').value);
        formData.append('permissions', JSON.stringify(permissions));
        formData.append('csrf', document.getElementById('csrf').value);

        var ajaxData = {
            url: '/admin/role/update',
            type: 'POST',
            data: formData,
            beforeSend: function () {

                form.getElementsByClassName('modal__content')[0].classList.add('loading');

            },
            success: function (response) {

                response = JSON.parse(response);
                raicare.core.log(response.message, response.status, corePrefix);
                form.getElementsByClassName('modal__content')[0].classList.remove('loading');

                raicare.notification.notify({
                    type: response.status,
                    message: response.message
                });


                if (parseInt(response.code) === 103 ) {

                    rolesWrapper.innerHTML = updateHTML_(permis);
                    raicare.modal.hide(form);
                    form.remove();

                }

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on changing user role', 'error', corePrefix, callbacks);
                form.getElementsByClassName('modal__content')[0].classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);

    };


    function getPermissions_(selectedPermissions) {

        var allPermissions = document.getElementsByClassName('permission-name'),
            str            = '',
            permissions    = [];


        for (i = 0; i < allPermissions.length; i++) {

            permissions[allPermissions[i].dataset.id] = {
                id: allPermissions[i].dataset.id,
                name: allPermissions[i].textContent,
                checked: ''
            };

        }

        for (i = 0; i < selectedPermissions.length; i++) {

            permissions[selectedPermissions[i]['id']].checked = 'checked';

        }

        while (permissions.length > 1) {

            var el = permissions.pop();

            str =
                '<p>' +
                '<input type="checkbox" id="modalpermission_' + el.id + '" class="checkbox" ' + el.checked + ' value="' + el.name + '">' +
                '<label for="modalpermission_' + el.id + '" class="checkbox-label">' + el.name + '</label>' +
                '</p>' + str ;

        }


        return str;

    }

    function updateHTML_(permis) {

        var name    = document.getElementById('updateRoleName').value,
            str     = '';

        str =
            '<span class="role-name">' + name + '</span>'+
            '<button onclick="admin.roles.openmodal(this)" role="button" class="m-l-5" data-pk="' + roleID + '" data-rolename="' + name + '" data-permissions=\'' + JSON.stringify(permis) + '\'><i class="fa fa-edit text-brand" aria-hidden="true"></i></button>'+
            '<ul>';

        for (i = 0; i < permis.length; i++) {

            str += '<li data-permission="' + permis[i].id + '">' + permis[i].name + '</li>';

        }

        str += '</ul>';

        return str;

    }

    return roles;

})({});