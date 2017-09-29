module.exports = (function (users) {

    var corePrefix      = 'Admin: users',
        passwordSymbols = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890',
        newModal    = null,
        userID      = null,
        userInfo    = null;


    /**
     * Create New User
     * @private
     */
    var createUser_ = function (event) {

        event.preventDefault();

        var ajaxData = {
            url: '/admin/user/create',
            type: 'POST',
            data: new FormData(newModal),
            beforeSend: function () {

                newModal.getElementsByClassName('modal__wrapper')[0].classList.add('loading');

            },
            success: function (response) {

                response = JSON.parse(response);
                newModal.getElementsByClassName('modal__wrapper')[0].classList.remove('loading');

                if (parseInt(response.code) === 50 ) {

                    window.location.reload();

                }

                raicare.notification.notify({
                    type: response.status,
                    message: response.message
                });

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on creating new user', 'error', corePrefix, callbacks);
                newModal.getElementsByClassName('modal__wrapper')[0].classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);

    };



    /**
     * Update User
     * @private
     */
    var updateUser_ = function (element) {

        var field        = element.closest('.js-field-name'),
            input        = field.getElementsByClassName('form-group__control')[0],
            formData     = new FormData(),
            pensionsVal  = [],
            pensionsName = [];

        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('id', userID.value);
        formData.append('name', input.name);
        formData.append('value', input.value);

        if (input.name === 'pensions[]') {

            var options = input.getElementsByTagName('option');

            for (var i = 0; i< options.length; i++) {

                if (pensionsVal.indexOf(options[i].value) === -1) {

                    pensionsVal.push(options[i].value);
                    pensionsName.push(options[i].textContent);

                }


            }
            formData.append('value', JSON.stringify(pensionsVal));

        }

        var ajaxData = {
            url: '/admin/user/update',
            type: 'POST',
            data: formData,
            beforeSend: function () {

                userInfo.classList.add('loading');

            },
            success: function (response) {

                response = JSON.parse(response);
                userInfo.classList.remove('loading');

                if (parseInt(response.code) === 53) {

                    field.getElementsByClassName('form-group__control-static')[0].classList.toggle('hide');
                    field.getElementsByClassName('form-group__control-group')[0].classList.toggle('hide');

                    if (input.name === 'role') {

                        field.getElementsByClassName('js-user-info')[0].textContent = field.getElementsByClassName('form-group__control')[0].getElementsByTagName('option')[0].textContent;

                    } else if (input.name === 'organization') {

                        field.getElementsByClassName('js-user-info')[0].textContent = field.getElementsByClassName('form-group__control')[0].getElementsByTagName('option')[0].textContent;
                        field.getElementsByClassName('js-user-info')[0].href = window.location.origin + '/organization/' + input.value;

                    } else if (input.name === 'pensions[]') {

                        var fieldStatic  = field.getElementsByClassName('form-group__control-static')[0];

                        fieldStatic.innerHTML = '';

                        for (i = 0; i < pensionsVal.length; i++) {

                            fieldStatic.innerHTML +=
                                '<a href="' + window.location.origin + '/pension/' + pensionsVal[i] + '" class="js-user-info link m-r-10">' +
                                    pensionsName[i] +
                                '</a>';

                        }
                        fieldStatic.innerHTML +=
                            '<a onclick="admin.users.edit(this)" role="button" class="m-l-5">' +
                                '<i class="fa fa-pencil" aria-hidden="true"></i>' +
                            '</a>';

                    } else {

                        field.getElementsByClassName('js-user-info')[0].textContent = input.value;

                    }

                }

                raicare.notification.notify({
                    type: response.status,
                    message: response.message
                });

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on updating user info', 'error', corePrefix, callbacks);
                userInfo.classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);

    };

    users.update = function (element) {

        updateUser_(element);

    };


    /**
     * Open editing form
     * @param element
     */
    users.edit = function (element) {

        var field = element.closest('.js-field-name');

        field.getElementsByClassName('form-group__control-static')[0].classList.toggle('hide');
        field.getElementsByClassName('form-group__control-group')[0].classList.toggle('hide');

    };


    /**
     * Generate Random Password
     * @param element
     */
    users.randompassword = function (element) {

        var password = '',
            rand;

        for (var i = 0; i < 10; i++) {

            rand = Math.floor(Math.random()*passwordSymbols.length);
            password += passwordSymbols.substring(rand, rand+1);

        }

        element.parentNode.getElementsByTagName('input')[0].value = password;

    };

    users.init = function (type) {

        if (type === 'all') {

            newModal = document.getElementById('newUserModal');
            newModal.addEventListener('submit', createUser_);

            new DataTable('#users', {
                perPage: 20,
                perPageSelect: [20, 40, 60, 80, 100],
                searchable: true,
                sortable: true,
                labels: {
                    placeholder: 'Поиск...',
                    perPage: '{select} пользователей на странице',
                    noRows: 'Пользователи не найдены',
                    info: 'Показано с {start} по {end} из {rows}',
                },
                nextPrev: false,
                footer: true
            });

        } else {

            userID   = document.getElementById('userID');
            userInfo = document.getElementById('userInfo');

            var userOrganization = new raicare.choices('#userOrganization', {
                placeholderValue: 'Введите название организации',
                loadingText: 'Загрузка...',
                noResultsText: 'Ничего не найдено',
                noChoicesText: 'Нет элементов для выбора',
                itemSelectText: 'выбрать',
                searchEnabled: true,
                searchChoices: false,
                searchFloor: 2,
                searchResultLimit: 30,
                resetScrollPosition: false
            });

            userOrganization.passedElement.addEventListener('search', function (event) {

                userOrganization.ajax(function () {

                    fetch('/admin/organization/get?name=' + event.detail.value)
                        .then(function (response) {

                            return response.json();

                        }).then(function (data) {

                            userOrganization.setChoices(data, 'id', 'name', true);

                        }).catch(function (error) {

                            console.log(error);

                        });

                });

            });

            var userPensions = new raicare.choices('#userPensions', {
                removeItemButton: true,
                placeholderValue: 'Введите название пансионата',
                loadingText: 'Загрузка...',
                noResultsText: 'Ничего не найдено',
                noChoicesText: 'Нет элементов для выбора',
                itemSelectText: 'выбрать',
                searchEnabled: true,
                searchChoices: false,
                searchFloor: 2,
                searchResultLimit: 30,
                resetScrollPosition: false
            });

            userPensions.passedElement.addEventListener('search', function (event) {

                userPensions.ajax(function () {

                    fetch('/admin/pension/get?name=' + event.detail.value)
                        .then(function (response) {

                            return response.json();

                        }).then(function (data) {

                            userPensions.setChoices(data, 'id', 'name', true);

                        }).catch(function (error) {

                            console.log(error);

                        });

                });

            });

        }

    };

    return users;

})({});