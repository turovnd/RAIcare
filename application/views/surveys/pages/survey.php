<div class="section__content">

    <h3 class="section__heading">
        <? if (in_array(34, $user->permissions)) : ?>
            Форма оценки #<?= $survey->pk; ?>
        <? else: ?>
            Форма оценки #<?= $survey->id; ?>
        <? endif; ?>
    </h3>

    <div class="row">

        <div class="col-xs-12">

            <?= View::factory('patients/blocks/profile-info', array('patient' => $survey->patient, 'full_info' => false)); ?>

            <div class="block">
                <div class="block__heading">Отчеты</div>
                <div class="block__body">
                    <ol class="col-xs-12 m-0">
                        <? foreach (Kohana::$config->load('reports.patient') as $report) : ?>
                            <li class="m-l-5 m-b-5"><a href="<?=URL::site('report/' . $survey->pk . '/' . $report['hash']); ?>" class="link p-10 p-t-5 display-inline-block"><?=$report['name']; ?></a></li>
                        <? endforeach; ?>
                    </ol>
                </div>
            </div>

        </div>

    </div>

</div>