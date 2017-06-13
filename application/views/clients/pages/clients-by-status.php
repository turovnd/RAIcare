<div class="section__content">

    <h3 class="section__heading">
        <? if($add_client) : ?>
            <a role="button" class="btn btn--brand btn--sm m-0 fl_r">Добавить клиента</a>
        <? endif; ?>
        <?=$title; ?>
        <small>Для просмотра нажмите на имя клиента</small>
    </h3>

    <? if($reject_client) : ?>
        <a href="<?=URL::site('clients/reject'); ?>" class="btn btn--lg btn--default m-b-20">Просмотреть отклоненные заявки</a>
    <? endif; ?>

    <div class="row">

        <div class="block-wrapper">

            <? if (empty($clients)) : ?>
                <h4 class="h4 col-xs-12 text-bold text-brand"><?=$empty_text; ?></h4>
            <? endif; ?>

            <? foreach ($clients as $client) : ?>

                <?= View::factory('clients/blocks/list-item', array('client' => $client)); ?>

            <? endforeach; ?>

        </div>

    </div>

</div>