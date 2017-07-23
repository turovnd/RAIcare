<?php defined('SYSPATH') or die('No direct script access.');


Class Model_MKB10 {

    public $id;
    public $name;
    public $code;
    public $parent_id;
    public $parent_code;
    public $node_count;
    public $additional_info;

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

        $select = Dao_MKB10::select()
            ->where('id', '=', $id)
            ->limit(1)
            ->cached(Date::MINUTE * 5, $id)
            ->execute();

        $this->fill_by_row($select);

        return $this;

    }

    public static function searchByName($name)
    {
        $select = Dao_MKB10::select()
            ->or_having('name', '%' . $name . '%')
            ->or_having('code', '%' . $name . '%')
            ->order_by('name', 'DESC')
            ->limit(30)
            ->execute();

        $items = array();

        if ( empty($select) ) return $items;

        foreach ($select as $sql) {
            $items[] = array(
                'value' => $sql['id'],
                'label' => $sql['name'] . ' (' . $sql['code'] . ')'
            );
        }

        return $items;
    }

}