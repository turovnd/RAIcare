<?php defined('SYSPATH') or die('No direct script access.');


Class Model_OrganizationPension {

    public $o_id;
    public $p_id;

    public static function add($organization, $pension)
    {
        Dao_OrganizationsPensions::insert()
            ->set('o_id', $organization)
            ->set('p_id', $pension)
            ->execute();
    }

    public static function delete($organization, $pension)
    {
        Dao_OrganizationsPensions::delete()
            ->where('o_id', '=', $organization)
            ->where('p_id', '=', $pension)
            ->limit(1)
            ->clearcache($organization . '_' . $pension)
            ->execute();
    }

    public static function getOrganizations($pension)
    {
        $select = Dao_OrganizationsPensions::select()
            ->where('p_id', '=', $pension)
            ->order_by('o_id', 'DESC')
            ->execute();

        if (empty($select)) return array();

        $organizations = array();

        foreach ($select as $item) {
            $organizations[] = $item['o_id'];
        }

        return $organizations;
    }

    public static function getPensions($organization)
    {
        $select = Dao_UsersPensions::select()
            ->where('o_id', '=', $organization)
            ->order_by('p_id', 'DESC')
            ->execute();

        if (empty($select)) return array();

        $pensions = array();

        foreach ($select as $item) {
            $pensions[] = $item['p_id'];
        }

        return $pensions;
    }

}