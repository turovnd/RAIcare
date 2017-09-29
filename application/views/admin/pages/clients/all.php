<div class="section__content">

    <h3 class="section__heading">
        <a id="printBtn" role="button" class="btn btn--default btn--sm m-0 fl_r">
            <i class="fa fa-print"></i>
        </a>
        Заявки от клиентов
    </h3>

    <div class="block">

        <div class="block__body overflow--hidden">

            <table id="clients">
                <thead>
                    <tr>
                        <th class="text-center" data-sortable="false" width="5%">
                            <input id="checkAll" type="checkbox" class="checkbox">
                            <label for="checkAll" class="checkbox-label"></label>
                        </th>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Эл.почта</th>
                        <th>Статус</th>
                        <th>Организация</th>
                        <th>Город</th>
                        <th>Телефон</th>
                        <th data-sortable="false">Комментарий</th>
                        <th>Дата создния</th>
                    </tr>
                </thead>
                <tbody>
                    <? foreach ($clients as $client) : ?>
                        <tr>
                            <td>
                                <input id="checkClient_<?= $client->id; ?>" type="checkbox" class="checkbox" value="<?= $client->id; ?>">
                                <label for="checkClient_<?= $client->id; ?>" class="checkbox-label"></label>
                            </td>
                            <td><?= $client->id; ?></td>
                            <td><?= $client->name; ?></td>
                            <td><?= $client->email; ?></td>
                            <td><?= $client->status; ?></td>
                            <td><?= $client->organization; ?></td>
                            <td><?= $client->city; ?></td>
                            <td><?= $client->phone; ?></td>
                            <td><?= $client->comment; ?></td>
                            <td><?= strftime('%d %b %Y', strtotime($client->dt_create)); ?></td>
                        </tr>
                    <? endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

    <div class="hide">
        <table id="printTable"></table>
    </div>


</div>

<!-----------  PAGE SCRIPT  ----------->
<script type="text/javascript" src="<?=$assets; ?>vendor/vanilla-datatables/dist/vanilla-dataTables.min.js?v=<?= filemtime("assets/vendor/vanilla-datatables/dist/vanilla-dataTables.min.js") ?>"></script>
<script type="text/javascript">

    var dataTable = new DataTable('#clients', {
        perPage: 20,
        perPageSelect: [20, 40, 60, 80, 100],
        searchable: true,
        sortable: true,
        labels: {
            placeholder: 'Поиск...',
            perPage: '{select} клиентов на странице',
            noRows: 'Клиенты не найдены',
            info: 'Показано с {start} по {end} из {rows}',
        },
        nextPrev: false,
        footer: true
    });


    var checkAll    = document.getElementById('checkAll'),
        inputs      = [].slice.call(dataTable.body.getElementsByClassName('checkbox')),
        btn         = document.getElementById('printBtn');

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
        inputs = [].slice.call(dataTable.body.getElementsByClassName('checkbox'));

    };

    // Print Rows
    var printRows_ = function () {

        var checked = dataTable.body.querySelectorAll('input:checked'),
            tds     = null,
            data    = [];

        if (checked.length) {

            checked.forEach(function (el, i) {
                tds = el.closest('tr').getElementsByTagName('td');
                data[i] = [
                    tds[1].data,
                    tds[2].data,
                    tds[3].data,
                    tds[4].data,
                    tds[5].data,
                    tds[6].data,
                    tds[7].data,
                    tds[8].data,
                    tds[9].data
                ];
            });

            var dataTable1 = new DataTable('#printTable', {
                searchable: false,
                sortable: false,
                nextPrev: false,
                data: {
                    "headings": [
                        "ID",
                        "Имя",
                        "Эл.почта",
                        "Статус",
                        "Организация",
                        "Город",
                        "Телефон",
                        "Комментарий",
                        "Дата создния"
                    ],
                    "data": data
                }
            });

            dataTable1.print();
            dataTable1.destroy();

        } else {

            raicare.notification.notify({
                type: 'error',
                message: 'Не выбраны клиенты'
            });

        }

    };

    // Print rows
    btn.addEventListener('click', printRows_);

    // Checkboxes
    dataTable.container.addEventListener('change', changeTable_);

    // Update
    dataTable.on('datatable.page', updateTable_);
    dataTable.on('datatable.perpage', updateTable_);
    dataTable.on('datatable.sort', updateTable_);

    dataTable.columns().sort(2, 'asc');

</script>