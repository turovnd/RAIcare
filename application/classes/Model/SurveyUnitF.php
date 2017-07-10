<?php defined('SYSPATH') or die('No direct script access.');


Class Model_SurveyUnitF
{
    public $pk;
    public $F1;
    public $F2;
    public $F3;
    public $F4;
    public $F5;
    public $progress;

    public function __construct($pk = null)
    {

        if (!empty($pk)) {
            $this->get_($pk);
        }

    }

    private function fill_by_row($db_selection)
    {

        if (empty($db_selection['pk'])) return $this;

        foreach ($db_selection as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $this->$fieldname = $value;
        }

        return $this;

    }

    private function get_($pk)
    {
        $select = Dao_SurveysUnitF::select()
            ->where('pk', '=', $pk)
            ->limit(1)
            ->cached(Date::MINUTE * 5, $pk)
            ->execute();

        return $this->fill_by_row($select);
    }

    public function save()
    {
        $insert = Dao_SurveysUnitF::insert();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $result = $insert
            ->clearcache($this->pk)
            ->execute();

        return $this->get_($result);
    }

    public function update()
    {
        $update = Dao_SurveysUnitF::update();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $update->set($fieldname, $value);
        }

        $update
            ->clearcache($this->pk)
            ->where('pk', '=', $this->pk)
            ->execute();

        return $this->get_($this->pk);
    }


    public static function delete($pk)
    {
        Dao_SurveysUnitF::delete()
            ->where('pk', '=', $pk)
            ->clearcache($pk)
            ->execute();
    }

}