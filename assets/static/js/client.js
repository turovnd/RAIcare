function ready() {

    var corePrefix      = "RAIsoft clients",
        addClientModal  = null,
        addClientBtn    = document.getElementById('addClient');


    function openAddClientModal_() {

        addClientModal = raisoft.notification.notify({
            type: 'confirm',
            message: '<form id="addClientForm">' +
            '<h2>Новый клиент</h2>' +
            '<fieldset class="text-left">'+
                '<div class="form-group">'+
                    '<label for="addClientName" class="form-group__label">Имя <span class="text-danger">*</span></label>'+
                    '<input type="text" id="addClientName" name="name" class="form-group__control" maxlength="256">'+
                '</div>'+
            '</fieldset>'+
            '<fieldset class="text-left">'+
                '<div class="form-group">'+
                    '<label for="addClientEmail" class="form-group__label">Адрес электронной почты <span class="text-danger">*</span></label>'+
                    '<input type="email" id="addClientEmail" name="email" class="form-group__control" maxlength="64">'+
                '</div>'+
            '</fieldset>'+
            '<fieldset class="text-left">'+
                '<div class="form-group">'+
                    '<label for="addClientOrganization" class="form-group__label">Организация / компания</label>'+
                    '<input type="text" id="addClientOrganization" name="organization" class="form-group__control">'+
                '</div>'+
            '</fieldset>'+
            '<fieldset class="text-left">'+
                '<div class="form-group">'+
                    '<label for="addClientCity" class="form-group__label">Город</label>'+
                    '<input type="text" id="addClientCity" name="city" class="form-group__control">'+
                '</div>'+
            '</fieldset>'+
            '<fieldset class="text-left">'+
                '<div class="form-group">'+
                    '<label for="addClientPhone" class="form-group__label">Телефон</label>'+
                    '<input type="text" id="addClientPhone" name="phone" class="form-group__control" maxlength="20">'+
                '</div>'+
            '</fieldset>'+
            '<fieldset class="text-left">'+
                '<div class="form-group">'+
                    '<label for="addClientComment" class="form-group__label">Комментарий</label>'+
                    '<textarea name="comment" id="addClientComment" rows="5" class="form-group__control"></textarea>'+
                '</div>'+
            '</fieldset>'+
            '</form>',
            showCancelButton: true,
            validation: true,
            confirmText: 'Создать',
            confirm: addClient_,
            cancel: function () {

                addClientModal = null;

            }
        });


    }

    function addClient_() {

        var form = document.getElementById('addClientForm'),
            formData = new FormData(form);

        formData.append('csrf', document.getElementById('csrf').value);

        var ajaxData = {
            url: '/client/add',
            type: 'POST',
            data: formData,
            beforeSend: function(){
                //form.classList.add('loading');
            },
            success: function(response) {
                response = JSON.parse(response);
                raisoft.core.log(response.message, response.status, corePrefix);
                //form.classList.remove('loading');

                raisoft.notification.notify({
                    type: response.status,
                    message: response.message
                });

                if (parseInt(response.code) === 22 ) {
                    addClientModal.close();
                    addClientModal = null;

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

                    document.getElementById('withoutAccessClients').insertBefore(client, document.getElementById('withoutAccessClients').childNodes[0]);
                    document.getElementById('withoutAccessClientsCounter').textContent = parseInt(document.getElementById('withoutAccessClientsCounter').textContent) + 1;
                }

            },
            error: function(callbacks) {
                raisoft.core.log('ajax error occur on submitting new client form','error', corePrefix, callbacks);
                //form.classList.remove('loading');
            }
        };

        raisoft.ajax.send(ajaxData);
    }


    if (addClientBtn)
        addClientBtn.addEventListener('click', openAddClientModal_);

}

document.addEventListener("DOMContentLoaded", ready);