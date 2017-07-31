<?php defined('SYSPATH') or die('No direct script access.');


Class Model_OrganizationPension {

    public $o_id;
    public $p_id;

    public static function add($pension, $organization)
    {
        Dao_OrganizationsPensions::insert()
            ->set('p_id', $pension)
            ->set('o_id', $organization)
            ->clearcache('pensions_' . $organization)
            ->execute();
    }

    public static function delete($pension, $organization)
    {
        Dao_OrganizationsPensions::delete()
            ->where('p_id', '=', $pension)
            ->where('o_id', '=', $organization)
            ->clearcache('pensions_' . $organization)
            ->limit(1)
            ->execute();
    }

    public static function getPensions($organization, $as_model = false)
    {
        $select = Dao_OrganizationsPensions::select()
            ->where('o_id', '=', $organization)
            ->cached(Date::MINUTE * 5, 'pensions_' . $organization)
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

}