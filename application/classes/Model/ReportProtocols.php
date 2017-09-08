<?php defined('SYSPATH') or die('No direct script access.');


Class Model_ReportProtocols {

    public $pk;         // primary key - copy from survey.pk
    public $id;         // copy from survey.id
    public $pension;    // pension.id
    public $P1;         // Behaviour - проблемное поведение
    public $P2;         // Communication - Коммуникация
    public $P3;         // Delirium - Деменция
    public $P4;         // Mood - Настроение
    public $P5;         // Cardio-respiratory - Сердечно-дыхательная недостаточность
    public $P6;         // Dehydration - Дегидратация
    public $P7;         // Falls - Падения
    public $P8;         // Feeding Tube - Питательная трубка
    public $P9;         // Nutrition - Недостаточное питание
    public $P10;        // Pain - Повреждения
    public $P11;        // Smoking and Drinking
    public $P12;        // Pressure Ulcer - Тяжелые пролежни
    public $P13;        // Urinary Incontinence - Недержание мочи
    public $P14;        // Physical restraint - Физическая сдержанность
    public $P15;        // Activities - Активность
    public $P16;        // Physical Activities Promotion
    public $P17;        // Prevention
    public $P18;        // Cognitive Loss
    public $P19;        // Appropriate Medications


    public function __construct($id = null) {

        if ( !empty($id) ) {
            $this->get_($id);
        }

    }

    private function fill_by_row($db_selection) {

        if (empty($db_selection['pk'])) return $this;

        foreach ($db_selection as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $this->$fieldname = $value;
        }

        return $this;
    }


    private function get_($pk) {

        $select = Dao_ReportsProtocols::select()
            ->where('pk', '=', $pk)
            ->limit(1)
            ->cached(Date::MINUTE * 5, $pk)
            ->execute();

        return $this->fill_by_row($select);
    }

    public function save()
    {
        $insert = Dao_ReportsProtocols::insert();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $result = $insert
            ->clearcache($this->pk)
            ->execute();

        return $this->get_($result);
    }

    public static function delete($pk)
    {
        Dao_ReportsProtocols::delete()
            ->where('pk', '=', $pk)
            ->clearcache($pk)
            ->execute();
    }


}