function ready() {

    var corePrefix  = "RAIsoft new application",
        form        = document.getElementById('newApplication');


    form.addEventListener('submit', function (event) {
        event.preventDefault();

        var ajaxData = {
            url: '/application/new',
            type: 'POST',
            data: new FormData(form),
            beforeSend: function(){
                form.getElementsByClassName('form__body')[0].classList.add('loading');
            },
            success: function(response) {
                response = JSON.parse(response);
                form.getElementsByClassName('form__body')[0].classList.remove('loading');
                raisoft.core.log(response.message, response.status, corePrefix);

                raisoft.notification.notify({
                    type: response.status,
                    message: response.message
                });

                if (parseInt(response.code) === 21) {
                    form.classList.add('hide');
                    document.getElementById('sendApplication').classList.remove('hide');
                }


            },
            error: function(callbacks) {
                raisoft.core.log('ajax error occur on sending new application form','error', corePrefix, callbacks);
                form.getElementsByClassName('form__body')[0].classList.remove('loading');
            }
        };

        raisoft.ajax.send(ajaxData);
    });

}

document.addEventListener("DOMContentLoaded", ready);