
<div id="co_workers" class="block__body p-0">

    <? foreach ($organization->users as $coworker) : ?>

        <fieldset class="p-15 m-b-0">
            <? // Module Organizations => EXCLUDE_CO_WORKER_FROM_ORG = 19
            if (in_array(19, $user->permissions) && $organization->owner != $coworker->id) : ?>
                <a onclick="organization.coworker.exclude(this)" role="button" class="fl_r m-l-10" data-pk="<?=$coworker->id; ?>" data-name="<?=$coworker->name; ?>">
                    <i class="fa fa-user-times" aria-hidden="true"></i>
                </a>
            <? endif; ?>
            <? // Module Organizations => CHANGE_CO_WORKER_ROLE_ORG = 22
            if (in_array(22, $user->permissions) && $organization->owner != $coworker->id && $user->id != $coworker->id) : ?>
                <a onclick="organization.coworker.openupdaterole(this)" role="button" class="fl_r m-l-10" data-pk="<?=$coworker->id; ?>">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>
            <? endif; ?>

            <div class="display-table"><?=$coworker->name; ?></div>
            <div class="display-table label label--brand"><?=$coworker->role->name; ?></div>

        </fieldset>

    <? endforeach; ?>

</div>

<? // Module Organizations => CHANGE_CO_WORKER_ROLE_ORG = 22
if (in_array(22, $user->permissions)) : ?>
    <input type="hidden" id="availableRoles" value='<?= json_encode($organization->roles); ?>'>
    <input type="hidden" id="availablePermissions" value='<?= json_encode($organization->permissions); ?>'>
<? endif; ?>

<? // Module Organizations => INVITE_CO_WORKER_TO_ORG = 18
if (in_array(18, $user->permissions)) : ?>



<? endif; ?>