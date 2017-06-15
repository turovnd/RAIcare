
<div id="co_workers" class="block__body p-0">

    <? foreach ($pension->users as $coworker) : ?>

        <fieldset class="p-15 m-b-0">
            <? // Module Organizations => EXCLUDE_CO_WORKER = 19
            if (in_array(19, $user->permissions) && $pension->owner != $coworker->id) : ?>
                <a onclick="organization.coworker.exclude(this)" role="button" class="fl_r m-l-10" data-pk="<?=$coworker->id; ?>" data-name="<?=$coworker->name; ?>">
                    <i class="fa fa-user-times" aria-hidden="true"></i>
                </a>
            <? endif; ?>
            <? // Module Organizations => CHANGE_CO_WORKER_ROLE = 22
            if (in_array(22, $user->permissions) && $pension->owner != $coworker->id) : ?>
                <a onclick="organization.coworker.openupdaterole(this)" role="button" class="fl_r m-l-10" data-pk="<?=$coworker->id; ?>">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>
                <input type="hidden" id="availableRoles" value='<?= json_encode($pension->roles); ?>'>
            <? endif; ?>

            <div class="display-table"><?=$coworker->name; ?></div>
            <div class="display-table label label--brand"><?=$coworker->role->name; ?></div>

        </fieldset>

    <? endforeach; ?>

</div>



<? // Module Organizations => INVITE_CO_WORKER = 18
if (in_array(18, $user->permissions)) : ?>

    <form class="modal" id="inviteCoWorkerModal" tabindex="-1">
        <div class="modal__content">
            <div class="modal__header">
                <button type="button" class="modal__title-close" data-close="modal">
                    <i class="fa fa-close" aria-hidden="true"></i>
                </button>
                <h4 class="modal__title">Приглашение сотрудника</h4>
            </div>
            <div class="modal__body">

                <fieldset>
                    <div class="form-group">
                        <label for="inviteCoWorkerName" class="form-group__label">Имя <span class="text-danger">*</span></label>
                        <input type="text" id="inviteCoWorkerName" name="name" class="form-group__control" maxlength="256">
                    </div>
                </fieldset>

                <fieldset class="m-0">
                    <div class="form-group">
                        <label for="inviteCoWorkerEmail" class="form-group__label">Эл.почта <span class="text-danger">*</span></label>
                        <input type="email" id="inviteCoWorkerEmail" name="email" class="form-group__control" maxlength="64">
                    </div>
                </fieldset>

            </div>
            <div class="modal__footer">
                <button type="button" class="btn btn--default" data-close="modal">Отмена</button>
                <button onclick="organization.coworker.invite()" type="button" class="btn btn--brand">Создать</button>
            </div>
        </div>
    </form>

<? endif; ?>