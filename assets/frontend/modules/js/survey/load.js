module.exports = (function (load) {

    var corePrefix       = 'Survey: load AJAX',
        ajaxSend         = false,
        holderSurveys    = null,
        surveysItems     = null,
        loadMoreBtn      = null;

    load.init = function () {

        surveysItems  = document.getElementById('allSurveyItems');
        holderSurveys = document.getElementById('surveys');
        loadMoreBtn   = document.getElementById('loadMoreBtn');

    };

    load.surveys = function (element) {

        if (!ajaxSend) {

            loadSurveys_();
            document.addEventListener('scroll', checkPageOffset_);

        }

    };

    function checkPageOffset_() {

        var bottom = holderSurveys.getBoundingClientRect().bottom;

        if (window.innerHeight - bottom > 0 && ajaxSend === false) {

            loadSurveys_();

        }

    }

    function loadSurveys_() {

        var formData = new FormData(),
            offset   = loadMoreBtn.dataset.offset,
            pension  = loadMoreBtn.dataset.pension;

        formData.append('offset', offset);
        formData.append('pension', pension);
        formData.append('csrf', document.getElementById('csrf').value);

        var ajaxData = {
            url: '/survey/load',
            type: 'POST',
            data: formData,
            beforeSend: function () {

                ajaxSend = true;
                loadMoreBtn.innerHTML = 'Загрузка ...';

            },
            success: function (response) {

                response = JSON.parse(response);
                raicare.core.log(response.message, response.status, corePrefix);
                ajaxSend = false;

                if (parseInt(response.code) === 162 ) {

                    loadMoreBtn.innerHTML = 'Загрузить ещё';

                    if (response.html !== '') {

                        loadMoreBtn.dataset.offset = parseInt(offset) + parseInt(response.number);

                        surveysItems.innerHTML += response.html;
                        raicare.table.create();

                    } else {

                        loadMoreBtn.innerHTML = 'Всего ' + parseInt(parseInt(offset) + parseInt(response.number));
                        loadMoreBtn.classList.add('pointer-events--none');
                        document.removeEventListener('scroll', checkPageOffset_);

                    }

                } else {

                    loadMoreBtn.innerHTML = "Ошибка при загрузке. <span class='link'>Повторить</span>";
                    loadMoreBtn.classList.remove('pointer-events--none');
                    document.removeEventListener('scroll', checkPageOffset_);

                    raicare.notification.notify({
                        type: response.status,
                        message: response.message
                    });

                }

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on searching surveys', 'error', corePrefix, callbacks);
                loadMoreBtn.innerHTML = "Ошибка при загрузке. <span class='link'>Повторить</span>";
                document.removeEventListener('scroll', checkPageOffset_);
                ajaxSend = false;

            }
        };

        raicare.ajax.send(ajaxData);

    }

    return load;

})({});