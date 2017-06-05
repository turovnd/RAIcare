<div class="section__content">

    <fieldset class="col-xs-12 p-b-20 m-b-0">
        <p class="h3 text-bold text-brand">Роли и права доступа</p>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <p class="h4">Роли</p>
                <ol id="roles">
                    <? foreach ($roles as $role) : ?>
                        <li class="p-b-5">
                            <span class="role-name" data-id="<?= $role['id']; ?>" ><?= $role['name']; ?></span>
                            <button role="button" class="js-edit-role" data-id="<?= $role['id']; ?>" data-name="<?= $role['name']; ?>"><i class="fa fa-edit m-l-5 text-brand" aria-hidden="true"></i></button>
                            <button role="button" class="js-delete-role" data-id="<?= $role['id']; ?>"><i class="fa fa-trash m-l-5 text-danger" aria-hidden="true"></i></button>
                        </li>
                    <? endforeach; ?>
                </ol>
                <button id="js-add-role" role="button" class="btn btn--default">добавить</button>
            </div>
            <div class="col-xs-12 col-sm-6">
                <p class="h4">Права достпа</p>
                <ol>
                    <li>ла ла</li>
                </ol>
                <button class="btn btn--default">добавить</button>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <p class="h4">Связь роли и прав достпа</p>
                <ol>
                    <li>
                        Администратор
                        <ul>
                            <li>ks ks</li>
                            <li>as as</li>
                        </ul>
                    </li>
                </ol>
            </div>
        </div>


    </fieldset>

    <fieldset class="col-xs-12 p-b-20 m-b-0">
        <p class="h3">Сменить основателя организаци</p>

    </fieldset>

</div>

<!-----------  PAGE SCRIPT  ----------->
<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/admin.min.js?v=<?= filemtime("assets/frontend/bundles/admin.min.js") ?>"></script>
<script type="text/javascript">
    admin.roles.init();
</script>