<ul class="aside__menu list-style--none">

    <li class="aside__item <? echo $action == "dashboard" ? 'aside__item--active' : ''; ?>">
        <a href="<?=URL::site('dashboard'); ?>" class="aside__link">
            <i class="fa fa-dashboard aside__icon" aria-hidden="true"></i>
            <span class="aside__text">Главная</span>
        </a>
    </li>

    <li class="aside__item <? echo $action == "admin" ? 'aside__item--active' : ''; ?>">
        <a href="<?=URL::site('admin'); ?>" class="aside__link">
            <i class="fa fa-cubes aside__icon" aria-hidden="true"></i>
            <span class="aside__text">Панель админа</span>
        </a>
    </li>

    <li class="aside__item <? echo $action == "clients" ? 'aside__item--active' : ''; ?>">
        <a href="<?=URL::site('clients'); ?>" class="aside__link">
            <i class="fa fa-id-card-o aside__icon" aria-hidden="true"></i>
            <div class="label label--danger m-t-10 m-r-5">12</div>
            <span class="aside__text">Клиенты</span>
        </a>
    </li>

    <li class="aside__item <? echo $action == 'members' || $action == 'reports' ? 'aside__item--active' : ''; ?>">
        <a role="button" class="aside__link" data-toggle="collapse" data-area="helpCollapse" data-opened="false">
            <i class="fa fa-briefcase aside__icon" aria-hidden="true"></i>
            <span class="aside__text">Организация</span>
            <i class="fa fa-angle-down aside__icon--right" aria-hidden="true"></i>
        </a>

        <ul id="helpCollapse" class="aside__collapse collapse list-style--none">
            <li class="aside__collapse-item">
                <a href="<?=URL::site('org/members'); ?>"  class="aside__collapse-link <?= $action == 'members' ? 'aside__collapse-link--active' : ''; ?>">
                    Сотрудники
                </a>
            </li>
            <li class="aside__collapse-item">
                <a href="<?=URL::site('org/patients'); ?>"  class="aside__collapse-link <?= $action == 'members' ? 'aside__collapse-link--active' : ''; ?>">
                    Пациенты
                </a>
            </li>
            <li class="aside__collapse-item">
                <a href="<?=URL::site('org/reports'); ?>" class="aside__collapse-link <?= $action == 'reports' ? 'aside__collapse-link--active' : ''; ?>">
                    Отчеты
                </a>
            </li>
        </ul>

    </li>

</ul>