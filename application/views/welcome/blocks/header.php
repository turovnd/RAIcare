<div class="container">

    <button id="openMobileMenu" class="header__open-btn animated fade__in">
        <i></i><i></i><i></i>
    </button>

    <a href="<?=URL::base(); ?>" class="header__brand fl_l">
        <?=$GLOBALS['SITE_NAME']; ?>
    </a>

    <ul class="header__menu animated fade__in list-style--none">
        <li class="header__item">
           <a href="<?=URL::site('software'); ?>" class="header__link">
               О системе
           </a>
        </li>
        <li class="header__item">
            <a href="<?=URL::site('training'); ?>" class="header__link">
                Обучение
            </a>
        </li>
        <li class="header__item hidden-sm hidden-md hidden-lg">
            <a href="<?=URL::site('join'); ?>" class="header__link">Присоединиться к <?=$GLOBALS['SITE_NAME']; ?></a>
        </li>
    </ul>

</div>