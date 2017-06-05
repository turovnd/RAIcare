<div class="container">

    <button id="openMobileMenu" class="header__open-btn animated fade__in">
        <i></i><i></i><i></i>
    </button>

    <a href="<?=URL::base(); ?>" class="header__brand fl_l">
        <?=$GLOBALS['SITE_NAME']; ?>
    </a>

    <ul class="header__menu animated fade__in list-style--none">
        <li class="header__item">
           <a href="<?=URL::site('/'); ?>" class="header__link">О системе</a>
        </li>
        <li class="header__item">
            <a href="<?=URL::site('/'); ?>" class="header__link">Планы</a>
        </li>
        <li class="header__item">
            <a href="<?=URL::site('/'); ?>" class="header__link">Поддержка</a>
        </li>
        <li class="header__item">
            <a href="<?= URL::site('login')?>" class="header__link btn btn--round btn--scaled">Войти</a>
        </li>
        <li class="header__item hidden-sm hidden-md hidden-lg">
            <a href="<?=URL::site('join'); ?>" class="header__link">Присоединиться к <?=$GLOBALS['SITE_NAME']; ?></a>
        </li>
    </ul>

</div>