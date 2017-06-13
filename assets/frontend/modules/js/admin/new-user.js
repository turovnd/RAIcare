module.exports = (function (newuser) {

    var corePrefix      = 'RAIsoft admin';


    newuser.create = function () {

        var form     = document.getElementById('newUserForm'),
            formData = new FormData(form);

        formData.append('csrf', document.getElementById('csrf').value);

        var ajaxData = {
            url: '/user/new',
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

                if ( parseInt(response.code) === 50) {

                    window.location.assign('/user/' + response.id);

                }

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on crating new user', 'error', corePrefix, callbacks);
                form.classList.remove('loading');

            }
        };

        raisoft.ajax.send(ajaxData);

    };


    return newuser;

})({});