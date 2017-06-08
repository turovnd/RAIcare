<?php defined('SYSPATH') or die('No direct script access.');


Class Model_Client {

    public $id;
    public $name;
    public $status;     // 0 - spam || reject, 1 - new client, 2 - conversation || waiting payments, 3 - access allowed
    public $email;
    public $organization;
    public $city;
    public $phone;
    public $comment;
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

        $select = Dao_Clients::select()
            ->where('id', '=', $id)
            ->limit(1)
            ->cached(Date::MINUTE * 5, $id)
            ->execute();

        $this->fill_by_row($select);

        return $this;

    }

    public function save()
    {
        $this->dt_create = Date::formatted_time('now');

        $insert = Dao_Clients::insert();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $result = $insert->execute();

        return $this->get_($result);
    }


    public function update()
    {
        $insert = Dao_Clients::update();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $insert->clearcache($this->id);
        $insert->where('id', '=', $this->id);

        $insert->execute();

        return $this->get_($this->id);
    }


    public static function getClientsByStatus($status)
    {
        $select = Dao_Clients::select()
            ->where('status', '=', $status)
            ->order_by('dt_create', 'DESC')
            ->execute();

        $clients = array();

        if ( empty($select) ) return $clients;

        foreach ($select as $item) {
            $client = new Model_Client();
            $clients[] = $client->fill_by_row($item);
        }

        return $clients;
    }
}