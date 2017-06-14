/**
 * @author Turov Nikolay
 * @copyright RAIsoft
 */

module.exports = ( function (clients) {

    clients.status     = require('./modules/js/clients/status');
    clients.edit        = require('./modules/js/clients/edit-info');
    clients.create      = require('./modules/js/clients/creating');

    return clients;

})({});
