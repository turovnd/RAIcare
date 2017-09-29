module.exports = (function (pensions) {

    var corePrefix       = 'Admin: pensions',
        newModal         = null,
        pensionID   = null,
        pensionInfo = null;


    /**
     * Create New Pension
     * @private
     */
    var createPension_ = function (event) {

        event.preventDefault();

        var ajaxData = {
            url: '/admin/pension/create',
            type: 'POST',
            data: new FormData(newModal),
            beforeSend: function () {

                newModal.getElementsByClassName('modal__wrapper')[0].classList.add('loading');

            },
            success: function (response) {

                response = JSON.parse(response);
                newModal.getElementsByClassName('modal__wrapper')[0].classList.remove('loading');

                if (parseInt(response.code) === 141 ) {

                    window.location.reload();

                }

                raicare.notification.notify({
                    type: response.status,
                    message: response.message
                });

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on creating new pension', 'error', corePrefix, callbacks);
                newModal.getElementsByClassName('modal__wrapper')[0].classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);

    };



    /**
     * Update Pension
     * @private
     */
    var updatePension_ = function (element) {

        var field        = element.closest('.js-field-name'),
            input        = field.getElementsByClassName('form-group__control')[0],
            formData     = new FormData(),
            pensionsVal  = [];

        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('id', pensionID.value);
        formData.append('name', input.name);
        formData.append('value', input.value);

        if (input.name === 'users[]') {

            var options = input.getElementsByTagName('option');

            for (var i =0; i< options.length; i++) {

                if (pensionsVal.indexOf(options[i].value) === -1) {

                    pensionsVal.push(options[i].value);

                }


            }
            formData.append('value', JSON.stringify(pensionsVal));

        }

        var ajaxData = {
            url: '/admin/pension/update',
            type: 'POST',
            data: formData,
            beforeSend: function () {

                pensionInfo.classList.add('loading');

            },
            success: function (response) {

                response = JSON.parse(response);
                pensionInfo.classList.remove('loading');

                if (parseInt(response.code) === 145) {

                    field.getElementsByClassName('form-group__control-static')[0].classList.toggle('hide');
                    field.getElementsByClassName('form-group__control-group')[0].classList.toggle('hide');

                    if (input.name === 'organization') {

                        field.getElementsByClassName('js-pension-info')[0].textContent = field.getElementsByClassName('form-group__control')[0].getElementsByTagName('option')[0].textContent;
                        field.getElementsByClassName('js-pension-info')[0].href = window.location.origin + '/organization/' + input.value;

                    } else if (input.name === 'users[]') {

                        var fieldStatic = field.getElementsByClassName('form-group__control-static')[0],
                            users       = response.users;


                        fieldStatic.innerHTML = '';

                        for (i = 0; i < users.length; i++) {

                            fieldStatic.innerHTML +=
                                '<a href="' + window.location.origin + '/user/' + users[i]['id'] + '" class="js-pension-info link m-r-10">' +
                                    users[i]['name'] + ' (' + users[i]['username'] + ')' +
                                '</a>';

                        }
                        fieldStatic.innerHTML +=
                            '<a onclick="admin.pensions.edit(this)" role="button" class="m-l-5">' +
                                '<i class="fa fa-pencil" aria-hidden="true"></i>' +
                            '</a>';

                    } else {

                        field.getElementsByClassName('js-pension-info')[0].textContent = input.value;

                    }

                }

                raicare.notification.notify({
                    type: response.status,
                    message: response.message
                });

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on updating pension info', 'error', corePrefix, callbacks);
                pensionInfo.classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);

    };

    pensions.update = function (element) {

        updatePension_(element);

    };


    /**
     * Open editing form
     * @param element
     */
    pensions.edit = function (element) {

        var field = element.closest('.js-field-name');

        field.getElementsByClassName('form-group__control-static')[0].classList.toggle('hide');
        field.getElementsByClassName('form-group__control-group')[0].classList.toggle('hide');

    };


    pensions.init = function (type) {

        if (type === 'all') {

            newModal = document.getElementById('newPensionModal');
            newModal.addEventListener('submit', createPension_);

            new DataTable('#pensions', {
                perPage: 20,
                perPageSelect: [20, 40, 60, 80, 100],
                searchable: true,
                sortable: true,
                labels: {
                    placeholder: 'Поиск...',
                    perPage: '{select} оргнизаций на странице',
                    noRows: 'Организации не найдены',
                    info: 'Показано с {start} по {end} из {rows}',
                },
                nextPrev: false,
                footer: true
            });

        } else {

            pensionID   = document.getElementById('pensionID');
            pensionInfo = document.getElementById('pensionInfo');

            var pensionUsers = new raicare.choices('#pensionUsers', {
                placeholderValue: 'Введите имя или логин пользователя',
                loadingText: 'Загрузка...',
                noResultsText: 'Ничего не найдено',
                noChoicesText: 'Нет элементов для выбора',
                itemSelectText: 'выбрать',
                searchEnabled: true,
                searchChoices: false,
                shouldSort: false,
                searchFloor: 2,
                searchResultLimit: 30,
                resetScrollPosition: false
            });

            pensionUsers.passedElement.addEventListener('search', function (event) {

                pensionUsers.ajax(function () {

                    fetch('/admin/user/get?name=' + event.detail.value)
                        .then(function (response) {

                            return response.json();

                        }).then(function (data) {

                            pensionUsers.setChoices(data, 'id', 'search', true);

                        }).catch(function (error) {

                            console.log(error);

                        });

                });

            });

        }

        var pensionOrganization = new raicare.choices('#pensionOrganization', {
            placeholderValue: 'Введите имя или логин пользователя',
            loadingText: 'Загрузка...',
            noResultsText: 'Ничего не найдено',
            noChoicesText: 'Нет элементов для выбора',
            itemSelectText: 'выбрать',
            searchEnabled: true,
            searchChoices: false,
            shouldSort: false,
            searchFloor: 2,
            searchResultLimit: 30,
            resetScrollPosition: false
        });

        pensionOrganization.passedElement.addEventListener('search', function (event) {

            pensionOrganization.ajax(function () {

                fetch('/admin/organization/get?name=' + event.detail.value)
                    .then(function (response) {

                        return response.json();

                    }).then(function (data) {

                        pensionOrganization.setChoices(data, 'id', 'name', true);

                    }).catch(function (error) {

                        console.log(error);

                    });

            });

        });

    };

    return pensions;

})({});