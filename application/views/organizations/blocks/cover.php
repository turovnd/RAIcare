<div class="section__cover valign">
    <div class="parallax" data-toggle="parallax">
        <img src="<?=URL::site('uploads/organizations/cover/'. $organization->cover); ?>" alt="Organization cover" class="parallax__img">
    </div>
    <? // Module Organizations => EDIT_ORGANIZATION = 17
    if (in_array(17, $user->permissions)) : ?>

        <div class="section__cover-update-wrapper">
            <a role="button" class="section__cover-update-btn">
                <i class="fa fa-camera section__cover-update-icon" aria-hidden="true"></i>
                <span class="section__cover-update-text">Обновить фото обложки</span>
            </a>
        </div>

    <? endif; ?>

    <div class="section__cover-text container">
        <?= $organization->name; ?>
    </div>

    <div class="section__cover-filter"></div>
</div>

<div class="bg-gray-dark p-15 m-b-30">
    <div class="display-flex">
        <div class="col-xs-4 text-center b-r-light">
            <h3 class="h3 m-0">9,8</h3>
            <small class="m-0 ">Рейтинг</small>
        </div>
        <div class="col-xs-4 text-center b-r-light">
            <h3 class="h3 m-0">40</h3>
            <small class="m-0 ">Анкет</small>
        </div>
        <div class="col-xs-4 text-center">
            <h3 class="h3 m-0">2</h3>
            <small class="m-0 ">Пансината</small>
        </div>
    </div>
</div>