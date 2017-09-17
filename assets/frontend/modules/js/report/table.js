module.exports = (function (table) {

    table.initStatus = function () {

        var adlSupportTable = new DataTable('#adlSupport', {
            perPage: 10,
            searchable: false,
            sortable: false,
            footer: true
        });

        adlSupportTable.wrapper.getElementsByClassName('dataTable-top')[0].remove();
        adlSupportTable.wrapper.getElementsByClassName('dataTable-bottom')[0].remove();

        if (document.getElementById('hearing')) {

            var hearingTable = new DataTable('#hearing', {
                perPage: 10,
                searchable: false,
                sortable: false,
                footer: false
            });

            hearingTable.wrapper.getElementsByClassName('dataTable-top')[0].remove();
            hearingTable.wrapper.getElementsByClassName('dataTable-bottom')[0].remove();

        }

        if (document.getElementById('vision')) {

            var visionTable = new DataTable('#vision', {
                perPage: 10,
                searchable: false,
                sortable: false,
                footer: false
            });

            visionTable.wrapper.getElementsByClassName('dataTable-top')[0].remove();
            visionTable.wrapper.getElementsByClassName('dataTable-bottom')[0].remove();

        }


        if (document.getElementById('communication')) {

            var communicationTable = new DataTable('#communication', {
                perPage: 10,
                searchable: false,
                sortable: false,
                footer: false
            });

            communicationTable.wrapper.getElementsByClassName('dataTable-top')[0].remove();
            communicationTable.wrapper.getElementsByClassName('dataTable-bottom')[0].remove();

        }


    };

    return table;

})({});
