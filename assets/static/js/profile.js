function ready() {

    var corePrefix      = "RAIsoft profile",
        changePassword  = document.getElementById('changePassword'),
        changeProfile   = document.getElementById('changeProfile');


    /**
     * Submit Change Profile Form
     */
     changeProfile.addEventListener('submit', function (event) {
        event.preventDefault();

        var ajaxData = {
            url: '/profile/update',
            type: 'POST',
            data: new FormData(changeProfile),
            beforeSend: function(){
                changeProfile.classList.add('loading');
            },
            success: function(response) {
                response = JSON.parse(response);
                raisoft.core.log(response.message, response.status, corePrefix);
                changeProfile.classList.remove('loading');

                raisoft.notification.notify({
                    type: response.status,
                    message: response.message
                });



            },
            error: function(callbacks) {
                raisoft.core.log('ajax error occur on changeProfile form','danger', corePrefix, callbacks);
                changeProfile.classList.remove('loading');
            }
        };

        raisoft.ajax.send(ajaxData);
    });


    /**
     * Submit Change Password Form
     */
    changePassword.addEventListener('submit', function (event) {
        event.preventDefault();

        var ajaxData = {
            url: '/profile/updatepassword',
            type: 'POST',
            data: new FormData(changePassword),
            beforeSend: function(){
                changePassword.classList.add('loading');
            },
            success: function(response) {
                response = JSON.parse(response);
                raisoft.core.log(response.message, response.status, corePrefix);
                changePassword.classList.remove('loading');

                raisoft.notification.notify({
                    type: response.status,
                    message: response.message
                });

                if (response.code === "44") {
                    changePassword.reset();
                }
            },
            error: function(callbacks) {
                raisoft.core.log('ajax error occur on changePassword form','danger',corePrefix,callbacks);
                changePassword.classList.remove('loading');
            }
        };

        raisoft.ajax.send(ajaxData);
    });



}

document.addEventListener("DOMContentLoaded", ready);