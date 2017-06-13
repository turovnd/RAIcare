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
                raisoft.core.log(response.message, response.status, corePrefix);
                form.getElementsByClassName('modal__content')[0].classList.remove('loading');

                raisoft.notification.notify({
                    type: response.status,
                    message: response.message
                });

                if (parseInt(response.code) === 22 ) {

                    var client = raisoft.draw.node('DIV', 'item clear-fix', {id: 'client_' + response.id});

                    client.innerHTML = '<a href="/client/' + response.id + '" class="col-xs-3 col-sm-2 col-lg-1 text-center">' +
                        '<i class="fa fa-id-card-o fa-4x" aria-hidden="true"></i></a>'+
                        '<ul class="col-xs-9 col-sm-10 col-lg-11 list-style--none">'+
                        '<li class="item__text col-xs-12">'+
                        '<div class="col-xs-12 col-sm-3 col-md-2 text-bold">Имя</div>'+
                        '<div class="col-xs-12 col-sm-9 col-md-10 item__search-text">' + document.getElementById('addClientName').value + '</div>'+
                        '</li>'+
                        '<li class="item__text col-xs-12">'+
                        '<div class="col-xs-12 col-sm-3 col-md-2 text-bold">Эл. почта</div>'+
                        '<div class="col-xs-12 col-sm-9 col-md-10">' + document.getElementById('addClientEmail').value + '</div>'+
                        '</li>'+
                        '<li class="item__text col-xs-12">'+
                        '<div class="col-xs-12 col-sm-3 col-md-2 text-bold">Телефон</div>'+
                        '<div class="col-xs-12 col-sm-9 col-md-10">' + document.getElementById('addClientPhone').value + '</div>'+
                        '</li>' +
                        '</ul>';

                    if (document.getElementById('withoutAccessClients').childElementCount === 0) {

                        document.getElementById('withoutAccessClients').appendChild(client);

                    } else {

                        document.getElementById('withoutAccessClients').insertBefore(client, document.getElementById('withoutAccessClients').childNodes[0]);

                    }

                    document.getElementById('withoutAccessClientsCounter').textContent = parseInt(document.getElementById('withoutAccessClientsCounter').textContent) + 1;

                    form.reset();
                    raisoft.modal.hide(form);

                }

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on submitting new client form', 'error', corePrefix, callbacks);
                form.getElementsByClassName('modal__content')[0].classList.remove('loading');

            }
        };

        raisoft.ajax.send(ajaxData);

    };

    create.user = function () {

        var formData = new FormData();

        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('client_id', document.getElementById('clientId').value);

        var ajaxData = {
            url: '/user/add',
            type: 'POST',
            data: formData,

            success: function (response) {

                response = JSON.parse(response);
                raisoft.core.log(response.message, response.status, corePrefix);


                raisoft.notification.notify({
                    type: response.status,
                    message: response.message
                });

                if (parseInt(response.code) === 29 ) {

                    window.setTimeout(function () {

                        window.location.reload();

                    }, 100);

                }

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on submitting creating new user form', 'error', corePrefix, callbacks);

            }
        };

        raisoft.ajax.send(ajaxData);

    };

    create.organization = function (id) {

        var form = document.getElementById(id);

        if (!form) {

            raisoft.core.log('Не удается найти форму создания организации. Перезагрузте страницу', 'error', corePrefix);
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
                raisoft.core.log(response.message, response.status, corePrefix);
                form.getElementsByClassName('modal__content')[0].classList.remove('loading');

                raisoft.notification.notify({
                    type: response.status,
                    message: response.message
                });

                if (parseInt(response.code) === 131 ) {

                    var block                   = raisoft.draw.node('LI', ''),
                        optionForCreatePension  = raisoft.draw.node('OPTION', '', {'value': response.id}),
                        organizations           = document.getElementById('organizations'),
                        selectForCreatePension  = document.getElementById('createPensionOrganization');

                    block.innerHTML = response.organization;
                    optionForCreatePension.textContent = response.name;

                    if (organizations.childElementCount === 1) {

                        organizations.innerHTML = '';
                        organizations.appendChild(block);
                        selectForCreatePension.appendChild(optionForCreatePension);

                    } else {

                        organizations.insertBefore(block, organizations.childNodes[0]);
                        selectForCreatePension.insertBefore(optionForCreatePension, selectForCreatePension.childNodes[0]);

                    }

                    form.reset();
                    raisoft.modal.hide(form);

                }

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on submitting new client form', 'error', corePrefix, callbacks);
                form.getElementsByClassName('modal__content')[0].classList.remove('loading');

            }
        };

        raisoft.ajax.send(ajaxData);

    };

    create.pension = function (id) {

        var form = document.getElementById(id);

        if (!form) {

            raisoft.core.log('Не удается найти форму создания пансионата. Перезагрузте страницу', 'error', corePrefix);
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
                raisoft.core.log(response.message, response.status, corePrefix);
                form.getElementsByClassName('modal__content')[0].classList.remove('loading');

                raisoft.notification.notify({
                    type: response.status,
                    message: response.message
                });

                if (parseInt(response.code) === 141 ) {

                    var block    = raisoft.draw.node('LI', ''),
                        pensions = document.getElementById('pensions');

                    block.innerHTML = response.organization;

                    if (pensions.childElementCount === 1) {

                        pensions.innerHTML = '';
                        pensions.appendChild(block);

                    } else {

                        pensions.insertBefore(block, pensions.childNodes[0]);

                    }

                    form.reset();
                    raisoft.modal.hide(form);

                }

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on submitting new client form', 'error', corePrefix, callbacks);
                form.getElementsByClassName('modal__content')[0].classList.remove('loading');

            }
        };

        raisoft.ajax.send(ajaxData);

    };

    return create;

})({});