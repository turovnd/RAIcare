/**
 * @author Turov Nikolay
 * @copyright RAIcare
 */

module.exports = ( function (admin) {

    admin.roles         = require('./modules/js/admin/roles');
    admin.users         = require('./modules/js/admin/users');
    admin.organizations = require('./modules/js/admin/organizations');

    return admin;

})({});
