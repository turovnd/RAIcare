<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
    'patient' => array(
        '1' => array(
            'name' => 'Полный отчет (ответы на вопросы анкеты)',
            'hash' => 'fullreport',
        ),
        '2' => array(
            'name' => 'Итоговый протокол оценки',
            'hash' => 'protocolsreport',
        ),
        '3' => array(
            'name' => 'Базовый персональный отчет',
            'hash' => 'basicreport',
        ),
        '4' => array(
            'name' => 'Персональный отчет о состоянии',
            'hash' => 'statusreport',
        ),
        '5' => array(
            'name' => 'Отчет по шкалам RAI',
            'hash' => 'raiscalesreport',
        ),
        '6' => array(
            'name' => 'Классификация RUG',
            'hash' => 'rugclassification',
        ),
        '7' => array(
            'name' => 'Клинический протокол',
            'hash' => 'clinicalprotocol',
        )
    )

);
