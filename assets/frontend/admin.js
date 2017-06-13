/**
 * @author Turov Nikolay
 * @copyright RAIsoft
 */

module.exports = ( function (admin) {

    admin.roles         = require('./modules/js/admin/roles');
    admin.permissions   = require('./modules/js/admin/permissions');
    admin.rolePermis    = require('./modules/js/admin/roles-permissions');
    admin.newuser       = require('./modules/js/admin/new-user');

    return admin;

})({});
