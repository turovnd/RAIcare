<?php defined('SYSPATH') or die('No direct script access.');


Class Model_SurveyUnitJ
{
    public $pk;
    public $J1;
    public $J2;
    public $J3;
    public $J4;
    public $J5;
    public $J6;
    public $J7;
    public $J8;
    public $J9;
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
        $select = Dao_SurveysUnitJ::select()
            ->where('pk', '=', $pk)
            ->limit(1)
            ->cached(Date::MINUTE * 5, $pk)
            ->execute();

        return $this->fill_by_row($select);
    }

    public function save()
    {
        $insert = Dao_SurveysUnitJ::insert();

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
        $update = Dao_SurveysUnitJ::update();

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
        Dao_SurveysUnitJ::delete()
            ->where('pk', '=', $pk)
            ->clearcache($pk)
            ->execute();
    }

}