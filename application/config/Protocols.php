<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
    // Behaviour
    'P1' => array(
        '0' => array(
            'name' => 'Не выявлено',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => 'Выявлено - снижение инцидентов ежедневного проблемного поведения',
            'key'  => 1,
            'class' => 'text-danger'
        ),
        '2' => array(
            'name' => 'Выявлено - предотвращение ежедневных инцидентов проблемного поведения',
            'key'  => 2,
            'class' => 'text-danger'
        ),
    ),
    // Communication
    'P2' => array(
        '0' => array(
            'name' => 'Не выявлено',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => 'Выявлено - потенциал для улучшения',
            'key'  => 1,
            'class' => 'text-danger'
        ),
        '2' => array(
            'name' => 'Выявлено - риск снижения',
            'key'  => 2,
            'class' => 'text-danger'
        ),
    ),
    // Delirium
    'P3' => array(
        '0' => array(
            'name' => 'Не выявлено',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => 'Выявлено',
            'key'  => 1,
            'class' => 'text-danger'
        ),
    ),
    // Mood
    'P4' => array(
        '0' => array(
            'name' => 'Не выявлено',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => 'Выявлено - низкий риск',
            'key'  => 1,
            'class' => 'text-danger'
        ),
        '2' => array(
            'name' => 'Выявлено - высокий риск',
            'key'  => 2,
            'class' => 'text-danger'
        ),
    ),
    // Cardio-respiratory
    'P5' => array(
        '0' => array(
            'name' => 'Не выявлено',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => 'Выявлено',
            'key'  => 1,
            'class' => 'text-danger'
        ),
    ),
    // Dehydration
    'P6' => array(
        '0' => array(
            'name' => 'Не выявлено',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => 'Выявлено - низкий уровень дегидратация',
            'key'  => 1,
            'class' => 'text-danger'
        ),
        '2' => array(
            'name' => 'Выявлено - высокий уровень дегидратация',
            'key'  => 2,
            'class' => 'text-danger'
        ),
    ),
    // Falls
    'P7' => array(
        '0' => array(
            'name' => 'Не выявлено',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => 'Выявлено - низкий риск',
            'key'  => 1,
            'class' => 'text-danger'
        ),
        '2' => array(
            'name' => 'Выявлено - высокий риск',
            'key'  => 2,
            'class' => 'text-danger'
        ),
    ),
    // Feeding Tube
    'P8' => array(
        '0' => array(
            'name' => 'Не выявлено',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => 'Выявлено - низкий риск',
            'key'  => 1,
            'class' => 'text-danger'
        ),
        '2' => array(
            'name' => 'Выявлено - высокий риск',
            'key'  => 2,
            'class' => 'text-danger'
        ),
    ),
    // Nutrition
    'P9' => array(
        '0' => array(
            'name' => 'Не выявлено',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => 'Выявлено - в зоне риска',
            'key'  => 1,
            'class' => 'text-danger'
        ),
        '2' => array(
            'name' => 'Выявлено - в зоне высокого риск',
            'key'  => 2,
            'class' => 'text-danger'
        ),
    ),
    // Pain
    'P10' => array(
        '0' => array(
            'name' => 'Не выявлено',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => 'Выявлено - средний приоритет',
            'key'  => 1,
            'class' => 'text-danger'
        ),
        '2' => array(
            'name' => 'Выявлено - высокий приоритет',
            'key'  => 2,
            'class' => 'text-danger'
        ),
    ),
    // Smoking and Drinking
    'P11' => array(
        '0' => array(
            'name' => 'Не выявлено',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => 'Выявлено',
            'key'  => 1,
            'class' => 'text-danger'
        ),
    ),
    // Pressure Ulcer
    'P12' => array(
        '0' => array(
            'name' => 'Не выявлено',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => 'Выявлено - has stage 2 ulcer',
            'key'  => 1,
            'class' => 'text-danger'
        ),
        '2' => array(
            'name' => 'Выявлено - at risk, has stage 1 ulcer',
            'key'  => 2,
            'class' => 'text-danger'
        ),
        '3' => array(
            'name' => 'Выявлено - at risk, no ulcer now',
            'key'  => 3,
            'class' => 'text-danger'
        ),
    ),
    // Urinary Incontinence
    'P13' => array(
        '0' => array(
            'name' => 'Не выявлено - poor decision making at baseline',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => 'Не выявлено - continent at baseline',
            'key'  => 1,
            'class' => 'text-brand'
        ),
        '2' => array(
            'name' => 'Выявлено - prevent decline',
            'key'  => 2,
            'class' => 'text-danger'
        ),
        '3' => array(
            'name' => 'Выявлено -  facilitate improvement',
            'key'  => 3,
            'class' => 'text-danger'
        ),
    ),
    // Physical restraint
    'P14' => array(
        '0' => array(
            'name' => 'Не выявлено',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => 'Выявлено - Little ADL ability',
            'key'  => 1,
            'class' => 'text-danger'
        ),
        '2' => array(
            'name' => 'Выявлено - ADL ability present',
            'key'  => 2,
            'class' => 'text-danger'
        ),
    ),
    // Activities
    'P15' => array(
        '0' => array(
            'name' => 'Не выявлено',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => 'Выявлено',
            'key'  => 1,
            'class' => 'text-danger'
        ),
    ),
    // Physical Activities Promotion
    'P16' => array(
        '0' => array(
            'name' => 'Не выявлено',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => 'Выявлено - Trigger to facilitate improvement',
            'key'  => 1,
            'class' => 'text-danger'
        ),
    ),
    // Prevention
    'P17' => array(
        '0' => array(
            'name' => 'Не выявлено',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => 'Выявлено - Preventive strategy was not pursed, and there has been no recent physican visit',
            'key'  => 1,
            'class' => 'text-danger'
        ),
        '2' => array(
            'name' => 'Выявлено - Preventive strategy was not pursed, despite a recent physican visit',
            'key'  => 2,
            'class' => 'text-danger'
        ),
    ),
    // Cognitive Loss
    'P18' => array(
        '0' => array(
            'name' => 'Не выявлено',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => 'Выявлено - to monitor risk of cognitive decline',
            'key'  => 1,
            'class' => 'text-danger'
        ),
        '2' => array(
            'name' => 'Выявлено - to prevent decline',
            'key'  => 2,
            'class' => 'text-danger'
        ),
    ),
    // Appropriate Medications
    'P19' => array(
        '0' => array(
            'name' => 'Не выявлено',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => 'Выявлено',
            'key'  => 1,
            'class' => 'text-danger'
        ),
    ),

);