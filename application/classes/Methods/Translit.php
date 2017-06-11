<?php

class Methods_Translit
{

    /**
     * Транслитерация кириллицы
     * @param string $string - строка с киррилицей
     * @return string
     */
    public static function rus2translit($string)
    {
        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => "",    'ы' => 'y',   'ъ' => "",
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'Y',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
            'Ь' => "",    'Ы' => 'Y',   'Ъ' => "",
            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        );

        // translit
        $converted_string = strtr($string, $converter);

        return $converted_string;
    }

    public static function getUsernameByName($string)
    {
        // заменяем все кириллические символы на латиницу
        $converted_string = self::rus2translit($string);

        // заменяем все не цифры и не буквы на дефисы
        $converted_string = preg_replace("/[^0-9a-zA-Z]/", "", $converted_string);

        // заменяем несколько дефисов на один
        $converted_string = preg_replace('/-{2,}/', '', $converted_string);

        // отсекаем лишние дефисы по краям
        $converted_string = trim($converted_string, '');

        // все буквы к нижнему реейстру
        $converted_string = strtolower($converted_string);

        return $converted_string;
    }
}
