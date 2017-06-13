/**
 * @author Turov Nikolay
 * @copyright RAIsoft
 */

module.exports = ( function (clients) {

    clients.request     = require('./modules/js/clients/request');
    clients.edit        = require('./modules/js/clients/edit-info');
    clients.create      = require('./modules/js/clients/creating');

    return clients;

})({});
