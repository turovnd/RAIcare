module.exports = (function (coworker) {

    var corePrefix   = 'Org: coworker',
        orgID        = document.getElementById('organizationID').value,
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
        formData.append('orgID', orgID);

        var ajaxData = {
            url: '/organization/coworkerupdate',
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
        formData.append('orgID', orgID);

        var ajaxData = {
            url: '/organization/coworkerupdate',
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

    coworker.pensionEdit = function (element) {

        var allPensions      = JSON.parse(element.dataset.allpensions),
            coWorkerPensions = JSON.parse(element.dataset.coworkerpensions);

        raicare.modal.create({
            id: 'pensionEditModal',
            header: 'Радактирование пансионатов',
            onclose: 'remove',
            body:
            '<div class="p-b-5">'+
                '<p class="text-bold">Выберите пансионаты, к которым имеет доступ сотрудник</p>'+
            '</div>'+

            getPensions_(allPensions, coWorkerPensions),

            footer:
                '<button type="button" class="btn btn--default" data-close="modal">Отмена</button>'+
                '<button onclick="organization.coworker.pensionSave()" type="button" class="btn btn--brand">Изменить</button>'
        });

        document.getElementById('pensionEditModal').getElementsByClassName('modal__wrapper')[0].dataset.id = element.closest('.block').dataset.id;

    };

    coworker.pensionSave = function () {

        var form     = document.getElementById('pensionEditModal'),
            formData = new FormData();

        if (!form) raicare.core.log('pensionEditModal not found in DOM', 'error', corePrefix);
        else form = form.getElementsByClassName('modal__wrapper')[0];

        formData.append('id', form.dataset.id);
        formData.append('orgID', orgID);
        formData.append('csrf', document.getElementById('csrf').value);

        var pensions = form.querySelectorAll('input:checked'),
            pensionsArr = [];

        for (var i = 0; i < pensions.length; i++) {

            pensionsArr.push(pensions[i].value);

        }

        formData.append('pensions', JSON.stringify(pensionsArr));

        var ajaxData = {
            url: '/organization/coworkerpensions',
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


                if (parseInt(response.code) === 147 ) {

                    var block = document.getElementById('coWorkers').querySelector('.block[data-id="' + form.dataset.id + '"]'),
                        btn   = block.getElementsByClassName('coWorkerPensions__btn')[0],
                        ul    = block.getElementsByClassName('coWorkerPensions__menu')[0],
                        out   = '';

                    btn.dataset.coworkerpensions = JSON.stringify(pensionsArr);

                    for (var j = 0; j < pensions.length; j++) {

                        out += '<li class="p-5">' + pensions[j].dataset.name +'</li>';

                    }
                    console.log(block, ul);
                    ul.innerHTML = out;
                    raicare.modal.remove(document.getElementById('pensionEditModal'));

                }

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on updating pensions info', 'error', corePrefix, callbacks);
                form.classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);

    };

    function getPensions_(all, selected) {

        var out = '';

        for (var i = 0; i < all.length; i++ ) {

            if (selected.indexOf(all[i]['id']) !== -1) {

                out +=
                    '<fieldset>'+
                        '<div class="form-group">'+
                            '<input id="coWorkerPension' + i + '" name="pensions[]" type="checkbox" class="checkbox" value="' + all[i]['id'] + '" checked data-name="' + all[i]['name'] + '">' +
                            '<label for="coWorkerPension' + i + '" class="checkbox-label">' + all[i]['name'] + '</label>'+
                        '</div>'+
                    '</fieldset>';

            } else {

                out +=
                    '<fieldset>'+
                        '<div class="form-group">'+
                            '<input id="coWorkerPatient' + i + '" name="patients" type="checkbox" class="checkbox" value="' + all[i]['id'] + '" data-name="' + all[i]['name'] + '">' +
                            '<label for="coWorkerPatient' + i + '" class="checkbox-label">' + all[i]['name'] + '</label>'+
                        '</div>'+
                    '</fieldset>';

            }

        }
        return out;

    }

    coworker.invite = function () {

        var form     = document.getElementById('newCoWorker'),
            formData = new FormData(form);

        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('orgID', orgID);

        var ajaxData = {
            url: '/organization/coworkerinvite',
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

                if (parseInt(response.code) === 134 ) {

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
                    '<p>Исключив сотрудника, у него больше не будет доступа к организации.</p>'+
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
        formData.append('organization', orgID);
        formData.append('csrf', document.getElementById('csrf').value);

        var ajaxData = {
            url: '/organization/coworkerexclude',
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

                if (parseInt(response.code) === 133 ) {

                    excludeBlock.close();
                    document.getElementById('coWorkers').querySelector('.block[data-id="' + form.dataset.id + '"]').parentNode.remove();

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