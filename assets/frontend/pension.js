/**
 * @author Turov Nikolay
 * @copyright RAIsoft
 */

module.exports = ( function (pension) {

    pension.edit       = require('./modules/js/pension/edit');
    pension.coworker   = require('./modules/js/pension/coworker');
    pension.get        = require('./modules/js/pension/get');

    return pension;

})({});