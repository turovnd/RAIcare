module.exports = (function (add) {

    var corePrefix      = 'RAIsoft clients';

    function prepare_() {

        var addClientModal = document.getElementById('addClientModal');

        if (addClientModal)
            addClientModal.addEventListener('submit', addClient_);

    }


    function prepareTabs_() {

        var btns      = document.getElementsByClassName('tabs__btn'),
            activeTab = raisoft.cookies.get('clients');

        for (var i = 0; i < btns.length; i++) {

            btns[i].addEventListener('click', changeTabs_);

        }


        if (activeTab !== undefined && document.querySelector('[data-block="' + activeTab + '"]'))
            document.querySelector('[data-block="' + activeTab + '"]').click();

    }


    function addClient_(event) {

        event.preventDefault();

        var form = this,
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

                    document.getElementById('withoutAccessClients').insertBefore(client, document.getElementById('withoutAccessClients').childNodes[0]);
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

    }


    function changeTabs_() {

        raisoft.cookies.set({
            name: 'clients',
            value: this.dataset.block,
            expires: 3600,
            path: '/'
        });

    }


    add.init = function () {

        prepare_();
        prepareTabs_();

    };

    return add;

})({});