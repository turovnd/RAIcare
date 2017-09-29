<?php defined('SYSPATH') or die('No direct script access.');


Class Model_UserPension {

    public $p_id;
    public $u_id;

    public static function add($user, $pension)
    {
        Dao_UsersPensions::insert()
            ->set('u_id', $user)
            ->set('p_id', $pension)
            ->clearcache('user_' . $user)
            ->clearcache('pension_' . $pension)
            ->execute();
    }

    public static function delete($user, $pension)
    {
        Dao_UsersPensions::delete()
            ->where('u_id', '=', $user)
            ->where('p_id', '=', $pension)
            ->clearcache('user_' . $user)
            ->clearcache('pension_' . $pension)
            ->execute();
    }

    public static function deleteAllPensions($user) {
        Dao_UsersPensions::delete()
            ->where('u_id', '=', $user)
            ->clearcache('user_' . $user)
            ->execute();
    }

    public static function deleteAllUsers($pension) {
        Dao_UsersPensions::delete()
            ->where('p_id', '=', $pension)
            ->clearcache('pension_' . $pension)
            ->execute();
    }

    public static function getPensions($user, $as_model = false)
    {
        $select = Dao_UsersPensions::select()
            ->cached(Date::MINUTE * 5, 'user_' . $user)
            ->where('u_id', '=', $user)
            ->order_by('p_id', 'ASC')
            ->execute();

        if (empty($select)) return array();

        $pensions = array();

        foreach ($select as $item) {
            if ($as_model) {
                $pensions[] = new Model_Pension($item['p_id']);
            } else {
                $pensions[] = $item['p_id'];
            }
        }

        return $pensions;
    }

    public static function getUsers($pension, $as_model = false)
    {
        $select = Dao_UsersPensions::select()
            ->cached(Date::MINUTE * 5,'pension_' . $pension)
            ->where('p_id', '=', $pension)
            ->order_by('u_id', 'ASC')
            ->execute();

        if (empty($select)) return array();

        $users = array();

        foreach ($select as $item) {
            if ($as_model) {
                $users[] = new Model_User($item['u_id']);
            } else {
                $users[] = $item['u_id'];
            }
        }

        return $users;
    }


}