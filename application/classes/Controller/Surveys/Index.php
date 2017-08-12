<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Surveys_Index
 *
 * @copyright RAIcare
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Surveys_Index extends Dispatch
{
    public $template = 'main';

    /** Current Organization */
    protected $organization = null;

    /** Current Pension */
    protected $pension = null;

    /** Current Patient */
    protected $patient = null;

    /** Current Survey */
    protected $survey   = null;


    public function before()
    {
        parent::before();

        $org_uri = Request::$subdomain;

        $this->organization = Model_Organization::getByFieldName('uri', $org_uri);

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

        if (! ( in_array($this->user->role,self::PEN_AVAILABLE_ROLES) ||
            $this->user->role == self::ROLE_PEN_CREATOR ||
            in_array($this->user->id, $this->pension->users) || $this->user->role == 1) ) {

            throw new HTTP_Exception_403();

        }

        if ($this->request->action() == 'survey') {
            $survey = $this->request->param('id');
            $this->survey = Model_Survey::getByFieldName('id', $survey);

            if (!$this->survey->pk || $this->survey->pension != $this->pension->id) {
                throw new HTTP_Exception_404();
            }

            if ($this->survey->status == 1 && strtotime(Date::formatted_time('now')) - strtotime($this->survey->dt_create) > Date::DAY * 3) {
                $this->survey->status= 3;
                $this->survey->update();
            }
        }

        $data = array(
            'aside_type' => 'survey',
            'pension'    => $this->pension,
            'survey'     => $this->survey,
            'action'     => $this->request->action()
        );

        $this->template->aside = View::factory('global_blocks/aside', $data);
    }

    public function action_surveys()
    {
        $surveys = Model_Survey::getAllByPension($this->pension->id, 0, 2);

        $this->template->title = "Все формы оценки - " . $this->pension->name;
        $this->template->section = View::factory('surveys/pages/surveys')
            ->set('pension', $this->pension)
            ->set('surveys', $surveys);
    }

    public function action_survey()
    {
        if ($this->survey->status == 1 && $this->user->role == self::ROLE_PEN_NURSE) {

            $this->survey->unavailable_units = json_encode($this->getUnavailableUnits());
            $section = 'survey-filling';

        } else {

            $this->getSurveyUnits();
            $this->patient = new Model_Patient($this->survey->patient);
            $section = 'survey-control';

        }

        $this->template->title = "Форма оценки #" . $this->survey->id . " - " . $this->pension->name;
        $this->template->section = View::factory('surveys/pages/' . $section)
            ->set('pension', $this->pension)
            ->set('patient', $this->patient)
            ->set('survey', $this->survey)
            ->set('can_conduct', true);
    }

    private function getUnavailableUnits()
    {
        $unitC = new Model_SurveyUnitC($this->survey->unitC);
        $units = array();
        if ($this->survey->type != 1) array_push($units, 'unitB');
        if ($this->survey->type != 5) array_push($units, 'unitR');
        if ($this->survey->type == 5) array_push($units, 'unitQ');
        if ($unitC->C1 == 5) {
            array_push($units, 'unitD');
            array_push($units, 'unitE');
            array_push($units, 'unitF');
        }

        return $units;
    }

    private function getSurveyUnits()
    {
        $this->survey->unitA = new Model_SurveyUnitA($this->survey->unitA);
        $this->survey->unitB = new Model_SurveyUnitB($this->survey->unitB);
        $this->survey->unitC = new Model_SurveyUnitC($this->survey->unitC);
        $this->survey->unitD = new Model_SurveyUnitD($this->survey->unitD);
        $this->survey->unitE = new Model_SurveyUnitE($this->survey->unitE);
        $this->survey->unitF = new Model_SurveyUnitF($this->survey->unitF);
        $this->survey->unitG = new Model_SurveyUnitG($this->survey->unitG);
        $this->survey->unitH = new Model_SurveyUnitH($this->survey->unitH);
        $this->survey->unitI = new Model_SurveyUnitI($this->survey->unitI);
        $this->survey->unitJ = new Model_SurveyUnitJ($this->survey->unitJ);
        $this->survey->unitK = new Model_SurveyUnitK($this->survey->unitK);
        $this->survey->unitL = new Model_SurveyUnitL($this->survey->unitL);
        $this->survey->unitM = new Model_SurveyUnitM($this->survey->unitM);
        $this->survey->unitN = new Model_SurveyUnitN($this->survey->unitN);
        $this->survey->unitO = new Model_SurveyUnitO($this->survey->unitO);
        $this->survey->unitP = new Model_SurveyUnitP($this->survey->unitP);
        $this->survey->unitQ = new Model_SurveyUnitQ($this->survey->unitQ);
        $this->survey->unitR = new Model_SurveyUnitR($this->survey->unitR);
    }
}