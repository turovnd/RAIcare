
<ul class="aside__menu list-style--none">

    <li class="aside__item <? echo $action == "dashboard" ? 'aside__item--active' : ''; ?>">
        <a href="<?=URL::site('dashboard'); ?>" class="aside__link">
            <i class="fa fa-dashboard aside__icon" aria-hidden="true"></i>
            <span class="aside__text">Главная</span>
        </a>
    </li>

    <? // Module Admin => permission: ADMIN_PANEL = 1
        if (in_array(1, $user->permissions)) : ?>

        <li class="aside__item <? echo $action == 'rules' || $action == 'orgs' || $action == 'pensions' ? 'aside__item--active' : ''; ?>">

            <a role="button" class="aside__link" data-toggle="collapse" data-area="moduleAdmin" data-opened="false">
                <i class="fa fa-cubes aside__icon" aria-hidden="true"></i>
                <span class="aside__text">Панель админа</span>
                <i class="fa fa-angle-down aside__icon--right" aria-hidden="true"></i>
            </a>

            <ul id="moduleAdmin" class="aside__collapse collapse list-style--none">

                <? // Module Admin => permission: ROLES_AND_PERMISSIONS = 2
                    if (in_array(2, $user->permissions)) : ?>

                    <li class="aside__collapse-item">
                        <a href="<?=URL::site('admin/rules'); ?>"  class="aside__collapse-link <?= $action == 'members' ? 'aside__collapse-link--active' : ''; ?>">
                            Roles&Permissions
                        </a>
                    </li>

                <? endif; ?>

                <? // Module Admin => permission: CHANGE_ORGANIZATION_OWNER = 3
                    if (in_array(3, $user->permissions)) : ?>

                    <li class="aside__collapse-item">
                        <a href="<?=URL::site('admin/orgs'); ?>"  class="aside__collapse-link <?= $action == 'members' ? 'aside__collapse-link--active' : ''; ?>">
                            Организации
                        </a>
                    </li>

                <? endif; ?>

                <? // Module Admin => permission: CHANGE_PENSION_OWNER = 4
                    if (in_array(4, $user->permissions)) : ?>

                    <li class="aside__collapse-item">
                        <a href="<?=URL::site('admin/pensions'); ?>" class="aside__collapse-link <?= $action == 'reports' ? 'aside__collapse-link--active' : ''; ?>">
                            Пансионаты
                        </a>
                    </li>

                <? endif; ?>

            </ul>

        </li>

    <? endif; ?>


    <?  // Module Clients => permission: 2
        if (in_array(2, $user->permissions)) : ?>

        <li class="aside__item <? echo $action == "clients" || $action == "client" ? 'aside__item--active' : ''; ?>">
            <a href="<?=URL::site('clients'); ?>" class="aside__link">
                <i class="fa fa-id-card-o aside__icon" aria-hidden="true"></i>
                <div class="label label--danger m-t-10 m-r-10"><?= count(Model_Client::getClientsByStatus(1)); ?></div>
                <span class="aside__text">Клиенты</span>
            </a>
        </li>

    <? endif; ?>

    <? // Module Organizations => permission: 3
    if (in_array(3, $user->permissions)) : ?>

        <li class="aside__item <? echo $action == "organizations" ? 'aside__item--active' : ''; ?>">
            <a href="<?=URL::site('organizations'); ?>" class="aside__link">
                <i class="fa fa-cubes aside__icon" aria-hidden="true"></i>
                <span class="aside__text">Все организации</span>
            </a>
        </li>

    <? endif; ?>

    <? // Module Organizations => permission: 4
    if (in_array(4, $user->permissions)) : ?>

        <li class="aside__item <? echo $action == "created_organizations" ? 'aside__item--active' : ''; ?>">
            <a href="<?=URL::site('organizations/created'); ?>" class="aside__link">
                <i class="fa fa-cubes aside__icon" aria-hidden="true"></i>
                <span class="aside__text">Созданные орг-ии</span>
            </a>
        </li>

    <? endif; ?>

    <? // Module Organizations => permission: 5
    if (in_array(5, $user->permissions)) : ?>

        <li class="aside__item <? echo $action == "my_organizations" ? 'aside__item--active' : ''; ?>">
            <a href="<?=URL::site('organizations/my'); ?>" class="aside__link">
                <i class="fa fa-cubes aside__icon" aria-hidden="true"></i>
                <span class="aside__text">Мои организации</span>
            </a>
        </li>

    <? endif; ?>

<!--    <li class="aside__item --><?// echo $action == 'members' || $action == 'reports' ? 'aside__item--active' : ''; ?><!--">-->
<!--        <a role="button" class="aside__link" data-toggle="collapse" data-area="helpCollapse" data-opened="false">-->
<!--            <i class="fa fa-briefcase aside__icon" aria-hidden="true"></i>-->
<!--            <span class="aside__text">Назв.</span>-->
<!--            <i class="fa fa-angle-down aside__icon--right" aria-hidden="true"></i>-->
<!--        </a>-->
<!---->
<!--        <ul id="helpCollapse" class="aside__collapse collapse list-style--none">-->
<!--            <li class="aside__collapse-item">-->
<!--                <a href="--><?//=URL::site('org/members'); ?><!--"  class="aside__collapse-link --><?//= $action == 'members' ? 'aside__collapse-link--active' : ''; ?><!--">-->
<!--                    Сотрудники-->
<!--                </a>-->
<!--            </li>-->
<!--            <li class="aside__collapse-item">-->
<!--                <a href="--><?//=URL::site('org/patients'); ?><!--"  class="aside__collapse-link --><?//= $action == 'members' ? 'aside__collapse-link--active' : ''; ?><!--">-->
<!--                    Пациенты-->
<!--                </a>-->
<!--            </li>-->
<!--            <li class="aside__collapse-item">-->
<!--                <a href="--><?//=URL::site('org/reports'); ?><!--" class="aside__collapse-link --><?//= $action == 'reports' ? 'aside__collapse-link--active' : ''; ?><!--">-->
<!--                    Отчеты-->
<!--                </a>-->
<!--            </li>-->
<!--        </ul>-->
<!---->
<!--    </li>-->

</ul>