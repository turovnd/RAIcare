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
                <small class="m-0 ">Сотрудников</small>
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


    <div class="col-xs-12 col-lg-9">

        <ul class="time-line">

            <li data-datetime="Today" class="time-line__separator"></li>

            <li class="time-line__item">

                <div class="time-line__badge bg-brand">
                    <i class="fa fa-comment" aria-hidden="true"></i>
                </div>

                <div class="time-line__content">

                    <div class="time-line__popover time-line__popover--left">
                        <div class="time-line__popover-arrow"></div>
                        <div class="time-line__popover-content">
                            content
                        </div>
                    </div>
                </div>

            </li>


            <li class="time-line__item time-line__inverted">

                <div class="time-line__badge bg-danger">
                    <i class="fa fa-comment" aria-hidden="true"></i>
                </div>

                <div class="time-line__content">

                    <div class="time-line__popover time-line__popover--right">
                        <div class="time-line__popover-arrow"></div>
                        <div class="time-line__popover-content">
                            content
                        </div>
                    </div>
                </div>
            </li>

            <li class="time-line__end">
                <a href="#" class="time-line__badge bg-gray-dark">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </a>
            </li>

        </ul>

    </div>

    <div class="col-xs-12 col-lg-3">

    </div>

</div>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/clients.min.js?v=<?= filemtime("assets/frontend/bundles/clients.min.js") ?>"></script>

<script type="text/javascript">
    raisoft.parallax.init();
</script>