/**
 * @author Turov Nikolay
 * @copyright RAIsoft
 */

require('./modules/css/main');

module.exports = ( function (raisoft) {

    raisoft.core         = require('./modules/core');
    raisoft.draw         = require('./modules/draw');
    raisoft.transport    = require('./modules/transport');
    raisoft.ajax         = require('./modules/js/ajax');
    raisoft.parallax     = require('./modules/js/parallax');
    raisoft.header       = require('./modules/js/header');
    raisoft.aside        = require('./modules/js/aside');
    raisoft.collapse     = require('./modules/js/collapse');
    raisoft.cookies      = require('./modules/js/cookies');
    raisoft.tabs         = require('./modules/js/tabs');
    raisoft.modal        = require('./modules/js/modal');
    raisoft.form         = require('./modules/js/form');
    raisoft.notification = require('./modules/js/notification');
    raisoft.choices      = require('choices.js');
    raisoft.table        = require('./modules/js/tablesaw');



    return raisoft;

})({});