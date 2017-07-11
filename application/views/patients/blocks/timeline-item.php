<div class="time-line__badge bg-brand">
    <i class="fa fa-sticky-note" aria-hidden="true"></i>
</div>

<div class="time-line__content">

    <div class="time-line__popover">
        <div class="time-line__popover-arrow"></div>
        <div class="time-line__popover-content">
            <h4 class="time-line__popover-heading">
                <? if (in_array(34, $user->permissions)) : ?>
                    Анкета #<?= $survey->pk; ?>
                <? else: ?>
                    Анкета #<?= $survey->id; ?>
                <? endif; ?>
            </h4>
            <p class="time-line__popover-text">
                В <?= Date('H:i', strtotime($survey->dt_finish)); ?>
                <? if (in_array(34, $user->permissions)) : ?>
                    <a href="<?=URL::site('profile/' . $survey->creator->id); ?>" class="link text-bold"><?=$survey->creator->name; ?></a>
                <? else: ?>
                    <span class="text-bold"><?=$survey->creator->name; ?></span>
                <? endif; ?>
                завершил(а) <?=Kohana::$config->load('form_type.get')[$survey->type]; ?>.
            </p>
            <? if (in_array(34, $user->permissions)) : ?>
                <a class="display-block m-b-5 link" href="<?=URL::site('pension/' . $survey->pension->id); ?>"> <i class="fa fa-user-md m-r-10" aria-hidden="true"></i>Пансионат #<?=$survey->pension->id; ?></a>
            <? endif; ?>
            <span class="time-line__popover-date"><?= Date('d M', strtotime($survey->dt_finish)); ?></span>
            <? if (in_array(34, $user->permissions)) : ?>
                <a href="<?=URL::site('survey/' . $survey->pk); ?>" class="btn btn--default fl_r m-0">Подробнее</a>
            <? else: ?>
                <a href="<?=URL::site('pension/' . $survey->pension->id . '/survey/' . $survey->id); ?>" class="btn btn--default fl_r m-0">Подробнее</a>
            <? endif; ?>
        </div>
    </div>
</div>

