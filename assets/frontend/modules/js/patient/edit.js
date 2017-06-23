module.exports = (function (edit) {

    var corePrefix  = 'Patient: edit info';

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

            for (var i = 0; i < checked.length; i++) {

                input.push(checked[i].value);

            }

            input = JSON.stringify(input);

        }

        formData.append('id', document.getElementById('patientID').value);
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
                raisoft.core.log(response.message, response.status, corePrefix);
                form.classList.remove('loading');

                raisoft.notification.notify({
                    type: response.status,
                    message: response.message
                });


                if (parseInt(response.code) === 153 ) {

                    if (name === 'birthday') {

                        var date = new Date(input);

                        field.getElementsByClassName('js-patient-info')[0].textContent = date.getDate() + '-' + date.getMonth() + '-' + date.getFullYear();

                    } else if (name === 'sex') {

                        field.getElementsByClassName('js-patient-info')[0].textContent = input === 1 ? 'мужской' : 'женский';

                    } else if (name === 'relation') {

                        field.getElementsByClassName('js-patient-info')[0].textContent = field.getElementsByClassName('form-group__control-group')[0].getElementsByTagName('option')[input - 1].textContent;

                    } else if (name === 'sources') {

                        var checkboxes = field.getElementsByClassName('form-group__control-group')[0].getElementsByClassName('checkbox-label'),
                            selected   = JSON.parse(input),
                            outstr     = '';

                        for (var i = 0; i < selected.length; i++) {

                            outstr += '<li>' + checkboxes[selected[i]-1].textContent + '</li>';

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

                raisoft.core.log('ajax error occur on updating patient info', 'error', corePrefix, callbacks);
                form.classList.remove('loading');

            }
        };

        raisoft.ajax.send(ajaxData);

    };


    return edit;

})({});