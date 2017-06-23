module.exports = (function (get) {

    var corePrefix  = 'Survey: get AJAX',
        unitHolder  = document.getElementsByClassName('section__content')[0],
        pensionID   = document.getElementById('pensionID'),
        patientID   = document.getElementById('patientID'),
        surveyID    = document.getElementById('surveyID'),
        ajaxSend    = false;


    if(pensionID) pensionID = pensionID.value;
    if(patientID) patientID = patientID.value;
    if(surveyID) surveyID = surveyID.value;

    get.unitstart = function () {

        window.addEventListener('hashchange', getUnitOnHashChange_);
        getUnitOnHashChange_();

    };


    function getUnitOnHashChange_() {

        var unit           = window.location.hash.replace('#', ''),
            element        = null,
            availableUnits = [];


        if (unit === '') unit = 'progress';

        element = unit === 'progress' ? '' : unit;
        element = document.querySelector('.aside__link[href="#' + element + '"]');

        get.unit(element, unit);

    }


    get.unit = function (element, unit) {

        // TODO check is unit available

        if (document.getElementsByClassName('aside__item--active')[0])
            document.getElementsByClassName('aside__item--active')[0].classList.remove('aside__item--active');

        if(document.getElementsByClassName('aside__link--active')[0])
            document.getElementsByClassName('aside__link--active')[0].classList.remove('aside__link--active');

        element.parentNode.classList.add('aside__item--active');
        element.classList.add('aside__link--active');

        getUnit_(unit);

    };


    function getUnit_(unit) {

        var formData = new FormData();

        formData.append('unit', unit);
        formData.append('survey', surveyID);
        formData.append('pension', pensionID);
        formData.append('csrf', document.getElementById('csrf').value);

        var ajaxData = {
            url: '/survey/getunit',
            type: 'POST',
            data: formData,
            beforeSend: function () {

                document.body.classList.add('loading');

            },
            success: function (response) {

                response = JSON.parse(response);
                raisoft.core.log(response.message, response.status, corePrefix);
                document.body.classList.remove('loading');

                if (parseInt(response.code) === 165 ) {

                    unitHolder.innerHTML = response.html;

                } else {

                    raisoft.notification.notify({
                        type: response.status,
                        message: response.message
                    });

                }

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on getting unit of survey', 'error', corePrefix, callbacks);
                document.body.classList.remove('loading');

            }
        };

        raisoft.ajax.send(ajaxData);

    }


    /**
     *
     * Function for working with time - line (getting surveys)
     *
     */
    var timeline        = null,
        getMoreFormsBtn = null,
        type            = null,
        patients        = null; // json string array


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
        formData.append('patient', patientID);
        formData.append('pension', pensionID);
        formData.append('csrf', document.getElementById('csrf').value);



        var ajaxData = {
            url: '/survey/get',
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


    /**
     *
     * Function for searching forms by Patient Name or Pension Name
     *
     */
    var holderSearch  = document.getElementById('surveys'),
        searchingName = '',
        getMoreBtn    = document.getElementById('getMoreBtn');

    get.search = function (element) {

        searchingName = element.value;

        if (!ajaxSend) {

            getMoreBtn.dataset.offset = 0;
            holderSearch.innerHTML = '';
            getSurveys_();

        }

    };


    get.surveys = function (element) {

        getMoreBtn  = element;

        if (!ajaxSend) {

            getSurveys_();
            document.addEventListener('scroll', checkPageOffset_);

        }

    };


    /**
     * Function checking offset of bottom of page for sending new AJAX request (getting patients)
     * @private
     */
    function checkPageOffset_() {

        var bottom = holderSearch.getBoundingClientRect().bottom;

        if (window.innerHeight - bottom > 0 && ajaxSend === false) {

            getSurveys_();

        }

    }

    function getSurveys_() {

        var formData       = new FormData(),
            offset         = getMoreBtn.dataset.offset,
            sendSearchName = searchingName;

        formData.append('name', sendSearchName);
        formData.append('offset', offset);
        formData.append('csrf', document.getElementById('csrf').value);

        var ajaxData = {
            url: '/survey/search',
            type: 'POST',
            data: formData,
            beforeSend: function () {

                ajaxSend = true;
                getMoreBtn.innerHTML = 'Загрузка ...';

            },
            success: function (response) {

                response = JSON.parse(response);
                raisoft.core.log(response.message, response.status, corePrefix);
                ajaxSend = false;

                if (parseInt(response.code) === 162 ) {

                    getMoreBtn.innerHTML = 'Загрузить ещё';

                    if (response.html !== '') {

                        getMoreBtn.dataset.offset = parseInt(offset) + parseInt(response.number);

                        if (searchingName === sendSearchName) {

                            holderSearch.innerHTML += response.html;

                        } else {

                            holderSearch.innerHTML = response.html;

                        }

                    } else {

                        getMoreBtn.innerHTML = 'Всего ' + parseInt(parseInt(offset) + parseInt(response.number));
                        document.removeEventListener('scroll', checkPageOffset_);

                    }

                } else {

                    getMoreBtn.innerHTML = "Ошибка при загрузке. <span class='link'>Повторить</span>";
                    document.removeEventListener('scroll', checkPageOffset_);

                    raisoft.notification.notify({
                        type: response.status,
                        message: response.message
                    });

                }

            },
            error: function (callbacks) {

                raisoft.core.log('ajax error occur on searching surveys', 'error', corePrefix, callbacks);
                getMoreBtn.innerHTML = "Ошибка при загрузке. <span class='link'>Повторить</span>";
                document.removeEventListener('scroll', checkPageOffset_);
                ajaxSend = false;

            }
        };

        raisoft.ajax.send(ajaxData);

    }



    return get;

})({});