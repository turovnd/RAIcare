module.exports = (function (edit) {

    var corePrefix  = 'Profile: edit info';

    edit.open = function (element) {

        var field = element.closest('.js-field-name');

        field.getElementsByClassName('form-group__control-static')[0].classList.toggle('hide');
        field.getElementsByClassName('form-group__control-group')[0].classList.toggle('hide');

    };

    edit.save = function (element) {

        var form     = document.getElementById('profile'),
            field    = element.closest('.js-field-name'),
            input    = field.getElementsByClassName('form-group__control')[0].value,
            name     = field.getElementsByClassName('form-group__control')[0].name,
            formData = new FormData();

        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('name', name);
        formData.append('value', input);

        var ajaxData = {
            url: '/profile/update',
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


                if (parseInt(response.code) === 53 ) {

                    field.getElementsByClassName('js-profile-info')[0].textContent = input;
                    field.getElementsByClassName('form-group__control-static')[0].classList.toggle('hide');
                    field.getElementsByClassName('form-group__control-group')[0].classList.toggle('hide');

                }

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on updating profile info', 'error', corePrefix, callbacks);
                form.classList.remove('loading');

            }
        };

        raisoft.ajax.send(ajaxData);

    };

    edit.password = function () {

        var form     = document.getElementById('changePasswordModal'),
            formData = new FormData(form),
            message  = null;

        if (formData.get('oldpassword') === '') {

            message = 'Не указан старый пароль';

        } else if (formData.get('newpassword') === '') {

            message = 'Не указан новый пароль';

        } else if (formData.get('oldpassword') === formData.get('newpassword')) {

            message = 'Старый и новый пароли одинаковые';

        }  else if (formData.get('newpassword') !== formData.get('newpassword2')) {

            message = 'Пароли не совпадают';

        }
        console.log(formData.get('newpassword') !== formData.get('newpassword2'), formData.get('newpassword'), formData.get('newpassword2'));
        if (message !== null) {

            raisoft.notification.notify({
                type: 'warning',
                message: message
            });
            return;

        }

        formData.append('csrf', document.getElementById('csrf').value);

        var ajaxData = {
            url: '/profile/updatepassword',
            type: 'POST',
            data: formData,
            beforeSend: function () {

                form.getElementsByClassName('modal__content')[0].classList.add('loading');

            },
            success: function (response) {

                response = JSON.parse(response);
                raisoft.core.log(response.message, response.status, corePrefix);
                form.getElementsByClassName('modal__content')[0].classList.remove('loading');

                raisoft.notification.notify({
                    type: response.status,
                    message: response.message
                });


                if (parseInt(response.code) === 57 ) {

                    form.reset();
                    raisoft.modal.hide(form);

                }

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on updating profile info', 'error', corePrefix, callbacks);
                form.getElementsByClassName('modal__content')[0].classList.remove('loading');

            }
        };

        raisoft.ajax.send(ajaxData);

    };

    return edit;

})({});