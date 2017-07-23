<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Surveys_Index
 *
 * @copyright raisoft
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Surveys_Index extends Dispatch
{
    CONST CAN_CONDUCT_A_SURVEY  = 36;
    CONST WATCH_ALL_SURVEYS     = 37;
    CONST WATCH_PEN_SURVEY      = 39;

    public $template = 'main';

    protected $pension  = null;
    protected $survey   = null;

    public function before()
    {
        parent::before();

        if (!self::isLogged()) {
            $this->redirect('login');
        }

        $data = array(
            'action' => $this->request->action()
        );

        $this->template->aside = View::factory('global_blocks/aside', $data);
    }

    public function action_all_surveys()
    {
        self::hasAccess(self::WATCH_ALL_SURVEYS);

        $surveys = Model_Survey::getAll(0,10);

        $this->template->title = "База данных всех форм оценки";
        $this->template->section = View::factory('surveys/pages/all-surveys')
            ->set('surveys', $surveys);
    }

    public function action_all_survey()
    {
        self::hasAccess(self::WATCH_ALL_SURVEYS);

        $this->getSurvey();

        $this->survey->patient = new Model_Patient($this->survey->patient);
        $this->survey->patient->can_edit = false;
        $this->survey->patient->full_info = true;

        $this->template->title = "Форма оценки #" . $this->survey->pk;
        $this->template->section = View::factory('surveys/pages/survey')
            ->set('survey', $this->survey);
    }

    public function action_pen_survey()
    {
        $this->getPension();
        $this->getSurvey();

        if ($this->survey->status == 1) {
            self::hasAccess(self::CAN_CONDUCT_A_SURVEY);
            $this->survey->unavailable_units = json_encode($this->getUnavailableUnits());
            $section = 'survey-filling';
        }

        if ($this->survey->status == 2) {
            self::hasAccess(self::WATCH_PEN_SURVEY);
            $this->survey->patient = new Model_Patient($this->survey->patient);
            $this->survey->patient->can_edit = false;
            $this->survey->patient->full_info = true;
            $section = 'survey';
        }

        $this->template->title = "Форма оценки долговременного ухода";
        $this->template->section = View::factory('surveys/pages/' . $section)
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

    private function getPension()
    {
        $pension = $this->request->param('pen_id');

        $this->pension = new Model_Pension($pension);

        if (!$this->pension->id) {
            throw new HTTP_Exception_404();
        }

        $usersIDs = Model_UserPension::getUsers($this->pension->id);

        if (!(in_array($this->user->id, $usersIDs))) {
            if ( $this->user->role != 1 ) {
                throw new HTTP_Exception_403();
            }
        }
    }

    private function getSurvey()
    {
        $survey = $this->request->param('s_pk');
        $this->survey = new Model_Survey($survey);

        if (!$survey) {
            $survey = $this->request->param('s_id');
            $this->survey = Model_Survey::getByFieldName('id', $survey);

            if ($this->survey->status == 1 && strtotime(Date::formatted_time('now')) - strtotime($this->survey->dt_create) > Date::DAY * 3) {
                $this->survey->status= 3;
                $this->survey->update();
                echo '<h2 class="h2">Форма была удалена.</h2><h3 class="h3">С момента создания прошло более 3 дней</h3><h4>Дата создания: '. Date('d M Y H:i', strtotime($this->survey->dt_create)) . '</h4><h4>Текущее время: ' . Date('d M Y H:i', strtotime(Date::formatted_time('now'))) . '</h4>';
                die();
            }

            if ($this->survey->pension != $this->pension->id || $this->survey->status == 3) {
                throw new HTTP_Exception_404();
            }
        }

        if (!$this->survey->pk) {
            throw new HTTP_Exception_404();
        }

    }

}