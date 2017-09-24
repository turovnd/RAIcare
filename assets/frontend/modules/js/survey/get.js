module.exports = (function (get) {

    var corePrefix       = 'Survey: get AJAX',
        unitHolder       = document.getElementsByClassName('section__content')[0],
        pensionID        = document.getElementById('pensionID'),
        patientPK        = document.getElementById('patientPK'),
        units            = ['progress', 'unitA', 'unitB', 'unitC', 'unitD', 'unitE', 'unitF', 'unitG', 'unitH', 'unitI',
            'unitJ', 'unitK', 'unitL', 'unitM', 'unitN', 'unitO', 'unitP', 'unitQ', 'unitR'],
        surveyPK         = document.getElementById('surveyPK'),
        ajaxSend         = false;


    if(pensionID) pensionID = pensionID.value;
    if(patientPK) patientPK = patientPK.value;
    if(surveyPK) surveyPK = surveyPK.value;

    get.unitstart = function () {

        var unavailableUnits = document.getElementById('unavailableUnits');

        if(unavailableUnits) {

            unavailableUnits = JSON.parse(unavailableUnits.value);

            for (var i = 0; i < unavailableUnits.length; i++) {

                units.splice(units.indexOf(unavailableUnits[i]), 1);
                var unit = document.querySelector(".aside__link[href='#" + unavailableUnits[i] + "']");

                if (unit) unit.parentNode.remove();

            }

        } else {

            return;

        }

        window.addEventListener('hashchange', getUnitOnHashChange_);
        getUnitOnHashChange_();

    };


    function getUnitOnHashChange_() {

        var unit    = window.location.hash.replace('#', ''),
            element = null;

        if (unit === '') unit = 'progress';

        element = (unit === 'progress' ? '' : unit);

        element = document.querySelector('.aside__link[href="#' + element + '"]');
        get.unit(element, unit);

    }


    get.unit = function (element, unit) {

        if (!isAvailableUnit(unit)) return;

        if (document.getElementsByClassName('aside__item--active')[0])
            document.getElementsByClassName('aside__item--active')[0].classList.remove('aside__item--active');

        if(document.getElementsByClassName('aside__link--active')[0])
            document.getElementsByClassName('aside__link--active')[0].classList.remove('aside__link--active');

        element.parentNode.classList.add('aside__item--active');
        element.classList.add('aside__link--active');

        getUnit_(unit);

    };


    function isAvailableUnit(unit) {

        if (units.indexOf(unit) === -1) {

            raicare.notification.notify({
                type: 'error',
                message: 'Не правильно указан адрес'
            });

            return false;

        }

        return true;

    }


    function getUnit_(unit) {

        var formData = new FormData();

        formData.append('unit', unit);
        formData.append('survey', surveyPK);
        formData.append('pension', pensionID);
        formData.append('csrf', document.getElementById('csrf').value);

        var ajaxData = {
            url: '/survey/getunit',
            type: 'POST',
            data: formData,
            beforeSend: function () {

                document.getElementsByClassName('wrapper')[0].classList.add('loading');

            },
            success: function (response) {

                response = JSON.parse(response);
                raicare.core.log(response.message, response.status, corePrefix);
                document.getElementsByClassName('wrapper')[0].classList.remove('loading');

                if (parseInt(response.code) === 165 ) {

                    unitHolder.innerHTML = response.html;

                    if (unit === 'progress') {

                        survey.table.initProgressTable();
                        raicare.loader.init();

                    }

                    initSelects_();

                } else {

                    raicare.notification.notify({
                        type: response.status,
                        message: response.message
                    });

                }

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on getting unit of survey', 'error', corePrefix, callbacks);
                document.getElementsByClassName('wrapper')[0].classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);

    }


    /**
     *
     * Function for working with time - line (getting surveys)
     *
     */
    var timeline        = null,
        getMoreSurveysBtn = null;


    get.timeLineItems = function () {


        if (!timeline || !getMoreSurveysBtn) {

            getMoreSurveysBtn = document.getElementById('getMoreSurveysBtn');
            timeline        = document.getElementById('timeline');

        }

        if (!ajaxSend) {

            getTimeLineItems_();

        }

    };

    function getTimeLineItems_() {

        var formData       = new FormData(),
            offset         = parseInt(getMoreSurveysBtn.dataset.offset);

        formData.append('offset', offset);
        formData.append('patient', patientPK);
        formData.append('pension', pensionID);
        formData.append('csrf', document.getElementById('csrf').value);

        var ajaxData = {
            url: '/survey/get',
            type: 'POST',
            data: formData,
            beforeSend: function () {

                ajaxSend = true;
                getMoreSurveysBtn.getElementsByClassName('fa')[0].classList.remove('fa-plus');
                getMoreSurveysBtn.getElementsByClassName('fa')[0].classList.add('fa-spinner', 'fa-fw', 'fa-pulse');

            },
            success: function (response) {

                response = JSON.parse(response);
                raicare.core.log(response.message, response.status, corePrefix);
                ajaxSend = false;
                getMoreSurveysBtn.getElementsByClassName('fa')[0].classList.add('fa-plus');
                getMoreSurveysBtn.getElementsByClassName('fa')[0].classList.remove('fa-spinner', 'fa-fw', 'fa-pulse');

                if (parseInt(response.code) === 162 ) {

                    if (response.surveys.length !== 0) {

                        var lastDate  = null,
                            separator = null,
                            date      = null;



                        for (var i = 0; i < response.surveys.length; i++) {

                            lastDate = document.querySelectorAll('[data-datetime]');
                            lastDate = new Date(lastDate[lastDate.length-1].dataset.datetime);
                            date = new Date(response.surveys[i].date);

                            if ( date - lastDate !== 0) {

                                separator = raicare.draw.node('LI', 'time-line__separator', {'data-datetime': response.surveys[i].date});

                                timeline.insertBefore(separator, timeline.getElementsByClassName('time-line__end')[0]);

                            }

                            var li = raicare.draw.node('LI', 'time-line__item' + ((offset + i) % 2 === 0 ? '' : ' time-line__item--inverted'));


                            li.innerHTML = response.surveys[i].html;
                            timeline.insertBefore(li, timeline.getElementsByClassName('time-line__end')[0]);

                        }


                        getMoreSurveysBtn.dataset.offset = parseInt(offset) + parseInt(response.number);



                    } else {

                        getMoreSurveysBtn.parentNode.remove();

                    }

                } else {

                    raicare.notification.notify({
                        type: response.status,
                        message: response.message
                    });

                }

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on getting patients', 'error', corePrefix, callbacks);
                ajaxSend = false;
                getMoreSurveysBtn.getElementsByClassName('fa')[0].classList.add('fa-plus');
                getMoreSurveysBtn.getElementsByClassName('fa')[0].classList.remove('fa-spinner', 'fa-fw', 'fa-pulse');

            }

        };

        raicare.ajax.send(ajaxData);

    }

    function initSelects_() {

        if (document.getElementsByClassName('js-single-select').length > 0) {

            new raicare.choices('.js-single-select', {
                shouldSort: false,
                searchEnabled: false,
                itemSelectText: 'выбрать'
            });

        }

        if (document.getElementById('I2')) {

            var I2 = new raicare.choices(document.getElementById('I2'), {
                removeItemButton: true,
                placeholderValue: 'Введите названия диагноза или код МКБ-10',
                loadingText: 'Загрузка...',
                noResultsText: 'Ничего не найдено',
                noChoicesText: 'Нет элементов для выбора',
                itemSelectText: 'выбрать',
                searchEnabled: true,
                searchFloor: 2,
                searchResultLimit: 30,
                resetScrollPosition: false
            });


            I2.passedElement.addEventListener('search', function (event) {

                I2.clearStore();

                I2.ajax(function (callback) {

                    fetch('/mkb10/get?name=' + event.detail.value)
                        .then(function (response) {

                            response.json().then(function (data) {

                                callback(data, 'value', 'label');

                            });

                        })
                        .catch(function (error) {

                            console.log(error);

                        });

                });

            }, false);

        }

    }

    return get;

})({});