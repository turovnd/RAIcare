<?
    $count_patients = Model_Patient::countByPension($pension->id);
    $count_surveys  = Model_Survey::countByPension($pension->id);
?>
<div class="section__cover valign">
    <div class="parallax" data-toggle="parallax">
        <img id="pensionCover" src="<?=URL::site('uploads/pensions/cover/o_'. $pension->cover); ?>" alt="Pension cover" class="parallax__img">
    </div>

    <? // ROLE_PEN_CREATOR = 20
    if ( $user->role == 20) : ?>

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
            <h3 class="h3 m-0"><?= $pension->places; ?></h3>
            <small class="m-0 "><?= Methods_Plural::getWithPlural($pension->places,'places');?></small>
        </div>
        <div class="col-xs-4 text-center b-r-light">
            <h3 class="h3 m-0"><?= $count_patients; ?></h3>
            <small class="m-0 "><?= Methods_Plural::getWithPlural($count_patients,'patients');?></small>
        </div>
        <div class="col-xs-4 text-center">
            <h3 class="h3 m-0"><?= $count_surveys; ?></h3>
            <small class="m-0 "><?= Methods_Plural::getWithPlural($count_surveys,'surveys');?></small>
        </div>
    </div>
</div>