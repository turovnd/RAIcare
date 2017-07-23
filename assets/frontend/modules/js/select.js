module.exports = (function (select) {

    select.init = function () {

        if (document.getElementsByClassName('js-single-select').length) {

            new raisoft.choices('.js-single-select', {
                shouldSort: false,
                searchEnabled: false,
                itemSelectText: 'выбрать'
            });

        }

    };

    return select;

})({});