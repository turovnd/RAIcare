module.exports = (function (edit) {

    var corePrefix  = 'Patient: edit info', i;

    edit.toggle = function (element) {

        var field = element.closest('.js-field-name');

        field.getElementsByClassName('form-group__control-static')[0].classList.toggle('hide');
        field.getElementsByClassName('form-group__control-group')[0].classList.toggle('hide');

    };

    edit.save = function (element) {

        var form     = document.getElementById('patientInfo'),
            field    = element.closest('.js-field-name'),
            input    = field.getElementsByClassName('form-group__control')[0].value,
            name     = field.getElementsByClassName('form-group__control')[0].name,
            formData = new FormData();

        if (name === 'sources') {

            input = [];
            var checked = field.querySelectorAll('.checkbox:checked');

            for (i = 0; i < checked.length; i++) {

                input.push(checked[i].value);

            }

            input = JSON.stringify(input);

        }

        formData.append('pk', document.getElementById('patientPK').value);
        formData.append('pension', document.getElementById('pensionID').value);
        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('name', name);
        formData.append('value', input);

        var ajaxData = {
            url: '/patient/update',
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


                if (parseInt(response.code) === 153 ) {

                    if (name === 'birthday') {

                        var date = new Date(input);

                        field.getElementsByClassName('js-patient-info')[0].textContent = date.getDate() + ' ' + getMonth(date) + ' ' + date.getFullYear();

                    } else if (name === 'sex') {

                        field.getElementsByClassName('js-patient-info')[0].innerHTML = (parseInt(input) === 1 ? '<i class="fa fa-male" aria-hidden="true"></i> мужской' : '<i class="fa fa-female" aria-hidden="true"></i> женский');

                    } else if (name === 'relation') {

                        field.getElementsByClassName('js-patient-info')[0].textContent = field.getElementsByClassName('form-group__control-group')[0].getElementsByTagName('option')[0].textContent;

                    } else if (name === 'sources') {

                        var checkboxes = field.getElementsByClassName('form-group__control-group')[0].getElementsByClassName('checkbox-label'),
                            selected   = JSON.parse(input),
                            outstr     = '';

                        for (i = 0; i < selected.length; i++) {

                            outstr += '<li class="p-b-5">' + checkboxes[selected[i]-1].textContent + '</li>';

                        }

                        field.getElementsByClassName('js-patient-info')[0].innerHTML = outstr;

                    } else {

                        field.getElementsByClassName('js-patient-info')[0].textContent = input;

                    }

                    field.getElementsByClassName('form-group__control-static')[0].classList.toggle('hide');
                    field.getElementsByClassName('form-group__control-group')[0].classList.toggle('hide');

                }

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on updating patient info', 'error', corePrefix, callbacks);
                form.classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);

    };

    function getMonth(date) {

        switch (date.getMonth() + 1) {
            case 1: return 'января';
            case 2: return 'февраля';
            case 3: return 'марта';
            case 4: return 'апреля';
            case 5: return 'мая';
            case 6: return 'июня';
            case 7: return 'июля';
            case 8: return 'августа';
            case 9: return 'сентября';
            case 10: return 'октября';
            case 11: return 'ноября';
            case 12: return 'декабря';
        }

    }


    return edit;

})({});