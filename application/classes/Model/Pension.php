<?php defined('SYSPATH') or die('No direct script access.');


Class Model_Pension {

    public $id;
    public $name;
    public $uri;
    public $organization;
    public $owner;
    public $creator;
    public $cover = "no-image.png";
    public $is_removed;
    public $dt_create;

    
    public function __construct($id = null) {

        if ( !empty($id) ) {
            $this->get_($id);
        }

    }

    private function fill_by_row($db_selection) {

        if (empty($db_selection['id'])) return $this;

        foreach ($db_selection as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $this->$fieldname = $value;
        }

        return $this;

    }

    
    private function get_($id) {

        $select = Dao_Pensions::select()
            ->where('id', '=', $id)
            ->limit(1)
            ->cached(Date::MINUTE * 5, $id)
            ->execute();

        return $this->fill_by_row($select);

    }

    public static function getByFieldName($field, $value) {

        $select = Dao_Pensions::select()
            ->where($field, '=', $value)
            ->limit(1)
            ->execute();

        $pension = new Model_Pension();
        return $pension->fill_by_row($select);

    }

    public function save()
    {
        $this->dt_create = Date::formatted_time('now');

        $insert = Dao_Pensions::insert();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $result = $insert->execute();

        return $this->get_($result);
    }

    public function update()
    {
        $insert = Dao_Pensions::update();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $insert->clearcache($this->id);
        $insert->where('id', '=', $this->id);

        $insert->execute();

        return $this->get_($this->id);
    }

    public static function check_uri($uri)
    {
        $select = Dao_Pensions::select()
            ->where('uri', '=', $uri)
            ->limit(1)
            ->execute();

        return boolval($select);

    }

    public static function getAll($offset, $limit = 10, $name = "")
    {
        if ($name == "") {
            $select = Dao_Pensions::select()
                ->order_by('dt_create', 'DESC')
                ->offset($offset)
                ->limit($limit)
                ->execute();

        } else {
            $select = Dao_Pensions::select()
                ->where('name','LIKE', '%' . $name . '%')
                ->order_by('dt_create', 'DESC')
                ->offset($offset)
                ->limit($limit)
                ->execute();
        }

        $pensions = array();

        if ( empty($select) ) return $pensions;

        foreach ($select as $item) {
            $pension = new Model_Pension();
            $pension = $pension->fill_by_row($item);
            $pension->creator = new Model_User($pension->creator);
            $pension->owner = new Model_User($pension->owner);
            $pension->organization = new Model_Organization($pension->organization);
            $pensions[] = $pension;
        }

        return $pensions;
    }


    public static function getByCreator($id, $offset, $limit = 10, $name = "")
    {
        if ($name == "") {
            $select = Dao_Pensions::select()
                ->where('creator','=', $id)
                ->order_by('dt_create', 'DESC')
                ->offset($offset)
                ->limit($limit)
                ->execute();

        } else {
            $select = Dao_Pensions::select()
                ->where('creator','=', $id)
                ->where('name','LIKE', '%' . $name . '%')
                ->order_by('dt_create', 'DESC')
                ->offset($offset)
                ->limit($limit)
                ->execute();
        }

        $pensions = array();

        if ( empty($select) ) return $pensions;

        foreach ($select as $item) {
            $pension = new Model_Pension();
            $pension = $pension->fill_by_row($item);
            $pension->creator = new Model_User($pension->creator);
            $pension->owner = new Model_User($pension->owner);
            $pension->organization = new Model_Organization($pension->organization);
            $pensions[] = $pension;
        }

        return $pensions;
    }


    public static function getByOrganizationID($id) {

        $select = Dao_Pensions::select()
            ->where('organization','=', $id)
            ->order_by('dt_create', 'DESC')
            ->execute();

        $pensions = array();

        if ( empty($select) ) return $pensions;

        foreach ($select as $item) {
            $pension = new Model_Pension();
            $pensions[] = $pension->fill_by_row($item);
        }

        return $pensions;

    }

}