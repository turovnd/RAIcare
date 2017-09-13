module.exports = (function (get) {

    get.init = function () {

        moment.locale('ru');
        raicare.moment.createDate('CLASS', 'js-date', true);
        raicare.moment.createDateFromNow('CLASS', 'js-data-fromNow');

        var dataTable = new DataTable('#patients', {
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

    return get;

})({});