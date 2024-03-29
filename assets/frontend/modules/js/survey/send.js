module.exports = (function (send) {

    var corePrefix  = 'Survey: send AJAX',
        surveyPK    = document.getElementById('surveyPK'),
        patientPK   = document.getElementById('patientPK'),
        pensionID   = document.getElementById('pensionID'),
        pensionURI  = document.getElementById('pensionURI');

    if(surveyPK) surveyPK= surveyPK.value;
    if(pensionID) pensionID = pensionID.value;
    if(pensionURI) pensionURI = pensionURI.value;
    if(patientPK) patientPK = patientPK.value;

    send.updateunit = function (unit) {

        var form = document.getElementById(unit);

        if (!form) return;

        var formData = new FormData(form);

        formData.append('unit', unit);
        formData.append('survey', surveyPK);
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

    send.complete = function () {

        var form     = document.body,
            formData = new FormData();

        formData.append('survey', surveyPK);
        formData.append('pension', pensionID);
        formData.append('patient', patientPK);
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

                    window.location.assign('/' + pensionURI + '/patient/' + response.id + '/status');

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