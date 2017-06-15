<div class="section__cover valign">
    <div class="parallax" data-toggle="parallax">
        <img id="pensionCover" src="<?=URL::site('uploads/pensions/cover/o_'. $pension->cover); ?>" alt="Pension cover" class="parallax__img">
    </div>
    <? // Module Organizations => EDIT_PENSION = 27
    if (in_array(27, $user->permissions)) : ?>

        <div class="section__cover-update-wrapper">
            <a onclick="pension.edit.cover(this)" role="button" class="section__cover-update-btn" data-pk="<?=$pension->id; ?>">
                <i class="fa fa-camera section__cover-update-icon" aria-hidden="true"></i>
                <span class="section__cover-update-text">Обновить фото обложки</span>
            </a>
        </div>

    <? endif; ?>

    <div class="section__cover-text container">
        <?= $pension->name; ?>
    </div>

    <div class="section__cover-filter"></div>
</div>

<div class="bg-gray-dark p-15 m-b-30">
    <div class="display-flex">
        <div class="col-xs-4 text-center b-r-light">
            <h3 class="h3 m-0">9,5</h3>
            <small class="m-0 ">Рейтинг</small>
        </div>
        <div class="col-xs-4 text-center b-r-light">
            <h3 class="h3 m-0">30</h3>
            <small class="m-0 ">Анкет</small>
        </div>
        <div class="col-xs-4 text-center">
            <h3 class="h3 m-0">10</h3>
            <small class="m-0 ">..</small>
        </div>
    </div>
</div>