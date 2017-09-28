<div class="section__content">

    <h3 class="section__heading">
        <a role="button" data-toggle="modal" data-area="newUserModal" class="btn btn--brand btn--sm m-0 fl_r">Новый пользователь</a>
        Пользователи
    </h3>

    <div class="block">

        <div class="block__body overflow--hidden">

            <table id="users">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Эл.почта</th>
                        <th>Логин</th>
                        <th>Организация</th>
                    </tr>
                </thead>
                <tbody>
                    <? foreach ($users as $user) : ?>
                        <tr>
                            <td><?= $user->id; ?></td>
                            <td>
                                <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/user/' . $user->id; ?>" class="link">
                                    <?= $user->name; ?>
                                </a>
                            </td>
                            <td><?= $user->email; ?></td>
                            <td><?= $user->username; ?></td>
                            <td>
                                <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/organization/' . $user->organization; ?>" class="link">
                                    <?= 'org #' . $user->organization; ?>
                                </a>
                            </td>
                        </tr>
                    <? endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

    <form class="modal" id="newUserModal" tabindex="-1">
        <div class="modal__content">
            <div class="modal__wrapper">
                <div class="modal__header">
                    <button type="button" class="modal__title-close" data-close="modal">
                        <i class="fa fa-close" aria-hidden="true"></i>
                    </button>
                    <h4 class="modal__title">Новый пользователь</h4>
                </div>
                <div class="modal__body">
                    <fieldset>
                        <div class="form-group">
                            <label for="newUserName" class="form-group__label">Имя</label>
                            <input type="text" name="name" id="newUserName" class="form-group__control" maxlength="256">
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label for="newUserEmail" class="form-group__label">Эл.почта</label>
                            <input type="email" name="email" id="newUserEmail" class="form-group__control" maxlength="64">
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label for="newUserUserName" class="form-group__label">Имя пользователя</label>
                            <input type="text" name="username" id="newUserUserName" class="form-group__control" maxlength="30">
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label for="newUserPassword" class="form-group__label">Пароль</label>
                            <div class="form-group__control-group">
                                <input type="text" name="password" id="newUserPassword" class="form-group__control form-group__control-group-input">
                                <label role="button" class="form-group__control-group-addon" onclick="admin.users.randompassword(this)">
                                    <i class="fa fa-random" aria-hidden="true"></i>
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label for="newUserRole" class="form-group__label">Роль</label>
                            <select name="role" id="newUserRole" class="form-group__control js-single-select">
                                <option value="-1" disabled selected>Не выбрано</option>
                                <? foreach ($roles as $role) : ?>
                                    <option value="<?= $role->id; ?>"><?= $role->name; ?></option>
                                <? endforeach; ?>
                            </select>
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
    admin.users.init('all');
</script>