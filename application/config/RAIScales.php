<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(

    'PURS' => array(
        '0' => array(
            'name' => '0 Очень низкий риск',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => '1 - 2 Низкий риск',
            'key'  => array(1, 2),
            'class' => 'text-brand'
        ),
        '2' => array(
            'name' => '3 Умеренный риск',
            'key'  => 3,
            'class' => 'text-danger'
        ),
        '3' => array(
            'name' => '4 - 5 Высокий риск',
            'key'  => array(4, 5),
            'class' => 'text-danger'
        ),
        '4' => array(
            'name' => '6 - 8 Очень высокий риск',
            'key'  => array(6, 7, 8),
            'class' => 'text-danger'
        ),
    ),

    'CPS' => array(
        '0' => array(
            'name' => '0 Нормальные',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => '1 В пределах нормы',
            'key'  => 1,
            'class' => 'text-brand'
        ),
        '2' => array(
            'name' => '2 Незначительные отклонения',
            'key'  => 2,
            'class' => 'text-brand'
        ),
        '3' => array(
            'name' => '3 Умеренные отклонения',
            'key'  => 3,
            'class' => 'text-danger'
        ),
        '4' => array(
            'name' => '4 Умеренные / серьезные отклонения',
            'key'  => 4,
            'class' => 'text-danger'
        ),
        '5' => array(
            'name' => '5 Серьезные отклонения',
            'key'  => 5,
            'class' => 'text-danger'
        ),
        '6' => array(
            'name' => '6 Очень серьезные отклонения',
            'key'  => 6,
            'class' => 'text-danger'
        ),
    ),

    'BMI' => array(
        '0' => array(
            'name' => '<20 Ниже нормы',
            'key'  => 20,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => '>25 Выше нормы',
            'key'  => 25,
            'class' => 'text-brand'
        )
    ),

    'DRS' => array(
        '0' => array(
            'name' => '0 - 2 Нет депрессии',
            'key'  => array(0,1,2),
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => '3 - 8 Симптомы депрессии, вероятна умеренная депрессия',
            'key'  => array(3,4,5,6,7,8),
            'class' => 'text-danger'
        ),
        '2' => array(
            'name' => '9 - 14 Симптомы депрессии, вероятна серьезная депрессия',
            'key'  => array(9,10,11,12,13,14),
            'class' => 'text-danger'
        ),
    ),

    'Pain' => array(
        '0' => array(
            'name' => '0 Нет болей',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => '1 Не ежедневные боли',
            'key'  => 1,
            'class' => 'text-brand'
        ),
        '2' => array(
            'name' => '2 Ежедневные не значительные боли',
            'key'  => 2,
            'class' => 'text-danger'
        ),
        '3' => array(
            'name' => '3 Ежедневные значительные боли',
            'key'  => 3,
            'class' => 'text-danger'
        ),
        '4' => array(
            'name' => '4 Ежедневные мучительные боли',
            'key'  => 4,
            'class' => 'text-danger'
        ),
    ),

    'COMM' => array(
        '0' => array(
            'name' => '0 Нормальные',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => '1 В пределах нормы',
            'key'  => 1,
            'class' => 'text-brand'
        ),
        '2' => array(
            'name' => '2 Незначительные отклонения',
            'key'  => 2,
            'class' => 'text-brand'
        ),
        '3' => array(
            'name' => '3 Незначительные / умеренные отклонения',
            'key'  => 3,
            'class' => 'text-danger'
        ),
        '4' => array(
            'name' => '4 Умеренные отклонения',
            'key'  => 4,
            'class' => 'text-danger'
        ),
        '5' => array(
            'name' => '5 Умеренные / серьезные отклонения',
            'key'  => 5,
            'class' => 'text-danger'
        ),
        '6' => array(
            'name' => '6 Серьезные отклонения',
            'key'  => 6,
            'class' => 'text-danger'
        ),
        '7' => array(
            'name' => '7 Серьезные / очень серьезные отклонения',
            'key'  => 7,
            'class' => 'text-danger'
        ),
        '8' => array(
            'name' => '8 Очень серьезные отклонения',
            'key'  => 8,
            'class' => 'text-danger'
        ),
    ),

    'CHESS' => array(
        '0' => array(
            'name' => '0 Стабильное здоровье',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => '1 Минимальная нестабильность здоровья',
            'key'  => 1,
            'class' => 'text-brand'
        ),
        '2' => array(
            'name' => '2 Низкая нестабильность здоровья',
            'key'  => 2,
            'class' => 'text-danger'
        ),
        '3' => array(
            'name' => '3 Средняя нестабильность здоровья',
            'key'  => 3,
            'class' => 'text-danger'
        ),
        '4' => array(
            'name' => '4 Высокая нестабильность здоровья',
            'key'  => 4,
            'class' => 'text-danger'
        ),
        '5' => array(
            'name' => '5 Очень высокая нестабильность здоровья',
            'key'  => 5,
            'class' => 'text-danger'
        ),
    ),

    'ADLH' => array(
        '0' => array(
            'name' => '0 Независим',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => '1 Требуется присмотр',
            'key'  => 1,
            'class' => 'text-brand'
        ),
        '2' => array(
            'name' => '2 Ограничивающие отклонения',
            'key'  => 2,
            'class' => 'text-danger'
        ),
        '3' => array(
            'name' => '3 Требуется максимальная поддержка',
            'key'  => 3,
            'class' => 'text-danger'
        ),
        '4' => array(
            'name' => '4 Требуется экстенсивная поддержка',
            'key'  => 4,
            'class' => 'text-danger'
        ),
        '5' => array(
            'name' => '5 Зависим',
            'key'  => 5,
            'class' => 'text-danger'
        ),
        '6' => array(
            'name' => '6 Полностью зависим',
            'key'  => 6,
            'class' => 'text-danger'
        ),
    ),

    'ABS' => array(
        '0' => array(
            'name' => '0 Не агрессивное поведение',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => '1 - 5 Умеренное - среднее агрессивное поведение',
            'key'  => array(1,2,3,4,5),
            'class' => 'text-danger'
        ),
        '2' => array(
            'name' => '6 - 12 Серьезное агрессивное поведение',
            'key'  => array(6,7,8,9,10,11,12),
            'class' => 'text-danger'
        ),
    ),

);