/**
 * @author Turov Nikolay
 * @copyright RAIsoft
 */

module.exports = ( function (admin) {

    admin.roles         = require('./modules/js/admin/roles');
    admin.permissions   = require('./modules/js/admin/permissions');

    return admin;

})({});
