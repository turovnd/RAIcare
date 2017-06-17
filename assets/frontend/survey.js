/**
 * @author Turov Nikolay
 * @copyright RAIsoft
 */

module.exports = ( function (survey) {

    survey.get       = require('./modules/js/survey/get');
    survey.send      = require('./modules/js/survey/send');

    return survey;

})({});
