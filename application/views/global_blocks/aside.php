
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
                            Права доступа
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

        <li class="aside__item <? echo $action == "users" || $action == "profile" ? 'aside__item--active' : ''; ?>">
            <a href="<?=URL::site('users'); ?>" class="aside__link <? echo $action == "users" || $action == "user" ? 'aside__link--active' : ''; ?>">
                <i class="fa fa-users aside__icon" aria-hidden="true"></i>
                <span class="aside__text">Пользователи</span>
            </a>
        </li>

    <? endif; ?>


    <?  // Module Clients => permission: MODULE_CLIENTS = 6
    $new_clients = count(Model_Client::getClientsByStatus(1));
    if (in_array(6, $user->permissions)) : ?>

        <li class="aside__item <? echo $action == "clients_new" || $action == "clients_in" || $action == "clients_out" || $action == "clients_reject" || $action == "clients_client" ? 'aside__item--active' : ''; ?>">

            <a role="button" data-toggle="collapse" data-area="moduleClients" data-opened="false" class="aside__link <? echo $action == "clients_new" || $action == "clients_in" || $action == "clients_out" || $action == "clients_reject" ? 'aside__link--active' : ''; ?>">
                <i class="fa fa-cubes aside__icon" aria-hidden="true"></i>
                <span class="aside__text">Клиенты</span>
                <i class="fa fa-angle-down aside__icon--right" aria-hidden="true"></i>

                <?  // Module Clients => permission: CLIENTS_REQUESTS = 8
                if (in_array(8, $user->permissions) && $new_clients > 0) : ?>

                    <div class="label label--absolute label--brand m-t-10 m-r-30"><?= $new_clients; ?></div>

                <? endif; ?>
            </a>

            <ul id="moduleClients" class="aside__collapse collapse list-style--none">

                <?  // Module Clients => permission: CLIENTS_REQUESTS = 8
                if (in_array(8, $user->permissions)) : ?>

                    <li class="aside__collapse-item">
                        <a href="<?=URL::site('clients/new'); ?>"  class="aside__collapse-link <?= $action == 'clients_new' ? 'aside__collapse-link--active' : ''; ?>">
                            Новые

                            <? if ($new_clients > 0) : ?>

                                <div class="label label--absolute label--brand m-t-10 m-r-30"><?= $new_clients; ?></div>

                            <? endif; ?>

                        </a>
                    </li>

                <? endif; ?>

                <li class="aside__collapse-item">
                    <a href="<?=URL::site('clients/in'); ?>" class="aside__collapse-link <?= $action == 'clients_in' ? 'aside__collapse-link--active' : ''; ?>">
                        В системе
                    </a>
                </li>

                <li class="aside__collapse-item">
                    <a href="<?=URL::site('clients/out'); ?>" class="aside__collapse-link <?= $action == 'clients_out' ? 'aside__collapse-link--active' : ''; ?>">
                        Без доступа
                    </a>
                </li>

            </ul>

        </li>

    <? endif; ?>


    <? // Module Organizations => permission: WATCH_ALL_ORGS_PAGES = 14 || WATCH_CREATED_ORGS_PAGES = 15
    if (in_array(14, $user->permissions) || in_array(15, $user->permissions)) : ?>

        <li class="aside__item <? echo $action == 'org_all'
                                    || $action == 'org_created'
                                    || $action == "org_organization"
                                    || $action == "org_settings"
                                    || $action == "org_statistic" ? 'aside__item--active' : ''; ?>">
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

        <li class="aside__item <? echo $action == 'org_my'
                                        || $action == "org_organization"
                                        || $action == "org_settings"
                                        || $action == "org_statistic" ? 'aside__item--active' : ''; ?>">
            <a href="<?=URL::site('organizations/my'); ?>" class="aside__link <? echo $action == "org_my" ? 'aside__link--active' : ''; ?>">
                <i class="fa fa-briefcase aside__icon" aria-hidden="true"></i>
                <span class="aside__text">Мои организации</span>
            </a>
        </li>

    <? endif; ?>


    <? // Module Pensions => permission: WATCH_ALL_PENSIONS_PAGES = 24 || WATCH_CREATED_PENSIONS_PAGES = 25
    if (in_array(24, $user->permissions) || in_array(25, $user->permissions)) : ?>

        <li class="aside__item <? echo $action == 'pen_all'
                                    || $action == 'pen_created'
                                    || $action == "pen_pension"
                                    || $action == "pen_settings"
                                    || $action == "pen_statistic"
                                    || $action == "pen_survey"
                                    || $action == "pen_patients"? 'aside__item--active' : ''; ?>">
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

        <li class="aside__item <? echo $action == "pen_my"
                                    || $action == "pen_pension"
                                    || $action == "pen_settings"
                                    || $action == "pen_statistic"
                                    || ($action == "pen_survey" && !$form)
                                    || $action == "pen_patients"? 'aside__item--active' : ''; ?>">
            <a href="<?=URL::site('pensions/my'); ?>" class="aside__link <? echo $action == "pen_my" ? 'aside__link--active' : ''; ?>">
                <i class="fa fa-user-md aside__icon" aria-hidden="true"></i>
                <span class="aside__text">Мои пансионаты</span>
            </a>
        </li>

    <? endif; ?>


    <? // Module Patients => WATCH_ALL_PATIENTS_PROFILES = 34
    if (in_array(34, $user->permissions)) : ?>

        <li class="aside__item <? echo $action == "all_patients"? 'aside__item--active' : ''; ?>">
            <a href="<?=URL::site('patients'); ?>" class="aside__link <? echo $action == "all_patients" ? 'aside__link--active' : ''; ?>">
                <i class="fa fa-database aside__icon" aria-hidden="true"></i>
                <span class="aside__text">БД всех пациентов</span>
            </a>
        </li>

    <? endif; ?>


    <? // Module Pensions Survey => CAN_CONDUCT_A_SURVEY = 36
    if (in_array(36, $user->permissions) && $action == "pen_survey") : ?>

        <? if ($form) : ?>

            <div class="divider"></div>

            <li class="aside__item">
                <div class="text-bold p-5 p-l-10 text-brand aside__text">Анкетирование</div>
            </li>

            <li class="aside__item <? echo $unit == 'unitprogress' || $unit == 'unit' ? 'aside__item--active' : '' ?>">
                <a onclick="survey.get.unit('progress')" class="aside__link display-flex <? echo $unit == 'unitprogress' || $unit == 'unit' ? 'aside__link--active' : '' ?>">
                    <i class="fa fa-bookmark aside__icon" aria-hidden="true"></i>
                    <span class="white-space--normal aside__text">Прогресс</span>
                </a>
            </li>


            <li class="aside__item <? echo $unit == 'unitA' ? 'aside__item--active' : '' ?>">
                <a onclick="survey.get.unit('A')" class="aside__link display-flex <? echo $unit == 'unitA' ? 'aside__link--active' : '' ?>">
                    <i class="fa fa-address-card-o aside__icon" aria-hidden="true"></i>
                    <span class="white-space--normal aside__text">Персональная информация</span>
                </a>
            </li>

            <li class="aside__item <? echo $unit == 'unitB' ? 'aside__item--active' : '' ?>">
                <a onclick="survey.get.unit('B')" class="aside__link display-flex <? echo $unit == 'unitB' ? 'aside__link--active' : '' ?>">
                    <i class="fa fa-history aside__icon" aria-hidden="true"></i>
                    <span class="white-space--normal aside__text">Первоначальная история</span>
                </a>
            </li>

            <li class="aside__item <? echo $unit == 'unitC' ? 'aside__item--active' : '' ?>">
                <a onclick="survey.get.unit('C')" class="aside__link display-flex <? echo $unit == 'unitC' ? 'aside__link--active' : '' ?>">
                    <i class="fa fa-bullseye aside__icon" aria-hidden="true"></i>
                    <span class="white-space--normal aside__text">Когнитивные способности</span>
                </a>
            </li>

            <li class="aside__item <? echo $unit == 'unitD' ? 'aside__item--active' : '' ?>">
                <a onclick="survey.get.unit('D')" class="aside__link display-flex <? echo $unit == 'unitD' ? 'aside__link--active' : '' ?>">
                    <i class="fa fa-eye aside__icon" aria-hidden="true"></i>
                    <span class="white-space--normal aside__text">Коммуникация и зрение</span>
                </a>
            </li>

            <li class="aside__item <? echo $unit == 'unitE' ? 'aside__item--active' : '' ?>">
                <a onclick="survey.get.unit('E')" class="aside__link display-flex <? echo $unit == 'unitE' ? 'aside__link--active' : '' ?>">
                    <i class="fa fa-smile-o aside__icon" aria-hidden="true"></i>
                    <span class="white-space--normal aside__text">Настроение и поведение</span>
                </a>
            </li>

            <li class="aside__item <? echo $unit == 'unitF' ? 'aside__item--active' : '' ?>">
                <a onclick="survey.get.unit('F')" class="aside__link display-flex <? echo $unit == 'unitF' ? 'aside__link--active' : '' ?>">
                    <i class="fa fa-group aside__icon" aria-hidden="true"></i>
                    <span class="white-space--normal aside__text">Психосоциальное благополучие</span>
                </a>
            </li>

            <li class="aside__item <? echo $unit == 'unitG' ? 'aside__item--active' : '' ?>">
                <a onclick="survey.get.unit('G')" class="aside__link display-flex <? echo $unit == 'unitG' ? 'aside__link--active' : '' ?>">
                    <i class="fa fa-child aside__icon" aria-hidden="true"></i>
                    <span class="white-space--normal aside__text">Функциональное состояние</span>
                </a>
            </li>

            <li class="aside__item <? echo $unit == 'unitH' ? 'aside__item--active' : '' ?>">
                <a onclick="survey.get.unit('H')" class="aside__link display-flex <? echo $unit == 'unitH' ? 'aside__link--active' : '' ?>">
                    <i class="fa fa-frown-o aside__icon" aria-hidden="true"></i>
                    <span class="white-space--normal aside__text">Недержание</span>
                </a>
            </li>

            <li class="aside__item <? echo $unit == 'unitI' ? 'aside__item--active' : '' ?>">
                <a onclick="survey.get.unit('I')" class="aside__link display-flex <? echo $unit == 'unitI' ? 'aside__link--active' : '' ?>">
                    <i class="fa fa-folder-o aside__icon" aria-hidden="true"></i>
                    <span class="white-space--normal aside__text">Диагнозы</span>
                </a>
            </li>

            <li class="aside__item <? echo $unit == 'unitJ' ? 'aside__item--active' : '' ?>">
                <a onclick="survey.get.unit('J')" class="aside__link display-flex <? echo $unit == 'unitJ' ? 'aside__link--active' : '' ?>">
                    <i class="fa fa-blind aside__icon" aria-hidden="true"></i>
                    <span class="white-space--normal aside__text">Нарушения состояния здоровья</span>
                </a>
            </li>

            <li class="aside__item <? echo $unit == 'unitK' ? 'aside__item--active' : '' ?>">
                <a onclick="survey.get.unit('K')" class="aside__link display-flex <? echo $unit == 'unitK' ? 'aside__link--active' : '' ?>">
                    <i class="fa fa-cutlery aside__icon" aria-hidden="true"></i>
                    <span class="white-space--normal aside__text">Вопросы питания и состояние ротовой области</span>
                </a>
            </li>

            <li class="aside__item <? echo $unit == 'unitL' ? 'aside__item--active' : '' ?>">
                <a onclick="survey.get.unit('L')" class="aside__link display-flex <? echo $unit == 'unitL' ? 'aside__link--active' : '' ?>">
                    <i class="fa fa-info-circle aside__icon" aria-hidden="true"></i>
                    <span class="white-space--normal aside__text">Состояние кожи</span>
                </a>
            </li>

            <li class="aside__item <? echo $unit == 'unitM' ? 'aside__item--active' : '' ?>">
                <a onclick="survey.get.unit('M')" class="aside__link display-flex <? echo $unit == 'unitM' ? 'aside__link--active' : '' ?>">
                    <i class="fa fa-music aside__icon" aria-hidden="true"></i>
                    <span class="white-space--normal aside__text">Досуг</span>
                </a>
            </li>

            <li class="aside__item <? echo $unit == 'unitN' ? 'aside__item--active' : '' ?>">
                <a onclick="survey.get.unit('N')" class="aside__link display-flex <? echo $unit == 'unitN' ? 'aside__link--active' : '' ?>">
                    <i class="fa fa-braille aside__icon" aria-hidden="true"></i>
                    <span class="white-space--normal aside__text">Лекарственные средства</span>
                </a>
            </li>

            <li class="aside__item <? echo $unit == 'unitO' ? 'aside__item--active' : '' ?>">
                <a onclick="survey.get.unit('O')" class="aside__link display-flex <? echo $unit == 'unitO' ? 'aside__link--active' : '' ?>">
                    <i class="fa fa-bath aside__icon" aria-hidden="true"></i>
                    <span class="white-space--normal aside__text">Лечебные мероприятия и процедуры</span>
                </a>
            </li>

            <li class="aside__item <? echo $unit == 'unitP' ? 'aside__item--active' : '' ?>">
                <a onclick="survey.get.unit('P')" class="aside__link display-flex <? echo $unit == 'unitP' ? 'aside__link--active' : '' ?>">
                    <i class="fa fa-gavel aside__icon" aria-hidden="true"></i>
                    <span class="white-space--normal aside__text">Правовая ответственность и распоряжения</span>
                </a>
            </li>

            <li class="aside__item <? echo $unit == 'unitQ' ? 'aside__item--active' : '' ?>">
                <a onclick="survey.get.unit('Q')" class="aside__link display-flex <? echo $unit == 'unitQ' ? 'aside__link--active' : '' ?>">
                    <i class="fa fa-home aside__icon" aria-hidden="true"></i>
                    <span class="white-space--normal aside__text">Перспективы выписки и выписка</span>
                </a>
            </li>

        <? endif; ?>

    <? endif; ?>


</ul>