
module.exports = (function (send) {

    var corePrefix  = 'Survey: send AJAX',
        holder      = document.getElementsByClassName('section__content')[0],
        pensionID   = document.getElementById('pensionID').value;

    send.unit = function (unit) {

    };

    send.newpatientform = function () {

        var form = document.getElementById('newPatientModalForm'),
            formData = new FormData(form);

        formData.append('pension', pensionID);
        formData.append('csrf', document.getElementById('csrf').value);

        var ajaxData = {
            url: '/patient/new',
            type: 'POST',
            data: formData,
            beforeSend: function () {

                form.getElementsByClassName('modal__wrapper')[0].classList.add('loading');

            },
            success: function (response) {

                response = JSON.parse(response);
                raisoft.core.log(response.message, response.status, corePrefix);
                form.getElementsByClassName('modal__wrapper')[0].classList.remove('loading');

                raisoft.notification.notify({
                    type: response.status,
                    message: response.message
                });

                if (parseInt(response.code) === 151 ) {

                    raisoft.modal.hide(form);
                    window.location.assign('?id=' + response.id);

                }

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on sending new patient form', 'error', corePrefix, callbacks);
                form.getElementsByClassName('modal__wrapper')[0].classList.remove('loading');

            }
        };

        raisoft.ajax.send(ajaxData);

    };

    return send;

})({});