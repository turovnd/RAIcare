<div class="section__content ">


    <h3 class="section__heading">
        Создание пользователей
    </h3>

    <div class="row">
        <div class="col-xs-12">

            <form class="form" id="newUserForm">

                <div class="form__body p-t-15">

                    <fieldset>
                        <label for="newUser" class="form-group__label">Имя</label>
                        <input id="newUser" type="text" name="name" class="form-group__control">
                    </fieldset>

                    <fieldset>
                        <label for="newUserEmail" class="form-group__label">Эл.почта</label>
                        <input id="newUserEmail" type="email" name="email" class="form-group__control">
                    </fieldset>

                    <fieldset>
                        <label for="newUserRole" class="form-group__label">Роль</label>
                        <select name="role" id="newUserRole" class="form-group__control">
                                <option value=""></option>

                            <? foreach ($roles as $role) : ?>

                                <option value="<?=$role['id']; ?>"><?=$role['name']; ?></option>

                            <? endforeach; ?>

                        </select>

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