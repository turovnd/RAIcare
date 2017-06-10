<div class="section__content section__content--unwrap">


    <div class="section__cover valign">
        <div class="parallax" data-toggle="parallax">
            <img src="<?=URL::site('uploads/organizations/cover/'. $organization->cover); ?>" alt="Organization cover" class="parallax__img">
        </div>
        <div class="section__cover-text container"><?= $organization->name; ?></div>
        <div class="section__cover-filter"></div>
    </div>

    <div class="bg-gray-dark p-15 m-b-30">
        <div class="flex">
            <div class="col-xs-4 text-center b-r-light">
                <h3 class="h3 m-0">2</h3>
                <small class="m-0 ">Сотрднкиов</small>
            </div>
            <div class="col-xs-4 text-center b-r-light">
                <h3 class="h3 m-0">12</h3>
                <small class="m-0 ">Пансионатов</small>
            </div>
            <div class="col-xs-4 text-center">
                <h3 class="h3 m-0">50</h3>
                <small class="m-0 ">Клиентов</small>
            </div>
        </div>
    </div>



    <div class="row">

        <div class="col-xs-12">


        </div>

    </div>

</div>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/clients.min.js?v=<?= filemtime("assets/frontend/bundles/clients.min.js") ?>"></script>

<script type="text/javascript">
    raisoft.parallax.init();
</script>