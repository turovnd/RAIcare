<div class="section__content section__content--unwrap">

    <?= View::factory('pensions/blocks/cover', array('pension' => $pension)); ?>



    <div class="col-xs-12 col-md-6">
        <div class="block">
            <div class="block__body text-center overflow--hidden">

                <svg id="patientsAgeBlock" data-value='<?= $patientsAges; ?>' width="300" height="200"></svg>

            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="block">
            <div class="block__body text-center overflow--hidden">

                <svg id="patientsSexBlock" data-value='<?= $patientsSex; ?>' width="300" height="200"></svg>

            </div>
        </div>
    </div>

    <input type="hidden" id="pensionID" value="<?=$pension->id; ?>">

</div>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/pension.min.js?v=<?= filemtime("assets/frontend/bundles/pension.min.js") ?>"></script>
<script type="text/javascript">
    raicare.parallax.init();
    pension.d3draw.patientsAges();
    pension.d3draw.patientsSex();
</script>

