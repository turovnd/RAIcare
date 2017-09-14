

module.exports = (function (table) {

    var surveysHistoryTable = document.getElementById('surveysHistory'),
        surveyProgressTable = document.getElementById('surveyProgress');


    var initHistoryTable_ = function () {

        raicare.moment.setLocale();
        raicare.moment.createDate('CLASS', 'js-date', true);
        raicare.moment.createDateFromNow('CLASS', 'js-data-fromNow');

        surveysHistoryTable = new DataTable('#surveysHistory', {
            perPage: 1000,
            searchable: false,
            sortable: true,
            labels: {
                placeholder: 'Поиск...',
                perPage: '{select} отчетов на странице',
                noRows: 'Отчеты не найдены',
                info: 'Показано с {start} по {end} из {rows}',
            },
            nextPrev: false
        });


        var openBtn     = document.getElementById('openCompareBtn'),
            checkAll    = document.getElementById('checkAll'),
            inputs      = [].slice.call(surveysHistoryTable.body.getElementsByClassName('checkbox')),
            btn         = document.getElementById('compareBtn');


        // Toggle Columns on click `openBtn`
        var toggleColumns_ = function () {

            if (openBtn.dataset.opened === 'false') {

                surveysHistoryTable.columns().hide([ 4 ]);
                surveysHistoryTable.columns().show([ 5 ]);

            } else {

                surveysHistoryTable.columns().show([ 4 ]);
                surveysHistoryTable.columns().hide([ 5 ]);

            }

            updateTable_();

        };

        // Change table
        var changeTable_ = function (e) {

            var input = e.target;

            if (input === checkAll) {

                for (var i = 0; i < inputs.length; i++) {

                    inputs[i].checked = input.checked;
                    inputs[i].parentNode.parentNode.classList.toggle('selected', input.checked);

                }

            } else {

                input.parentNode.parentNode.classList.toggle('selected', input.checked);

            }

        };

        // Update Table
        var updateTable_ = function () {

            checkAll.checked = false;
            inputs = [].slice.call(surveysHistoryTable.body.getElementsByClassName('checkbox'));

        };

        // Generate Report
        var getReport_ = function () {

            var checked = surveysHistoryTable.body.querySelectorAll('input:checked'),
                ids     = [];

            if (checked.length) {

                checked.forEach(function (el, i) {

                    ids[i] = el.value;

                });

                // / TODO compare Reports by pk
                console.log('Compare: ' + JSON.stringify(ids));
                raicare.notification.notify({
                    type: 'success',
                    message: 'Compare: ' + JSON.stringify(ids)
                });

            } else {

                raicare.notification.notify({
                    type: 'error',
                    message: 'Не выбраны отчеты'
                });

            }

        };

        // Generate Report
        btn.addEventListener('click', getReport_);

        // Checkboxes
        surveysHistoryTable.container.addEventListener('change', changeTable_);

        // Toggle Columns
        openBtn.addEventListener('click', toggleColumns_);

        // Update
        surveysHistoryTable.on('datatable.page', updateTable_);
        surveysHistoryTable.on('datatable.perpage', updateTable_);
        surveysHistoryTable.on('datatable.sort', updateTable_);

        surveysHistoryTable.wrapper.getElementsByClassName('dataTable-top')[0].classList.add('hide');
        surveysHistoryTable.columns().sort(2, 'asc');
        surveysHistoryTable.columns().hide([ 5 ]);

    };



    table.initProgressTable = function () {

        var surveyProgressTable = new DataTable('#surveyProgress', {
            perPage: 20,
            searchable: false,
            sortable: true,
            footer: true
        });

        surveyProgressTable.wrapper.getElementsByClassName('dataTable-top')[0].remove();
        surveyProgressTable.wrapper.getElementsByClassName('dataTable-bottom')[0].remove();

    };


    // init
    if (surveysHistoryTable) initHistoryTable_();
    if (surveyProgressTable) table.initProgressTable();




    // table.init = function () {
    //
    //     (function ( win ) {
    //
    //         var $ = win.shoestring;
    //
    //         $( document ).trigger( 'enhance.tablesaw' );
    //
    //     })( typeof window !== 'undefined' ? window : this );
    //
    // };
    //
    //
    // table.addRow = function (id) {
    //
    //     var tbl    = document.getElementById(id),
    //         tbody  = tbl.getElementsByTagName('tbody')[0],
    //         newNum = tbody.getElementsByTagName('tr').length,
    //         newEl  = raicare.draw.node('TR'),
    //         N1cOptions = JSON.parse(document.getElementById('N1cOptions').value),
    //         N1dOptions = JSON.parse(document.getElementById('N1dOptions').value),
    //         N1eOptions = JSON.parse(document.getElementById('N1eOptions').value);
    //
    //     newEl.innerHTML = '<td width="30%"> <div class="form-group">'+
    //         '<select name="N1[' + newNum + '][0]" class="form-group__control">'+
    //             '<option selected value="-1">Не выбрано</option>'+
    //         '</select>'+
    //     '</div> </td>'+
    //     '<td width="13%"> <div class="form-group">'+
    //         '<input name="N1[' + newNum + '][1]" type="number" min="0" step=".01" class="form-group__control">'+
    //     '</div> </td>'+
    //     '<td width="13%"> <div class="form-group">' +
    //         '<select name="N1[' + newNum + '][2]" class="form-group__control">' +
    //             '<option selected disabled value="-1">Не выбрано</option>' +
    //             getOptions_(N1cOptions) +
    //         '</select>'+
    //     '</div> </td>'+
    //     '<td width="13%"> <div class="form-group">'+
    //         '<select name="N1[' + newNum + '][3]" class="form-group__control">'+
    //             '<option selected disabled value="-1">Не выбрано</option>'+
    //             getOptions_(N1dOptions) +
    //         '</select>'+
    //     '</div> </td>' +
    //     '<td width="13%"> <div class="form-group">'+
    //         '<select name="N1[' + newNum + '][4]" class="form-group__control">'+
    //             '<option selected disabled value="-1">Не выбрано</option>'+
    //             getOptions_(N1eOptions) +
    //         '</select>'+
    //     '</div> </td>' +
    //     '<td width="13%"> <div class="form-group">'+
    //         '<select name="N1[' + newNum + '][5]" class="form-group__control">'+
    //         '<option selected disabled value="-1">Не выбрано</option>'+
    //             '<option value="1">Да</option>'+
    //             '<option value="0">Нет</option>'+
    //         '</select>'+
    //     '</div> </td>'+
    //     '<td width="5%">'+
    //         '<input id="N1_checkbox' + newNum + '" class="checkbox" type="checkbox" data-row="' + newNum + '">'+
    //         '<label for="N1_checkbox' + newNum + '" class="checkbox-label"></label>'+
    //     '</td>';
    //
    //     tbody.appendChild(newEl);
    //
    // };
    //
    // function getOptions_(options) {
    //
    //     var str = '';
    //
    //     for (var i = 0; i < options.length; i++) {
    //
    //         str += '<option value="' + i +'"> ' + options[i] + ' </option>';
    //
    //     }
    //     return str;
    //
    // }
    //
    // table.removeRow = function (id) {
    //
    //     var tbl   = document.getElementById(id),
    //         tbody = tbl.getElementsByTagName('tbody')[0],
    //         trs   = tbody.getElementsByTagName('tr'),
    //         chTrs = tbody.querySelectorAll('.checkbox:checked');
    //
    //     if (chTrs.length === 0) return;
    //
    //     for (var i = chTrs.length - 1; i >= 0; i--) {
    //
    //         trs[chTrs[i].dataset.row].remove();
    //
    //     }
    //
    //     if (trs.length === 0)
    //         tbody = '';
    //     else
    //         tbody = updateIndex_(trs);
    //
    // };
    //
    // function updateIndex_(collections) {
    //
    //     var str = '';
    //
    //     for (var i = 0; i < collections.length; i++) {
    //
    //         var inputs = collections[i].querySelectorAll('.form-group__control');
    //
    //         for (var j = 0; j < collections.length; j++) {
    //
    //             inputs[j].name = 'N1[' + i + '][' + j + ']';
    //
    //         }
    //
    //         collections[i].querySelector('.checkbox').dataset.row = i;
    //
    //         str += collections[i].innerHTML;
    //
    //     }
    //
    //     return str;
    //
    // }

    return table;

})({});
