<?php defined('SYSPATH') or die('No direct script access.');


Class Model_UserOrganization {

    public $o_id;
    public $u_id;

    public static function add($user, $organization)
    {
        Dao_UsersOrganizations::insert()
            ->set('u_id', $user)
            ->set('o_id', $organization)
            ->execute();
    }

    public static function delete($user, $organization)
    {
        Dao_UsersOrganizations::delete()
            ->where('u_id', '=', $user)
            ->where('o_id', '=', $organization)
            ->limit(1)
            ->clearcache($user . '_' . $organization)
            ->execute();
    }

    public static function getOrganizations($user)
    {
        $select = Dao_UsersOrganizations::select()
            ->where('u_id', '=', $user)
            ->order_by('o_id', 'DESC')
            ->execute();

        if (empty($select)) return array();

        $organizations = array();

        foreach ($select as $item) {
            $organizations[] = $item['o_id'];
        }

        return $organizations;
    }

    public static function getUsers($organization)
    {
        $select = Dao_UsersOrganizations::select()
            ->where('o_id', '=', $organization)
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