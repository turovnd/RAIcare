module.exports = (function (roles) {

    var corePrefix  = 'Admin: roles',
        currentRow  = null,
        newModal    = null,
        updateModal = null;


    /**
     * Create New Role
     * @private
     */
    var newRole_ = function (event) {

        event.preventDefault();

        var ajaxData = {
            url: '/admin/newrole',
            type: 'POST',
            data: new FormData(newModal),
            beforeSend: function () {

                newModal.getElementsByClassName('modal__wrapper')[0].classList.add('loading');

            },
            success: function (response) {

                response = JSON.parse(response);
                newModal.getElementsByClassName('modal__wrapper')[0].classList.remove('loading');

                if (parseInt(response.code) === 100 ) {

                    window.location.reload();

                }

                raicare.modal.hide(newModal);
                raicare.notification.notify({
                    type: response.status,
                    message: response.message
                });

            },
            error: function (callbacks) {

                raicare.core.log('ajax error occur on creating new role', 'error', corePrefix, callbacks);
                newModal.getElementsByClassName('modal__wrapper')[0].classList.remove('loading');

            }
        };

        raicare.ajax.send(ajaxData);

    };

    /**
     * Update Role
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
     * Delete Role
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


    roles.openmodal = function (element) {

        currentRow = element.parentNode.parentNode;

        document.getElementById('currentRoleID').value = currentRow.getElementsByTagName('td')[0].textContent;
        document.getElementById('updateRoleName').value = currentRow.getElementsByTagName('td')[1].textContent;

        raicare.modal.show(updateModal);

    };

    roles.delete = function (id) {

        deleteRole_(id);

    };

    roles.init = function () {

        updateModal = document.getElementById('updateRoleModal');
        updateModal.addEventListener('submit', updateRole_);

        newModal = document.getElementById('newRoleModal');
        newModal.addEventListener('submit', newRole_);

    };

    return roles;

})({});