<div class="container p-t-50 p-b-10">

    <ul class="footer__menu m-b-20">
        <li class="footer__item">
            <span class="footer__helper"> Узнай больше </span>
        </li>
        <li class="footer__item">
            <a href="<?=URL::site('software'); ?>" class="footer__link">О системе</a>
        </li>
        <li class="footer__item">
            <a href="<?=URL::site('training'); ?>" class="footer__link">Об обучении</a>
        </li>
    </ul>

    <ul class="footer__menu m-b-20">
        <li class="footer__item">
            <span class="footer__helper"> Контакты </span>
        </li>
        <li class="footer__item">
            <a href="mailto:<?=getenv('INFO_EMAIL'); ?>" class="footer__link"><?= getenv('INFO_EMAIL'); ?></a>
        </li>
    </ul>

</div>