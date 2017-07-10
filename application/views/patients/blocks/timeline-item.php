<div class="time-line__badge bg-brand">
    <i class="fa fa-sticky-note" aria-hidden="true"></i>
</div>

<div class="time-line__content">

    <div class="time-line__popover">
        <div class="time-line__popover-arrow"></div>
        <div class="time-line__popover-content">
            <h4 class="time-line__popover-heading">
                <a href="<?=URL::site('patient/' . $survey->patient); ?>" class="link">
                    Опрос пациента #<?= $survey->patient; ?>
                </a>
            </h4>
            <p class="time-line__popover-text">
                В <?= Date('H:i', strtotime($survey->dt_finish)) . ' ' . mb_strtolower($survey->creator->role->name); ?> <a href="<?=URL::site('profile/' . $survey->creator->id); ?>" class="link"><?=$survey->creator->name; ?></a> завершил(а) <?=Kohana::$config->load('form_type.get')[$survey->type]; ?>.
            </p>
            <span class="time-line__popover-date"><?= Date('d M', strtotime($survey->dt_finish)); ?></span>
            <a href="<?=URL::site('survey/' . $survey->pk); ?>" class="btn btn--default fl_r m-0">Подробнее</a>
        </div>
    </div>
</div>

