<?
if (empty($surveys)) {
    echo '<h4 class="h4 text-brand m-b-15 col-xs-12">Анкетирования не найдены.</h4>';
    return;
}
?>

<ul id="timeline" class="time-line">

<?

$date = Date('M Y', strtotime($surveys[0]->dt_finish));

foreach ($surveys as $key => $survey) {

    if ($key == 0) {
        echo '<li data-datetime="' . Date('M Y', strtotime($survey->dt_finish)) . '" class="time-line__separator"></li>';
    }

    if ($date != Date('M Y', strtotime($survey->dt_finish))) {
        $date = Date('M Y', strtotime($survey->dt_finish));
        echo '<li data-datetime="' . Date('M Y', strtotime($survey->dt_finish)) . '" class="time-line__separator"></li>';
    }

    echo
        '<li class="time-line__item' . ($key % 2 == 0 ? '' : ' time-line__item--inverted') . '">' .
            View::factory('patients/blocks/timeline-item', array('key' => $key, 'survey' => $survey)) .
        '</li>';

} ?>


    <li class="time-line__end">
        <a id="getMoreSurveysBtn" data-offset="<?= count($surveys); ?>" role="button" class="time-line__badge bg-gray-dark" onclick="survey.get.timeLineItems();">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </a>
    </li>

</ul>