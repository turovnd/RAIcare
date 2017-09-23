/**
 * @author Turov Nikolay
 * @copyright RAIcare
 */

require('./modules/css/main');

module.exports = (function (raicare) {

    raicare.core         = require('./modules/core');
    raicare.draw         = require('./modules/draw');
    raicare.transport    = require('./modules/transport');
    raicare.ajax         = require('./modules/js/ajax');
    raicare.parallax     = require('./modules/js/parallax');
    raicare.aside        = require('./modules/js/aside');
    raicare.collapse     = require('./modules/js/collapse');
    raicare.cookies      = require('./modules/js/cookies');
    raicare.tabs         = require('./modules/js/tabs');
    raicare.modal        = require('./modules/js/modal');
    raicare.form         = require('./modules/js/form');
    raicare.notification = require('./modules/js/notification');
    raicare.choices      = require('choices.js');
    raicare.select       = require('./modules/js/select');
    raicare.loader       = require('./modules/js/loader');
    raicare.progress     = require('./modules/js/progress');
    raicare.moment       = require('./modules/js/moment');

    raicare.init = function () {
        raicare.collapse.init();
        raicare.aside.init();
        raicare.notification.createHolder();
        raicare.modal.init();
        raicare.loader.init();
        raicare.progress.init();
        raicare.select.init();
    };

    raicare.initWelcome = function () {
        raicare.parallax.init();
        raicare.notification.createHolder();
    };

    return raicare;

})({});