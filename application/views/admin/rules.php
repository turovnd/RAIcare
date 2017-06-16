<div class="section__content ">

    <h3 class="section__heading">
        Права доступа
    </h3>

    <div class="row">

        <div class="col-xs-12">

            <div class="block">

                <div  class="block__body">

                    <ul id="permissions">

                        <? foreach ($permissions as $permission) : ?>

                            <li class="p-b-10">
                                <div class="fl_r">
                                    <button role="button" class="fl_l m-l-5 js-edit-permission" data-id="<?= $permission->id; ?>" data-name="<?= $permission->name; ?>"><i class="fa fa-edit text-brand" aria-hidden="true"></i></button>
                                    <button role="button" class="fl_l m-l-5 js-delete-permission" data-id="<?= $permission->id; ?>"><i class="fa fa-trash text-danger" aria-hidden="true"></i></button>
                                </div>
                                <span class="permission-id"><?= 'id:' . $permission->id . ' - name:'; ?></span>
                                <span class="permission-name" data-id="<?= $permission->id; ?>"><?= $permission->name; ?></span>
                            </li>

                        <? endforeach; ?>

                    </ul>

                </div>

                <div class="block__footer">

                    <button id="js-add-permission" role="button" class="btn btn--default fl_r m-0">добавить</button>

                </div>

            </div>

        </div>

    </div>

</div>

<!-----------  PAGE SCRIPT  ----------->
<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/admin.min.js?v=<?= filemtime("assets/frontend/bundles/admin.min.js") ?>"></script>
<script type="text/javascript">
    function ready() {
        //admin.roles.init();
        admin.permissions.init();
        //admin.rolePermis.init();
    }
    document.addEventListener("DOMContentLoaded", ready);
</script>