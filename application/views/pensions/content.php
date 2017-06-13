<div class="section__content">

    <h3 class="section__heading">
        <?=$title; ?>
        <small>Поиск возможен по названию</small>
    </h3>

    <div class="row">

        <div class="col-xs-12">

            <? if (empty($pensions)) : ?>

                <div class="h4 text-brand m-t-10 m-b-10">Пансионаты не созданы, обратитесь к сотрудникам <?=$GLOBALS["SITE_NAME"]; ?> для создания.</div>

            <? endif; ?>


            <? foreach ($pensions as $pension) : ?>

                <?=View::factory('pensions/blocks/card', array('pension' => $pension));?>

            <? endforeach; ?>

        </div>

    </div>

</div>

