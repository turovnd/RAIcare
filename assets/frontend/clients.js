/**
 * @author Turov Nikolay
 * @copyright RAIcare
 */

module.exports = ( function (clients) {

    clients.status     = require('./modules/js/clients/status');
    clients.edit        = require('./modules/js/clients/edit');
    clients.create      = require('./modules/js/clients/creating');

    return clients;

})({});
