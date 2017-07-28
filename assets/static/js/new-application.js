var join = ( function (join) {

    var corePrefix  = "New application",
        joinForm    = document.getElementById('newApplication'),
        successJoin = document.getElementById('sendApplication');

    if (!joinForm || !successJoin) {
        raicare.core.log('Not found neWApplication || sendApplication forms','error',corePrefix);
        return;
    }

    joinForm.addEventListener('submit', function (event) {
        event.preventDefault();

        var ajaxData = {
            url: '/application/new',
            type: 'POST',
            data: new FormData(joinForm),
            beforeSend: function(){
                joinForm.classList.add('loading');
            },
            success: function(response) {
                response = JSON.parse(response);
                joinForm.classList.remove('loading');
                raicare.core.log(response.message, response.status, corePrefix);

                raicare.notification.notify({
                    type: response.status,
                    message: response.message
                });

                if (parseInt(response.code) === 21) {
                    joinForm.classList.add('hide');
                    successJoin.classList.remove('hide');
                }


            },
            error: function(callbacks) {
                raicare.core.log('ajax error occur on sending new application form','error', corePrefix, callbacks);
                joinForm.classList.remove('loading');
            }
        };

        raicare.ajax.send(ajaxData);
    });

    return join;

})({});