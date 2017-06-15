module.exports = (function (coworker) {

    var corePrefix   = 'Organiz: coworker',
        excludeUser  = null,
        excludeBlock = null,
        excludeForm  = null,
        roleLabel    = null;

    coworker.invite = function () {

        var form     = document.getElementById('inviteCoWorkerModal'),
            formData = new FormData(form);

        formData.append('organization', document.getElementById('organizationID').value);
        formData.append('csrf', document.getElementById('csrf').value);

        var ajaxData = {
            url: '/organization/inviteuser',
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


                if (parseInt(response.code) === 62 ) {

                    raisoft.modal.hide(form);

                }

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on inviting coworker', 'error', corePrefix, callbacks);
                form.getElementsByClassName('modal__content')[0].classList.remove('loading');

            }
        };

        raisoft.ajax.send(ajaxData);

    };

    coworker.exclude = function (element) {

        excludeUser  = element.dataset.pk;
        excludeBlock = element.parentNode;

        var name = element.dataset.name;

        excludeForm = raisoft.notification.notify({
            type: 'confirm',
            message: '<div id="excludeForm">' +
            '<h2>Исключить сотрудника</h2>'+
            '<p>Вы уверены, то хотите исключить ' + name + '?</p>'+
            '<p>Исключив сотрудника, у него больше не будет доступа к организации.</p>'+
            '</div>',
            confirmText: 'Исключить',
            showCancelButton: true,
            validation: true,
            confirm: exclude_,
            cancel: function () {

                excludeUser = null;

            }
        });

    };

    function exclude_() {

        var form     = document.getElementById('excludeForm'),
            formData = new FormData();

        formData.append('user', excludeUser);
        formData.append('organization', document.getElementById('organizationID').value);
        formData.append('csrf', document.getElementById('csrf').value);

        var ajaxData = {
            url: '/organization/excludeuser',
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


                if (parseInt(response.code) === 133 ) {

                    excludeBlock.remove();
                    excludeForm.close();
                    excludeForm = null;

                }

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on excluding coworker', 'error', corePrefix, callbacks);
                form.classList.remove('loading');

            }
        };

        raisoft.ajax.send(ajaxData);

    }

    coworker.openupdaterole = function (element) {

        roleLabel = element.parentNode.getElementsByClassName('label')[0];

        raisoft.modal.create({
            id: 'updateCoWorkerModal',
            header: 'Изменить роль сотрудника',
            body:

                '<div class="form-group">'+
                '<label for="updateCoWorkerRole" class="form-group__label">Роль</label>'+
                '<select name="role" id="updateCoWorkerRole" data-pk="' + element.dataset.pk +'" class="form-group__control">'+
                    getRolesOptions_() +
                '</select>'+
                '</div>',

            footer:
                '<button type="button" class="btn btn--default" data-close="modal">Отмена</button>'+
                '<button onclick="organization.coworker.updaterole()" type="button" class="btn btn--brand">Изменить</button>'
        });


    };

    coworker.updaterole = function () {

        var form     = document.getElementById('updateCoWorkerModal'),
            formData = new FormData(form);

        formData.append('organization', document.getElementById('organizationID').value);
        formData.append('role', document.getElementById('updateCoWorkerRole').value);
        formData.append('type', 'organization');
        formData.append('user', document.getElementById('updateCoWorkerRole').dataset.pk);
        formData.append('csrf', document.getElementById('csrf').value);

        var ajaxData = {
            url: '/profile/changerole',
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


                if (parseInt(response.code) === 53 ) {

                    raisoft.modal.hide(form);
                    roleLabel.textContent = response.role['name'];
                    roleLabel = null;
                    form.remove();

                }

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on changing coworker role', 'error', corePrefix, callbacks);
                form.getElementsByClassName('modal__content')[0].classList.remove('loading');

            }
        };

        raisoft.ajax.send(ajaxData);

    };

    function getRolesOptions_() {

        var options = JSON.parse(document.getElementById('availableRoles').value),
            str     = '';

        for (var i = 0; i < options.length; i++) {

            str += '<option value="' + options[i]['id'] +'">' + options[i]['name'] + '</option>';

        }

        return str;

    }


    return coworker;

})({});