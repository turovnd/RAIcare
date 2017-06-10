module.exports = (function (request) {

    var corePrefix  = 'RAIsoft clients',
        formData    = null;

    function prepare_() {

        var acceptBtn       = document.getElementsByClassName('js-request-accept')[0],
            rejectBtn       = document.getElementsByClassName('js-request-reject')[0];

        if (acceptBtn)
            acceptBtn.addEventListener('click', acceptApplication_);

        if (rejectBtn)
            rejectBtn.addEventListener('click', rejectApplication_);

        formData = new FormData();

        formData.append('id', document.getElementById('clientId').value);
        formData.append('csrf', document.getElementById('csrf').value);

    }

    function acceptApplication_() {

        formData.append('status', 'accept');
        sendRequest_();

    }

    function rejectApplication_() {

        formData.append('status', 'reject');
        sendRequest_();

    }


    function sendRequest_() {

        var form = document.getElementById('application');

        var ajaxData = {
            url: '/client/changestatus',
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

                window.setTimeout(function () {

                    if (parseInt(response.code) === 24 ) {

                        window.location.reload();

                    }

                    if (parseInt(response.code) === 25 ) {

                        window.history.back();

                    }

                }, 1000);

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on submitting application form', 'error', corePrefix, callbacks);
                form.classList.remove('loading');

            }
        };

        raisoft.ajax.send(ajaxData);

    }

    request.init = function () {

        prepare_();

    };

    return request;

})({});