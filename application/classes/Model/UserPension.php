<?php defined('SYSPATH') or die('No direct script access.');


Class Model_UserPension {

    public $p_id;
    public $u_id;

    public static function add($user, $pension)
    {
        Dao_UsersPensions::insert()
            ->set('u_id', $user)
            ->set('p_id', $pension)
            ->execute();
    }

    public static function delete($user, $pension)
    {
        Dao_UsersPensions::delete()
            ->where('u_id', '=', $user)
            ->where('p_id', '=', $pension)
            ->limit(1)
            ->clearcache($user . '_' . $pension)
            ->execute();
    }

    public static function getPensions($user)
    {
        $select = Dao_UsersPensions::select()
            ->where('u_id', '=', $user)
            ->order_by('p_id', 'DESC')
            ->execute();

        if (empty($select)) return array();

        $pensions = array();

        foreach ($select as $item) {
            $pensions[] = $item['p_id'];
        }

        return $pensions;
    }

    public static function getUsers($pension)
    {
        $select = Dao_UsersPensions::select()
            ->where('p_id', '=', $pension)
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