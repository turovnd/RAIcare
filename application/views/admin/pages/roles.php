<div class="section__content ">

    <h3 class="section__heading">
        <a role="button" data-toggle="modal" data-area="newRoleModal" class="btn btn--brand btn--sm m-0 fl_r">Новая роль</a>
        Роли
    </h3>

    <div class="block">

        <div class="block__body overflow--hidden">

            <table id="roles">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Навзвание</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <? foreach ($roles as $role) : ?>
                        <tr>
                            <td><?= $role->id; ?></td>
                            <td><?= $role->name; ?></td>
                            <td class="text-center">
                                <i onclick="admin.roles.openmodal(this)" class="fa fa-edit text-brand cursor-pointer" aria-hidden="true"></i>
                                <i onclick="admin.roles.delete(<?= $role->id; ?>)" class="fa fa-trash text-danger cursor-pointer m-l-10" aria-hidden="true"></i>
                            </td>
                        </tr>
                    <? endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>


    <form class="modal" id="newRoleModal" tabindex="-1">
        <div class="modal__content">
            <div class="modal__wrapper">
                <div class="modal__header">
                    <button type="button" class="modal__title-close" data-close="modal">
                        <i class="fa fa-close" aria-hidden="true"></i>
                    </button>
                    <h4 class="modal__title">Новая роль</h4>
                </div>
                <div class="modal__body">
                    <fieldset>
                        <div class="form-group">
                            <label for="newRoleID" class="form-group__label">ID роли</label>
                            <input type="number" name="id" id="newRoleID" class="form-group__control" value="">
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label for="newRoleName" class="form-group__label">Название роли</label>
                            <input type="text" name="name" id="newRoleName" class="form-group__control" maxlength="128" value="">
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

    <form class="modal" id="updateRoleModal" tabindex="-1">
        <div class="modal__content">
            <div class="modal__wrapper">
                <div class="modal__header">
                    <button type="button" class="modal__title-close" data-close="modal">
                        <i class="fa fa-close" aria-hidden="true"></i>
                    </button>
                    <h4 class="modal__title">Редактирование роли</h4>
                </div>
                <div class="modal__body">
                    <fieldset>
                        <div class="form-group">
                            <label for="updateRoleName" class="form-group__label">Название роли</label>
                            <input type="text" name="name" id="updateRoleName" class="form-group__control" maxlength="128" value="">
                        </div>
                    </fieldset>
                </div>
                <div class="modal__footer">
                    <button type="button" class="btn btn--default" data-close="modal">Отмена</button>
                    <button type="submit" class="btn btn--brand">Обновить</button>
                    <input type="hidden" name="csrf" value="<?=Security::token();?>">
                    <input type="hidden" id="currentRoleID" name="id" value="">
                </div>
            </div>
        </div>
    </form>

</div>

<!-----------  PAGE SCRIPT  ----------->
<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/admin.min.js?v=<?= filemtime("assets/frontend/bundles/admin.min.js") ?>"></script>
<script type="text/javascript">
    admin.roles.init();
</script>