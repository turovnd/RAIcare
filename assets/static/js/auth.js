function ready() {

    var corePrefix      = "RAIsoft auth",
        host            = window.location.host,
        protocol        = window.location.protocol,
        pathname        = window.location.pathname,
        signin          = document.getElementById('signin'),
        forget          = document.getElementById('forget'),
        reset           = document.getElementById('reset'),
        toReset         = document.getElementById('toReset'),
        cancelForget    = document.getElementById('cancelForget'),
        cancelReset     = document.getElementById('cancelReset');

    /**
     * Opening SignIn Form
     */
    var openSignIn = function () {
        signin.classList.remove('hide');
        forget.classList.add('hide');
    };


    /**
     * Open Reset Password Form
     */
    var openReset = function () {
        signin.classList.add('hide');
        forget.classList.remove('hide');
    };



    if (!raisoft.cookies.get('reset_link')) {

        /**
         * On page load
         */
        if (pathname === "/login") {
            openSignIn();
        } else {
            window.location.replace(protocol + '//' + host);
        }


        /**
         * Event Listener
         */
        toReset.addEventListener('click', openReset);
        cancelForget.addEventListener('click', openSignIn);


        /**
         * Submit SignIn Form
         */
        signin.addEventListener('submit', function (event) {
            event.preventDefault();

            var ajaxData = {
                url: 'auth/signin',
                type: 'POST',
                data: new FormData(signin),
                beforeSend: function(){
                    signin.classList.add('loading');
                },
                success: function(response) {
                    response = JSON.parse(response);
                    signin.classList.remove('loading');
                    raisoft.core.log(response.message, response.status, corePrefix);

                    if (parseInt(response.code) === 12) {
                        window.location.replace(protocol + '//' + host + '/app');
                        return;
                    }

                    raisoft.notification.notify({
                        type: response.status,
                        message: response.message
                    });
                },
                error: function(callbacks) {
                    raisoft.core.log('ajax error occur on signin form','error',corePrefix ,callbacks);
                    signin.classList.add('loading');
                }
            };

            raisoft.ajax.send(ajaxData);
        });


        /**
         * Submit Forget password Form
         */
        forget.addEventListener('submit', function (event) {
            event.preventDefault();

            var ajaxData = {
                url: '/auth/forget',
                type: 'POST',
                data: new FormData(forget),
                beforeSend: function(){
                    forget.classList.add('loading');
                },
                success: function(response) {
                    response = JSON.parse(response);
                    forget.classList.remove('loading');
                    raisoft.core.log(response.message, response.status, corePrefix);

                    raisoft.notification.notify({
                        type: response.status,
                        message: response.message
                    });

                    if (response.code === "62")
                        window.location.replace(protocol + '//' + host + '/login');

                },
                error: function(callbacks) {
                    raisoft.core.log('ajax error occur on forget form','error',corePrefix,callbacks);
                    forget.classList.remove('loading');
                }
            };

            raisoft.ajax.send(ajaxData);
        });


    } else {

        /**
         * Submit Reset password Form
         */
        reset.addEventListener('submit', function (event) {
            event.preventDefault();

            var ajaxData = {
                url: '/auth/reset',
                type: 'POST',
                data: new FormData(reset),
                beforeSend: function(){
                    reset.classList.add('loading');
                },
                success: function(response) {
                    response = JSON.parse(response);
                    reset.classList.remove('loading');
                    raisoft.core.log(response.message, response.status, corePrefix);

                    raisoft.notification.notify({
                        type: response.status,
                        message: response.message
                    });

                    if (response.code === "15")
                        window.location.reload();

                },
                error: function(callbacks) {
                    raisoft.core.log('ajax error occur on reset form','error',corePrefix,callbacks);
                    reset.classList.remove('loading');
                }
            };

            raisoft.ajax.send(ajaxData);
        });

        cancelReset.addEventListener('click', function () {
           raisoft.cookies.remove('reset_link');
           window.location.reload();
        });

    }



}

document.addEventListener("DOMContentLoaded", ready);