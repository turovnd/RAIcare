module.exports = (function (status) {

    var corePrefix  = 'Clients: statuss',
        formData    = null;

    status.accept = function () {

        formData = new FormData();
        formData.append('id', document.getElementById('clientId').value);
        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('status', 'accept');
        sendRequest_();

    };

    status.reject = function () {

        formData = new FormData();
        formData.append('id', document.getElementById('clientId').value);
        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('status', 'reject');
        sendRequest_();

    };

    status.reestablish = function () {

        formData = new FormData();
        formData.append('id', document.getElementById('clientId').value);
        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('status', 'reestablish');
        sendRequest_();

    };

    status.delete = function () {

        formData = new FormData();
        formData.append('id', document.getElementById('clientId').value);
        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('status', 'delete');
        sendRequest_();

    };


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

                if (parseInt(response.code) === 24) {

                    document.getElementsByClassName('section')[0].innerHTML = response.view;

                }

                formData = null;

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on changing client status', 'error', corePrefix, callbacks);
                form.classList.remove('loading');

            }
        };

        raisoft.ajax.send(ajaxData);

    }

    return status;

})({});