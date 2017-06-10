module.exports = (function (edit) {

    var corePrefix  = 'RAIsoft clients', i,
        form        = null,
        clientId    = null,
        csrf        = null;

    function prepare_() {

        var editBtns = document.getElementsByClassName('js-edit-info'),
            saveBtns = document.getElementsByClassName('js-save-info');

        for (i = 0; i < editBtns.length; i++) {

            editBtns[i].addEventListener('click', openEditForm_);

        }

        for (i = 0; i < saveBtns.length; i++) {

            saveBtns[i].addEventListener('click', saveEditForm_);

        }

        clientId = document.getElementById('clientId').value;
        csrf     = document.getElementById('csrf').value;
        form     = document.getElementById('application');

    }

    function openEditForm_() {

        var field = this.closest('.js-field-name');

        field.getElementsByClassName('form-group__control-static')[0].classList.toggle('hide');
        field.getElementsByClassName('form-group__control-group')[0].classList.toggle('hide');

    }

    function saveEditForm_() {

        var field    = this.closest('.js-field-name'),
            input    = field.getElementsByClassName('form-group__control')[0].value,
            name     = field.getElementsByClassName('form-group__control')[0].name,
            formData = new FormData();


        formData.append('id', clientId);
        formData.append('csrf', csrf);
        formData.append('name', name);
        formData.append('value', input);


        var ajaxData = {
            url: '/client/update',
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


                if (parseInt(response.code) === 27 ) {

                    field.getElementsByClassName('js-client-name')[0].textContent = input;
                    field.getElementsByClassName('form-group__control-static')[0].classList.toggle('hide');
                    field.getElementsByClassName('form-group__control-group')[0].classList.toggle('hide');

                }

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on updating client info', 'error', corePrefix, callbacks);
                form.classList.remove('loading');

            }
        };

        raisoft.ajax.send(ajaxData);

    }


    edit.init = function () {

        prepare_();

    };

    return edit;

})({});