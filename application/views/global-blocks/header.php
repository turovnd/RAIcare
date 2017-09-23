<a href="<?= '//' . $_SERVER['HTTP_HOST'] . '/dashboard'; ?>" class="header__brand fl_l">
    <?= $GLOBALS['SITE_NAME']; ?>
</a>

<div class="header__wrapper pos-absolute right-0">

    <ul class="fl_r list-style--none">

        <li class="header__item">
            <a id="openAsideMenu" role="button" class="header__link p-l-15 p-r-15 m-l-0">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </a>
        </li>

        <li class="header__item">
            <a href="<?= '//' . $_SERVER['HTTP_HOST'] . '/profile'?>" class="header__link p-l-15 p-r-15 m-l-0">
                <i class="fa fa-user" aria-hidden="true"></i>
            </a>
        </li>


        <li class="header__item">
            <a href="<?= '//' . $_SERVER['HTTP_HOST'] . '/logout'; ?>" class="header__link p-l-15 p-r-15 m-l-0">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
            </a>
        </li>

    </ul>


</div>