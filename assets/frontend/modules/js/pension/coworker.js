module.exports = (function (coworker) {

    var corePrefix   = 'Pension: coworker',
        penID        = document.getElementById('pensionID').value,
        excludeBlock = null;

    coworker.toggle = function (element) {

        var field = element.closest('.js-field-name');

        field.getElementsByClassName('form-group__control-static')[0].classList.toggle('hide');
        field.getElementsByClassName('form-group__control-group')[0].classList.toggle('hide');

    };

    coworker.save = function (element) {

        var form     = element.closest('.block'),
            field    = element.closest('.js-field-name'),
            value    = field.getElementsByClassName('form-group__control')[0].value,
            name     = field.getElementsByClassName('form-group__control')[0].name,
            formData = new FormData();

        formData.append('id', form.dataset.id);
        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('name', name);
        formData.append('value', value);
        formData.append('penID', penID);

        var ajaxData = {
            url: '/pension/coworkerupdate',
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

                    if (name === 'role') {

                        window.location.reload();

                    } else {

                        field.getElementsByClassName('js-co-worker-info')[0].textContent = value;

                    }

                    field.getElementsByClassName('form-group__control-static')[0].classList.toggle('hide');
                    field.getElementsByClassName('form-group__control-group')[0].classList.toggle('hide');

                }

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on updating co-worker info', 'error', corePrefix, callbacks);
                form.classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);

    };

    coworker.changePass = function (element) {

        var form     = element.closest('.block'),
            name     = 'password',
            formData = new FormData();

        formData.append('id', form.dataset.id);
        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('name', name);
        formData.append('penID', penID);

        var ajaxData = {
            url: '/pension/coworkerupdate',
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

                }

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on updating co-worker password', 'error', corePrefix, callbacks);
                form.classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);

    };

    coworker.invite = function () {

        var form     = document.getElementById('newCoWorker'),
            formData = new FormData(form);

        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('penID', penID);

        var ajaxData = {
            url: '/pension/coworkerinvite',
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

                if (parseInt(response.code) === 144 ) {

                    form.reset();
                    raicare.modal.hide(form);

                }

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on inviting coworker', 'error', corePrefix, callbacks);
                form.getElementsByClassName('modal__wrapper')[0].classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);

    };

    coworker.exclude = function (element) {

        var block = element.closest('.block'),
            id    = block.dataset.id,
            name  = block.dataset.name;

        excludeBlock = raicare.notification.notify({
            type: 'confirm',
            message:
                '<form id="excludeForm" data-id="' + id + '">' +
                '<h2>Исключить сотрудника</h2>'+
                '<p>Вы уверены, то хотите исключить ' + name + '?</p>'+
                '<p>Исключив сотрудника, у него больше не будет доступа к пансионату.</p>'+
                '</form>',
            confirmText: 'Исключить',
            showCancelButton: true,
            validation: true,
            confirm: exclude_
        });

    };

    function exclude_() {

        var form     = document.getElementById('excludeForm'),
            formData = new FormData();

        formData.append('user', form.dataset.id);
        formData.append('penID', penID);
        formData.append('csrf', document.getElementById('csrf').value);

        var ajaxData = {
            url: '/pension/coworkerexclude',
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

                if (parseInt(response.code) === 143 ) {

                    excludeBlock.close();
                    document.getElementById('coWorkers').querySelector('.block[data-id="' + form.dataset.id + '"]').remove();

                }

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on excluding coworker', 'error', corePrefix, callbacks);
                form.classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);

    }

    return coworker;

})({});