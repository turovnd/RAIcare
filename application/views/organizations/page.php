<div class="section__content section__content--unwrap">


    <div class="section__cover valign">
        <div class="parallax" data-toggle="parallax">
            <img src="<?=URL::site('uploads/organizations/cover/'. $organization->cover); ?>" alt="Organization cover" class="parallax__img">
        </div>
        <div class="section__cover-update-wrapper">
            <a id="" role="button" class="section__cover-update-btn" data-pk="1">
                <i class="fa fa-camera section__cover-update-icon" aria-hidden="true"></i>
                <span class="section__cover-update-text">Обновить фото обложки</span>
            </a>
        </div>
        <div class="section__cover-text container"><?= $organization->name; ?></div>
        <div class="section__cover-filter"></div>
    </div>

    <div class="bg-gray-dark p-15 m-b-30">
        <div class="display-flex">
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


    <div class="col-xs-12 col-md-9">

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

    <div class="col-xs-12 col-md-3">

        <a href="/" class="btn btn--lg btn--brand col-xs-12 fl_n m-b-20">Статистика</a>

        <div class="block">
            <div class="block__heading">
                <h4 class="m-0">
                    <a href="" class="fl_r">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    </a>
                    Пансионаты
                </h4>
            </div>
            <div id="pensions" class="block__body p-0">
                <fieldset id="pension_1" class="p-0 m-0">
                    <a href="/" class="p-15 display-block text-brand">Панисонат 1</a>
                </fieldset>
                <fieldset id="pension_2" class="p-0 m-0">
                    <a href="/" class="p-15 display-block text-brand">Панисонат 2</a>
                </fieldset>
            </div>
        </div>


        <div class="block">
            <div class="block__heading">
                <h4 class="m-0">
                    <a href="" class="fl_r">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                    </a>
                    Сотрудники
                </h4>
            </div>
            <div id="assistants" class="block__body p-0">
                <fieldset id="assistant_1" class="p-15 m-b-0">
                    <a href="" class="fl_r m-l-5">
                        <i class="fa fa-user-times" aria-hidden="true"></i>
                    </a>
                    <img src="/" alt="" class="img img--small img--circle fl_l m-r-10">
                    <div class="display-table">Имя фамилия </div>
                </fieldset>

                <fieldset id="assistant_2" class="p-15 m-b-0">
                    <a href="" class="fl_r m-l-5">
                        <i class="fa fa-user-times" aria-hidden="true"></i>
                    </a>
                    <img src="/" alt="" class="img img--small img--circle fl_l m-r-10">
                    <div class="display-table">Имя фамилия </div>
                </fieldset>
            </div>
        </div>

    </div>

</div>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/clients.min.js?v=<?= filemtime("assets/frontend/bundles/clients.min.js") ?>"></script>

<script type="text/javascript">
    raisoft.parallax.init();
</script>