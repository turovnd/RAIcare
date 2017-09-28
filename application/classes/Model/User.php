<?php defined('SYSPATH') or die('No direct script access.');


Class Model_User
{

    public $id;
    public $name;
    public $email;
    public $username;
    public $role;
    public $organization;
    public $city;
    public $phone;
    public $is_confirmed;
    public $creator;
    public $dt_create;


    public function __construct($id = null)
    {

        if (!empty($id)) {
            $this->get_($id);
        }

    }

    private function fill_by_row($db_selection)
    {

        if (empty($db_selection['id'])) return $this;

        foreach ($db_selection as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $this->$fieldname = $value;
        }

        return $this;
    }

    private function get_($id)
    {

        $select = Dao_Users::select()
            ->where('id', '=', $id)
            ->limit(1)
            ->cached(Date::MINUTE * 5, $id)
            ->execute();

        $this->fill_by_row($select);

        return $this;

    }


    public static function getByFieldName($field, $value)
    {

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

        $insert->clearcache('org_' . $this->organization);
        $result = $insert->execute();

        return $this->get_($result);
    }

    public function update()
    {
        $insert = Dao_Users::update()
            ->where('id', '=', $this->id);

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $insert
            ->clearcache('org_' . $this->organization)
            ->clearcache($this->id);

        $insert->execute();

        return $this->get_($this->id);
    }


    public static function getAll()
    {
        $select = Dao_Users::select()
            ->order_by('id', 'DESC')
            ->execute();

        $users = array();

        if (empty($select)) return $users;

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
    public function checkPassword($pass)
    {

        $select = Dao_Users::select(array('password'))
            ->where('id', '=', $this->id)
            ->limit(1)
            ->execute();

        $password = $select['password'];
        return $password == $pass;
    }


    /**
     * Change password
     *
     * @param $password
     * @return object
     */
    public function changePassword($password)
    {

        $insert = Dao_Users::update()
            ->set('password', $password)
            ->where('id', '=', $this->id)
            ->clearcache($this->id)
            ->execute();
        return $insert;
    }

    public function emptyUserName()
    {
        $select = Dao_Users::select()
            ->where('username', '=', $this->username)
            ->limit(1)
            ->execute();

        return !empty($select);
    }

    public function emptyEmail()
    {
        $select = Dao_Users::select()
            ->where('email', '=', $this->email)
            ->limit(1)
            ->execute();

        return !empty($select);
    }

    public function delete()
    {
        Dao_Users::delete()
            ->where('id', '=', $this->id)
            ->clearcache('org_' . $this->organization)
            ->clearcache($this->id)
            ->execute();
    }

    public static function getAllFromOrganization($org, $as_model = false)
    {
        $select = Dao_Users::select()
            ->where('organization', '=', $org)
            ->cached(Date::MONTH * 5, 'org_' . $org)
            ->execute();

        $users = array();
        if (empty($select)) return $users;

        foreach ($select as $selection) {
            if ($as_model) {
                $user = new Model_User();
                $user->fill_by_row($selection);
                $users[] = $user;
            } else {
                $users[] = $selection['id'];
            }
        }
        return $users;
    }

    /**
     * Search User
     * @param $name - `name` or `username`
     * @return array - Model_Users
     */
    public static function searchByName($name) {

        $select = Dao_Users::select()
            ->or_having('name', '%' . $name . '%')
            ->or_having('username', '%' . $name . '%')
            ->order_by('id', 'DESC')
            ->limit(30)
            ->execute();

        $users = array();

        if (empty($select)) return $users;

        foreach ($select as $db_selection) {
            $user = new Model_User();
            $user = $user->fill_by_row($db_selection);
            $user->search = $user->name . ' (' . $user->username . ')';
            $users[] = $user;
        }

        return $users;
    }

    /**
     * Change User->organization with clear cache of oldOrgID and curOrgID
     */
    public function changeOrg()
    {
        Dao_Users::update()
            ->where('id', '=', $this->id)
            ->set('organization', $this->organization)
            ->clearcache('org_' . $this->organization)
            ->clearcache('org_' . $this->old_organization)
            ->clearcache($this->id)->execute();

    }
}