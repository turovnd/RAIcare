<div class="section__content">

    <h3 class="section__heading">
        Мои организации
    </h3>

    <div class="row">

        <div class="col-xs-12">

            <? if (empty($organizations)) : ?>

                <div class="m-t-10 m-b-10">
                    <h4 class="h4 text-brand m-b-15">Организации не созданы, обратитесь к сотрудникам <?=$GLOBALS["SITE_NAME"]; ?> для создания.</h4>
                    <p>Вы можете посмотреть часть функционала в <a class="link" href="">демо версии</a></p>
                </div>

            <? else: ?>

                <div class="row block-wrapper" id="organizations">

                    <? foreach ($organizations as $organization) : ?>

                        <?=View::factory('organizations/blocks/card', array('organization' => $organization))?>

                    <? endforeach; ?>

                </div>

            <? endif; ?>

        </div>

    </div>

</div>

