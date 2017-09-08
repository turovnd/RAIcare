/**
 * @author Turov Nikolay
 * @copyright RAIcare
 */

module.exports = ( function (survey) {

    survey.get       = require('./modules/js/survey/get');
    survey.send      = require('./modules/js/survey/send');
    survey.table     = require('./modules/js/survey/table');
    survey.load      = require('./modules/js/survey/load');

    return survey;

})({});
