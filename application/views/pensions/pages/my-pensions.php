<div class="section__content">

    <h3 class="section__heading">
        Мои пансионаты
    </h3>

    <div class="row">

        <div class="col-xs-12">

            <? if (empty($pensions)) : ?>

                <div class="m-t-10 m-b-10">
                    <h4 class="h4 text-brand m-b-15">Пансионаты не созданы, обратитесь к сотрудникам <?=$GLOBALS["SITE_NAME"]; ?> для создания.</h4>
                    <p>Вы можете посотреть часть функционала в <a class="link" href="">демо версии</a></p>
                </div>

            <? else: ?>

                <div class="row block-wrapper" id="pensions">

                    <? foreach ($pensions as $pension) : ?>

                        <?=View::factory('pensions/blocks/card', array('pension' => $pension))?>

                    <? endforeach; ?>

                </div>

            <? endif; ?>

        </div>

    </div>

</div>

