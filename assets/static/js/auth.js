var auth = ( function (auth) {

    var corePrefix   = "RAIcare auth",
        host         = window.location.host,
        protocol     = window.location.protocol,
        pathname     = window.location.pathname,
        signInLogged = document.getElementById('signinLogged'),
        signIn       = document.getElementById('signin'),
        forget       = document.getElementById('forget'),
        reset        = document.getElementById('reset');

    if (signInLogged) {
        signInLogged.addEventListener('submit', submitSignInLogged_);
        document.getElementById('signinLoggedCancel').addEventListener('click', submitSignInLoggedCancel_)
    }

    if (reset) {
        reset.addEventListener('submit', submitReset_);
        document.getElementById('resetCancel').addEventListener('click', submitResetCancel_)
    }

    if (forget && signIn)  {
        signIn.addEventListener('submit', submitSignIn_);
        forget.addEventListener('submit', submitForget_);
    }


    function submitSignIn_(event) {
        event.preventDefault();

        var ajaxData = {
            url: 'auth/signin',
            type: 'POST',
            data: new FormData(signIn),
            beforeSend: function () {
                signIn.classList.add('loading');
            },
            success: function (response) {
                response = JSON.parse(response);
                signIn.classList.remove('loading');
                raicare.core.log(response.message, response.status, corePrefix);

                if (parseInt(response.code) === 11) {
                    window.location = protocol + '//' + response.org + '.' + host + '/dashboard';
                    return;
                }

                raicare.notification.notify({
                    type: response.status,
                    message: response.message
                });
            },
            error: function (callbacks) {
                raicare.core.log('ajax error occur on signIn form', 'error', corePrefix, callbacks);
                signIn.classList.add('loading');
            }
        };

        raicare.ajax.send(ajaxData);
    }


    function submitSignInLogged_(event) {
        event.preventDefault();

        var ajaxData = {
            url: 'auth/signinrecover',
            type: 'POST',
            data: new FormData(signInLogged),
            beforeSend: function () {
                signInLogged.classList.add('loading');
            },
            success: function (response) {
                response = JSON.parse(response);
                signInLogged.classList.remove('loading');
                raicare.core.log(response.message, response.status, corePrefix);

                if (parseInt(response.code) === 13) {
                    window.location = protocol + '//' + response.org + '.' + host + '/dashboard';
                    return;
                }

                raicare.notification.notify({
                    type: response.status,
                    message: response.message
                });
            },
            error: function (callbacks) {
                raicare.core.log('ajax error occur on signInLogged form', 'error', corePrefix, callbacks);
                signInLogged.classList.add('loading');
            }
        };

        raicare.ajax.send(ajaxData);
    }


    function submitSignInLoggedCancel_(event) {
        event.preventDefault();

        var ajaxData = {
            url: 'auth/signinrecovercancel',
            type: 'POST',
            data: new FormData(signInLogged),
            beforeSend: function () {
                signInLogged.classList.add('loading');
            },
            success: function (response) {
                response = JSON.parse(response);
                signInLogged.classList.remove('loading');

                if (parseInt(response.code) === 14) {
                    window.location.reload();
                }
            },
            error: function (callbacks) {
                raicare.core.log('ajax error occur on signInLoggedCancel form', 'error', corePrefix, callbacks);
                signInLogged.classList.add('loading');
            }
        };

        raicare.ajax.send(ajaxData);
    }


    function submitForget_(event) {
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
                raicare.core.log(response.message, response.status, corePrefix);

                raicare.notification.notify({
                    type: response.status,
                    message: response.message
                });

                if (parseInt(response.code) === 62)
                    forget.reset();

            },
            error: function(callbacks) {
                raicare.core.log('ajax error occur on forget form','error',corePrefix,callbacks);
                forget.classList.remove('loading');
            }
        };

        raicare.ajax.send(ajaxData);
    }


    function submitReset_(event) {
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
                raicare.core.log(response.message, response.status, corePrefix);

                if (parseInt(response.code) === 56) {
                    window.location = protocol + '//' + host + '/dashboard';
                    return;
                }

                raicare.notification.notify({
                    type: response.status,
                    message: response.message
                });
            },
            error: function(callbacks) {
                raicare.core.log('ajax error occur on reset form','error',corePrefix,callbacks);
                reset.classList.remove('loading');
            }
        };

        raicare.ajax.send(ajaxData);
    }


    function submitResetCancel_() {
        event.preventDefault();

        var ajaxData = {
            url: '/auth/resetcancel',
            type: 'POST',
            data: new FormData(reset),
            beforeSend: function(){
                reset.classList.add('loading');
            },
            success: function(response) {
                response = JSON.parse(response);
                reset.classList.remove('loading');
                raicare.core.log(response.message, response.status, corePrefix);

                if (parseInt(response.code) === 57) {
                    window.setTimeout(function () {
                        window.location.reload();
                    }, 500);
                }

                raicare.notification.notify({
                    type: response.status,
                    message: response.message
                });
            },
            error: function(callbacks) {
                raicare.core.log('ajax error occur on resetcancel form','error',corePrefix,callbacks);
                reset.classList.remove('loading');
            }
        };

        raicare.ajax.send(ajaxData);
    }


    auth.openSignIn = function () {
        signIn.classList.remove('hide');
        forget.classList.add('hide');
    };

    auth.openReset = function () {
        signIn.classList.add('hide');
        forget.classList.remove('hide');
    };

    return auth;

})({});