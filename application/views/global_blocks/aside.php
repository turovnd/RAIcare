<ul class="aside__menu list-style--none">

    <li class="aside__item <? echo $action == 'dashboard' ? 'aside__item--active' : ''; ?>">
        <a href="<?= '/\/' .$_SERVER['HTTP_HOST'] . '/dashboard'; ?>" class="aside__link <? echo $action == "dashboard" ? 'aside__link--active' : ''; ?>">
            <i class="fa fa-dashboard aside__icon" aria-hidden="true"></i>
            <span class="aside__text">Главная</span>
        </a>
    </li>


    <? if ( $aside_type == 'organization' || $aside_type == 'dashboard' || $aside_type == 'profile') : ?>

        <? // ROLE_ORG_CREATOR || ROLE_ORG_CO_WORKER_MANAGER => 10 || 11
        if ( $user->role == 10 || $user->role == 11) : ?>
            <li class="aside__item <? echo $action == "manage" ? 'aside__item--active' : ''; ?>">
                <a href="<?= '/\/' .$_SERVER['HTTP_HOST'] . '/manage'; ?>" class="aside__link <? echo $action == "manage" ? 'aside__link--active' : ''; ?>">
                    <i class="fa fa-group aside__icon" aria-hidden="true"></i>
                    <span class="aside__text">Сотрудники</span>
                </a>
            </li>
        <? endif; ?>

        <? // ROLE_ORG_CREATOR || ROLE_ORG_QUALITY_MANAGER => 10 || 12
        if ( $user->role == 10 || $user->role == 12 ) : ?>
            <li class="aside__item <? echo $action == "control_organization" ? 'aside__item--active' : ''; ?>">
                <a href="<?= '/\/' .$_SERVER['HTTP_HOST'] . '/control/organization'; ?>" class="aside__link <? echo $action == "control_organization" ? 'aside__link--active' : ''; ?>">
                    <i class="fa fa-pie-chart aside__icon" aria-hidden="true"></i>
                    <span class="aside__text">Динамика орг-ии</span>
                </a>
            </li>
            <li class="aside__item <? echo $action == "control_pension" ? 'aside__item--active' : ''; ?>">
                <a href="<?= '/\/' .$_SERVER['HTTP_HOST'] . '/control/pension'; ?>" class="aside__link <? echo $action == "control_pension" ? 'aside__link--active' : ''; ?>">
                    <i class="fa fa-area-chart aside__icon" aria-hidden="true"></i>
                    <span class="aside__text">Динамика пан-та</span>
                </a>
            </li>
            <li class="aside__item <? echo $action == "control_patient" ? 'aside__item--active' : ''; ?>">
                <a href="<?= '/\/' .$_SERVER['HTTP_HOST'] . '/control/patient'; ?>" class="aside__link <? echo $action == "control_patient" ? 'aside__link--active' : ''; ?>">
                    <i class="fa fa-line-chart aside__icon" aria-hidden="true"></i>
                    <span class="aside__text">Динамика пац-та</span>
                </a>
            </li>
        <? endif; ?>

    <? endif; ?>


    <? if ( $aside_type == 'pension' || $aside_type == 'survey' || $aside_type == 'report') : ?>

        <li class="divider"></li>
        <li class="aside__text text-bold f-s-0_8 p-5">Пансионат</li>

        <li class="aside__item <? echo $action == "index" ? 'aside__item--active' : ''; ?>">
            <a href="<?='/\/' . $_SERVER['HTTP_HOST'] . '/' . $pension->uri; ?>" class="aside__link <? echo $action == "index" ? 'aside__link--active' : ''; ?>">
                <i class="fa fa-user-md aside__icon" aria-hidden="true"></i>
                <span class="aside__text"><?= $pension->name; ?></span>
            </a>
        </li>

        <? // ROLE_PEN_CREATOR => 20
        if ( $user->role == 20 ) : ?>

            <li class="aside__item <? echo $action == "settings" ? 'aside__item--active' : ''; ?>">
                <a href="<?='/\/' . $_SERVER['HTTP_HOST'] . '/' . $pension->uri. '/settings' ?>" class="aside__link <? echo $action == "settings" ? 'aside__link--active' : ''; ?>">
                    <i class="fa fa-cogs aside__icon" aria-hidden="true"></i>
                    <span class="aside__text">Настройки</span>
                </a>
            </li>

        <? endif; ?>

        <? // ROLE_PEN_CREATOR || ROLE_PEN_QUALITY_MANAGER => 20 || 22
        if ( $user->role == 20 || $user->role == 22 ) : ?>

            <li class="aside__item <? echo $action == "control" ? 'aside__item--active' : ''; ?>">
                <a href="<?= '/\/' .$_SERVER['HTTP_HOST'] . '/' . $pension->uri. '/control'; ?>" class="aside__link <? echo $action == "control" ? 'aside__link--active' : ''; ?>">
                    <i class="fa fa-area-chart aside__icon" aria-hidden="true"></i>
                    <span class="aside__text">Динамика пан-та</span>
                </a>
            </li>

        <? endif; ?>

        <? // ROLE_PEN_CREATOR || ROLE_PEN_CO_WORKER_MANAGER => 20 || 21
        if ( $user->role == 20 || $user->role == 21) : ?>

            <li class="aside__item <? echo $action == "manage" ? 'aside__item--active' : ''; ?>">
                <a href="<?= '/\/' . $_SERVER['HTTP_HOST'] . '/' . $pension->uri . '/manage'; ?>" class="aside__link <? echo $action == "manage" ? 'aside__link--active' : ''; ?>">
                    <i class="fa fa-group aside__icon" aria-hidden="true"></i>
                    <span class="aside__text">Сотрудники</span>
                </a>
            </li>

        <? endif; ?>

        <? // ROLE_PEN_CREATOR || ROLE_PEN_QUALITY_MANAGER || ROLE_PEN_NURSE => 20 || 22 || 23
        if ( $user->role == 20 || $user->role == 22 || $user->role == 23 ) : ?>

            <li class="aside__item <? echo $action == "patients" ||
                                            $action == "patient" ? 'aside__item--active' : ''; ?>">
                <a href="<?='/\/' . $_SERVER['HTTP_HOST'] . '/' . $pension->uri. '/patients'; ?>" class="aside__link <? echo $action == "patients" ? 'aside__link--active' : ''; ?>">
                    <i class="fa fa-database aside__icon" aria-hidden="true"></i>
                    <span class="aside__text">Пациенты</span>
                </a>
            </li>

            <li class="aside__item <? echo $action == "surveys" ||
                                            $action == "survey" ||
                                            $aside_type == 'report' ? 'aside__item--active' : ''; ?>">
                <a href="<?= '/\/' .$_SERVER['HTTP_HOST'] . '/' . $pension->uri. '/surveys'; ?>" class="aside__link <? echo $action == "surveys" ? 'aside__link--active' : ''; ?>">
                    <i class="fa fa-archive aside__icon" aria-hidden="true"></i>
                    <span class="aside__text">Отчеты</span>
                </a>
            </li>

        <? endif; ?>

    <? endif; ?>


    <? if ( !empty($pensions)) : ?>

        <li class="divider"></li>
        <li class="aside__text text-bold f-s-0_8 p-5">Список пансионатов</li>

        <? foreach ($pensions as $pension) : ?>

            <li class="aside__item">
                <a href="<?='/\/' . $_SERVER['HTTP_HOST'] . '/' . $pension->uri; ?>" class="aside__link">
                    <i class="fa fa-user-md aside__icon" aria-hidden="true"></i>
                    <span class="aside__text"><?= $pension->name; ?></span>
                </a>
            </li>

        <? endforeach; ?>

    <? endif; ?>

    <? // ROLE_PEN_NURSE => 23
    if (!empty($survey) && $survey->status == 1 && $user->role == 23) : ?>

        <li class="divider"></li>
        <li class="aside__text text-bold f-s-0_8 p-5">Форма оценки #<?= $survey->id; ?></li>

        <li class="aside__item">
            <a href="#" class="aside__link display-flex">
                <i class="fa fa-bookmark aside__icon" aria-hidden="true"></i>
                <span class="white-space--normal aside__text">Прогресс</span>
            </a>
        </li>


        <li class="aside__item">
            <a href="#unitA" class="aside__link display-flex">
                <i class="fa fa-address-card-o aside__icon" aria-hidden="true"></i>
                <span class="white-space--normal aside__text">Персональная информация</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitB" class="aside__link display-flex">
                <i class="fa fa-history aside__icon" aria-hidden="true"></i>
                <span class="white-space--normal aside__text">Первоначальная история</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitC" class="aside__link display-flex">
                <i class="fa fa-bullseye aside__icon" aria-hidden="true"></i>
                <span class="white-space--normal aside__text">Когнитивные способности</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitD" class="aside__link display-flex">
                <i class="fa fa-eye aside__icon" aria-hidden="true"></i>
                <span class="white-space--normal aside__text">Коммуникация и зрение</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitE" class="aside__link display-flex">
                <i class="fa fa-smile-o aside__icon" aria-hidden="true"></i>
                <span class="white-space--normal aside__text">Настроение и поведение</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitF" class="aside__link display-flex">
                <i class="fa fa-group aside__icon" aria-hidden="true"></i>
                <span class="white-space--normal aside__text">Психосоциальное благополучие</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitG" class="aside__link display-flex">
                <i class="fa fa-child aside__icon" aria-hidden="true"></i>
                <span class="white-space--normal aside__text">Функциональное состояние</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitH" class="aside__link display-flex">
                <i class="fa fa-frown-o aside__icon" aria-hidden="true"></i>
                <span class="white-space--normal aside__text">Недержание</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitI" class="aside__link display-flex">
                <i class="fa fa-folder-o aside__icon" aria-hidden="true"></i>
                <span class="white-space--normal aside__text">Диагнозы</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitJ" class="aside__link display-flex">
                <i class="fa fa-blind aside__icon" aria-hidden="true"></i>
                <span class="white-space--normal aside__text">Нарушения состояния здоровья</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitK" class="aside__link display-flex">
                <i class="fa fa-cutlery aside__icon" aria-hidden="true"></i>
                <span class="white-space--normal aside__text">Вопросы питания и состояние ротовой области</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitL" class="aside__link display-flex">
                <i class="fa fa-info-circle aside__icon" aria-hidden="true"></i>
                <span class="white-space--normal aside__text">Состояние кожи</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitM" class="aside__link display-flex">
                <i class="fa fa-music aside__icon" aria-hidden="true"></i>
                <span class="white-space--normal aside__text">Досуг</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitN" class="aside__link display-flex">
                <i class="fa fa-braille aside__icon" aria-hidden="true"></i>
                <span class="white-space--normal aside__text">Лекарственные средства</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitO" class="aside__link display-flex">
                <i class="fa fa-bath aside__icon" aria-hidden="true"></i>
                <span class="white-space--normal aside__text">Лечебные мероприятия и процедуры</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitP" class="aside__link display-flex">
                <i class="fa fa-gavel aside__icon" aria-hidden="true"></i>
                <span class="white-space--normal aside__text">Правовая ответственность и распоряжения</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitQ" class="aside__link display-flex">
                <i class="fa fa-home aside__icon" aria-hidden="true"></i>
                <span class="white-space--normal aside__text">Перспективы выписки</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitR" class="aside__link display-flex">
                <i class="fa fa-home aside__icon" aria-hidden="true"></i>
                <span class="white-space--normal aside__text">Выписка</span>
            </a>
        </li>

    <? endif; ?>


</ul>