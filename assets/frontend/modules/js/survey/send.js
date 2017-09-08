module.exports = (function (send) {

    var corePrefix  = 'Survey: send AJAX',
        surveyID    = document.getElementById('surveyID'),
        pensionID   = document.getElementById('pensionID');

    if(surveyID) surveyID= surveyID.value;
    if(pensionID) pensionID = pensionID.value;

    send.updateunit = function (unit) {

        var form = document.getElementById(unit);

        if (!form) return;

        var formData = new FormData(form);

        formData.append('unit', unit);
        formData.append('survey', surveyID);
        formData.append('pension', pensionID);
        formData.append('csrf', document.getElementById('csrf').value);

        var ajaxData = {
            url: '/survey/updateunit',
            type: 'POST',
            data: formData,
            beforeSend: function () {

                form.getElementsByClassName('form')[0].classList.add('loading');

            },
            success: function (response) {

                response = JSON.parse(response);
                raicare.core.log(response.message, response.status, corePrefix);
                form.getElementsByClassName('form')[0].classList.remove('loading');

                raicare.notification.notify({
                    type: response.status,
                    message: response.message
                });

                if (parseInt(response.code) === 169) {

                    window.location.reload();

                }

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on updating unit data', 'error', corePrefix, callbacks);
                form.getElementsByClassName('form')[0].classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);

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
                raicare.core.log(response.message, response.status, corePrefix);
                form.getElementsByClassName('modal__wrapper')[0].classList.remove('loading');

                raicare.notification.notify({
                    type: response.status,
                    message: response.message
                });

                if (parseInt(response.code) === 151 ) {

                    raicare.modal.hide(form);
                    window.location.assign('survey/' + response.id);

                }

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on sending new patient form', 'error', corePrefix, callbacks);
                form.getElementsByClassName('modal__wrapper')[0].classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);

    };

    send.newpatientformwithtype = function (element) {

        var formData = new FormData(),
            patient  = element.dataset.pk,
            typeArea = element.dataset.area,
            type     = document.getElementById(typeArea).getElementsByClassName('js-form-type')[0].value,
            form     = element.parentNode;

        if (type === '') {

            raicare.notification.notify({
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
            url: '/survey/new',
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

                if (parseInt(response.code) === 161 ) {

                    window.location.assign('survey/' + response.id);

                }

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on sending new patient form', 'error', corePrefix, callbacks);
                form.classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);

    };

    send.complete = function () {

        var form     = document.body,
            formData = new FormData();

        formData.append('survey', surveyID);
        formData.append('pension', pensionID);
        formData.append('csrf', document.getElementById('csrf').value);

        var ajaxData = {
            url: '/survey/complete',
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

                if (parseInt(response.code) === 169) {

                    window.location.reload();

                }

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on sending complete survey', 'error', corePrefix, callbacks);
                form.classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);

    };

    return send;

})({});