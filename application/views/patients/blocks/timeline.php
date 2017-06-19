<?
if (empty($forms)) {
    echo '<h4 class="h4 text-brand m-b-15 col-xs-12">Анкетирования не найдены.</h4>';
    return;
}
?>

<ul id="timeline" class="time-line" data-pk='<?=json_encode($sameSnils);?>'>

<?

$date = Date('M Y', strtotime($forms[0]->dt_finish));

foreach ($forms as $key => $form) {

    if ($key == 0) {
        echo '<li data-datetime="' . Date('M Y', strtotime($form->dt_finish)) . '" class="time-line__separator"></li>';
    }

    if ($date != Date('M Y', strtotime($form->dt_finish))) {
        $date = Date('M Y', strtotime($form->dt_finish));
        echo '<li data-datetime="' . Date('M Y', strtotime($form->dt_finish)) . '" class="time-line__separator"></li>';
    }

    echo
        '<li class="time-line__item' . ($key % 2 == 0 ? '' : ' time-line__item--inverted') . '">' .
            View::factory('patients/blocks/timeline-item', array('key' => $key, 'form' => $form)) .
        '</li>';

} ?>


    <li class="time-line__end">
        <a id="getMoreFormsBtn" data-offset="<?= count($forms); ?>" data-type="json" role="button" class="time-line__badge bg-gray-dark" onclick="survey.get.forms();">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </a>
    </li>

</ul>