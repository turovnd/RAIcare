module.exports = (function (tablesaw) {

    tablesaw.init = function () {

        require('tablesaw/dist/tablesaw');
        require('tablesaw/dist/tablesaw-init');

    };

    return tablesaw;

})({});