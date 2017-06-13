<?php defined('SYSPATH') or die('No direct script access.');


Class Model_User {

    public $id;
    public $name;
    public $email;
    public $username;
    public $role;
    public $city;
    public $phone;
    public $newsletter;
    public $is_confirmed;
    public $creator;
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

        $select = Dao_Users::select()
            ->where('id', '=', $id)
            ->limit(1)
            ->cached(Date::MINUTE * 5, $id)
            ->execute();

        $this->fill_by_row($select);

        return $this;

    }


    public static function getByFieldName($field, $value) {

        $select = Dao_Users::select()
            ->where($field, '=', $value)
            ->limit(1)
            ->execute();

        $user = new Model_User($select['id']);
        return $user->fill_by_row($select);

    }


    public function save()
    {
       $this->dt_create = Date::formatted_time('now');

       $insert = Dao_Users::insert();

       foreach ($this as $fieldname => $value) {
           if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
       }

       $result = $insert->execute();

       return $this->get_($result);
    }

    public function update()
    {
       $insert = Dao_Users::update();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $insert->clearcache($this->id);
        $insert->where('id', '=', $this->id);
        $insert->execute();

        return $this->get_($this->id);
    }



    public static function getAll()
    {
        $select = Dao_Users::select()
            ->order_by('id', 'DESC')
            ->execute();

        $users = array();

        if ( empty($select) ) return $users;

        foreach ($select as $item) {
            $user = new Model_User();
            $users[] = $user->fill_by_row($item);
        }

        return $users;
    }


    /**
     * Checking Password before changing
     *
     * @param $pass
     * @return bool
     */
    public function checkPassword ($pass) {

        $selection = Dao_Users::select(array('password'))
                      ->where('id', '=', $this->id)
                      ->limit(1)
                      ->execute();

        $password = $selection['password'];

        return $password == $pass;
    }


    /**
     * Change password
     *
     * @param $newpass
     * @return object
     */
    public function changePassword ($newpass) {

        $insert = Dao_Users::update()
                   ->set('password', $newpass)
                   ->where('id', '=', $this->id)
                   ->clearcache($this->id)
                   ->execute();
        return $insert;
    }


}