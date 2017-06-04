<a href="<?=URL::site('app'); ?>" class="header__brand fl_l">
    <?=$GLOBALS['SITE_NAME'];?>
</a>

<div class="header__wrapper fl_r">

    <ul class="fl_r">

        <li class="header__item">
            <a id="openAsideMenu" role="button" class="header__link p-l-15 p-r-15 m-l-0">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </a>
        </li>

        <li class="header__item">
            <a href="<?=URL::site('app/profile')?>" class="header__link p-l-15 p-r-15 m-l-0">
                <i class="fa fa-user" aria-hidden="true"></i>
            </a>
        </li>

        <li class="header__item">
            <a role="button" class="header__link p-l-15 p-r-15 m-l-0">
                <i class="fa fa-bell-o" aria-hidden="true"></i>
                <div class="label label--danger m-t-5">12</div>
            </a>
        </li>

        <li class="header__item">
            <a href="<?=URL::site('logout'); ?>" class="header__link p-l-15 p-r-15 m-l-0">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
            </a>
        </li>

    </ul>


</div>