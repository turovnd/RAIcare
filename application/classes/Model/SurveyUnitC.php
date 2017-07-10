<?php defined('SYSPATH') or die('No direct script access.');


Class Model_SurveyUnitC
{
    public $pk;
    public $C1;
    public $C2;
    public $C3;
    public $C4;
    public $C5;
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
        $select = Dao_SurveysUnitC::select()
            ->where('pk', '=', $pk)
            ->limit(1)
            ->cached(Date::MINUTE * 5, $pk)
            ->execute();

        return $this->fill_by_row($select);
    }

    public function save()
    {
        $insert = Dao_SurveysUnitC::insert();

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
        $update = Dao_SurveysUnitC::update();

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
        Dao_SurveysUnitC::delete()
            ->where('pk', '=', $pk)
            ->clearcache($pk)
            ->execute();
    }

}