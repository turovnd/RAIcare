module.exports = (function (newpatient) {

    var corePrefix  = 'Patient: new',
        pensionID   = null,
        form        = null;

    newpatient.init = function () {

        pensionID   = document.getElementById('pensionID').value;
        form        = document.getElementById('newPatientModalForm');

        if (form)
            form.addEventListener('submit', create_);

    };


    function create_(event) {

        event.preventDefault();

        var formData = new FormData(form);

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

    return newpatient;

})({});