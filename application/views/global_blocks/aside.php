
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

                <? // Module Admin => permission: CREATE_USERS = 5
                if (in_array(5, $user->permissions)) : ?>

                    <li class="aside__collapse-item">
                        <a href="<?=URL::site('admin/newuser'); ?>" class="aside__collapse-link <?= $action == 'newuser' ? 'aside__collapse-link--active' : ''; ?>">
                            New user
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

                    <div class="label label--absolute label--danger m-t-10 m-r-10"><?= count(Model_Client::getClientsByStatus(1)); ?></div>

                <? endif; ?>

                <span class="aside__text">Клиенты</span>
            </a>
        </li>

    <? endif; ?>


    <? // Module Organizations => permission: WATCH_ALL_ORGS_PAGES = 14 || WATCH_CREATED_ORGS_PAGES = 15
    if (in_array(14, $user->permissions) || in_array(15, $user->permissions)) : ?>

        <li class="aside__item <? echo $action == 'org_all' || $action == 'org_created' || $action == "org_organization" ? 'aside__item--active' : ''; ?>">

            <a role="button" data-toggle="collapse" data-area="moduleOrganizations" data-opened="false" class="aside__link <? echo $action == 'org_all' || $action == 'org_created' ? 'aside__link--active' : ''; ?>">
                <i class="fa fa-briefcase aside__icon" aria-hidden="true"></i>
                <span class="aside__text">Организации</span>
                <i class="fa fa-angle-down aside__icon--right" aria-hidden="true"></i>
            </a>

            <ul id="moduleOrganizations" class="aside__collapse collapse list-style--none">

                <? // Module Organizations => permission: WATCH_ALL_ORGS_PAGES = 14
                if (in_array(14, $user->permissions)) : ?>

                    <li class="aside__collapse-item">
                        <a href="<?=URL::site('organizations/all'); ?>"  class="aside__collapse-link <?= $action == 'org_all' ? 'aside__collapse-link--active' : ''; ?>">
                            Все организации
                        </a>
                    </li>

                <? endif; ?>

                <? // Module Organizations => permission: WATCH_CREATED_ORGS_PAGES = 15
                if (in_array(15, $user->permissions)) : ?>

                    <li class="aside__collapse-item">
                        <a href="<?=URL::site('organizations/created'); ?>"  class="aside__collapse-link <?= $action == 'org_created' ? 'aside__collapse-link--active' : ''; ?>">
                            Созданные орг-ии
                        </a>
                    </li>

                <? endif; ?>

            </ul>

        </li>

    <? endif; ?>


    <? // Module Organizations => WATCH_CERTAIN_ORGS_PAGES = 16
    if (in_array(16, $user->permissions)) : ?>

        <li class="aside__item <? echo $action == "org_my" || $action == "org_organization" ? 'aside__item--active' : ''; ?>">
            <a href="<?=URL::site('organizations/my'); ?>" class="aside__link <? echo $action == "org_my" ? 'aside__link--active' : ''; ?>">
                <i class="fa fa-briefcase aside__icon" aria-hidden="true"></i>
                <span class="aside__text">Мои организации</span>
            </a>
        </li>

    <? endif; ?>


    <? // Module Pensions => permission: WATCH_ALL_PENSIONS_PAGES = 24 || WATCH_CREATED_PENSIONS_PAGES = 25
    if (in_array(24, $user->permissions) || in_array(25, $user->permissions)) : ?>

        <li class="aside__item <? echo $action == 'pen_all' || $action == 'pen_created' || $action == "pen_pension" ? 'aside__item--active' : ''; ?>">

            <a role="button" data-toggle="collapse" data-area="modulePensions" data-opened="false" class="aside__link <? echo $action == 'pen_all' || $action == 'pen_created' ? 'aside__link--active' : ''; ?>">
                <i class="fa fa-user-md aside__icon" aria-hidden="true"></i>
                <span class="aside__text">Пансионаты</span>
                <i class="fa fa-angle-down aside__icon--right" aria-hidden="true"></i>
            </a>

            <ul id="modulePensions" class="aside__collapse collapse list-style--none">

                <? // Module Pensions => permission: WATCH_ALL_PENSIONS_PAGES = 24
                if (in_array(24, $user->permissions)) : ?>

                    <li class="aside__collapse-item">
                        <a href="<?=URL::site('pensions/all'); ?>"  class="aside__collapse-link <?= $action == 'pen_all' ? 'aside__collapse-link--active' : ''; ?>">
                            Все пансионаты
                        </a>
                    </li>

                <? endif; ?>

                <? // Module Pensions => permission: WATCH_CREATED_PENSIONS_PAGES = 25
                if (in_array(25, $user->permissions)) : ?>

                    <li class="aside__collapse-item">
                        <a href="<?=URL::site('pensions/created'); ?>"  class="aside__collapse-link <?= $action == 'pen_created' ? 'aside__collapse-link--active' : ''; ?>">
                            Созданные пан-ты
                        </a>
                    </li>

                <? endif; ?>

            </ul>

        </li>

    <? endif; ?>


    <? // Module Pensions => WATCH_CERTAIN_PENSIONS_PAGES = 26
    if (in_array(26, $user->permissions)) : ?>

        <li class="aside__item <? echo $action == "pen_my" || $action == "pen_pension" ? 'aside__item--active' : ''; ?>">
            <a href="<?=URL::site('pensions/my'); ?>" class="aside__link <? echo $action == "pen_my" ? 'aside__link--active' : ''; ?>">
                <i class="fa fa-user-md aside__icon" aria-hidden="true"></i>
                <span class="aside__text">Мои пансионаты</span>
            </a>
        </li>

    <? endif; ?>

</ul>