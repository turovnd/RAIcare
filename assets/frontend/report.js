/**
 * @author Turov Nikolay
 * @copyright RAIcare
 */

module.exports = ( function (report) {

    // report.print = require('./modules/js/report/print');
    report.onclick  = require('./modules/js/report/onclick');
    report.get      = require('./modules/js/report/get');
    report.table    = require('./modules/js/report/table');

    return report;

})({});
