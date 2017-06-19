module.exports = (function (get) {

    var corePrefix  = 'Survey: get AJAX',
        holder      = document.getElementsByClassName('section__content')[0],
        form        = null,
        mode        = null,
        pensionID   = document.getElementById('pensionID');

    if(pensionID) pensionID = pensionID.value;

    get.unit = function (unit) {

        if (!form)
            form = document.getElementById('formID').value;

        window.location.assign('survey?id=' + form + '&unit=' + unit);

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


    get.search = function (element, mod) {

        if (!mode) mode = mod;
        searchingPatientName = element.value;

        if (!ajaxPOSTing) {

            getMorePatientsBtn.dataset.offset = 0;
            holderPatients.innerHTML = '';
            getPatients_();

        }

    };

    get.patients = function (element, mod) {

        if (!mode) mode = mod;
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
            url: '/patient/' + mode,
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


    /** *
     *
     * Function for working with FORMS
     *
     */
    var timeline        = null,
        getMoreFormsBtn = null,
        type            = null,
        patients        = null, // json string array
        ajaxSend        = false;

    get.forms = function () {

        if (!timeline || !getMoreFormsBtn) {

            getMoreFormsBtn = document.getElementById('getMoreFormsBtn');
            timeline        = document.getElementById('timeline');
            patients        = timeline.dataset.pk;
            type            = getMoreFormsBtn.dataset.type;

        }

        if (!ajaxSend) {

            getForms_();

        }

    };

    function getForms_() {

        var formData       = new FormData(),
            offset         = parseInt(getMoreFormsBtn.dataset.offset);

        formData.append('type', type);
        formData.append('patients', patients);
        formData.append('offset', offset);
        formData.append('csrf', document.getElementById('csrf').value);

        var ajaxData = {
            url: '/forms/longterm/get',
            type: 'POST',
            data: formData,
            beforeSend: function () {

                ajaxSend = true;
                getMoreFormsBtn.getElementsByClassName('fa')[0].classList.remove('fa-plus');
                getMoreFormsBtn.getElementsByClassName('fa')[0].classList.add('fa-spinner', 'fa-fw', 'fa-pulse');

            },
            success: function (response) {

                response = JSON.parse(response);
                raisoft.core.log(response.message, response.status, corePrefix);
                ajaxSend = false;
                getMoreFormsBtn.getElementsByClassName('fa')[0].classList.add('fa-plus');
                getMoreFormsBtn.getElementsByClassName('fa')[0].classList.remove('fa-spinner', 'fa-fw', 'fa-pulse');

                if (parseInt(response.code) === 162 ) {

                    if (response.forms.length !== 0) {

                        var lastDate  = null,
                            separator = null,
                            date      = null;



                        for (var i = 0; i < response.forms.length; i++) {

                            lastDate = document.querySelectorAll('[data-datetime]');
                            lastDate = new Date(lastDate[lastDate.length-1].dataset.datetime);
                            date = new Date(response.forms[i].date);

                            if ( date - lastDate !== 0) {

                                separator = raisoft.draw.node('LI', 'time-line__separator', {'data-datetime': response.forms[i].date});

                                timeline.insertBefore(separator, timeline.getElementsByClassName('time-line__end')[0]);

                            }

                            var li = raisoft.draw.node('LI', 'time-line__item' + ((offset + i) % 2 === 0 ? '' : ' time-line__item--inverted'));


                            li.innerHTML = response.forms[i].html;
                            timeline.insertBefore(li, timeline.getElementsByClassName('time-line__end')[0]);

                        }


                        getMoreFormsBtn.dataset.offset = parseInt(offset) + parseInt(response.number);



                    } else {

                        getMoreFormsBtn.parentNode.remove();

                    }

                } else {

                    raisoft.notification.notify({
                        type: response.status,
                        message: response.message
                    });

                }

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on getting patients', 'error', corePrefix, callbacks);
                ajaxSend = false;
                getMoreFormsBtn.getElementsByClassName('fa')[0].classList.add('fa-plus');
                getMoreFormsBtn.getElementsByClassName('fa')[0].classList.remove('fa-spinner', 'fa-fw', 'fa-pulse');

            }

        };

        raisoft.ajax.send(ajaxData);

    }



    return get;

})({});