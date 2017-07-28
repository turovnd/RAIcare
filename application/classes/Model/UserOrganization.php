<?php defined('SYSPATH') or die('No direct script access.');


Class Model_UserOrganization {

    public $o_id;
    public $u_id;

    public static function add($user, $organization)
    {
        Dao_UsersOrganizations::insert()
            ->set('u_id', $user)
            ->set('o_id', $organization)
            ->clearcache('user_' . $user)
            ->clearcache('organization_' . $organization)
            ->execute();
    }

    public static function delete($user, $organization)
    {
        Dao_UsersOrganizations::delete()
            ->where('u_id', '=', $user)
            ->where('o_id', '=', $organization)
            ->clearcache('user_' . $user)
            ->clearcache('organization_' . $organization)
            ->limit(1)
            ->execute();
    }

    public static function getOrganization($user)
    {
        $select = Dao_UsersOrganizations::select('o_id')
            ->where('u_id', '=', $user)
            ->cached(Date::MINUTE * 5, 'user_' . $user)
            ->order_by('o_id', 'DESC')
            ->limit(1)
            ->execute();

        return new Model_Organization($select['o_id']);
    }

    public static function getUsers($organization)
    {
        $select = Dao_UsersOrganizations::select()
            ->where('o_id', '=', $organization)
            ->cached(Date::MINUTE * 5, 'organization_' . $organization)
            ->order_by('u_id', 'ASC')
            ->execute();

        if (empty($select)) return array();

        $users = array();

        foreach ($select as $item) {
            $users[] = $item['u_id'];
        }

        return $users;
    }


}