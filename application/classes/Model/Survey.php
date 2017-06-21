<?php defined('SYSPATH') or die('No direct script access.');


Class Model_Survey {

    public $pk;         // primary key - autoincrement (unique in global)
    public $id;         // not unique in  global + getting via redis
    public $type ;
    public $status;     //	1 - filling, 2 - finished, 3 - deleted
    public $patient;
    public $pension;    // pension + id - unique index for form in pension
    public $organization;
    public $dt_create;
    public $dt_finish;
    public $creator;

    
    public function __construct($id = null) {

        if ( !empty($id) ) {
            $this->get_($id);
        }

    }

    private function fill_by_row($db_selection) {

        if (empty($db_selection['pk'])) return $this;

        foreach ($db_selection as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $this->$fieldname = $value;
        }

        return $this;

    }

    
    private function get_($id) {

        $select = Dao_Surveys::select()
            ->where('pk', '=', $id)
            ->limit(1)
            ->cached(Date::MINUTE * 5, $id)
            ->execute();

        return $this->fill_by_row($select);

    }


    public static function getByFieldName($field, $value)
    {
        $select = Dao_Surveys::select()
            ->where($field, '=', $value)
            ->limit(1)
            ->execute();

        $patient = new Model_Survey($select['pk']);
        return $patient->fill_by_row($select);

    }


    public function save()
    {
        $this->dt_create = Date::formatted_time('now');
        $this->status = 1;

        $insert = Dao_Surveys::insert();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $result = $insert
            ->clearcache($this->patient)
            ->clearcache($this->id)
            ->execute();

        return $this->get_($result);
    }

    public function update()
    {
        $insert = Dao_Surveys::update();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $insert->clearcache($this->id)
               ->clearcache($this->patient);

        $insert->where('id', '=', $this->id);

        $insert->execute();

        return $this->get_($this->id);
    }

    public static function getFillingFormByPatientAndPension($patient, $pension)
    {
        $select = Dao_Surveys::select()
            ->where('pension','=', $pension)
            ->where('patient','=', $patient)
            ->where('status','=', 1)
            ->limit(1)
            ->execute();

        $form = new Model_Survey();

        return $form->fill_by_row($select);

    }

    public static function getAll($offset, $limit)
    {
        $select = Dao_Surveys::select()
            ->offset($offset)
            ->limit($limit)
            ->execute();

        $forms = array();

        if (empty($select)) return $forms;

        foreach ($select as $item) {
            $form = new Model_Survey();
            $form->fill_by_row($item);
            $form->organization = new Model_Organization($form->organization);
            $form->pension = new Model_Pension($form->pension);
            $form->patient = new Model_Patient($form->patient);
            $form->creator = new Model_User($form->creator);
            $forms[] = $form;
        }

        return $forms;
    }



    public static function getAllFormsByPatientAndPension($patient, $pension, $offset, $limit)
    {
        $select = Dao_Surveys::select()
            ->where('pension','=', $pension)
            ->where('patient','=', $patient)
            ->where('status','=', 2)
            ->offset($offset)
            ->limit($limit)
            ->execute();

        $forms = array();

        if (empty($select)) return $forms;

        foreach ($select as $item) {
            $form = new Model_Survey();
            $form->fill_by_row($item);
            $form->organization = new Model_Organization($form->organization);
            $form->pension = new Model_Pension($form->pension);
            $form->creator = new Model_User($form->creator);
            $form->creator->role = new Model_Role($form->creator->role);
            $forms[] = $form;
        }

        return $forms;
    }



    public static function searchForms($offset, $limit, $name)
    {
        if ($name == "") {
            $select = Dao_Surveys::select('pk')
                ->offset($offset)
                ->limit($limit)
                ->execute();
        } else {
            echo Debug::vars();

            $select = DB::query(Database::SELECT,
                'SELECT `Surveys`.`pk` AS `pk` '.
                    'FROM `Surveys` '.
                        'JOIN `Patients` ON (`Surveys`.`patient` = `Patients`.`pk`)'.
                        'JOIN `Pensions` ON (`Surveys`.`pension` = `Pensions`.`id`)'.
                    'WHERE `Patients`.`name` LIKE \'%'. $name .'%\' '.
                        'OR `Pensions`.`name` LIKE \'%'. $name .'%\' '.
                    ' LIMIT '. $limit .
                    ' OFFSET '. $offset)
                ->execute()
                ->as_array();
        }

        $forms = array();

        if (empty($select)) return $forms;

        foreach ($select as $item) {
            $form = new Model_Survey($item['pk']);
            $form->organization = new Model_Organization($form->organization);
            $form->patient = new Model_Patient($form->patient);
            $form->pension = new Model_Pension($form->pension);
            $form->creator = new Model_User($form->creator);
            $forms[] = $form;
        }

        return $forms;
    }




    public static function getAllFormsByPatients($patients, $offset, $limit)
    {
        $sql = "";
        $key = 0;

        foreach ($patients as $patient) {
            $key++;
            if ($key == count($patients)) {
                $sql .= '`patient` = ' . $patient;
            } else {
                $sql .= '`patient` = ' . $patient . ' OR ';
            }
        }

        $select = DB::query(Database::SELECT,'SELECT * from Surveys WHERE `status` = 2 AND (' . $sql . ') ORDER BY `dt_finish` DESC LIMIT ' .  $offset . ', ' . $limit)
            ->execute()
            ->as_array();

        $forms = array();

        if (empty($select)) return $forms;

        foreach ($select as $item) {
            $form = new Model_Survey();
            $form->fill_by_row($item);
            $form->organization = new Model_Organization($form->organization);
            $form->pension = new Model_Pension($form->pension);
            $form->creator = new Model_User($form->creator);
            $form->creator->role = new Model_Role($form->creator->role);
            $forms[] = $form;
        }

        return $forms;
    }

}