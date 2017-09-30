<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Pensions_Index
 *
 * @copyright RAIcare
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Pensions_Index extends Dispatch
{
    public $template = 'main';

    /** Current Organization */
    protected $organization = null;

    /** Current Pension */
    protected $pension  = null;

    public function before()
    {
        parent::before();

        $org_uri = Request::$subdomain;

        $this->organization = Model_Organization::getByUri($org_uri);

        if (!$this->organization->id && !in_array($org_uri, self::PRIVATE_SUBDOMIANS)) {
            throw new HTTP_Exception_404();
        }

        if (!self::isLogged()) self::gotoLoginPage();

        $pen_uri = $this->request->param('pen_uri');
        $this->pension = Model_Pension::getByFieldName('uri', $pen_uri);

        if (!$this->pension->id || $this->pension->organization != $this->organization->id) {
            throw new HTTP_Exception_404();
        }

        $this->pension->users = Model_UserPension::getUsers($this->pension->id);

        if (! ( ( in_array($this->user->id, $this->pension->users) && (
                    $this->user->role == self::ROLE_PEN_CREATOR ||
                    in_array($this->user->role,self::PEN_AVAILABLE_ROLES) ) ) ||
            $this->user->role == self::ROLE_ORG_CREATOR ||
            in_array($this->user->role,self::ORG_AVAILABLE_ROLES) ||
            $this->user->role == self::ROLE_ADMIN ||
            $this->user->role == self::ROLE_DEMO ) ) {

            throw new HTTP_Exception_403;
        }

        $data = array(
            'aside_type' => 'pension',
            'pension'    => $this->pension,
            'action'     => $this->request->action()
        );

        $this->template->aside = View::factory('global-blocks/aside', $data);
    }


    /**
     * Main Page Of Pension - show not private statistic for all users (co-workers from org + pen)
     */
    public function action_index()
    {
        $patients = Model_Patient::getAllByPension($this->pension->id);
        $patientsAges = array( 'total' => count($patients),
                                'data' => array( array( 'name' => 'Меньше 65 лет', 'number' => 0 ),
                                                 array( 'name' => '66-84 лет', 'number' => 0 ),
                                                 array( 'name' => 'Старше 85 лет', 'number' => 0 ) ) );

        $patientsSex = array( 'total' => count($patients),
                                'data' => array( array( 'name' => 'Мужской', 'number' => 0 ),
                                                 array( 'name' => 'Женский', 'number' => 0 ) ) );

        foreach ($patients as $patient) {
            if ($patient->age < 65) $patientsAges['data'][0]['number']++;
                elseif($patient->age > 85) $patientsAges['data'][2]['number']++;
                    else $patientsAges['data'][1]['number']++;

            if ($patient->sex == 1) $patientsSex['data'][0]['number']++;
                else $patientsSex['data'][1]['number']++;
        }

        $RAI_scales = $this->getRAIScales();

        $this->template->title = $this->pension->name;
        $this->template->section = View::factory('pensions/pages/main')
            ->set('pension', $this->pension)
            ->set('RAI_scales', $RAI_scales)
            ->set('patientsAges', json_encode($patientsAges))
            ->set('patientsSex', json_encode($patientsSex));
    }

    /**
     * Edit Main Info about Pension - only for owner
     */
    public function action_settings()
    {
        if ( ! ($this->user->role == self::ROLE_ORG_CREATOR ||
            $this->user->role == self::ROLE_PEN_CREATOR ||
            $this->user->role == self::ROLE_ADMIN ||
            $this->user->role == self::ROLE_DEMO ) ) {
            throw new HTTP_Exception_403();
        }

        $this->template->title = 'Настройки - ' . $this->pension->name;
        $this->template->section = View::factory('pensions/pages/settings')
            ->set('pension', $this->pension);
    }


    /**
     * Manage Co Workers Of Pension
     */
    public function action_manage()
    {
        if ( ! ($this->user->role == self::ROLE_PEN_CREATOR ||
            $this->user->role == self::ROLE_PEN_CO_WORKER_MANAGER ||
            $this->user->role == self::ROLE_DEMO ) ) {

            throw new HTTP_Exception_403();

        }

        $co_workers = array();
        foreach ($this->pension->users as $id) {
            $user = new Model_User($id);
            $user->role = new Model_Role($user->role);
            $co_workers[] = $user;
        }

        $roles = array();
        foreach (self::PEN_AVAILABLE_ROLES as $id) {
            $roles[] = new Model_Role($id);
        }

        $this->template->title = 'Сотрудники - ' . $this->pension->name;
        $this->template->section = View::factory('pensions/pages/manage')
            ->set('co_workers', $co_workers)
            ->set('roles', $roles)
            ->set('pension', $this->pension);

    }


    private function getRAIScales() {
        $reports = Model_ReportRAIScales::getAllByPension($this->pension->id);

        $RAI_scales['ADLH'] = array( 'total' => count($reports),
            'data' => array( array( 'name' => 'Независим', 'number' => 0 ),
                array( 'name' => 'Присмотр', 'number' => 0 ),
                array( 'name' => 'Мин. помощь', 'number' => 0 ),
                array( 'name' => 'Сред. помощь', 'number' => 0 ),
                array( 'name' => 'Макс. помощь', 'number' => 0 ),
                array( 'name' => 'Зависим', 'number' => 0 ),
                array( 'name' => 'Макс. зависим', 'number' => 0 ) ) );

        $RAI_scales['DRS'] = array( 'total' => count($reports),
            'data' => array( array( 'name' => 'Отсутствует', 'number' => 0 ),
                array( 'name' => 'Умеренная', 'number' => 0 ),
                array( 'name' => 'Сильная', 'number' => 0 ) ) );

        $RAI_scales['CPS'] = array( 'total' => count($reports),
            'data' => array( array( 'name' => 'Нормальные', 'number' => 0 ),
                array( 'name' => 'В приделах нормы', 'number' => 0 ),
                array( 'name' => 'Незн. отклонения', 'number' => 0 ),
                array( 'name' => 'Ум. отклонения', 'number' => 0 ),
                array( 'name' => 'Ум/сер отклонения', 'number' => 0 ),
                array( 'name' => 'Сер. отклонения', 'number' => 0 ),
                array( 'name' => 'Оч.сер отклонения', 'number' => 0 ) ) );

        $RAI_scales['COMM'] = array( 'total' => count($reports),
            'data' => array( array( 'name' => 'В приделах нормы', 'number' => 0 ),
                array( 'name' => 'Незн. отклонения', 'number' => 0 ),
                array( 'name' => 'Умер. отклонения', 'number' => 0 ),
                array( 'name' => 'Cер. отклонения', 'number' => 0 ),
                array( 'name' => 'Оч.сер отклонения', 'number' => 0 ) ) );


        foreach ($reports as $report) {
            if ($report->ADLH == 0) $RAI_scales['ADLH']['data'][0]['number']++;
            elseif ($report->ADLH == 1) $RAI_scales['ADLH']['data'][1]['number']++;
            elseif ($report->ADLH == 2) $RAI_scales['ADLH']['data'][2]['number']++;
            elseif ($report->ADLH == 3) $RAI_scales['ADLH']['data'][3]['number']++;
            elseif ($report->ADLH == 4) $RAI_scales['ADLH']['data'][4]['number']++;
            elseif ($report->ADLH == 5) $RAI_scales['ADLH']['data'][5]['number']++;
            else $RAI_scales['ADLH']['data'][6]['number']++;

            if ($report->DRS == 0 || $report->DRS == 1 || $report->DRS == 2) $RAI_scales['DRS']['data'][0]['number']++;
            elseif ($report->DRS == 3 || $report->DRS == 4 || $report->DRS == 5 || $report->DRS == 6 || $report->DRS == 7 || $report->DRS == 8) $RAI_scales['DRS']['data'][1]['number']++;
            else $RAI_scales['DRS']['data'][2]['number']++;

            if ($report->CPS == 0) $RAI_scales['CPS']['data'][0]['number']++;
            elseif ($report->CPS == 1) $RAI_scales['CPS']['data'][1]['number']++;
            elseif ($report->CPS == 2) $RAI_scales['CPS']['data'][2]['number']++;
            elseif ($report->CPS == 3) $RAI_scales['CPS']['data'][3]['number']++;
            elseif ($report->CPS == 4) $RAI_scales['CPS']['data'][4]['number']++;
            elseif ($report->CPS == 5) $RAI_scales['CPS']['data'][5]['number']++;
            else $RAI_scales['CPS']['data'][6]['number']++;

            if ($report->COMM == 0 || $report->COMM == 1) $RAI_scales['COMM']['data'][0]['number']++;
            elseif ($report->COMM == 2 || $report->COMM == 3) $RAI_scales['COMM']['data'][1]['number']++;
            elseif ($report->COMM == 4 || $report->COMM == 5) $RAI_scales['COMM']['data'][2]['number']++;
            elseif ($report->COMM == 6 || $report->COMM == 7) $RAI_scales['COMM']['data'][3]['number']++;
            else $RAI_scales['COMM']['data'][4]['number']++;
        }

        return $RAI_scales;
    }

}