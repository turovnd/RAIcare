/**
 * @author Turov Nikolay
 * @copyright RAIsoft
 */

module.exports = ( function (patient) {

    patient.get       = require('./modules/js/patient/get');
    patient.edit      = require('./modules/js/patient/edit');

    return patient;

})({});
