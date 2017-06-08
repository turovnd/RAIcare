<div class="section__content ">
    <div class="row">
        <fieldset class="col-xs-12 p-b-20 m-b-0">
            <p class="h3 text-bold text-brand">Роли и права доступа</p>

            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <p class="h4">Роли</p>
                    <ul id="roles" class="list-style--none">
                        <? foreach ($roles as $role) : ?>
                            <li class="p-b-5">
                                <span class="role-id"><?= 'id:' . $role['id'] . ' - name:'; ?></span>
                                <span class="role-name" data-id="<?= $role['id']; ?>" ><?= $role['name']; ?></span>
                                <button role="button" class="js-edit-role" data-id="<?= $role['id']; ?>" data-name="<?= $role['name']; ?>"><i class="fa fa-edit m-l-5 text-brand" aria-hidden="true"></i></button>
                                <button role="button" class="js-delete-role" data-id="<?= $role['id']; ?>"><i class="fa fa-trash m-l-5 text-danger" aria-hidden="true"></i></button>
                            </li>
                        <? endforeach; ?>
                    </ul>
                    <button id="js-add-role" role="button" class="btn btn--default">добавить</button>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <p class="h4">Права достпа (модули)</p>
                    <ul id="permissions" class="list-style--none">
                        <? foreach ($permissions as $permission) : ?>
                            <li class="p-b-5">
                                <span class="permission-id"><?= 'id:' . $permission['id'] . ' - name:'; ?></span>
                                <span class="permission-name" data-id="<?= $permission['id']; ?>"><?= $permission['name']; ?></span>
                                <button role="button" class="js-edit-permission" data-id="<?= $permission['id']; ?>" data-name="<?= $permission['name']; ?>"><i class="fa fa-edit m-l-5 text-brand" aria-hidden="true"></i></button>
                                <button role="button" class="js-delete-permission" data-id="<?= $permission['id']; ?>"><i class="fa fa-trash m-l-5 text-danger" aria-hidden="true"></i></button>
                            </li>
                        <? endforeach; ?>
                    </ul>
                    <button id="js-add-permission" role="button" class="btn btn--default">добавить</button>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <p class="h4">Связь роли и прав достпа</p>
                    <ol id="rolePermis">
                        <? foreach ($rolepermis as $relation) : ?>
                            <li class="p-b-5">
                                <span class="role-permis-role" data-role="<?= $relation['roleId']; ?>"><?= $relation['roleName']; ?></span>
                                <button role="button" class="js-edit-role-permis" data-role="<?= $relation['roleId']; ?>" data-permissions='<?= json_encode($relation["json_permissions"]); ?>'><i class="fa fa-edit m-l-5 text-brand" aria-hidden="true"></i></button>
                                <button role="button" class="js-delete-role-permis" data-role="<?= $relation['roleId']; ?>"><i class="fa fa-trash m-l-5 text-danger" aria-hidden="true"></i></button>
                                <ul>
                                    <? foreach ($relation['permission'] as $permission) : ?>
                                        <li data-permission="<?= $permission['id']; ?>"><?= $permission['name']; ?></li>
                                    <? endforeach; ?>
                                </ul>
                            </li>
                        <? endforeach; ?>
                    </ol>
                    <button id="js-add-role-permis" role="button" class="btn btn--default">добавить</button>
                </div>
            </div>


        </fieldset>

        <fieldset class="col-xs-12 p-b-20 m-b-0">
            <p class="h3">Сменить основателя организаци</p>

        </fieldset>

    </div>
</div>

<!-----------  PAGE SCRIPT  ----------->
<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/admin.min.js?v=<?= filemtime("assets/frontend/bundles/admin.min.js") ?>"></script>
<script type="text/javascript">
    admin.roles.init();
    admin.permissions.init();
    admin.rolePermis.init();
</script>