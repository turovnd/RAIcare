<?php defined('SYSPATH') or die('No direct script access.');


Class Model_Pension {

    public $id;
    public $name;
    public $uri;
    public $organization;
    public $places;
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

    public static function getByUri($uri) {

        $select = Dao_Pensions::select()
            ->where('uri', '=', $uri)
            ->limit(1)
            ->cached(Date::MINUTE * 5, $uri)
            ->execute();

        $pension = new Model_Pension();
        return $pension->fill_by_row($select);

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

        $insert->clearcache('organization_' . $this->organization);

        $result = $insert->execute();

        return $this->get_($result);
    }

    public function update()
    {
        $insert = Dao_Pensions::update();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $insert->where('id', '=', $this->id);

        $insert->clearcache($this->id);
        $insert->clearcache($this->uri);
        $insert->clearcache('organization_' . $this->organization);

        $insert->execute();

        return $this->get_($this->id);
    }

    public static function check_uri($uri, $organization)
    {
        $select = Dao_Pensions::select()
            ->where('organization','=', $organization)
            ->where('uri','=', $uri)
            ->limit(1)
            ->execute();

        return boolval($select);
    }

    public static function getByOrganizationID($id, $as_model = false) {

        $select = Dao_Pensions::select()
            ->where('organization','=', $id)
            ->cached(Date::MINUTE * 5, 'organization_' . $id)
            ->order_by('dt_create', 'DESC')
            ->execute();

        $pensions = array();

        if ( empty($select) ) return $pensions;

        foreach ($select as $item) {
            if ($as_model) {
                $pension = new Model_Pension();
                $pensions[] = $pension->fill_by_row($item);
            } else {
                $pensions[] = $item['id'];
            }
        }

        return $pensions;

    }


    public static function searchByName($name) {

        $select = Dao_Pensions::select()
            ->or_having('name', '%' . $name . '%')
            ->order_by('id', 'DESC')
            ->limit(30)
            ->execute();

        $pensions = array();

        if (empty($select)) return $pensions;

        foreach ($select as $db_selection) {
            $pension = new Model_Pension();
            $pensions[] = $pension->fill_by_row($db_selection);
        }

        return $pensions;
    }

    public static function getAll() {

        $select = Dao_Pensions::select()
            ->execute();

        $pensions = array();

        if (empty($select)) return $pensions;

        foreach ($select as $db_selection) {
            $pension = new Model_Pension();
            $pensions[] = $pension->fill_by_row($db_selection);
        }

        return $pensions;
    }
}