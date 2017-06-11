<div class="section__content ">

    <h3 class="section__heading">
        Роли и права доступа
    </h3>

    <div class="row">
        <fieldset class="col-xs-12 p-b-20 m-b-0">

            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="block">
                        <div class="block__heading">Роли</div>
                        <div class="block__body">
                            <ul id="roles" >
                                <? foreach ($roles as $role) : ?>

                                    <li class="p-b-10">
                                        <div class="fl_r">
                                            <button role="button" class="fl_l m-l-5 js-edit-role" data-id="<?= $role['id']; ?>" data-name="<?= $role['name']; ?>"><i class="fa fa-edit text-brand" aria-hidden="true"></i></button>
                                            <button role="button" class="fl_l m-l-5 js-delete-role" data-id="<?= $role['id']; ?>"><i class="fa fa-trash text-danger" aria-hidden="true"></i></button>
                                        </div>

                                        <span class="role-id"><?= 'id:' . $role['id'] . ' - name:'; ?></span>
                                        <span class="role-name" data-id="<?= $role['id']; ?>" ><?= $role['name']; ?></span>

                                    </li>

                                <? endforeach; ?>
                            </ul>

                            <button id="js-add-role" role="button" class="btn btn--default m-0 fl_r">добавить</button>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="block">
                        <div class="block__heading">Права достпа (модули)</div>
                        <div  class="block__body">
                            <ul id="permissions">
                                <? foreach ($permissions as $permission) : ?>

                                    <li class="p-b-10">
                                        <div class="fl_r">
                                            <button role="button" class="fl_l m-l-5 js-edit-permission" data-id="<?= $permission['id']; ?>" data-name="<?= $permission['name']; ?>"><i class="fa fa-edit text-brand" aria-hidden="true"></i></button>
                                            <button role="button" class="fl_l m-l-5 js-delete-permission" data-id="<?= $permission['id']; ?>"><i class="fa fa-trash text-danger" aria-hidden="true"></i></button>
                                        </div>
                                        <span class="permission-id"><?= 'id:' . $permission['id'] . ' - name:'; ?></span>
                                        <span class="permission-name" data-id="<?= $permission['id']; ?>"><?= $permission['name']; ?></span>
                                    </li>

                                <? endforeach; ?>
                            </ul>

                            <button id="js-add-permission" role="button" class="btn btn--default fl_r m-0">добавить</button>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="block">
                        <div class="block__heading">Связь роли и прав достпа</div>
                        <div class="block__body">
                            <ol id="rolePermis" class="col-xs-12">
                                <? foreach ($rolepermis as $relation) : ?>
                                    <li class="col-xs-12 col-sm-4 m-b-10">
                                        <span class="role-permis-role" data-role="<?= $relation['roleId']; ?>"><?= $relation['roleName']; ?></span>
                                        <button role="button" class="m-l-5 js-edit-role-permis" data-role="<?= $relation['roleId']; ?>" data-permissions='<?= json_encode($relation["json_permissions"]); ?>'><i class="fa fa-edit text-brand" aria-hidden="true"></i></button>
                                        <button role="button" class="m-l-5 js-delete-role-permis" data-role="<?= $relation['roleId']; ?>"><i class="fa fa-trash text-danger" aria-hidden="true"></i></button>
                                        <ul>
                                            <? foreach ($relation['permission'] as $permission) : ?>
                                                <li data-permission="<?= $permission['id']; ?>"><?= $permission['name']; ?></li>
                                            <? endforeach; ?>
                                        </ul>
                                    </li>
                                <? endforeach; ?>
                            </ol>
                            <button id="js-add-role-permis" role="button" class="btn btn--default fl_r m-0">добавить</button>
                        </div>
                    </div>
                </div>
            </div>

        </fieldset>

    </div>

    <h3 class="section__heading">
        Сменить основателя организации
    </h3>

    <div class="row">

    </div>

    <h3 class="section__heading">
        Сменить основателя пансионата
    </h3>

    <div class="row">
        <fieldset class="col-xs-12 p-b-20 m-b-0">

        </fieldset>
    </div>

</div>

<!-----------  PAGE SCRIPT  ----------->
<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/admin.min.js?v=<?= filemtime("assets/frontend/bundles/admin.min.js") ?>"></script>
<script type="text/javascript">
    function ready() {
        admin.roles.init();
        admin.permissions.init();
        admin.rolePermis.init();
    }
    document.addEventListener("DOMContentLoaded", ready);
</script>