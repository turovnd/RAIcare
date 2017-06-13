<div class="section__content">

    <h3 class="section__heading">
        Мои организации
    </h3>

    <div class="row">

        <div class="col-xs-12">

            <? if (empty($organizations)) : ?>

                <div class="h4 text-brand m-t-10 m-b-10">Организации не созданы, обратитесь к сотрудникам <?=$GLOBALS["SITE_NAME"]; ?> для создания.</div>

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

