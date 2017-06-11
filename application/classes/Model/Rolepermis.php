<?php defined('SYSPATH') or die('No direct script access.');


Class Model_Rolepermis {

    public $role;
    public $permission;

    public function __construct($role = null) {

        if ( !empty($role) ) {
            $this->get_($role);
        }

    }

    private function fill_by_row($db_selection) {

        if (empty($db_selection['role'])) return $this;

        foreach ($db_selection as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $this->$fieldname = $value;
        }

        return $this;

    }

    private function get_($role) {

        $select = Dao_RolesPermissions::select()
            ->where('role', '=', $role)
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

        $insert->clearcache($this->role);
        $result = $insert->execute();

        return $this->get_($result);
     }


     public function update()
     {
        $insert = Dao_RolesPermissions::update();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $insert->where('role', '=', $this->role);
        $insert->clearcache($this->role);
        $result = $insert->execute();

        return $this->get_($result);
     }

     public static function deletePermission($permission)
     {
         Dao_RolesPermissions::delete()
             ->where('permission', '=', $permission)
             ->clearcache()
             ->execute();
     }

     public static function deleteAll($role)
     {
        Dao_RolesPermissions::delete()
            ->where('role', '=', $role)
            ->clearcache($role)
            ->execute();
     }

     public static function getAll()
     {
         return Dao_RolesPermissions::select()
             ->order_by('role', 'ASC')
             ->order_by('permission', 'ASC')
             ->execute();
     }

     public static function getPermissionsByRole($role)
     {
         $select = Dao_RolesPermissions::select()
            ->where('role', '=', $role)
            ->order_by('role', 'ASC')
            ->order_by('permission', 'ASC')
            ->execute();

         if (empty($select))
             return [];

         $permissions = array();

         foreach ($select as $permission){
             $permissions[] = $permission['permission'];
         }

         return $permissions;
     }


}