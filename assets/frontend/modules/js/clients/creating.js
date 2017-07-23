module.exports = (function (create) {

    var corePrefix      = 'Clients: creating';

    create.client = function () {

        var form = document.getElementById('addClientModal'),
            formData = new FormData(form);

        formData.append('csrf', document.getElementById('csrf').value);

        var ajaxData = {
            url: '/client/add',
            type: 'POST',
            data: formData,
            beforeSend: function () {

                form.getElementsByClassName('modal__content')[0].classList.add('loading');

            },
            success: function (response) {

                response = JSON.parse(response);
                raicare.core.log(response.message, response.status, corePrefix);
                form.getElementsByClassName('modal__content')[0].classList.remove('loading');

                raicare.notification.notify({
                    type: response.status,
                    message: response.message
                });

                if (parseInt(response.code) === 22 ) {

                    form.reset();
                    raicare.modal.hide(form);
                    window.location.assign('/client/' + response.id);

                }

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on submitting new client form', 'error', corePrefix, callbacks);
                form.getElementsByClassName('modal__content')[0].classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);

    };

    create.user = function () {

        var formData = new FormData();

        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('client_id', document.getElementById('clientId').value);

        var ajaxData = {
            url: '/profile/add',
            type: 'POST',
            data: formData,

            success: function (response) {

                response = JSON.parse(response);
                raicare.core.log(response.message, response.status, corePrefix);


                if (parseInt(response.code) !== 50 ) {

                    raicare.notification.notify({
                        type: response.status,
                        message: response.message
                    });

                } else {

                    window.location.reload();

                }

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on submitting creating new user form', 'error', corePrefix, callbacks);

            }
        };

        raicare.ajax.send(ajaxData);

    };

    create.organization = function () {

        var form = document.getElementById('createOrganizationModal');

        if (!form) {

            raicare.core.log('Не удается найти форму создания организации. Перезагрузите страницу', 'error', corePrefix);
            return;

        }

        var formData = new FormData(form);

        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('userId', document.getElementById('userId').value);

        var ajaxData = {
            url: '/organization/new',
            type: 'POST',
            data: formData,
            beforeSend: function () {

                form.getElementsByClassName('modal__content')[0].classList.add('loading');

            },
            success: function (response) {

                response = JSON.parse(response);
                raicare.core.log(response.message, response.status, corePrefix);
                form.getElementsByClassName('modal__content')[0].classList.remove('loading');

                raicare.notification.notify({
                    type: response.status,
                    message: response.message
                });

                if (parseInt(response.code) === 131 ) {

                    var block                   = raicare.draw.node('LI', 'col-xs-12 col-md-6'),
                        optionForCreatePension  = raicare.draw.node('OPTION', '', {'value': response.id}),
                        organizations           = document.getElementById('organizations'),
                        selectForCreatePension  = document.getElementById('createPensionOrganization');

                    block.innerHTML = response.organization;
                    optionForCreatePension.textContent = response.name;

                    if (organizations.getElementsByTagName('li').length === 0) {

                        organizations.innerHTML = '';
                        organizations.appendChild(block);
                        selectForCreatePension.appendChild(optionForCreatePension);

                    } else {

                        organizations.insertBefore(block, organizations.childNodes[0]);
                        selectForCreatePension.insertBefore(optionForCreatePension, selectForCreatePension.childNodes[0]);

                    }

                    form.reset();
                    raicare.modal.hide(form);

                }

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on submitting new client form', 'error', corePrefix, callbacks);
                form.getElementsByClassName('modal__content')[0].classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);

    };

    create.pension = function () {

        var form = document.getElementById('createPensionModal');

        if (!form) {

            raicare.core.log('Не удается найти форму создания пансионата. Перезагрузите страницу', 'error', corePrefix);
            return;

        }

        var formData = new FormData(form);

        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('userId', document.getElementById('userId').value);

        var ajaxData = {
            url: '/pension/new',
            type: 'POST',
            data: formData,
            beforeSend: function () {

                form.getElementsByClassName('modal__content')[0].classList.add('loading');

            },
            success: function (response) {

                response = JSON.parse(response);
                raicare.core.log(response.message, response.status, corePrefix);
                form.getElementsByClassName('modal__content')[0].classList.remove('loading');

                raicare.notification.notify({
                    type: response.status,
                    message: response.message
                });

                if (parseInt(response.code) === 141 ) {

                    var block    = raicare.draw.node('LI', 'col-xs-12 col-md-6'),
                        pensions = document.getElementById('pensions');

                    block.innerHTML = response.pension;

                    if (pensions.getElementsByTagName('li').length === 0) {

                        pensions.innerHTML = '';
                        pensions.appendChild(block);

                    } else {

                        pensions.insertBefore(block, pensions.childNodes[0]);

                    }

                    form.reset();
                    raicare.modal.hide(form);

                }

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on submitting new client form', 'error', corePrefix, callbacks);
                form.getElementsByClassName('modal__content')[0].classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);

    };

    return create;

})({});