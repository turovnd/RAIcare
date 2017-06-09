/**
 * @author Turov Nikolay
 * @copyright RAIsoft
 */

module.exports = ( function (clients) {

    clients.add         = require('./modules/js/clients/add');
    clients.request      = require('./modules/js/clients/request');

    return clients;

})({});
