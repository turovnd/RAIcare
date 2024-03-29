<ul class="aside__menu list-style--none">

    <li class="aside__item <? echo $action == 'dashboard' ? 'aside__item--active' : ''; ?>">
        <a href="<?= '/\/' .$_SERVER['HTTP_HOST'] . '/dashboard'; ?>" class="aside__link <? echo $action == "dashboard" ? 'aside__link--active' : ''; ?>">
            <i class="fa fa-dashboard aside__icon" aria-hidden="true"></i>
            <span class="aside__text">Главная</span>
        </a>
    </li>


    <? if ( $aside_type == 'organization' || $aside_type == 'dashboard' || $aside_type == 'profile') : ?>

        <? if ( $user->role == 2 || $user->role == 10 || $user->role == 11) : ?>
            <li class="aside__item <? echo $action == "manage" ? 'aside__item--active' : ''; ?>">
                <a href="<?= '/\/' .$_SERVER['HTTP_HOST'] . '/manage'; ?>" class="aside__link <? echo $action == "manage" ? 'aside__link--active' : ''; ?>">
                    <i class="fa fa-group aside__icon" aria-hidden="true"></i>
                    <span class="aside__text">Сотрудники</span>
                </a>
            </li>
        <? endif; ?>

        <? if ( $user->role == 2 || $user->role == 10 || $user->role == 12 ) : ?>
            <li class="hide aside__item <? echo $action == "control_organization" ? 'aside__item--active' : ''; ?>">
                <a href="<?= '/\/' .$_SERVER['HTTP_HOST'] . '/control/organization'; ?>" class="aside__link <? echo $action == "control_organization" ? 'aside__link--active' : ''; ?>">
                    <i class="fa fa-pie-chart aside__icon" aria-hidden="true"></i>
                    <span class="aside__text">отчеты</span>
                </a>
            </li>
        <? endif; ?>

    <? endif; ?>


    <? if ( $aside_type == 'pension' || $aside_type == 'survey' || $aside_type == 'patient' || $aside_type == 'report') : ?>

        <li class="divider"></li>
        <li class="aside__text text-bold f-s-0_8 p-5">Раздел пансионата</li>

        <li class="aside__item <? echo $action == "index" ? 'aside__item--active' : ''; ?>">
            <a href="<?='/\/' . $_SERVER['HTTP_HOST'] . '/' . $pension->uri; ?>" class="aside__link <? echo $action == "index" ? 'aside__link--active' : ''; ?>">
                <i class="fa fa-user-md aside__icon" aria-hidden="true"></i>
                <span class="aside__text"><?= $pension->name; ?></span>
            </a>
        </li>

        <? if ( $user->role == 1 || $user->role == 2 || $user->role == 10 || $user->role == 20 ) : ?>

            <li class="aside__item <? echo $action == "settings" ? 'aside__item--active' : ''; ?>">
                <a href="<?='/\/' . $_SERVER['HTTP_HOST'] . '/' . $pension->uri. '/settings' ?>" class="aside__link <? echo $action == "settings" ? 'aside__link--active' : ''; ?>">
                    <i class="fa fa-cogs aside__icon" aria-hidden="true"></i>
                    <span class="aside__text">Настройки</span>
                </a>
            </li>

        <? endif; ?>

        <? if ( $user->role == 2 || $user->role == 20 || $user->role == 21) : ?>

            <li class="aside__item <? echo $action == "manage" ? 'aside__item--active' : ''; ?>">
                <a href="<?= '/\/' . $_SERVER['HTTP_HOST'] . '/' . $pension->uri . '/manage'; ?>" class="aside__link <? echo $action == "manage" ? 'aside__link--active' : ''; ?>">
                    <i class="fa fa-group aside__icon" aria-hidden="true"></i>
                    <span class="aside__text">Сотрудники</span>
                </a>
            </li>

        <? endif; ?>

        <? if ( $user->role == 1 || $user->role == 2 || $user->role == 10 || $user->role == 12 ||
                $user->role == 20 || $user->role == 22 || $user->role == 23 ) : ?>

            <li class="aside__item <? echo $aside_type == "patient" ||
                                            $action == "patients" ||
                                            $action == "survey" ||
                                            $action == "patient" ? 'aside__item--active' : ''; ?>">
                <a href="<?='/\/' . $_SERVER['HTTP_HOST'] . '/' . $pension->uri. '/patients'; ?>" class="aside__link <? echo $action == "patients" ? 'aside__link--active' : ''; ?>">
                    <i class="fa fa-database aside__icon" aria-hidden="true"></i>
                    <span class="aside__text">Резиденты</span>
                </a>
            </li>

        <? endif; ?>


        <? if ( $user->role == 2 || $user->role == 20 || $user->role == 22 ) : ?>

            <li class="hide aside__item <? echo $aside_type == 'report' ? 'aside__item--active' : ''; ?>">
                <a role="button" data-toggle="collapse" data-area="reportsMenu" data-opened="<?= $aside_type == 'report' ? 'true' : 'false'?>"
                                                                    class="aside__link <?= $aside_type == 'report' ? 'aside__link--active' : ''; ?>">
                    <i class="fa fa-file aside__icon" aria-hidden="true"></i>
                    <span class="aside__text">Отчеты</span>
                    <i class="fa fa-angle-down aside__icon--right" aria-hidden="true"></i>
                </a>
                <ul id="reportsMenu" class="aside__collapse collapse list-style--none">
                    <li class="aside__collapse-item">
                        <a href="<?= '/\/' .$_SERVER['HTTP_HOST'] . '/' . $pension->uri. '/reports/'; ?>" class="aside__collapse-link">
                            213
                        </a>
                    </li>
                    <li class="aside__collapse-item">
                        <a href="<?=URL::site('sign/organizer/logout'); ?>" class="aside__collapse-link">
                            123
                        </a>
                    </li>
                </ul>
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

    <? if (!empty($survey) && $survey->status == 1 && ($user->role == 23 || $user->role == 2)) : ?>

        <li class="divider"></li>
        <li class="aside__text text-bold f-s-0_8 p-5">Анкета #<?= $survey->id; ?></li>

        <li class="aside__item">
            <a href="#" class="aside__link display-flex">
                <i class="fa fa-line-chart aside__icon" aria-hidden="true"></i>
                <span class="white-space--normal aside__text">Прогресс</span>
            </a>
        </li>


        <li class="aside__item">
            <a href="#unitA" class="aside__link display-flex">
                <i class="fa aside__icon text-bold">A</i>
                <span class="white-space--normal aside__text">Персональная информация</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitB" class="aside__link display-flex">
                <i class="fa aside__icon text-bold">B</i>
                <span class="white-space--normal aside__text">Первоначальная история</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitC" class="aside__link display-flex">
                <i class="fa aside__icon text-bold">C</i>
                <span class="white-space--normal aside__text">Когнитивные способности</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitD" class="aside__link display-flex">
                <i class="fa aside__icon text-bold">D</i>
                <span class="white-space--normal aside__text">Коммуникация и зрение</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitE" class="aside__link display-flex">
                <i class="fa aside__icon text-bold">E</i>
                <span class="white-space--normal aside__text">Настроение и поведение</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitF" class="aside__link display-flex">
                <i class="fa aside__icon text-bold">F</i>
                <span class="white-space--normal aside__text">Психосоциальное благополучие</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitG" class="aside__link display-flex">
                <i class="fa aside__icon text-bold">G</i>
                <span class="white-space--normal aside__text">Функциональное состояние</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitH" class="aside__link display-flex">
                <i class="fa aside__icon text-bold">H</i>
                <span class="white-space--normal aside__text">Недержание</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitI" class="aside__link display-flex">
                <i class="fa aside__icon text-bold">I</i>
                <span class="white-space--normal aside__text">Диагнозы</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitJ" class="aside__link display-flex">
                <i class="fa aside__icon text-bold">J</i>
                <span class="white-space--normal aside__text">Нарушения состояния здоровья</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitK" class="aside__link display-flex">
                <i class="fa aside__icon text-bold">K</i>
                <span class="white-space--normal aside__text">Вопросы питания и состояние ротовой области</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitL" class="aside__link display-flex">
                <i class="fa aside__icon text-bold">L</i>
                <span class="white-space--normal aside__text">Состояние кожи</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitM" class="aside__link display-flex">
                <i class="fa aside__icon text-bold">M</i>
                <span class="white-space--normal aside__text">Досуг</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitN" class="aside__link display-flex">
                <i class="fa aside__icon text-bold">N</i>
                <span class="white-space--normal aside__text">Лекарственные средства</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitO" class="aside__link display-flex">
                <i class="fa aside__icon text-bold">O</i>
                <span class="white-space--normal aside__text">Лечебные мероприятия и процедуры</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitP" class="aside__link display-flex">
                <i class="fa aside__icon text-bold">P</i>
                <span class="white-space--normal aside__text">Правовая ответственность и распоряжения</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitQ" class="aside__link display-flex">
                <i class="fa aside__icon text-bold">Q</i>
                <span class="white-space--normal aside__text">Перспективы выписки</span>
            </a>
        </li>

        <li class="aside__item">
            <a href="#unitR" class="aside__link display-flex">
                <i class="fa aside__icon text-bold">R</i>
                <span class="white-space--normal aside__text">Выписка</span>
            </a>
        </li>

    <? endif; ?>


</ul>