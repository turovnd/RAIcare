<div class="section__content">

    <h3 class="section__heading">
        <a role="button" data-toggle="collapse" data-area="personalInfo" data-opened="false" data-textclosed="подробно" data-textopened="кратко" class="btn btn--default btn--sm m-b-0 m-r-0 fl_r collapse-btn"></a>
        Персональные данные пациента #<?=$patient->pk; ?>

        <? if (!empty($patient->sameSnils)) {
            echo '<small>Похожие профиля пациента по данным СНИЛСа и даты рождения: ';
            foreach ($patient->sameSnils as $id) {
                echo '<a class="link m-r-5" href="' . URL::site('patient/' . $id ) . '">#' . $id . '</a>';
            }
            echo '</small>';
        }?>
    </h3>

    <div class="row">

        <div class="col-xs-12">

            <?= View::factory('patients/blocks/profile-info', array('patient' => $patient))?>

        </div>

    </div>

    <h3 class="section__heading">
        Информация о <?= ngettext("пансионате", "пансинатах", count($patient->pensions)); ?>
    </h3>

    <div class="row">

        <? foreach ($patient->pensions as $pension) : ?>

            <div class="col-xs-12 col-md-6">

                <?= View::factory('pensions/blocks/list-item', array('pension' => $pension));?>

            </div>

        <? endforeach; ?>

    </div>


    <h3 class="section__heading">
        Последние анкетирования
    </h3>

    <div class="row">



        <?= View::factory('patients/blocks/timeline', array('surveys' => $patient->surveys, 'sameSnils' => $patient->sameSnils, 'type' => 'json'));?>

    </div>

</div>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/survey.min.js?v=<?= filemtime("assets/frontend/bundles/survey.min.js") ?>"></script>