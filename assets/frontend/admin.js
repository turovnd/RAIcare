/**
 * @author Turov Nikolay
 * @copyright RAIsoft
 */

module.exports = ( function (admin) {

    admin.permissions   = require('./modules/js/admin/permissions');
    admin.newuser       = require('./modules/js/admin/new-user');

    return admin;

})({});
