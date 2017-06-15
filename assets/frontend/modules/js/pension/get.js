module.exports = (function (get) {

    var corePrefix  = 'Pension: get AJAX',
        formData    = null,
        type        = null,
        offset      = null,
        searchName  = '',
        holder      = document.getElementById('pensions'),
        button      = document.getElementById('getMoreBtn'),
        ajaxPOST    = false;


    get.search = function (element) {

        searchName = element.value;

        if (!ajaxPOST) {

            button.dataset.offset = 0;
            holder.innerHTML = '';
            getBlocks_();

        }

    };



    get.blocks = function (element) {

        button  = element;

        if (!ajaxPOST) {

            getBlocks_();
            document.addEventListener('scroll', checkOffset_);

        }

    };


    function getBlocks_() {

        formData = new FormData();

        offset = button.dataset.offset;
        type   = button.dataset.type;

        var sendSearchName = searchName;

        formData.append('name', searchName);
        formData.append('type', type);
        formData.append('offset', offset);
        formData.append('csrf', document.getElementById('csrf').value);


        var ajaxData = {
            url: '/pension/get',
            type: 'POST',
            data: formData,
            beforeSend: function () {

                ajaxPOST = true;
                button.innerHTML = 'Загрузка ...';

            },
            success: function (response) {

                response = JSON.parse(response);
                raisoft.core.log(response.message, response.status, corePrefix);
                ajaxPOST = false;

                if (parseInt(response.code) === 146 ) {

                    formData = null;
                    button.innerHTML = 'Загрузить ещё';

                    if (response.html !== '') {

                        button.dataset.offset = parseInt(offset) + parseInt(response.number);

                        if (searchName === sendSearchName) {

                            holder.innerHTML += response.html;

                        } else {

                            holder.innerHTML = response.html;

                        }

                    } else {

                        button.innerHTML = 'Всего ' + parseInt(parseInt(offset) + parseInt(response.number));
                        document.removeEventListener('scroll', checkOffset_);

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



    function checkOffset_() {

        var bottom = holder.getBoundingClientRect().bottom;

        if (window.innerHeight - bottom > 0 && ajaxPOST === false) {

            getBlocks_();

        }

    }



    return get;

})({});