/**
 * @author Turov Nikolay
 * @copyright RAIcare
 */

module.exports = ( function (patient) {

    patient.table     = require('./modules/js/patient/table');
    patient.edit      = require('./modules/js/patient/edit');
    patient.new       = require('./modules/js/patient/new');

    return patient;

})({});
