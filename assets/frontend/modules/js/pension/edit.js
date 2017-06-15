module.exports = (function (edit) {

    var corePrefix  = 'Organiz: edit info';

    edit.toggle = function (element) {

        var field = element.closest('.js-field-name');

        field.getElementsByClassName('form-group__control-static')[0].classList.toggle('hide');
        field.getElementsByClassName('form-group__control-group')[0].classList.toggle('hide');

    };

    edit.save = function (element) {

        var form     = document.getElementById('organization'),
            field    = element.closest('.js-field-name'),
            input    = field.getElementsByClassName('form-group__control')[0].value,
            name     = field.getElementsByClassName('form-group__control')[0].name,
            formData = new FormData();

        formData.append('id', document.getElementById('organizationID').value);
        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('name', name);
        formData.append('value', input);


        var ajaxData = {
            url: '/organization/update',
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


                if (parseInt(response.code) === 134 ) {

                    field.getElementsByClassName('js-organization-info')[0].textContent = input;
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

    };

    edit.cover = function (element) {

        var holder = document.getElementById('organizationCover');

        raisoft.transport.init({
            url : '/transport/1',
            params : {
                id : element.dataset.pk
            },
            beforeSend : function () {

                var fileReader = new FileReader(),
                    input = raisoft.transport.getInput(),
                    file = input.files[0];

                fileReader.readAsDataURL(file);

                fileReader.onload = function (event) {

                    holder.classList.add('image--loading');
                    holder.src = event.target.result;

                };

            },
            success : function (response) {

                response = JSON.parse(response);

                raisoft.notification.notify({
                    type: response.status,
                    message: response.message
                });

                if (parseInt(response.code) === 88) {

                    holder.src = response.url;
                    holder.classList.remove('image--loading');

                }

            },
            error : function (callbacks) {

                raisoft.core.log('ajax error occur on updating organization cover', 'error', corePrefix, callbacks);
                return false;

            }
        });

    };


    return edit;

})({});