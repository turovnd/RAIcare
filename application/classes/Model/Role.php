<?php defined('SYSPATH') or die('No direct script access.');


Class Model_Role {

    public $id;
    public $name;

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

        $select = Dao_Roles::select()
            ->where('id', '=', $id)
            ->limit(1)
            ->cached(Date::MINUTE * 5, $id)
            ->execute();

        $this->fill_by_row($select);

        return $this;
    }

    public static function getAll() {

        $select = Dao_Roles::select()->execute();

        $roles = array();

        if (empty($select)) return $roles;

        foreach ($select as $db_selection) {
            $role = new Model_Role();
            $roles[] = $role->fill_by_row($db_selection);
        }

        return $roles;
    }

     public function save()
     {
        $insert = Dao_Roles::insert();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $insert->clearcache($this->id);
        $result = $insert->execute();

        return $this->get_($result);
     }


     public function update()
     {
        $insert = Dao_Roles::update();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $insert->where('id', '=', $this->id);
        $insert->clearcache($this->id);

        $result = $insert->execute();

        return $this->get_($result);
     }

     public function delete()
     {
         Dao_Roles::delete()
             ->where('id', '=', $this->id)
             ->clearcache($this->id)
             ->limit(1)
             ->execute();
     }

}