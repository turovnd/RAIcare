
module.exports = (function (send) {

    var corePrefix  = 'Survey: send AJAX',
        holder      = document.getElementsByClassName('section__content')[0],
        pensionID   = document.getElementById('pensionID');

    if(pensionID) pensionID = pensionID.value;


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
                    window.location.assign('survey?id=' + response.id);

                }

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on sending new patient form', 'error', corePrefix, callbacks);
                form.getElementsByClassName('modal__wrapper')[0].classList.remove('loading');

            }
        };

        raisoft.ajax.send(ajaxData);

    };

    send.newpatientformwithtype = function (element) {

        var formData = new FormData(),
            patient  = element.dataset.pk,
            typeArea = element.dataset.area,
            type     = document.getElementById(typeArea).getElementsByClassName('js-form-type')[0].value,
            form     = element.parentNode;

        if (type === '') {

            raisoft.notification.notify({
                type: 'error',
                message: 'Пожалуйста выберите причина прохождения оценки пациентом'
            });
            return;

        }

        formData.append('pension', pensionID);
        formData.append('patient', patient);
        formData.append('type', type);
        formData.append('csrf', document.getElementById('csrf').value);

        var ajaxData = {
            url: '/forms/longterm/create',
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

                if (parseInt(response.code) === 161 ) {

                    window.location.assign('survey?id=' + response.id);

                }

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on sending new patient form', 'error', corePrefix, callbacks);
                form.classList.remove('loading');

            }
        };

        raisoft.ajax.send(ajaxData);

    };


    return send;

})({});