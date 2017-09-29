
<div class="section__content">

    <h3 class="section__heading">
        <a role="button" data-toggle="modal" data-area="newPensionModal" class="btn btn--brand btn--sm m-0 fl_r">Новый пансионат</a>
        Пансионаты
    </h3>

    <div class="block">

        <div class="block__body overflow--hidden">

            <table id="pensions">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>URI</th>
                        <th>Организация</th>
                        <th>Кол-во мест</th>
                        <th>Создатель</th>
                    </tr>
                </thead>
                <tbody>
                    <? foreach ($pensions as $pension) : ?>
                        <tr>
                            <td><?= $pension->id; ?></td>
                            <td>
                                <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/pension/' . $pension->id; ?>" class="link">
                                    <?= $pension->name; ?>
                                </a>
                            </td>
                            <td> <?= $pension->uri; ?> </td>
                            <td>
                                <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/organization/' . $pension->organization; ?>" class="link">
                                    <?= 'org #' . $pension->organization; ?>
                                </a>
                            </td>
                            <td> <?= $pension->places; ?> </td>
                            <td>
                                <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/user/' . $pension->creator; ?>" class="link">
                                    <?= 'user #' . $pension->creator; ?>
                                </a>
                            </td>
                        </tr>
                    <? endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

    <form class="modal" id="newPensionModal" tabindex="-1">
        <div class="modal__content">
            <div class="modal__wrapper">
                <div class="modal__header">
                    <button type="button" class="modal__title-close" data-close="modal">
                        <i class="fa fa-close" aria-hidden="true"></i>
                    </button>
                    <h4 class="modal__title">Новый пансионат</h4>
                </div>
                <div class="modal__body">
                    <fieldset>
                        <div class="form-group">
                            <label for="newPensionName" class="form-group__label">Название</label>
                            <input type="text" name="name" id="newPensionName" class="form-group__control" maxlength="256">
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label for="newPensionURI" class="form-group__label">URI</label>
                            <input type="text" name="uri" id="newPensionURI" class="form-group__control" maxlength="64">
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label for="pensionOrganization" class="form-group__label">
                                Организация
                            </label>
                            <select name="organization" id="pensionOrganization" class="form-group__control form-group__control-group-input">

                            </select>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label for="newPensionPlaces" class="form-group__label">Кол-во мест</label>
                            <input type="number" name="places" id="newPensionPlaces" class="form-group__control">
                        </div>
                    </fieldset>
                </div>
                <div class="modal__footer">
                    <button type="button" class="btn btn--default" data-close="modal">Отмена</button>
                    <button type="submit" class="btn btn--brand">Создать</button>
                    <input type="hidden" name="csrf" value="<?=Security::token();?>">
                </div>
            </div>
        </div>
    </form>

</div>

<!-----------  PAGE SCRIPT  ----------->
<script type="text/javascript" src="<?=$assets; ?>vendor/vanilla-datatables/dist/vanilla-dataTables.min.js?v=<?= filemtime("assets/vendor/vanilla-datatables/dist/vanilla-dataTables.min.js") ?>"></script>
<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/admin.min.js?v=<?= filemtime("assets/frontend/bundles/admin.min.js") ?>"></script>
<script type="text/javascript">
    admin.pensions.init('all');
</script>