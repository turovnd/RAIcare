module.exports = (function (newsurvey) {

    var corePrefix  = 'Survey: new',
        pensionID   = null,
        selectField = null,
        patientPK   = null;


    newsurvey.init = function () {

        pensionID   = document.getElementById('pensionID');
        selectField = document.getElementById('surveyReasonOptions');

        if (pensionID)
            pensionID = pensionID.value;

        if (selectField)
            selectField = selectField.dataset.html;

    };

    newsurvey.createModal = function (element) {

        patientPK = element.dataset.pk;
        raicare.modal.create({
            node: 'FORM',
            id: 'newSurveyModalForm',
            header: 'Причина прохождения оценки',
            body:
                '<div class="row">' +
                    '<label for="surveyReason" class="col-xs-12 form-group__label">' +
                        'Укажите причину прохождения анкетирования' +
                    '</label>' +
                    '<div class="col-xs-12">' +
                        '<select id="surveyReason" name="type" class="form-group__control js-single-select">' +
                            '<option value="-1" disabled selected>Не выбрано</option>' +
                            selectField +
                        '</select>' +
                    '</div>' +
                '</div>' +
                '<button type="submit" class="btn btn--lg btn--brand fl_r m-t-20 m-r-0">Создать</button>',
            onclose: 'remove'
        });

        raicare.select.init();

        document.getElementById('newSurveyModalForm').addEventListener('submit', createWithType_);

    };

    function createWithType_(event) {

        event.preventDefault();

        var form     = document.getElementById('newSurveyModalForm'),
            formData = new FormData(form);

        formData.append('pension', pensionID);
        formData.append('patient', patientPK);
        formData.append('csrf', document.getElementById('csrf').value);

        var ajaxData = {
            url: '/survey/new',
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

                if (parseInt(response.code) === 161 ) {

                    window.location.assign('survey/' + response.id);

                }

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on sending new patient form', 'error', corePrefix, callbacks);
                form.getElementsByClassName('modal__wrapper')[0].classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);

    }

    return newsurvey;

})({});