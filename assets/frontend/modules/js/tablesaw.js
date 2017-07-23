module.exports = (function (tablesaw) {

    tablesaw.init = function () {

        require('tablesaw/dist/tablesaw');
        require('tablesaw/dist/tablesaw-init');

    };

    tablesaw.create = function () {

        (function (win) {

            var $ = win.shoestring;

            $(document).trigger('enhance.tablesaw');

        })(typeof window !== 'undefined' ? window : this);

    };

    return tablesaw;

})({});