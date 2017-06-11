
<ul class="aside__menu list-style--none">

    <li class="aside__item <? echo $action == "dashboard" ? 'aside__item--active' : ''; ?>">
        <a href="<?=URL::site('dashboard'); ?>" class="aside__link <? echo $action == "dashboard" ? 'aside__link--active' : ''; ?>">
            <i class="fa fa-dashboard aside__icon" aria-hidden="true"></i>
            <span class="aside__text">Главная</span>
        </a>
    </li>


    <? // Module Admin => permission: MODULE_ADMIN = 1
        if (in_array(1, $user->permissions)) : ?>

        <li class="aside__item <? echo $action == 'rules' || $action == 'orgs' || $action == 'pensions' || $action == 'newuser'? 'aside__item--active' : ''; ?>">

            <a role="button" data-toggle="collapse" data-area="moduleAdmin" data-opened="false" class="aside__link <? echo $action == 'rules' || $action == 'orgs' || $action == 'pensions' || $action == 'newuser'? 'aside__link--active' : ''; ?>">
                <i class="fa fa-cubes aside__icon" aria-hidden="true"></i>
                <span class="aside__text">Панель админа</span>
                <i class="fa fa-angle-down aside__icon--right" aria-hidden="true"></i>
            </a>

            <ul id="moduleAdmin" class="aside__collapse collapse list-style--none">

                <? // Module Admin => permission: ROLES_AND_PERMISSIONS = 2
                    if (in_array(2, $user->permissions)) : ?>

                    <li class="aside__collapse-item">
                        <a href="<?=URL::site('admin/rules'); ?>"  class="aside__collapse-link <?= $action == 'rules' ? 'aside__collapse-link--active' : ''; ?>">
                            Roles&Permissions
                        </a>
                    </li>

                <? endif; ?>

                <? // Module Admin => permission: CHANGE_ORGANIZATION_OWNER = 3
                    if (in_array(3, $user->permissions)) : ?>

                    <li class="aside__collapse-item">
                        <a href="<?=URL::site('admin/orgs'); ?>"  class="aside__collapse-link <?= $action == 'orgs' ? 'aside__collapse-link--active' : ''; ?>">
                            Организации
                        </a>
                    </li>

                <? endif; ?>

                <? // Module Admin => permission: CHANGE_PENSION_OWNER = 4
                    if (in_array(4, $user->permissions)) : ?>

                    <li class="aside__collapse-item">
                        <a href="<?=URL::site('admin/pensions'); ?>" class="aside__collapse-link <?= $action == 'pensions' ? 'aside__collapse-link--active' : ''; ?>">
                            Пансионаты
                        </a>
                    </li>

                <? endif; ?>

                <? // Module Admin => permission: CREATE_USERS = 5
                if (in_array(5, $user->permissions)) : ?>

                    <li class="aside__collapse-item">
                        <a href="<?=URL::site('admin/newuser'); ?>" class="aside__collapse-link <?= $action == 'newuser' ? 'aside__collapse-link--active' : ''; ?>">
                            Пользователи
                        </a>
                    </li>

                <? endif; ?>

            </ul>

        </li>

    <? endif; ?>


    <?  // Module Users => permission: MODULE_USERS = 10
        if (in_array(10, $user->permissions)) : ?>

        <li class="aside__item <? echo $action == "users" || $action == "user" ? 'aside__item--active' : ''; ?>">
            <a href="<?=URL::site('users'); ?>" class="aside__link <? echo $action == "users" || $action == "user" ? 'aside__link--active' : ''; ?>">
                <i class="fa fa-users aside__icon" aria-hidden="true"></i>
                <span class="aside__text">Пользователи</span>
            </a>
        </li>

    <? endif; ?>


    <?  // Module Clients => permission: MODULE_CLIENTS = 6
        if (in_array(6, $user->permissions)) : ?>

        <li class="aside__item <? echo $action == "clients" || $action == "client" ? 'aside__item--active' : ''; ?>">
            <a href="<?=URL::site('clients'); ?>" class="aside__link <? echo $action == "clients" || $action == "client" ? 'aside__link--active' : ''; ?>">
                <i class="fa fa-id-card-o aside__icon" aria-hidden="true"></i>

                <?  // Module Clients => permission: CLIENTS_REQUESTS = 8
                    if (in_array(8, $user->permissions)) : ?>

                    <div class="label label--danger m-t-10 m-r-10"><?= count(Model_Client::getClientsByStatus(1)); ?></div>

                <? endif; ?>

                <span class="aside__text">Клиенты</span>
            </a>
        </li>

    <? endif; ?>


    <? // Module Organizations => permission: WATCH_ALL_ORGS_PAGES = 14 || WATCH_CREATED_ORGS_PAGES = 15
        if (in_array(14, $user->permissions) || in_array(15, $user->permissions)) : ?>

        <li class="aside__item <? echo $action == 'all' || $action == 'created' || $action == "organization" ? 'aside__item--active' : ''; ?>">

            <a role="button" data-toggle="collapse" data-area="moduleOrganizations" data-opened="false" class="aside__link <? echo $action == 'all' || $action == 'created' ? 'aside__link--active' : ''; ?>">
                <i class="fa fa-cubes aside__icon" aria-hidden="true"></i>
                <span class="aside__text">Организации</span>
                <i class="fa fa-angle-down aside__icon--right" aria-hidden="true"></i>
            </a>

            <ul id="moduleOrganizations" class="aside__collapse collapse list-style--none">

                <? // Module Organizations => permission: WATCH_ALL_ORGS_PAGES = 14
                if (in_array(14, $user->permissions)) : ?>

                    <li class="aside__collapse-item">
                        <a href="<?=URL::site('organizations/all'); ?>"  class="aside__collapse-link <?= $action == 'all' ? 'aside__collapse-link--active' : ''; ?>">
                            Все организации
                        </a>
                    </li>

                <? endif; ?>

                <? // Module Organizations => permission: WATCH_CREATED_ORGS_PAGES = 15
                if (in_array(15, $user->permissions)) : ?>

                    <li class="aside__collapse-item">
                        <a href="<?=URL::site('organizations/created'); ?>"  class="aside__collapse-link <?= $action == 'created' ? 'aside__collapse-link--active' : ''; ?>">
                            Созданные орг-ии
                        </a>
                    </li>

                <? endif; ?>

            </ul>

        </li>

    <? endif; ?>

    <? // Module Organizations => WATCH_CERTAIN_ORGS_PAGES = 16
        if (in_array(16, $user->permissions)) : ?>

        <li class="aside__item <? echo $action == "my" || $action == "organization" ? 'aside__item--active' : ''; ?>">
            <a href="<?=URL::site('organizations/my'); ?>" class="aside__link <? echo $action == "my" ? 'aside__link--active' : ''; ?>">
                <i class="fa fa-cubes aside__icon" aria-hidden="true"></i>
                <span class="aside__text">Мои организации</span>
            </a>
        </li>

    <? endif; ?>

</ul>