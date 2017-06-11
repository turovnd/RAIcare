<?php defined('SYSPATH') or die('No direct script access.');


Class Model_UserOrganization {

    public $organization;
    public $user;

    public static function add($user, $organization)
    {
        Dao_UsersOrganizations::insert()
            ->set('user', $user)
            ->set('organization', $organization)
            ->execute();
    }

    public static function delete($user, $organization)
    {
        Dao_UsersOrganizations::delete()
            ->where('user', '=', $user)
            ->where('organization', '=', $organization)
            ->limit(1)
            ->clearcache($user . '_' . $organization)
            ->execute();
    }

    public static function getOrganizations($user)
    {
        return Dao_UsersOrganizations::select()
            ->where('user', '=', $user)
            ->order_by('organization', 'DESC')
            ->execute();
    }

    public static function getUser($organization)
    {
        $select = Dao_UsersOrganizations::select()
            ->where('organization', '=', $organization)
            ->limit(1)
            ->order_by('user', 'DESC')
            ->execute();

        return $select['user'];
    }


}