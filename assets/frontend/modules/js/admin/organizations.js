module.exports = (function (organizations) {

    var corePrefix       = 'Admin: organizations',
        newModal         = null,
        organizationID   = null,
        organizationInfo = null;


    /**
     * Create New Organization
     * @private
     */
    var createOrganization_ = function (event) {

        event.preventDefault();

        var ajaxData = {
            url: '/admin/organization/create',
            type: 'POST',
            data: new FormData(newModal),
            beforeSend: function () {

                newModal.getElementsByClassName('modal__wrapper')[0].classList.add('loading');

            },
            success: function (response) {

                response = JSON.parse(response);
                newModal.getElementsByClassName('modal__wrapper')[0].classList.remove('loading');

                if (parseInt(response.code) === 131 ) {

                    window.location.reload();

                }

                raicare.notification.notify({
                    type: response.status,
                    message: response.message
                });

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on creating new organization', 'error', corePrefix, callbacks);
                newModal.getElementsByClassName('modal__wrapper')[0].classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);

    };



    /**
     * Update Organization
     * @private
     */
    var updateOrganization_ = function (element) {

        var field        = element.closest('.js-field-name'),
            input        = field.getElementsByClassName('form-group__control')[0],
            formData     = new FormData(),
            pensionsVal  = [],
            pensionsName = [];

        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('id', organizationID.value);
        formData.append('name', input.name);
        formData.append('value', input.value);

        if (input.name === 'users[]') {

            var options = input.getElementsByTagName('option');

            for (var i =0; i< options.length; i++) {

                if (pensionsVal.indexOf(options[i].value) === -1) {

                    pensionsVal.push(options[i].value);
                    pensionsName.push(options[i].textContent);

                }


            }
            formData.append('value', JSON.stringify(pensionsVal));

        }

        var ajaxData = {
            url: '/admin/organization/update',
            type: 'POST',
            data: formData,
            beforeSend: function () {

                organizationInfo.classList.add('loading');

            },
            success: function (response) {

                response = JSON.parse(response);
                organizationInfo.classList.remove('loading');

                if (parseInt(response.code) === 135) {

                    field.getElementsByClassName('form-group__control-static')[0].classList.toggle('hide');
                    field.getElementsByClassName('form-group__control-group')[0].classList.toggle('hide');

                    if (input.name === 'owner') {

                        field.getElementsByClassName('js-organization-info')[0].textContent = field.getElementsByClassName('form-group__control')[0].getElementsByTagName('option')[0].textContent;
                        field.getElementsByClassName('js-organization-info')[0].href = window.location.origin + '/user/' + input.value;

                    } else if (input.name === 'users[]') {

                        var fieldStatic  = field.getElementsByClassName('form-group__control-static')[0];

                        fieldStatic.innerHTML = '';

                        for (i = 0; i < pensionsVal.length; i++) {

                            fieldStatic.innerHTML +=
                                '<a href="' + window.location.origin + '/user/' + pensionsVal[i] + '" class="js-organization-info link m-r-10">' +
                                    pensionsName[i] +
                                '</a>';

                        }
                        fieldStatic.innerHTML +=
                            '<a onclick="admin.organizations.edit(this)" role="button" class="m-l-5">' +
                                '<i class="fa fa-pencil" aria-hidden="true"></i>' +
                            '</a>';

                    } else {

                        field.getElementsByClassName('js-organization-info')[0].textContent = input.value;

                    }

                }

                raicare.notification.notify({
                    type: response.status,
                    message: response.message
                });

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on updating organization info', 'error', corePrefix, callbacks);
                organizationInfo.classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);

    };

    organizations.update = function (element) {

        updateOrganization_(element);

    };


    /**
     * Open editing form
     * @param element
     */
    organizations.edit = function (element) {

        var field = element.closest('.js-field-name');

        field.getElementsByClassName('form-group__control-static')[0].classList.toggle('hide');
        field.getElementsByClassName('form-group__control-group')[0].classList.toggle('hide');

    };


    organizations.init = function (type) {

        if (type === 'all') {

            newModal = document.getElementById('newOrganizationModal');
            newModal.addEventListener('submit', createOrganization_);

            new DataTable('#organizations', {
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

            organizationID   = document.getElementById('organizationID');
            organizationInfo = document.getElementById('organizationInfo');

            var organizationUsers = new raicare.choices('#organizationUsers', {
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

            console.log(organizationUsers);
            organizationUsers.passedElement.addEventListener('search', function (event) {

                organizationUsers.ajax(function () {

                    fetch('/admin/user/get?name=' + event.detail.value)
                        .then(function (response) {

                            return response.json();

                        }).then(function (data) {

                            organizationUsers.setChoices(data, 'id', 'search', true);

                        }).catch(function (error) {

                            console.log(error);

                        });

                });

            });

        }

        var organizationOwner = new raicare.choices('#organizationOwner', {
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

        organizationOwner.passedElement.addEventListener('search', function (event) {

            organizationOwner.ajax(function () {

                fetch('/admin/user/get?name=' + event.detail.value)
                    .then(function (response) {

                        return response.json();

                    }).then(function (data) {

                        organizationOwner.setChoices(data, 'id', 'search', true);

                    }).catch(function (error) {

                        console.log(error);

                    });

            });

        });

    };

    return organizations;

})({});