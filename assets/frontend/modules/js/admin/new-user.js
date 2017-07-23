module.exports = (function (newuser) {

    var corePrefix      = 'RAIcare admin';

    newuser.changerole = function (element) {

        if (element.value === 'new') {

            document.getElementById('newUserPermissions').classList.remove('hide');
            document.getElementById('newUserRoleName').parentNode.classList.remove('hide');

        } else {

            document.getElementById('newUserPermissions').classList.add('hide');
            document.getElementById('newUserRoleName').parentNode.classList.add('hide');

        }

    };


    newuser.create = function () {

        var form             = document.getElementById('newUserForm'),
            formData         = new FormData(),
            permissionsBlock = document.getElementById('newUserPermissions').querySelectorAll('.checkbox:checked'),
            permissions      = [];

        for (var i = 0; i < permissionsBlock.length; i++) {

            permissions.push(permissionsBlock[i].id.split('_')[1]);

        }


        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('name', document.getElementById('newUser').value);
        formData.append('email', document.getElementById('newUserEmail').value);
        formData.append('role', document.getElementById('newUserRole').value);
        formData.append('roleName', document.getElementById('newUserRoleName').value);
        formData.append('permissions', JSON.stringify(permissions));

        var ajaxData = {
            url: '/profile/new',
            type: 'POST',
            data: formData,
            beforeSend: function () {

                form.classList.add('loading');

            },
            success: function (response) {

                response = JSON.parse(response);
                raicare.core.log(response.message, response.status, corePrefix);
                form.classList.remove('loading');

                raicare.notification.notify({
                    type: response.status,
                    message: response.message
                });

                if ( parseInt(response.code) === 50) {

                    window.location.assign('/profile/' + response.id);

                }

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on crating new user', 'error', corePrefix, callbacks);
                form.classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);

    };


    return newuser;

})({});