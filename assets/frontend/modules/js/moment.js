module.exports = (function (momentjs) {

    var corePrefix = 'RAIcare: momentJS',
        date       = null;

    /**
     * Set Russian Language
     */
    momentjs.setLocale = function () {

        moment.locale('ru');

    };

    /**
     * Create moment date
     * @param attribute - ID || CLASS
     * @param indent - id_name || class_name
     * @param asTimestamp - boolean
     */
    momentjs.createDate = function (attribute, indent, asTimestamp) {

        if (attribute === 'ID') {

            var el = document.getElementById(indent);

            if (!el) {

                raicare.core.log('элемент не найден', 'error', corePrefix);
                return;

            }

            if (asTimestamp) {

                el.textContent = moment.unix(el.dataset.timestamp).format('DD MMM YYYY');

            } else {

                date = new Date(el.textContent);
                el.textContent = moment(date).format('DD MMM YYYY');

            }


        } else if (attribute === 'CLASS') {

            var els = document.getElementsByClassName(indent);

            if (els.length === 0) {

                raicare.core.log('элементы не найден', 'error', corePrefix);
                return;

            }

            for (var i = 0; i < els.length; i++) {

                if (asTimestamp) {

                    els[i].textContent = moment.unix(els[i].dataset.timestamp).format('DD MMM YYYY');

                } else {

                    date = new Date(els[i].textContent);
                    els[i].textContent = moment(date).format('DD MMM YYYY');

                }

            }

        } else {

            raicare.core.log('не правильный индентификатор', 'error', corePrefix);

        }

    };


    /**
     * Create moment date from now ONLY timestamp
     * @param attribute - ID || CLASS
     * @param indent - id_name || class_name
     */
    momentjs.createDateFromNow = function (attribute, indent) {

        if (attribute === 'ID') {

            var el = document.getElementById(indent);

            if (!el)  return;

            el.textContent = moment.unix(el.dataset.timestamp).fromNow();

        } else if (attribute === 'CLASS') {

            var els = document.getElementsByClassName(indent);

            if (els.length === 0)  return;

            for (var i = 0; i < els.length; i++) {

                els[i].textContent = moment.unix(els[i].dataset.timestamp).fromNow();

            }

        } else {

            raicare.core.log('не правильный индентификатор', 'error', corePrefix);

        }

    };

    return momentjs;

})({});