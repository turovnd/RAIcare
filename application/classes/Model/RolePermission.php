<?php defined('SYSPATH') or die('No direct script access.');


Class Model_RolePermission {

    public $r_id;
    public $p_id;

    public function __construct($role = null) {

        if ( !empty($role) ) {
            $this->get_($role);
        }

    }

    private function fill_by_row($db_selection) {

        if (empty($db_selection['r_id'])) return $this;

        foreach ($db_selection as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $this->$fieldname = $value;
        }

        return $this;

    }

    private function get_($role) {

        $select = Dao_RolesPermissions::select()
            ->where('r_id', '=', $role)
            ->limit(1)
            ->cached(Date::MINUTE * 5, $role)
            ->execute();

        $this->fill_by_row($select);

        return $this;

    }

     public function save()
     {
        $insert = Dao_RolesPermissions::insert();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $insert->clearcache($this->r_id);
        $result = $insert->execute();

        return $this->get_($result);
     }


     public function update()
     {
        $insert = Dao_RolesPermissions::update();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $insert->where('r_id', '=', $this->r_id);
        $insert->clearcache($this->r_id);
        $result = $insert->execute();

        return $this->get_($result);
     }

     public static function deletePermission($permission)
     {
         Dao_RolesPermissions::delete()
             ->where('p_id', '=', $permission)
             ->clearcache()
             ->execute();
     }

     public static function deleteAll($role)
     {
        Dao_RolesPermissions::delete()
            ->where('r_id', '=', $role)
            ->clearcache($role)
            ->execute();
     }

     public static function getAll()
     {
         return Dao_RolesPermissions::select()
             ->order_by('r_id', 'ASC')
             ->order_by('p_id', 'ASC')
             ->execute();
     }

     public static function getPermissionsByRole($role)
     {
         $select = Dao_RolesPermissions::select()
            ->where('r_id', '=', $role)
            ->order_by('r_id', 'ASC')
            ->order_by('p_id', 'ASC')
            ->execute();

         if (empty($select))
             return [];

         $permissions = array();

         foreach ($select as $permission){
             $permissions[] = $permission['p_id'];
         }

         return $permissions;
     }


}