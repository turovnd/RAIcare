module.exports = (function (table) {

    table.init = function () {

        (function ( win ) {

            var $ = win.shoestring;

            $( document ).trigger( 'enhance.tablesaw' );

        })( typeof window !== 'undefined' ? window : this );

    };


    table.addRow = function (id) {

        var tbl    = document.getElementById(id),
            tbody  = tbl.getElementsByTagName('tbody')[0],
            newNum = tbody.getElementsByTagName('tr').length,
            newEl  = raicare.draw.node('TR'),
            N1cOptions = JSON.parse(document.getElementById('N1cOptions').value),
            N1dOptions = JSON.parse(document.getElementById('N1dOptions').value),
            N1eOptions = JSON.parse(document.getElementById('N1eOptions').value);

        newEl.innerHTML = '<td width="30%"> <div class="form-group">'+
            '<select name="N1[' + newNum + '][0]" class="form-group__control">'+
                '<option selected value="-1">Не выбрано</option>'+
            '</select>'+
        '</div> </td>'+
        '<td width="13%"> <div class="form-group">'+
            '<input name="N1[' + newNum + '][1]" type="number" min="0" step=".01" class="form-group__control">'+
        '</div> </td>'+
        '<td width="13%"> <div class="form-group">' +
            '<select name="N1[' + newNum + '][2]" class="form-group__control">' +
                '<option selected disabled value="-1">Не выбрано</option>' +
                getOptions_(N1cOptions) +
            '</select>'+
        '</div> </td>'+
        '<td width="13%"> <div class="form-group">'+
            '<select name="N1[' + newNum + '][3]" class="form-group__control">'+
                '<option selected disabled value="-1">Не выбрано</option>'+
                getOptions_(N1dOptions) +
            '</select>'+
        '</div> </td>' +
        '<td width="13%"> <div class="form-group">'+
            '<select name="N1[' + newNum + '][4]" class="form-group__control">'+
                '<option selected disabled value="-1">Не выбрано</option>'+
                getOptions_(N1eOptions) +
            '</select>'+
        '</div> </td>' +
        '<td width="13%"> <div class="form-group">'+
            '<select name="N1[' + newNum + '][5]" class="form-group__control">'+
            '<option selected disabled value="-1">Не выбрано</option>'+
                '<option value="1">Да</option>'+
                '<option value="0">Нет</option>'+
            '</select>'+
        '</div> </td>'+
        '<td width="5%">'+
            '<input id="N1_checkbox' + newNum + '" class="checkbox" type="checkbox" data-row="' + newNum + '">'+
            '<label for="N1_checkbox' + newNum + '" class="checkbox-label"></label>'+
        '</td>';

        tbody.appendChild(newEl);

    };

    function getOptions_(options) {

        var str = '';

        for (var i = 0; i < options.length; i++) {

            str += '<option value="' + i +'"> ' + options[i] + ' </option>';

        }
        return str;

    }

    table.removeRow = function (id) {

        var tbl   = document.getElementById(id),
            tbody = tbl.getElementsByTagName('tbody')[0],
            trs   = tbody.getElementsByTagName('tr'),
            chTrs = tbody.querySelectorAll('.checkbox:checked');

        if (chTrs.length === 0) return;

        for (var i = chTrs.length - 1; i >= 0; i--) {

            trs[chTrs[i].dataset.row].remove();

        }

        if (trs.length === 0)
            tbody = '';
        else
            tbody = updateIndex_(trs);

    };

    function updateIndex_(collections) {

        var str = '';

        for (var i = 0; i < collections.length; i++) {

            var inputs = collections[i].querySelectorAll('.form-group__control');

            for (var j = 0; j < collections.length; j++) {

                inputs[j].name = 'N1[' + i + '][' + j + ']';

            }

            collections[i].querySelector('.checkbox').dataset.row = i;

            str += collections[i].innerHTML;

        }

        return str;

    }

    return table;

})({});