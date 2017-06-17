module.exports = (function (get) {

    var corePrefix  = 'Survey: get AJAX',
        holder      = document.getElementsByClassName('section__content')[0],
        form        = null,
        pensionID   = document.getElementById('pensionID').value;

    get.unit = function (unit) {

        if (!form)
            form = document.getElementById('formID').value;

        window.location.assign('survey?id=' + form + '&&unit=' + unit);

    };


    /** *
     *
     * Searching functions
     *
     */

    var searchingPatientName = '',
        holderPatients       = document.getElementById('patients'),
        getMorePatientsBtn   = document.getElementById('getMorePatientsBtn'),
        ajaxPOSTing          = false;


    get.search = function (element) {

        searchingPatientName = element.value;

        if (!ajaxPOSTing) {

            getMorePatientsBtn.dataset.offset = 0;
            holderPatients.innerHTML = '';
            getPatients_();

        }

    };

    get.patients = function (element) {

        getMorePatientsBtn  = element;

        if (!ajaxPOSTing) {

            getPatients_();
            document.addEventListener('scroll', checkPageOffset_);

        }

    };

    /**
     * Function checking offset of bottom of page for sending new AJAX request (getting patients)
     * @private
     */
    function checkPageOffset_() {

        var bottom = holder.getBoundingClientRect().bottom;

        if (window.innerHeight - bottom > 0 && ajaxPOSTing === false) {

            getPatients_();

        }

    }


    function getPatients_() {

        var formData       = new FormData(),
            offset         = getMorePatientsBtn.dataset.offset,
            sendSearchName = searchingPatientName;

        formData.append('name', sendSearchName);
        formData.append('pension', pensionID);
        formData.append('offset', offset);
        formData.append('csrf', document.getElementById('csrf').value);

        var ajaxData = {
            url: '/patient/get',
            type: 'POST',
            data: formData,
            beforeSend: function () {

                ajaxPOSTing = true;
                getMorePatientsBtn.innerHTML = 'Загрузка ...';

            },
            success: function (response) {

                response = JSON.parse(response);
                raisoft.core.log(response.message, response.status, corePrefix);
                ajaxPOSTing = false;

                if (parseInt(response.code) === 150 ) {

                    getMorePatientsBtn.innerHTML = 'Загрузить ещё';

                    if (response.html !== '') {

                        getMorePatientsBtn.dataset.offset = parseInt(offset) + parseInt(response.number);

                        if (searchingPatientName === sendSearchName) {

                            holderPatients.innerHTML += response.html;

                        } else {

                            holderPatients.innerHTML = response.html;

                        }

                    } else {

                        getMorePatientsBtn.innerHTML = 'Всего ' + parseInt(parseInt(offset) + parseInt(response.number));
                        document.removeEventListener('scroll', checkPageOffset_);

                    }

                } else {

                    getMorePatientsBtn.innerHTML = "Ошибка при загрузке. <span class='link'>Повторить</span>";

                    raisoft.notification.notify({
                        type: response.status,
                        message: response.message
                    });

                }

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on getting patients', 'error', corePrefix, callbacks);
                getMorePatientsBtn.innerHTML = "Ошибка при загрузке. <span class='link'>Повторить</span>";
                ajaxPOSTing = false;

            }
        };

        raisoft.ajax.send(ajaxData);

    }

    return get;

})({});