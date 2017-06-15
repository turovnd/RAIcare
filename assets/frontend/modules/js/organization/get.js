module.exports = (function (get) {

    var corePrefix  = 'Organiz: get AJAX',
        formData    = null,
        type        = null,
        offset      = null,
        search      = null,
        holder      = null,
        button      = null,
        ajaxPOST    = null;

    get.blocks = function (element) {

        type    = element.dataset.type;
        offset  = element.dataset.offset;
        search  = element.dataset.search;
        button  = element;

        holder = document.getElementById('organizations');
        ajaxPOST = false;

        if (!ajaxPOST) {

            getBlocks_();
            document.addEventListener('scroll', checkForOffset_);

        }

    };


    function getBlocks_() {

        formData = new FormData();

        offset = button.dataset.offset;

        formData.append('type', type);
        formData.append('offset', offset);
        formData.append('csrf', document.getElementById('csrf').value);


        var ajaxData = {
            url: '/organization/get',
            type: 'POST',
            data: formData,
            beforeSend: function () {

                ajaxPOST = true;
                button.classList.remove('hide');
                button.innerHTML = 'Загрузка ...';

            },
            success: function (response) {

                response = JSON.parse(response);
                raisoft.core.log(response.message, response.status, corePrefix);
                ajaxPOST = false;

                if (parseInt(response.code) === 135 ) {

                    formData = null;
                    button.classList.add('hide');

                    if (response.html !== '') {

                        button.dataset.offset = parseInt(offset) + 2;
                        holder.innerHTML += response.html;

                    } else {

                        document.removeEventListener('scroll', checkForOffset_);

                    }

                } else {

                    button.innerHTML = "Ошибка при загрузке. <span class='link'>Повторить</span>";

                    raisoft.notification.notify({
                        type: response.status,
                        message: response.message
                    });

                }

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on getting organizations', 'error', corePrefix, callbacks);
                button.innerHTML = "Ошибка при загрузке. <span class='link'>Повторить</span>";
                ajaxPOST = false;

            }
        };

        raisoft.ajax.send(ajaxData);

    }



    function checkForOffset_() {

        var bottom = holder.getBoundingClientRect().bottom;

        if (window.innerHeight - bottom > 0 && ajaxPOST === false) {

            getBlocks_();

        }

    }



    return get;

})({});