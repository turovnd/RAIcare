/**
 * @author Turov Nikolay
 * @copyright RAIcare
 */

module.exports = ( function (admin) {

    admin.roles = require('./modules/js/admin/roles');
    admin.users = require('./modules/js/admin/users');

    return admin;

})({});
