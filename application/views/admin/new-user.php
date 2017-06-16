<div class="section__content ">


    <h3 class="section__heading">
        Создание пользователя
    </h3>

    <div class="row">
        <div class="col-xs-12">

            <form class="form" id="newUserForm">

                <div class="form__body p-t-15">

                    <fieldset>
                        <label for="newUser" class="form-group__label">Имя</label>
                        <input id="newUser" type="text" class="form-group__control">
                    </fieldset>

                    <fieldset>
                        <label for="newUserEmail" class="form-group__label">Эл.почта</label>
                        <input id="newUserEmail" type="email" name="email" class="form-group__control">
                    </fieldset>

                    <fieldset>
                        <label for="newUserRole" class="form-group__label">Роль</label>
                        <select name="role" id="newUserRole" class="form-group__control" onchange="admin.newuser.changerole(this)">
                                <option value="new">Новая</option>

                            <? foreach ($roles as $role) : ?>

                                <option value="<?=$role->id; ?>"><?=$role->name; ?></option>

                            <? endforeach; ?>

                        </select>

                    </fieldset>

                    <fieldset>
                        <label for="newUserRoleName" class="form-group__label">Наименование новой роли</label>
                        <input id="newUserRoleName" type="text" class="form-group__control" maxlength="128">
                    </fieldset>

                    <fieldset id="newUserPermissions">
                        <label class="form-group__label">Права доступа</label>

                        <? foreach ($permissions as $permission) : ?>

                            <p>
                                <input type="checkbox" id="permission_<?=$permission->id; ?>" class="checkbox">
                                <label for="permission_<?=$permission->id; ?>" class="checkbox-label"><?=$permission->name; ?></label>
                            </p>

                        <? endforeach; ?>

                    </fieldset>

                </div>

                <div class="form__submit text-right">
                    <button type="button" onclick="admin.newuser.create()" class="btn btn--brand m-0">Создать</button>
                </div>

            </form>

        </div>
    </div>

</div>

<!-----------  PAGE SCRIPT  ----------->
<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/admin.min.js?v=<?= filemtime("assets/frontend/bundles/admin.min.js") ?>"></script>