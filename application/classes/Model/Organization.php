<?php defined('SYSPATH') or die('No direct script access.');


Class Model_Organization {

    public $id;
    public $name;
    public $uri;
    public $owner;
    public $creator;
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

        $select = Dao_Organizations::select()
            ->where('id', '=', $id)
            ->limit(1)
            ->cached(Date::MINUTE * 5, $id)
            ->execute();

        return $this->fill_by_row($select);

    }

    public static function getByUri($uri) {

        $select = Dao_Organizations::select()
            ->where('uri', '=', $uri)
            ->limit(1)
            ->cached(Date::MINUTE * 5, 'uri_' . $uri)
            ->execute();

        $organization = new Model_Organization();
        return $organization->fill_by_row($select);

    }

    public static function getByFieldName($field, $value) {

        $select = Dao_Organizations::select()
            ->where($field, '=', $value)
            ->limit(1)
            ->execute();

        $organization = new Model_Organization();
        return $organization->fill_by_row($select);

    }

    public function save()
    {
        $this->dt_create = Date::formatted_time('now');

        $insert = Dao_Organizations::insert();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $result = $insert->execute();

        return $this->get_($result);
    }

    public function update()
    {
        $insert = Dao_Organizations::update();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $insert
            ->where('id', '=', $this->id)
            ->clearcache($this->id)
            ->clearcache('uri_' . $this->uri)
            ->execute();

        return $this->get_($this->id);
    }

    public static function check_uri($uri)
    {
        $select = Dao_Organizations::select()
            ->where('uri', '=', $uri)
            ->limit(1)
            ->execute();

        return boolval($select);
    }

    public static function searchByName($name) {

        $select = Dao_Organizations::select()
            ->or_having('name', '%' . $name . '%')
            ->order_by('id', 'DESC')
            ->limit(30)
            ->execute();

        $organizations = array();

        if (empty($select)) return $organizations;

        foreach ($select as $db_selection) {
            $organization = new Model_Organization();
            $organizations[] = $organization->fill_by_row($db_selection);
        }

        return $organizations;
    }

    public static function getAll() {

        $select = Dao_Organizations::select()
            ->execute();

        $organizations = array();

        if (empty($select)) return $organizations;

        foreach ($select as $db_selection) {
            $organization = new Model_Organization();
            $organizations[] = $organization->fill_by_row($db_selection);
        }

        return $organizations;
    }

}