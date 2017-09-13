/**
 * @author Turov Nikolay
 * @copyright RAIcare
 */

module.exports = ( function (patient) {

    patient.get       = require('./modules/js/patient/get');
    patient.edit      = require('./modules/js/patient/edit');
    patient.new       = require('./modules/js/patient/new');

    return patient;

})({});
