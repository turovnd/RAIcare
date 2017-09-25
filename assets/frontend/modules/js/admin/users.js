module.exports = (function (users) {

    var corePrefix      = 'Admin: users',
        passwordSymbols = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890',
        currentRow  = null,
        newModal    = null,
        updateModal = null;


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
    var updateRole_ = function (event) {

        event.preventDefault();

        var ajaxData = {
            url: '/admin/updaterole',
            type: 'POST',
            data: new FormData(updateModal),
            beforeSend: function () {

                updateModal.getElementsByClassName('modal__wrapper')[0].classList.add('loading');

            },
            success: function (response) {

                response = JSON.parse(response);
                updateModal.getElementsByClassName('modal__wrapper')[0].classList.remove('loading');

                if (parseInt(response.code) === 101 ) {

                    currentRow.getElementsByTagName('td')[1].textContent = document.getElementById('updateRoleName').value;

                }

                raicare.modal.hide(updateModal);
                raicare.notification.notify({
                    type: response.status,
                    message: response.message
                });

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on updating role', 'error', corePrefix, callbacks);
                updateModal.getElementsByClassName('modal__wrapper')[0].classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);

    };


    /**
     * Delete User
     * @param id - role ID
     * @private
     */
    var deleteRole_ = function (id) {

        var formData = new FormData();

        formData.append('id', id);
        formData.append('csrf', document.getElementById('csrf').value);

        var ajaxData = {
            url: '/admin/deleterole',
            type: 'POST',
            data: formData,
            beforeSend: function () {

                document.body.classList.add('loading');

            },
            success: function (response) {

                response = JSON.parse(response);
                document.body.classList.remove('loading');

                if (parseInt(response.code) === 102 ) {

                    window.location.reload();

                }

                raicare.notification.notify({
                    type: response.status,
                    message: response.message
                });

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on deleting role', 'error', corePrefix, callbacks);
                document.body.classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);

    };


    users.openmodal = function (element) {

        currentRow = element.parentNode.parentNode;

        document.getElementById('currentRoleID').value = currentRow.getElementsByTagName('td')[0].textContent;
        document.getElementById('updateRoleName').value = currentRow.getElementsByTagName('td')[1].textContent;

        raicare.modal.show(updateModal);

    };

    users.delete = function (id) {

        deleteRole_(id);

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
            // updateModal = document.getElementById('updateRoleModal');
            // updateModal.addEventListener('submit', updateRole_);
        }

    };

    return users;

})({});