/**
 * @author Turov Nikolay
 * @copyright RAIcare
 */

module.exports = ( function (admin) {

    admin.permissions   = require('./modules/js/admin/permissions');
    admin.roles         = require('./modules/js/admin/roles');
    admin.newuser       = require('./modules/js/admin/new-user');

    return admin;

})({});
