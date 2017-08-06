<div class="time-line__badge bg-brand">
    <i class="fa fa-sticky-note" aria-hidden="true"></i>
</div>

<div class="time-line__content">

    <div class="time-line__popover">
        <div class="time-line__popover-arrow"></div>
        <div class="time-line__popover-content">
            <h4 class="time-line__popover-heading">
                Анкета #<?= $survey->id; ?>
            </h4>
            <p class="time-line__popover-text">
                В <?= Date('H:i', strtotime($survey->dt_finish)); ?>
                <span class="text-bold"><?=$survey->creator->name; ?></span>
                завершил(а) <?=Kohana::$config->load('form_type.get')[$survey->type]; ?>.
            </p>
            <span class="time-line__popover-date"><?= Date('d M', strtotime($survey->dt_finish)); ?></span>
            <a href="<?= '/\/' . $_SERVER['HTTP_HOST'] . '/' . $survey->pension->uri . '/survey/' . $survey->id; ?>" class="btn btn--default fl_r m-0">Подробнее</a>
        </div>
    </div>
</div>

