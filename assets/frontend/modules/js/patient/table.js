module.exports = (function (table) {

    table.initAllPatients = function () {

        raicare.moment.setLocale();
        raicare.moment.createDate('CLASS', 'js-date', true);
        raicare.moment.createDateFromNow('CLASS', 'js-data-fromNow');

        var dataTable = new DataTable(document.querySelector('#patients'), {
            perPage: 20,
            perPageSelect: [20, 40, 60, 80, 100],
            searchable: true,
            sortable: true,
            labels: {
                placeholder: 'Поиск...',
                perPage: '{select} пациентов на странице',
                noRows: 'Пациенты не найдены',
                info: 'Показано с {start} по {end} из {rows}',
            },
            nextPrev: false,
            footer: true
        });

        dataTable.columns().sort(3, 'asc');

    };

    return table;

})({});