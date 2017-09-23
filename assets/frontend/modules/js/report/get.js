module.exports = (function (get) {

    var corePrefix  = 'Report: get',
        formData    = null,
        ajaxData    = null,
        modalScale  = null,
        modalCAP    = null;

    var getCAP = function (name) {

        formData = new FormData();
        formData.append('name', name);
        formData.append('csrf', document.getElementById('csrf').value);

        ajaxData = {
            url: '/report/getCAP',
            type: 'POST',
            data: formData,
            beforeSend: function () {

                modalCAP.getElementsByClassName('modal__wrapper')[0].classList.add('loading');
                modalCAP.getElementsByClassName('modal__title')[0].innerHTML = 'Загрузка ...';
                modalCAP.getElementsByClassName('modal__body')[0].innerHTML = '';
                raicare.modal.show(modalCAP);

            },
            success: function (response) {

                response = JSON.parse(response);
                modalCAP.getElementsByClassName('modal__wrapper')[0].classList.remove('loading');

                if (parseInt(response.code) === 171) {

                    modalCAP.getElementsByClassName('modal__title')[0].innerHTML = response.title;
                    modalCAP.getElementsByClassName('modal__body')[0].innerHTML = response.html;

                } else {

                    raicare.modal.hide(modalCAP);
                    raicare.notification.notify({
                        type: response.status,
                        message: response.message
                    });

                }

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on getting getCAP', 'error', corePrefix, callbacks);
                modalCAP.getElementsByClassName('modal__wrapper')[0].classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);


    };

    var getScale = function (name) {

        formData = new FormData();
        formData.append('name', name);
        formData.append('csrf', document.getElementById('csrf').value);

        ajaxData = {
            url: '/report/getScale',
            type: 'POST',
            data: formData,
            beforeSend: function () {

                modalScale.getElementsByClassName('modal__wrapper')[0].classList.add('loading');
                modalScale.getElementsByClassName('modal__title')[0].innerHTML = 'Значения шкалы ' + name;
                modalScale.getElementsByClassName('modal__body')[0].innerHTML = '';
                raicare.modal.show(modalScale);

            },
            success: function (response) {

                response = JSON.parse(response);
                modalScale.getElementsByClassName('modal__wrapper')[0].classList.remove('loading');

                if (parseInt(response.code) === 171) {

                    modalScale.getElementsByClassName('modal__body')[0].innerHTML = response.html;

                } else {

                    raicare.modal.hide(modalScale);
                    raicare.notification.notify({
                        type: response.status,
                        message: response.message
                    });

                }

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on getting getScale', 'error', corePrefix, callbacks);
                modalScale.getElementsByClassName('modal__wrapper')[0].classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);

    };


    get.cap = function (name) {

        if (!modalCAP)
            modalCAP = document.getElementById('modalCAP');
        getCAP(name);

    };

    get.scale = function (name) {

        if (!modalScale)
            modalScale = document.getElementById('modalScale');
        getScale(name);

    };

    return get;

})({});
