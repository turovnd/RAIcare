var profile = ( function (profile) {

    var corePrefix  = 'RAIcare: profile';

    profile.toggle = function (element) {

        var field = element.closest('.js-field-name');

        field.getElementsByClassName('form-group__control-static')[0].classList.toggle('hide');
        field.getElementsByClassName('form-group__control-group')[0].classList.toggle('hide');

    };

    profile.save = function (element) {

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
                raicare.core.log(response.message, response.status, corePrefix);
                form.classList.remove('loading');

                raicare.notification.notify({
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

                raicare.core.log('ajax error occur on updating profile info', 'error', corePrefix, callbacks);
                form.classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);

    };

    profile.sendConfirm = function () {

        var form     = document.getElementById('profile'),
            formData = new FormData();

        formData.append('csrf', document.getElementById('csrf').value);

        var ajaxData = {
            url: '/profile/confirmemail',
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

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on sending confirm email', 'error', corePrefix, callbacks);
                form.classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);
    };

    profile.changepassword = function () {

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

            raicare.notification.notify({
                type: 'error',
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


                if (parseInt(response.code) === 57 ) {

                    form.reset();
                    raicare.modal.hide(form);

                }

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on updating profile info', 'error', corePrefix, callbacks);
                form.getElementsByClassName('modal__wrapper')[0].classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);

    };

    return profile;

})({});