/**
 * @author Turov Nikolay
 * @copyright RAIcare
 */

module.exports = ( function (organization) {

    organization.edit       = require('./modules/js/organization/edit');
    organization.coworker   = require('./modules/js/organization/coworker');
    organization.get        = require('./modules/js/organization/get');

    return organization;

})({});
