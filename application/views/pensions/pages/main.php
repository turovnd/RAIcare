<div class="section__content section__content--unwrap">

    <?= View::factory('pensions/blocks/cover', array('pension' => $pension)); ?>


    <div class="col-xs-12 col-md-6">
        <div class="block">
            <div class="block__body text-center overflow--hidden">

                <svg id="patientsAgeBlock" data-value='<?= $patientsAges; ?>' width="320" height="200"></svg>

            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="block">
            <div class="block__body text-center overflow--hidden">

                <svg id="patientsSexBlock" data-value='<?= $patientsSex; ?>' width="320" height="200"></svg>

            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="block">
            <div class="block__body text-center overflow--hidden">

                <svg id="RAIScalesADLH" data-value='<?= json_encode($RAI_scales['ADLH']); ?>' width="320" height="200"></svg>

            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="block">
            <div class="block__body text-center overflow--hidden">

                <svg id="RAIScalesCPS" data-value='<?= json_encode($RAI_scales['CPS']); ?>' width="320" height="200"></svg>

            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="block">
            <div class="block__body text-center overflow--hidden">

                <svg id="RAIScalesCOMM" data-value='<?= json_encode($RAI_scales['COMM']); ?>' width="320" height="200"></svg>

            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="block">
            <div class="block__body text-center overflow--hidden">

                <svg id="RAIScalesDRS" data-value='<?= json_encode($RAI_scales['DRS']); ?>' width="320" height="200"></svg>

            </div>
        </div>
    </div>


    <input type="hidden" id="pensionID" value="<?=$pension->id; ?>">

</div>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/pension.min.js?v=<?= filemtime("assets/frontend/bundles/pension.min.js") ?>"></script>
<script type="text/javascript">
    raicare.parallax.init();
    pension.d3draw.init();
</script>

