<?php defined('SYSPATH') or die('No direct script access.');

use SimpleExcel\SimpleExcel;

class Controller_Test extends Dispatch
{
    public $template = 'main';

    protected $excel  = null;
    protected $survey = null;
    protected $report = null;

    function before() {

        parent::before();
    }


    public function action_test()
    {
        $surveys   = array();
        $protocols = array();
        $raiscales = array();

        $excel_surveys   = array();
        $excel_protocols = array();
        $excel_raiscales = array();

        $this->excel = new SimpleExcel();
        $this->excel->loadFile('data.csv', 'CSV', array('delimiter' => ';'));
//        echo Debug::vars($this->excel->getWorksheet(1)->getRecord(1));
//        echo Debug::vars($this->excel->getWorksheet(1)->getRecord(2));
//        die();

        for ($i = 1; $i <= 35; $i++) {
            $this->survey = new Model_Survey($i);
            $this->getUnitsData();
            $surveys[] = $this->survey;

            $this->report = new Model_ReportProtocols($i);
            $protocols[] = $this->report;

            $this->report = new Model_ReportRAIScales($i);
            $raiscales[] = $this->report;

            $this->survey = new Model_Survey();
            $this->get_excel_surveys($i);
            $excel_surveys[] = $this->survey;

            $this->report = new Model_ReportProtocols();
            $this->get_excel_protocols($i);
            $excel_protocols[] = $this->report;

            $this->report = new Model_ReportRAIScales();
            $this->get_excel_raiscales($i);
            $excel_raiscales[] = $this->report;
        }

        $this->template = View::factory('test');
        $this->template->headers = $this->excel->getWorksheet(1)->getRecord(1);
        $this->template->surveys = $surveys;
        $this->template->protocols = $protocols;
        $this->template->raiscales = $raiscales;
        $this->template->excel_surveys = $excel_surveys;
        $this->template->excel_protocols = $excel_protocols;
        $this->template->excel_raiscales = $excel_raiscales;
    }

    public function action_test1()
    {
        $surveys   = array();
        $protocols = array();
        $raiscales = array();

        $excel_surveys   = array();
        $excel_protocols = array();
        $excel_raiscales = array();

        $this->excel = new SimpleExcel();
        $this->excel->loadFile('data.csv', 'CSV', array('delimiter' => ';'));
//        echo Debug::vars($this->excel->getWorksheet(1)->getRecord(1));
//        echo Debug::vars($this->excel->getWorksheet(1)->getRecord(2));
//        die();

        for ($i = 36; $i <= 70; $i++) {
            $this->survey = new Model_Survey($i);
            $this->getUnitsData();
            $surveys[] = $this->survey;

            $this->report = new Model_ReportProtocols($i);
            $protocols[] = $this->report;

            $this->report = new Model_ReportRAIScales($i);
            $raiscales[] = $this->report;

            $this->survey = new Model_Survey();
            $this->get_excel_surveys($i);
            $excel_surveys[] = $this->survey;

            $this->report = new Model_ReportProtocols();
            $this->get_excel_protocols($i);
            $excel_protocols[] = $this->report;

            $this->report = new Model_ReportRAIScales();
            $this->get_excel_raiscales($i);
            $excel_raiscales[] = $this->report;
        }

        $this->template = View::factory('test');
        $this->template->headers = $this->excel->getWorksheet(1)->getRecord(1);
        $this->template->surveys = $surveys;
        $this->template->protocols = $protocols;
        $this->template->raiscales = $raiscales;
        $this->template->excel_surveys = $excel_surveys;
        $this->template->excel_protocols = $excel_protocols;
        $this->template->excel_raiscales = $excel_raiscales;
    }

    public function action_test2()
    {
        $surveys   = array();
        $protocols = array();
        $raiscales = array();

        $excel_surveys   = array();
        $excel_protocols = array();
        $excel_raiscales = array();

        $this->excel = new SimpleExcel();
        $this->excel->loadFile('data.csv', 'CSV', array('delimiter' => ';'));
//        echo Debug::vars($this->excel->getWorksheet(1)->getRecord(1));
//        echo Debug::vars($this->excel->getWorksheet(1)->getRecord(2));
//        die();

        for ($i = 71; $i <= 105; $i++) {
            $this->survey = new Model_Survey($i);
            $this->getUnitsData();
            $surveys[] = $this->survey;

            $this->report = new Model_ReportProtocols($i);
            $protocols[] = $this->report;

            $this->report = new Model_ReportRAIScales($i);
            $raiscales[] = $this->report;

            $this->survey = new Model_Survey();
            $this->get_excel_surveys($i);
            $excel_surveys[] = $this->survey;

            $this->report = new Model_ReportProtocols();
            $this->get_excel_protocols($i);
            $excel_protocols[] = $this->report;

            $this->report = new Model_ReportRAIScales();
            $this->get_excel_raiscales($i);
            $excel_raiscales[] = $this->report;
        }

        $this->template = View::factory('test');
        $this->template->headers = $this->excel->getWorksheet(1)->getRecord(1);
        $this->template->surveys = $surveys;
        $this->template->protocols = $protocols;
        $this->template->raiscales = $raiscales;
        $this->template->excel_surveys = $excel_surveys;
        $this->template->excel_protocols = $excel_protocols;
        $this->template->excel_raiscales = $excel_raiscales;
    }

    public function action_test3()
    {
        $surveys   = array();
        $protocols = array();
        $raiscales = array();

        $excel_surveys   = array();
        $excel_protocols = array();
        $excel_raiscales = array();

        $this->excel = new SimpleExcel();
        $this->excel->loadFile('data.csv', 'CSV', array('delimiter' => ';'));
//        echo Debug::vars($this->excel->getWorksheet(1)->getRecord(1));
//        echo Debug::vars($this->excel->getWorksheet(1)->getRecord(2));
//        die();

        for ($i = 106; $i <= 140; $i++) {
            $this->survey = new Model_Survey($i);
            $this->getUnitsData();
            $surveys[] = $this->survey;

            $this->report = new Model_ReportProtocols($i);
            $protocols[] = $this->report;

            $this->report = new Model_ReportRAIScales($i);
            $raiscales[] = $this->report;

            $this->survey = new Model_Survey();
            $this->get_excel_surveys($i);
            $excel_surveys[] = $this->survey;

            $this->report = new Model_ReportProtocols();
            $this->get_excel_protocols($i);
            $excel_protocols[] = $this->report;

            $this->report = new Model_ReportRAIScales();
            $this->get_excel_raiscales($i);
            $excel_raiscales[] = $this->report;
        }

        $this->template = View::factory('test');
        $this->template->headers = $this->excel->getWorksheet(1)->getRecord(1);
        $this->template->surveys = $surveys;
        $this->template->protocols = $protocols;
        $this->template->raiscales = $raiscales;
        $this->template->excel_surveys = $excel_surveys;
        $this->template->excel_protocols = $excel_protocols;
        $this->template->excel_raiscales = $excel_raiscales;
    }

    public function action_test4()
    {
        $surveys   = array();
        $protocols = array();
        $raiscales = array();

        $excel_surveys   = array();
        $excel_protocols = array();
        $excel_raiscales = array();

        $this->excel = new SimpleExcel();
        $this->excel->loadFile('data.csv', 'CSV', array('delimiter' => ';'));
//        echo Debug::vars($this->excel->getWorksheet(1)->getRecord(1));
//        echo Debug::vars($this->excel->getWorksheet(1)->getRecord(2));
//        die();

        for ($i = 141; $i <= 175; $i++) {
            $this->survey = new Model_Survey($i);
            $this->getUnitsData();
            $surveys[] = $this->survey;

            $this->report = new Model_ReportProtocols($i);
            $protocols[] = $this->report;

            $this->report = new Model_ReportRAIScales($i);
            $raiscales[] = $this->report;

            $this->survey = new Model_Survey();
            $this->get_excel_surveys($i);
            $excel_surveys[] = $this->survey;

            $this->report = new Model_ReportProtocols();
            $this->get_excel_protocols($i);
            $excel_protocols[] = $this->report;

            $this->report = new Model_ReportRAIScales();
            $this->get_excel_raiscales($i);
            $excel_raiscales[] = $this->report;
        }

        $this->template = View::factory('test');
        $this->template->headers = $this->excel->getWorksheet(1)->getRecord(1);
        $this->template->surveys = $surveys;
        $this->template->protocols = $protocols;
        $this->template->raiscales = $raiscales;
        $this->template->excel_surveys = $excel_surveys;
        $this->template->excel_protocols = $excel_protocols;
        $this->template->excel_raiscales = $excel_raiscales;
    }

    public function action_test5()
    {
        $surveys   = array();
        $protocols = array();
        $raiscales = array();

        $excel_surveys   = array();
        $excel_protocols = array();
        $excel_raiscales = array();

        $this->excel = new SimpleExcel();
        $this->excel->loadFile('data.csv', 'CSV', array('delimiter' => ';'));
//        echo Debug::vars($this->excel->getWorksheet(1)->getRecord(1));
//        echo Debug::vars($this->excel->getWorksheet(1)->getRecord(2));
//        die();

        for ($i = 176; $i <= 210; $i++) {
            $this->survey = new Model_Survey($i);
            $this->getUnitsData();
            $surveys[] = $this->survey;

            $this->report = new Model_ReportProtocols($i);
            $protocols[] = $this->report;

            $this->report = new Model_ReportRAIScales($i);
            $raiscales[] = $this->report;

            $this->survey = new Model_Survey();
            $this->get_excel_surveys($i);
            $excel_surveys[] = $this->survey;

            $this->report = new Model_ReportProtocols();
            $this->get_excel_protocols($i);
            $excel_protocols[] = $this->report;

            $this->report = new Model_ReportRAIScales();
            $this->get_excel_raiscales($i);
            $excel_raiscales[] = $this->report;
        }

        $this->template = View::factory('test');
        $this->template->headers = $this->excel->getWorksheet(1)->getRecord(1);
        $this->template->surveys = $surveys;
        $this->template->protocols = $protocols;
        $this->template->raiscales = $raiscales;
        $this->template->excel_surveys = $excel_surveys;
        $this->template->excel_protocols = $excel_protocols;
        $this->template->excel_raiscales = $excel_raiscales;
    }

    public function action_test6()
    {
        $surveys   = array();
        $protocols = array();
        $raiscales = array();

        $excel_surveys   = array();
        $excel_protocols = array();
        $excel_raiscales = array();

        $this->excel = new SimpleExcel();
        $this->excel->loadFile('data.csv', 'CSV', array('delimiter' => ';'));
//        echo Debug::vars($this->excel->getWorksheet(1)->getRecord(1));
//        echo Debug::vars($this->excel->getWorksheet(1)->getRecord(2));
//        die();

        for ($i = 211; $i <= 245; $i++) {
            $this->survey = new Model_Survey($i);
            $this->getUnitsData();
            $surveys[] = $this->survey;

            $this->report = new Model_ReportProtocols($i);
            $protocols[] = $this->report;

            $this->report = new Model_ReportRAIScales($i);
            $raiscales[] = $this->report;

            $this->survey = new Model_Survey();
            $this->get_excel_surveys($i);
            $excel_surveys[] = $this->survey;

            $this->report = new Model_ReportProtocols();
            $this->get_excel_protocols($i);
            $excel_protocols[] = $this->report;

            $this->report = new Model_ReportRAIScales();
            $this->get_excel_raiscales($i);
            $excel_raiscales[] = $this->report;
        }

        $this->template = View::factory('test');
        $this->template->headers = $this->excel->getWorksheet(1)->getRecord(1);
        $this->template->surveys = $surveys;
        $this->template->protocols = $protocols;
        $this->template->raiscales = $raiscales;
        $this->template->excel_surveys = $excel_surveys;
        $this->template->excel_protocols = $excel_protocols;
        $this->template->excel_raiscales = $excel_raiscales;
    }

    public function action_test7()
    {
        $surveys   = array();
        $protocols = array();
        $raiscales = array();

        $excel_surveys   = array();
        $excel_protocols = array();
        $excel_raiscales = array();

        $this->excel = new SimpleExcel();
        $this->excel->loadFile('data.csv', 'CSV', array('delimiter' => ';'));
//        echo Debug::vars($this->excel->getWorksheet(1)->getRecord(1));
//        echo Debug::vars($this->excel->getWorksheet(1)->getRecord(2));
//        die();

        for ($i = 246; $i <= 280; $i++) {
            $this->survey = new Model_Survey($i);
            $this->getUnitsData();
            $surveys[] = $this->survey;

            $this->report = new Model_ReportProtocols($i);
            $protocols[] = $this->report;

            $this->report = new Model_ReportRAIScales($i);
            $raiscales[] = $this->report;

            $this->survey = new Model_Survey();
            $this->get_excel_surveys($i);
            $excel_surveys[] = $this->survey;

            $this->report = new Model_ReportProtocols();
            $this->get_excel_protocols($i);
            $excel_protocols[] = $this->report;

            $this->report = new Model_ReportRAIScales();
            $this->get_excel_raiscales($i);
            $excel_raiscales[] = $this->report;
        }

        $this->template = View::factory('test');
        $this->template->headers = $this->excel->getWorksheet(1)->getRecord(1);
        $this->template->surveys = $surveys;
        $this->template->protocols = $protocols;
        $this->template->raiscales = $raiscales;
        $this->template->excel_surveys = $excel_surveys;
        $this->template->excel_protocols = $excel_protocols;
        $this->template->excel_raiscales = $excel_raiscales;
    }

    public function action_test8()
    {
        $surveys   = array();
        $protocols = array();
        $raiscales = array();

        $excel_surveys   = array();
        $excel_protocols = array();
        $excel_raiscales = array();

        $this->excel = new SimpleExcel();
        $this->excel->loadFile('data.csv', 'CSV', array('delimiter' => ';'));
//        echo Debug::vars($this->excel->getWorksheet(1)->getRecord(1));
//        echo Debug::vars($this->excel->getWorksheet(1)->getRecord(2));
//        die();

        for ($i = 281; $i <= 315; $i++) {
            $this->survey = new Model_Survey($i);
            $this->getUnitsData();
            $surveys[] = $this->survey;

            $this->report = new Model_ReportProtocols($i);
            $protocols[] = $this->report;

            $this->report = new Model_ReportRAIScales($i);
            $raiscales[] = $this->report;

            $this->survey = new Model_Survey();
            $this->get_excel_surveys($i);
            $excel_surveys[] = $this->survey;

            $this->report = new Model_ReportProtocols();
            $this->get_excel_protocols($i);
            $excel_protocols[] = $this->report;

            $this->report = new Model_ReportRAIScales();
            $this->get_excel_raiscales($i);
            $excel_raiscales[] = $this->report;
        }

        $this->template = View::factory('test');
        $this->template->headers = $this->excel->getWorksheet(1)->getRecord(1);
        $this->template->surveys = $surveys;
        $this->template->protocols = $protocols;
        $this->template->raiscales = $raiscales;
        $this->template->excel_surveys = $excel_surveys;
        $this->template->excel_protocols = $excel_protocols;
        $this->template->excel_raiscales = $excel_raiscales;
    }

    public function action_test9()
    {
        $surveys   = array();
        $protocols = array();
        $raiscales = array();

        $excel_surveys   = array();
        $excel_protocols = array();
        $excel_raiscales = array();

        $this->excel = new SimpleExcel();
        $this->excel->loadFile('data.csv', 'CSV', array('delimiter' => ';'));
//        echo Debug::vars($this->excel->getWorksheet(1)->getRecord(1));
//        echo Debug::vars($this->excel->getWorksheet(1)->getRecord(2));
//        die();

        for ($i = 316; $i <= 349; $i++) {
            $this->survey = new Model_Survey($i);
            $this->getUnitsData();
            $surveys[] = $this->survey;

            $this->report = new Model_ReportProtocols($i);
            $protocols[] = $this->report;

            $this->report = new Model_ReportRAIScales($i);
            $raiscales[] = $this->report;

            $this->survey = new Model_Survey();
            $this->get_excel_surveys($i);
            $excel_surveys[] = $this->survey;

            $this->report = new Model_ReportProtocols();
            $this->get_excel_protocols($i);
            $excel_protocols[] = $this->report;

            $this->report = new Model_ReportRAIScales();
            $this->get_excel_raiscales($i);
            $excel_raiscales[] = $this->report;
        }

        $this->template = View::factory('test');
        $this->template->headers = $this->excel->getWorksheet(1)->getRecord(1);
        $this->template->surveys = $surveys;
        $this->template->protocols = $protocols;
        $this->template->raiscales = $raiscales;
        $this->template->excel_surveys = $excel_surveys;
        $this->template->excel_protocols = $excel_protocols;
        $this->template->excel_raiscales = $excel_raiscales;
    }

    public function action_testcreate()
    {
        for ($i = 1; $i <= 349; $i++) {
            $this->survey = new Model_Survey($i);
            $this->getUnitsData();

            $this->createRAIScales();
//            echo Debug::vars(
//                'id:   ' . $this->survey->pk,
//                'PURS: ' . $this->report->PURS,
//                'CPS:  ' . $this->report->CPS,
//                'BMI:  ' . $this->report->BMI,
//                'SRD:  ' . $this->report->SRD,
//                'DRS:  ' . $this->report->DRS,
//                'Pain: ' . $this->report->Pain,
//                'COMM: ' . $this->report->COMM,
//                'CHESS:' . $this->report->CHESS,
//                'ADLH: ' . $this->report->ADLH,
//                'ABS:  ' . $this->report->ABS,
//                'ADLLF:' . $this->report->ADLLF
//            );

            $this->createProtocolsReport();
//            echo Debug::vars(
//                'id: ' . $this->survey->pk,
//                'P1: ' . $this->report->P1,
//                'P2: ' . $this->report->P2,
//                'P3: ' . $this->report->P3,
//                'P4: ' . $this->report->P4,
//                'P5: ' . $this->report->P5,
//                'P6: ' . $this->report->P6,
//                'P7: ' . $this->report->P7,
//                'P8: ' . $this->report->P8,
//                'P9: ' . $this->report->P9,
//                'P10:' . $this->report->P10,
//                'P11:' . $this->report->P11,
//                'P12:' . $this->report->P12,
//                'P13:' . $this->report->P13,
//                'P14:' . $this->report->P14,
//                'P15:' . $this->report->P15,
//                'P16:' . $this->report->P16,
//                'P17:' . $this->report->P17,
//                'P18:' . $this->report->P18,
//                'P19:' . $this->report->P19
//            );
        }

        echo Debug::vars('Finish!');
        die();

    }

    public function action_reports()
    {
        $protocols = array();
        $raiscales = array();

        $excel_protocols = array();
        $excel_raiscales = array();

        $this->excel = new SimpleExcel();
        $this->excel->loadFile('data.csv', 'CSV', array('delimiter' => ';'));

        for ($i = 1; $i <= 349; $i++) {
            $this->survey = new Model_Survey($i);
            $this->getUnitsData();

            $this->report = new Model_ReportProtocols();
            $this->createProtocolsReport(false);
            $protocol = $this->report;

            $this->report = new Model_ReportProtocols();
            $this->get_excel_protocols($i);
            $excel_protocol = $this->report;

            $this->report = new Model_ReportRAIScales();
            $this->createRAIScales(false);
            $raiscale = $this->report;

            $this->report = new Model_ReportRAIScales();
            $this->get_excel_raiscales($i);
            $excel_raiscale = $this->report;

            if ( ! ($this->protocolsValid($protocol, $excel_protocol) && $this->raiscalesValid($raiscale, $excel_raiscale) ) ) {
                $protocols[] = $protocol;
                $raiscales[] = $raiscale;
                $excel_protocols[] = $excel_protocol;
                $excel_raiscales[] = $excel_raiscale;
            }
        }

        $this->template = View::factory('test1');
        $this->template->headers = $this->excel->getWorksheet(1)->getRecord(1);

        $this->template->protocols = $protocols;
        $this->template->raiscales = $raiscales;

        $this->template->excel_protocols = $excel_protocols;
        $this->template->excel_raiscales = $excel_raiscales;
    }


    private function protocolsValid($p1, $p2){
        if ($p1->P1 == $p2->P1 && $p1->P2 == $p2->P2 && $p1->P3 == $p2->P3 && $p1->P4 == $p2->P4 && $p1->P5 == $p2->P5 &&
            $p1->P6 == $p2->P6 && $p1->P7 == $p2->P7 && $p1->P8 == $p2->P8 && $p1->P9 == $p2->P9 && $p1->P10 == $p2->P10 &&
            $p1->P11 == $p2->P11 && $p1->P12 == $p2->P12 && $p1->P13 == $p2->P13 && $p1->P14 == $p2->P14 && $p1->P15 == $p2->P15) {

            return true;
        }

        return false;
    }


    private function raiscalesValid($p1, $p2){
        if ($p1->PURS == $p2->PURS && $p1->CPS == $p2->CPS && $p1->BMI == $p2->BMI && $p1->SRD == $p2->SRD &&
            $p1->DRS == $p2->DRS && $p1->Pain == $p2->Pain && $p1->COMM == $p2->COMM && $p1->CHESS == $p2->CHESS &&
            $p1->ADLH == $p2->ADLH && $p1->ABS == $p2->ABS && $p1->ADLLF == $p2->ADLLF) {

            return true;
        }
        return false;
    }


    private function get_excel_surveys($i) {
        $this->survey->unitC = new Model_SurveyUnitC();
        $this->survey->unitC->C1 = $this->excel->getWorksheet(1)->getRecord($i+1)[0]->value;
        $this->survey->unitC->C2 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[1]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[2]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[3]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[4]->value
        );
        $this->survey->unitC->C3 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[5]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[6]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[7]->value
        );
        $this->survey->unitC->C4 = $this->excel->getWorksheet(1)->getRecord($i+1)[8]->value;
        $this->survey->unitC->C5 = $this->excel->getWorksheet(1)->getRecord($i+1)[9]->value;

        $this->survey->unitD = new Model_SurveyUnitD();
        $this->survey->unitD->D1 = $this->excel->getWorksheet(1)->getRecord($i+1)[10]->value;
        $this->survey->unitD->D2 = $this->excel->getWorksheet(1)->getRecord($i+1)[11]->value;
        $this->survey->unitD->D3 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[12]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[13]->value
        );
        $this->survey->unitD->D4 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[14]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[15]->value
        );

        $this->survey->unitE = new Model_SurveyUnitE();
        $this->survey->unitE->E1 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[16]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[17]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[18]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[19]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[20]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[21]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[22]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[23]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[24]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[25]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[26]->value,
        );
        $this->survey->unitE->E2 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[27]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[28]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[29]->value,
        );
        $this->survey->unitE->E3 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[30]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[31]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[32]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[33]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[34]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[35]->value,
        );

        $this->survey->unitF = new Model_SurveyUnitF();
        $this->survey->unitF->F1 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[36]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[37]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[38]->value,
        );
        $this->survey->unitF->F2 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[39]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[40]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[41]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[42]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[43]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[44]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[45]->value,
        );
        $this->survey->unitF->F3 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[46]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[47]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[48]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[49]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[50]->value,
        );
        $this->survey->unitF->F4 = $this->excel->getWorksheet(1)->getRecord($i+1)[51]->value;
        $this->survey->unitF->F5 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[52]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[53]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[54]->value,
        );

        $this->survey->unitG = new Model_SurveyUnitG();
        $this->survey->unitG->G1 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[55]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[56]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[57]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[58]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[59]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[60]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[61]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[62]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[63]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[64]->value,
        );
        $this->survey->unitG->G2 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[65]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[66]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[67]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[68]->value,
        );
        $this->survey->unitG->G3 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[69]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[70]->value,
        );
        $this->survey->unitG->G4 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[71]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[72]->value,
        );
        $this->survey->unitG->G5 = $this->excel->getWorksheet(1)->getRecord($i+1)[73]->value;

        $this->survey->unitH = new Model_SurveyUnitH();
        $this->survey->unitH->H1 = $this->excel->getWorksheet(1)->getRecord($i+1)[74]->value;
        $this->survey->unitH->H2 = $this->excel->getWorksheet(1)->getRecord($i+1)[75]->value;
        $this->survey->unitH->H3 = $this->excel->getWorksheet(1)->getRecord($i+1)[76]->value;
        $this->survey->unitH->H4 = $this->excel->getWorksheet(1)->getRecord($i+1)[77]->value;

        $this->survey->unitI = new Model_SurveyUnitI();
        $this->survey->unitI->I1 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[78]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[79]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[80]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[81]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[82]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[83]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[84]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[85]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[86]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[87]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[88]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[89]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[90]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[91]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[92]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[93]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[94]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[95]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[96]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[97]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[98]->value,
        );

        $this->survey->unitJ = new Model_SurveyUnitJ();
        $this->survey->unitJ->J1 = $this->excel->getWorksheet(1)->getRecord($i+1)[99]->value;
        $this->survey->unitJ->J2 = $this->excel->getWorksheet(1)->getRecord($i+1)[100]->value;
        $this->survey->unitJ->J3 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[101]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[102]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[103]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[104]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[105]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[106]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[107]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[108]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[109]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[110]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[111]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[112]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[113]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[114]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[115]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[116]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[117]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[118]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[119]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[120]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[121]->value,
        );
        $this->survey->unitJ->J4 = $this->excel->getWorksheet(1)->getRecord($i+1)[122]->value;
        $this->survey->unitJ->J5 = $this->excel->getWorksheet(1)->getRecord($i+1)[123]->value;
        $this->survey->unitJ->J6 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[124]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[125]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[126]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[127]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[128]->value,
        );
        $this->survey->unitJ->J7 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[129]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[130]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[131]->value,
        );
        $this->survey->unitJ->J8 = $this->excel->getWorksheet(1)->getRecord($i+1)[132]->value;
        $this->survey->unitJ->J9 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[133]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[134]->value,
        );

        $this->survey->unitK = new Model_SurveyUnitK();
        $this->survey->unitK->K1 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[135]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[136]->value,
        );
        $this->survey->unitK->K2 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[137]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[138]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[139]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[140]->value,
        );
        $this->survey->unitK->K3 = $this->excel->getWorksheet(1)->getRecord($i+1)[141]->value;
        $this->survey->unitK->K4 = $this->excel->getWorksheet(1)->getRecord($i+1)[142]->value;
        $this->survey->unitK->K5 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[143]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[144]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[145]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[146]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[147]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[148]->value,
        );

        $this->survey->unitL = new Model_SurveyUnitL();
        $this->survey->unitL->L1 = $this->excel->getWorksheet(1)->getRecord($i+1)[149]->value;
        $this->survey->unitL->L2 = $this->excel->getWorksheet(1)->getRecord($i+1)[150]->value;
        $this->survey->unitL->L3 = $this->excel->getWorksheet(1)->getRecord($i+1)[151]->value;
        $this->survey->unitL->L4 = $this->excel->getWorksheet(1)->getRecord($i+1)[152]->value;
        $this->survey->unitL->L5 = $this->excel->getWorksheet(1)->getRecord($i+1)[153]->value;
        $this->survey->unitL->L6 = $this->excel->getWorksheet(1)->getRecord($i+1)[154]->value;
        $this->survey->unitL->L7 = $this->excel->getWorksheet(1)->getRecord($i+1)[155]->value;

        $this->survey->unitM = new Model_SurveyUnitM();
        $this->survey->unitM->M1 = $this->excel->getWorksheet(1)->getRecord($i+1)[156]->value;
        $this->survey->unitM->M2 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[157]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[158]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[159]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[160]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[161]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[162]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[163]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[164]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[165]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[166]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[167]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[168]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[169]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[170]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[171]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[172]->value,
        );
        $this->survey->unitM->M3 = $this->excel->getWorksheet(1)->getRecord($i+1)[173]->value;

        $this->survey->unitN = new Model_SurveyUnitN();
        $this->survey->unitN->N2 = $this->excel->getWorksheet(1)->getRecord($i+1)[174]->value;

        $this->survey->unitO = new Model_SurveyUnitO();
        $this->survey->unitO->O1 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[175]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[176]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[177]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[178]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[179]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[180]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[181]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[182]->value,
        );
        $this->survey->unitO->O2 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[183]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[184]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[185]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[186]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[187]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[188]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[189]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[190]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[191]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[192]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[193]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[194]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[195]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[196]->value,
        );
        $this->survey->unitO->O3 = array(
            array(
                $this->excel->getWorksheet(1)->getRecord($i+1)[197]->value,
                $this->excel->getWorksheet(1)->getRecord($i+1)[198]->value,
                $this->excel->getWorksheet(1)->getRecord($i+1)[199]->value,
            ),
            array(
                $this->excel->getWorksheet(1)->getRecord($i+1)[200]->value,
                $this->excel->getWorksheet(1)->getRecord($i+1)[201]->value,
                $this->excel->getWorksheet(1)->getRecord($i+1)[202]->value,
            ),
            array(
                $this->excel->getWorksheet(1)->getRecord($i+1)[203]->value,
                $this->excel->getWorksheet(1)->getRecord($i+1)[204]->value,
                $this->excel->getWorksheet(1)->getRecord($i+1)[205]->value,
            ),
            array(
                $this->excel->getWorksheet(1)->getRecord($i+1)[206]->value,
                $this->excel->getWorksheet(1)->getRecord($i+1)[207]->value,
                $this->excel->getWorksheet(1)->getRecord($i+1)[208]->value,
            ),
            array(
                $this->excel->getWorksheet(1)->getRecord($i+1)[209]->value,
                $this->excel->getWorksheet(1)->getRecord($i+1)[210]->value,
                $this->excel->getWorksheet(1)->getRecord($i+1)[211]->value,
            ),
            array(
                $this->excel->getWorksheet(1)->getRecord($i+1)[212]->value,
                $this->excel->getWorksheet(1)->getRecord($i+1)[213]->value,
                $this->excel->getWorksheet(1)->getRecord($i+1)[214]->value,
            )
        );
        $this->survey->unitO->O4 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[215]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[216]->value,
        );
        $this->survey->unitO->O5 = $this->excel->getWorksheet(1)->getRecord($i+1)[217]->value;
        $this->survey->unitO->O6 = $this->excel->getWorksheet(1)->getRecord($i+1)[218]->value;
        $this->survey->unitO->O7 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[219]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[220]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[221]->value,
        );

        $this->survey->unitP = new Model_SurveyUnitP();
        $this->survey->unitP->P1 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[222]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[223]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[224]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[225]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[226]->value,
        );
        $this->survey->unitP->P2 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[227]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[228]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[229]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[230]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[231]->value,
        );

        $this->survey->unitQ = new Model_SurveyUnitQ();
        $this->survey->unitQ->Q1 = array(
            $this->excel->getWorksheet(1)->getRecord($i+1)[232]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[233]->value,
            $this->excel->getWorksheet(1)->getRecord($i+1)[234]->value,
        );
        $this->survey->unitQ->Q2 = $this->excel->getWorksheet(1)->getRecord($i+1)[235]->value;

    }

    private function get_excel_protocols($i) {
        $this->report->P1 = $this->excel->getWorksheet(1)->getRecord($i+1)[247]->value;
        $this->report->P2 = $this->excel->getWorksheet(1)->getRecord($i+1)[248]->value;
        $this->report->P3 = $this->excel->getWorksheet(1)->getRecord($i+1)[249]->value;
        $this->report->P4 = $this->excel->getWorksheet(1)->getRecord($i+1)[250]->value;
        $this->report->P5 = $this->excel->getWorksheet(1)->getRecord($i+1)[251]->value;
        $this->report->P6 = $this->excel->getWorksheet(1)->getRecord($i+1)[252]->value;
        $this->report->P7 = $this->excel->getWorksheet(1)->getRecord($i+1)[253]->value;
        $this->report->P8 = $this->excel->getWorksheet(1)->getRecord($i+1)[254]->value;
        $this->report->P9 = $this->excel->getWorksheet(1)->getRecord($i+1)[255]->value;
        $this->report->P10 = $this->excel->getWorksheet(1)->getRecord($i+1)[256]->value;
        $this->report->P11 = $this->excel->getWorksheet(1)->getRecord($i+1)[257]->value;
        $this->report->P12 = $this->excel->getWorksheet(1)->getRecord($i+1)[258]->value;
        $this->report->P13 = $this->excel->getWorksheet(1)->getRecord($i+1)[259]->value;
        $this->report->P14 = $this->excel->getWorksheet(1)->getRecord($i+1)[260]->value;
        $this->report->P15 = $this->excel->getWorksheet(1)->getRecord($i+1)[261]->value;
    }

    private function get_excel_raiscales($i) {
        $this->report->PURS     = $this->excel->getWorksheet(1)->getRecord($i+1)[236]->value;
        $this->report->CPS      = $this->excel->getWorksheet(1)->getRecord($i+1)[237]->value;
        $this->report->BMI      = number_format(floatval(str_replace(',','.', $this->excel->getWorksheet(1)->getRecord($i+1)[238]->value)),2);
        $this->report->SRD      = $this->excel->getWorksheet(1)->getRecord($i+1)[239]->value;
        $this->report->DRS      = $this->excel->getWorksheet(1)->getRecord($i+1)[240]->value;
        $this->report->Pain     = $this->excel->getWorksheet(1)->getRecord($i+1)[241]->value;
        $this->report->COMM     = $this->excel->getWorksheet(1)->getRecord($i+1)[242]->value;
        $this->report->CHESS    = $this->excel->getWorksheet(1)->getRecord($i+1)[243]->value;
        $this->report->ADLH     = $this->excel->getWorksheet(1)->getRecord($i+1)[244]->value;
        $this->report->ABS      = $this->excel->getWorksheet(1)->getRecord($i+1)[245]->value;
        $this->report->ADLLF    = $this->excel->getWorksheet(1)->getRecord($i+1)[246]->value;
    }



    /**
     * Create Protocols Report
     */
    private function createProtocolsReport($save = true)
    {
        $C3 = $this->survey->unitC->C3;
        $E1 = $this->survey->unitE->E1;
        $E3 = $this->survey->unitE->E3;
        $F2 = $this->survey->unitF->F2;
        $G1 = $this->survey->unitG->G1;
        $G3 = $this->survey->unitG->G3;
        $G4 = $this->survey->unitG->G4;
        $I1 = $this->survey->unitI->I1;
        $J3 = $this->survey->unitJ->J3;
        $J6 = $this->survey->unitJ->J6;
        $J9 = $this->survey->unitJ->J9;
        $K2 = $this->survey->unitK->K2;
        $O1 = $this->survey->unitO->O1;
        $O7 = $this->survey->unitO->O7;

        $this->report = new Model_ReportProtocols();

        $this->report->pk = $this->survey->pk;
        $this->report->id = $this->survey->id;
        $this->report->pension = $this->survey->pension;

        // Behaviour - проблемное поведение
        $P1 = 0;
        if ($this->survey->unitC->C1 != 5) {
            foreach ($this->survey->unitE->E3 as $item) { if ($item == 3) { $P1 = 2; } elseif ($item == 2 && $P1 < 2) { $P1 = 1; } }
        } else {
            $P1 = -1;
        }
        $this->report->P1 = $P1;

        // Communication - Коммуникация
        /*if ($this->survey->unitC->C1 == 5) {
            $P2 = -1;
        } elseif ($this->survey->unitC->C1 < 2 && $this->survey->unitD->D1 <= 2 || $this->survey->unitD->D2 <= 2) {
            // 0 || 1

            if ($this->survey->unitC->C1 == 1 && ($this->survey->unitD->D1 >= 1 || $this->survey->unitD->D2 >= 1) ||
                ($this->survey->unitC->C1 == 0 && $this->survey->unitD->D1 == 1 && $this->survey->unitD->D2 == 1)) {
                $P2 = 1;
            } else {
                $P2 = 0;
            }

        } else {

            // 0 || 1 || 2

            if ($this->survey->unitD->D1 == 0 || $this->survey->unitD->D2 == 0) {
                $P2 = 0;
            } else {
                $P2 = 1;
            }

            $P2 = ($this->survey->unitC->C1 == 2 && $this->survey->unitD->D1 <= 2 && $this->survey->unitD->D2 <= 2) ? 2 :
                (($this->survey->unitC->C1 <= 3 && $this->survey->unitD->D1 >= 1 && $this->survey->unitD->D2 >= 1) ? 1 : 0);
        }*/
        if ($this->survey->unitC->C1 != 5) {
            $P2 = ($this->survey->unitC->C1 >= 3 && $this->survey->unitD->D1 < 3 && $this->survey->unitD->D2 < 3) ? 2 :
                (($this->survey->unitC->C1 < 3 && $this->survey->unitD->D1 >=2 && $this->survey->unitD->D2 >= 2) ? 1 : 0);
        } else {
            $P2 = -1;
        }
        //echo Debug::vars($this->survey->unitC->C1,$this->survey->unitD->D1,$this->survey->unitD->D2,$P2); die();
        $this->report->P2 = $P2;

        // Delirium - деменция
        if ($this->survey->unitC->C1 != 5) {
            $P3 = $this->survey->unitC->C4 == 1 ? 1 : 0;
            if ($P3 == 0) { foreach ($this->survey->unitC->C3 as $item) { if ($item == 2) { $P3 = 1; break; } } }
        } else {
            $P3 = -1;
        }

        $this->report->P3 = $P3;

        // Mood - Настроение
        $P4 = $this->getDRS();
        $this->report->P4 = $P4 >= 3 ? 2 : (($P4 == 1 || $P4 == 2) ? 1 : 0);

        // Cardio-respiratory - Сердечно-дыхательная недостаточность
        $P5 = ($J3[2] >= 2 || $J3[4] >= 2 || $this->survey->unitJ->J4 >= 2 || $I1[10] >= 2 || $I1[11] >= 2 || $I1[12] >= 2) ? 1 : 0;
        $this->report->P5 = $P5;

        // Dehydration - Дегидратация
        $P6 = $K2[1] == 1 ? (($K2[0] == 1 || $J3[2] >= 2 || $J3[8] >= 2 || $J3[12] >= 2 || $J3[13] >= 2 || $J3[17] >= 2) ? 2 : 1) : 0;
        $this->report->P6 = $P6;

        // Falls - Падения
        $P7 = $this->survey->unitJ->J1 == 3 ? 2 : ($this->survey->unitJ->J1 == 0 ? 0 : 1);
        $this->report->P7 = $P7;

        // Feeding Tube - Питательная трубка
        $P8 = ($this->survey->unitK->K3 < 5 || $this->survey->unitK->K3 == 9) ? 0 : (($this->survey->unitC->C1 >= 0 && $this->survey->unitC->C1 <=3) ? 2 : 1);
        $this->report->P8 = $P8;

        // Nutrition - Питание
        $P9 = $this->getBMI() < 19 ? 2 : $this->getBMI() > 21 ? 0 : 1;
        $this->report->P9 = $P9;

        // Pain - Повреждения
        $P10 = ($J6[1] == 3 || $J6[1] == 4) ? 2 : (($J6[1] == 1 || $J6[1] == 2) && $J6[0] == 3) ? 1 : 0;
        $this->report->P10 = $P10;

        // Smoking and Drinking
        $P11 = ($J9[0] >= 1 || $J9[1] == 3) ? 1 : 0;
        $this->report->P11 = $P11;

        // Pressure Ulcer - Тяжелые пролежни
        $ADLH = $this->getADLH();
        if ( $this->survey->unitC->C1 == 5 ) {
            $P12 = 3;
        } else {

            $P12 = $this->survey->unitL->L1 >= 2 ? 1 :
                ($this->survey->unitL->L1 == 1 ? 2 :
                    (($this->getADLH() == 5 || $this->getADLH() == 6) && ($this->survey->unitL->L2 == 1 ||
                        $this->survey->unitL->L3 == 1 || $this->survey->unitL->L4 == 1 || $this->survey->unitL->L5 == 1
                        /*|| $this->survey->unitL->L6 == 1*/) ? 3 : 0));
        }
        $this->report->P12 = $P12;

        // Urinary Incontinence - Недержание мочи
        $P13 = ($this->getCPS() >= 5) ? 0 :
            (($this->survey->unitH->H1 >= 2 && $this->getCPS() <= 3 &&
                ($this->survey->unitO->O2[8] == 0 || $this->survey->unitI->I1[0] >= 1 ||
                    $this->survey->unitG->G5 == 2 || $this->survey->unitH->H2 == 2 ||
                    $this->survey->unitI->I1[17] >= 1 || $this->survey->unitJ->J3[12] >= 1)) ? 2 :
                (($this->survey->unitH->H1 >= 2 && $this->survey->unitC->C1 < 2 && $this->getADLH() < 6 &&
                    $this->survey->unitG->G1[5] < 4 && ($this->survey->unitO->O2[8] == 0 || $this->survey->unitI->I1[0] >= 1 ||
                        $this->survey->unitG->G5 == 2 || $this->survey->unitH->H2 == 2 || $this->survey->unitI->I1[17] >= 1 ||
                        $this->survey->unitJ->J3[12] >= 1)) ? 3 : 1));
        //echo Debug::vars($this->survey->unitL, $this->getADLH(),$this->survey->unitC->C1 , $P12); die();
        $this->report->P13 = $P13;

        // Physical restraint - Физическая сдержанность
        $P14 = (($O7[0] > 0 || $O7[1] > 0 || $O7[2] > 0) && $this->getADLH() <= 3) ? 2 :
            ((($O7[0] > 0 || $O7[1] > 0 || $O7[2] > 0) && ($this->getADLH() > 3)) ? 1 : 0);
        $this->report->P14 = $P14;

        // Activities - Активность
        if ($this->survey->unitC->C1 != 5) {
            $P15count = 0;
            if ($E1[8] > 0) $P15count++;
            if ($E1[9] > 0 ) $P15count++;
            if ($F2[0] == 0 ) $P15count++;
            if ($F2[1] == 0) $P15count++;
            $P15 = ($this->survey->unitM->M1 < 3 && $this->survey->unitC->C1 <= 3 && $P15count >= 2) ? 1 : 0;
        } else {
            $P15 = -1;
        }

        $this->report->P15 = $P15;

        // Physical Activities Promotion
        // TODO про тот триггер оставь звездочку что там могут быть еще условия потом
        $P16 = $G3[0] <= 2 && ($G1[5] < 3 || $G4[0] == 1 || $G4[1] == 1) ? 1 : 0;
        $this->report->P16 = $P16;

        // Prevention
        $P17check = ($O1[0] == 0 || $O1[1] == 0 || $O1[2] == 0 || $O1[3] == 0 || $O1[4] == 0 || $O1[5] == 0 || $O1[6] == 0 || $O1[7] == 0) ? true : false;
        $P17 = ($this->survey->unitO->O5 < 7 && $P17check) ? 2 : (($this->survey->unitO->O5 > 7 && $P17check) ? 1 : 0);
        $this->report->P17 = $P17;

        // Cognitive Loss
        if ($this->survey->unitC->C1 != 5) {
            $P18count = 0;
            if ($I1[2] >= 2) $P18count++;
            if ($I1[3] >= 2) $P18count++;
            if ($this->survey->unitD->D1 == 4) $P18count++;
            if ($this->survey->unitD->D2 == 4) $P18count++;
            if ($E1[3] >= 2) $P18count++;
            if ($E1[4] >= 2) $P18count++;
            if ($E1[7] >= 2) $P18count++;
            if ($E3[0] >= 2) $P18count++;
            if ($E3[2] >= 2) $P18count++;
            if ($C3[0] == 2) $P18count++;
            if ($C3[1] == 2) $P18count++;
            if ($C3[2] == 2) $P18count++;
            if ($this->survey->unitC->C4 == 1) $P18count++;
            if ($this->survey->unitC->C5 == 2) $P18count++;

            $P18 = $this->getCPS() <= 2 ? ($P18count >= 2 ? 2 : ($P18count == 1 ? 1 : 0)) : 0;
        } else {
            $P18 = -1;
        }

        $this->report->P18 = $P18;

        // Appropriate Medications
        // TODO do it in future
        $P19 = 0;
        $this->report->P19 = $P19;

        if ($save == true)
            $this->report->save();
    }

    /**
     * Create RAI Scales Report
     */
    private function createRAIScales($save = true)
    {
        $this->report = new Model_ReportRAIScales();

        $this->report->pk = $this->survey->pk;
        $this->report->id = $this->survey->id;
        $this->report->pension = $this->survey->pension;

        $this->report->PURS = $this->getPURS();
        $this->report->CPS = $this->getCPS();
        $this->report->BMI = $this->getBMI();
        $this->report->SRD = $this->getSRD();
        $this->report->DRS = $this->getDRS();
        $this->report->Pain = $this->getPain();
        $this->report->COMM = $this->getCOMM();
        $this->report->CHESS = $this->getCHESS();
        $this->report->ADLH = $this->getADLH();
        $this->report->ABS = $this->getABS();
        $this->report->ADLLF = $this->getADLLF();

        if ($save == true)
            $this->report->save();
    }

    // Get All Units Data
    private function getUnitsData()
    {
        $this->survey->unitC = new Model_SurveyUnitC($this->survey->unitC);
        $this->survey->unitC->C2 = json_decode($this->survey->unitC->C2);
        $this->survey->unitC->C3 = json_decode($this->survey->unitC->C3);

        $this->survey->unitD = new Model_SurveyUnitD($this->survey->unitD);
        $this->survey->unitD->D3 = json_decode($this->survey->unitD->D3);
        $this->survey->unitD->D4 = json_decode($this->survey->unitD->D4);

        $this->survey->unitE = new Model_SurveyUnitE($this->survey->unitE);
        $this->survey->unitE->E1 = json_decode($this->survey->unitE->E1);
        $this->survey->unitE->E2 = json_decode($this->survey->unitE->E2);
        $this->survey->unitE->E3 = json_decode($this->survey->unitE->E3);

        $this->survey->unitF = new Model_SurveyUnitF($this->survey->unitF);
        $this->survey->unitF->F1 = json_decode($this->survey->unitF->F1);
        $this->survey->unitF->F2 = json_decode($this->survey->unitF->F2);
        $this->survey->unitF->F3 = json_decode($this->survey->unitF->F3);
        $this->survey->unitF->F5 = json_decode($this->survey->unitF->F5);

        $this->survey->unitG = new Model_SurveyUnitG($this->survey->unitG);
        $this->survey->unitG->G1 = json_decode($this->survey->unitG->G1);
        $this->survey->unitG->G2 = json_decode($this->survey->unitG->G2);
        $this->survey->unitG->G3 = json_decode($this->survey->unitG->G3);
        $this->survey->unitG->G4 = json_decode($this->survey->unitG->G4);

        $this->survey->unitH = new Model_SurveyUnitH($this->survey->unitH);

        $this->survey->unitI = new Model_SurveyUnitI($this->survey->unitI);
        $this->survey->unitI->I1 = json_decode($this->survey->unitI->I1);

        $this->survey->unitJ = new Model_SurveyUnitJ($this->survey->unitJ);
        $this->survey->unitJ->J3 = json_decode($this->survey->unitJ->J3);
        $this->survey->unitJ->J6 = json_decode($this->survey->unitJ->J6);
        $this->survey->unitJ->J7 = json_decode($this->survey->unitJ->J7);
        $this->survey->unitJ->J9 = json_decode($this->survey->unitJ->J9);

        $this->survey->unitK = new Model_SurveyUnitK($this->survey->unitK);
        $this->survey->unitK->K1 = json_decode($this->survey->unitK->K1);
        $this->survey->unitK->K2 = json_decode($this->survey->unitK->K2);
        $this->survey->unitK->K5 = json_decode($this->survey->unitK->K5);

        $this->survey->unitL = new Model_SurveyUnitL($this->survey->unitL);

        $this->survey->unitM = new Model_SurveyUnitM($this->survey->unitM);
        $this->survey->unitM->M2 = json_decode($this->survey->unitM->M2);

        $this->survey->unitN = new Model_SurveyUnitN($this->survey->unitN);

        $this->survey->unitO = new Model_SurveyUnitO($this->survey->unitO);
        $this->survey->unitO->O1 = json_decode($this->survey->unitO->O1);
        $this->survey->unitO->O2 = json_decode($this->survey->unitO->O2);
        $this->survey->unitO->O3 = json_decode($this->survey->unitO->O3);
        $this->survey->unitO->O4 = json_decode($this->survey->unitO->O4);
        $this->survey->unitO->O7 = json_decode($this->survey->unitO->O7);

        $this->survey->unitP = new Model_SurveyUnitP($this->survey->unitP);
        $this->survey->unitP->P1 = json_decode($this->survey->unitP->P1);
        $this->survey->unitP->P2 = json_decode($this->survey->unitP->P2);

        $this->survey->unitQ = new Model_SurveyUnitQ($this->survey->unitQ);
        $this->survey->unitQ->Q1 = json_decode($this->survey->unitQ->Q1);
    }

    // Pressure Ulcer Risk Scale
    private function getPURS()
    {
        $G1 = $this->survey->unitG->G1;
        $K2 = $this->survey->unitK->K2;

        $J6 = $this->survey->unitJ->J6;
        $purs = 0;
        if ( $G1[8] > 3 ) $purs++;
        if ( $G1[4] > 3 ) $purs++;
        if ( $this->survey->unitH->H3 > 2 ) $purs++;
        if ( $K2[0] == 1 ) $purs++;
        if ( $J6[0] == 3 ) $purs++;
        if ( $this->survey->unitL->L2 == 1 ) $purs = $purs + 2;
        if ( $this->survey->unitJ->J4 >= 2 ) $purs++;

        return $purs;
    }

    // Cognitive Performance Scale
    private function getCPS()
    {
        switch ($this->survey->unitC->C1) {
            case 5:
                return 6;
                break;
            case 4:
                $G1j = $this->survey->unitG->G1[9];
                if ($G1j == 6 || $G1j == 8) return 6;
                else return 5;
                break;
            default:
                // Impairment Count
                $imp_count = 0;
                if ($this->survey->unitC->C1 > 0) $imp_count++;
                if ($this->survey->unitC->C2[0] == 1) $imp_count++;
                if ($this->survey->unitD->D1 > 0) $imp_count++;
                switch ($imp_count) {
                    case 0: return 0; break;
                    case 1: return 1; break;
                    default:
                        // Severe Impairment Count
                        $sev_imp_count = 0;
                        if ($this->survey->unitC->C1 == 3) $sev_imp_count++;
                        if ($this->survey->unitD->D1 >= 3) $sev_imp_count++;
                        switch ($sev_imp_count) {
                            case 0: return 2; break;
                            case 1: return 3; break;
                            case 2: return 4; break;
                        }
                        break;
                }
                break;
        }
    }

    // Body Mass Index
    private function getBMI()
    {
        $K1 = $this->survey->unitK->K1;
        return number_format ($K1[1] / ($K1[0] * $K1[0]) * 10000, 2);
    }

    // Self Rated Depression
    private function getSRD()
    {
        $C1 = $this->survey->unitC->C1;
        $E2 = $this->survey->unitE->E2;

        if ($E2[0] == 8 || $E2[1] == 8 || $E2[2] == 8 || $C1 == 5)
            return -1;
        else
            return $E2[0] + $E2[1] + $E2[2];
    }

    // Depression Rating Scale
    private function getDRS()
    {
        if ($this->survey->unitC->C1 == 5)
            return -1;

        $E1 = $this->survey->unitE->E1;
        $drs = 0;
        $drs += $E1[0] == 0 ? 0 : (($E1[0] == 1 || $E1[0] == 2) ? 1 : 2);
        $drs += $E1[1] == 0 ? 0 : (($E1[1] == 1 || $E1[1] == 2) ? 1 : 2);
        $drs += $E1[2] == 0 ? 0 : (($E1[2] == 1 || $E1[2] == 2) ? 1 : 2);
        $drs += $E1[3] == 0 ? 0 : (($E1[3] == 1 || $E1[3] == 2) ? 1 : 2);
        $drs += $E1[4] == 0 ? 0 : (($E1[4] == 1 || $E1[4] == 2) ? 1 : 2);
        $drs += $E1[5] == 0 ? 0 : (($E1[5] == 1 || $E1[5] == 2) ? 1 : 2);
        $drs += $E1[6] == 0 ? 0 : (($E1[6] == 1 || $E1[6] == 2) ? 1 : 2);
        return $drs;
    }

    // Pain Scale
    private function getPain()
    {
        $J6 = $this->survey->unitJ->J6;

        if ($J6[0] == 3) {
            if ($J6[1] >= 3) return 3;
            return 2;
        }

        if ($J6[0] > 0) return 1;
//        if ($J6[0] > 0 || $J6[1] > 0) return 1; // согласно протоколу
        return 0;
    }

    // Communication Scale
    private function getCOMM()
    {
        if ($this->survey->unitC->C1 == 5)
            return -1;

        return $this->survey->unitD->D1 + $this->survey->unitD->D2;
    }

    // Changes in Health, End-Stage Disease, Signs, and Symptoms Scale
    private function getCHESS()
    {
        if ( ($this->survey->unitC->C5 == 8 && $this->survey->unitG->G5 == 8) ||
            ($this->survey->unitC->C5 <=2 && $this->survey->unitG->G5 == 8) ) {

            return -1;

        } else {

            $J3 = $this->survey->unitJ->J3;
            $J7 = $this->survey->unitJ->J7;
            $K2 = $this->survey->unitK->K2;

            $CHESS = 0;
            $count = 0;

            if ( $this->survey->unitC->C5 == 2 ) $CHESS++;
            if ( $this->survey->unitG->G5 == 2 ) $CHESS++;
            if ( $J7[2] == 1 ) $CHESS++;

            if ($count <= 2 &&$K2[1] == 1 && $K2[3] == 1) $count++;
            if ($count <= 2 &&$K2[0] == 1) $count++;
            if ($count <= 2 &&$K2[2] == 1) $count++;
            // может оказаться что J4>1
            if ($count <= 2 &&$this->survey->unitJ->J4 != 0) $count++;
            if ($count <= 2 &&$J3[13] == 2) $count++;
            if ($count <= 2 &&$J3[20] == 2) $count++;

            return $CHESS + $count ;
        }

    }

    // Activities of Daily Living (Hierarchy)
    private function getADLH()
    {
        //Personal hygiene  $this->survey->unitG->G1[1] => G1b
        //Toilet use        $this->survey->unitG->G1[7] => G1h
        //Locomotion        $this->survey->unitG->G1[5] => G1f
        //Eating            $this->survey->unitG->G1[9] => G1j
        $G1 =  $this->survey->unitG->G1;
        return  ($G1[1] >= 6 && $G1[5] >= 6 && $G1[7] >= 6 && $G1[9] >= 6) ? 6 :
            (($G1[9] >= 6 || $G1[5] >= 6) ? 5 :
                ((($G1[9] < 6 && $G1[5] < 6) && ($G1[9] == 4 || $G1[5] == 4)) ? 4 :
                    ((($G1[1] == 4 || $G1[7] == 4) && ($G1[9] < 4 && $G1[5] < 4)) ? 3 :
                        ((($G1[1] < 4 && $G1[7] < 4 && $G1[9] < 4 && $G1[5] < 4) && ($G1[1] == 3 || $G1[7] == 3 || $G1[9] == 3 || $G1[5] == 3)) ? 2 :
                            ((($G1[1] < 3 && $G1[7] < 3 && $G1[9] < 3 && $G1[5] < 3) && ($G1[1] == 2 || $G1[7] == 2 || $G1[9] == 2 || $G1[5] == 2)) ? 1 : 0)))));
    }

    // Aggressive Behaviour Scale
    private function getABS()
    {
        $E3 =  $this->survey->unitE->E3;
        return $E3[1] + $E3[2] + $E3[3] + $E3[5];
    }

    // Activities of Daily Living (Long Form)
    private function getADLLF()
    {
        $G1 =  $this->survey->unitG->G1;
        $ADLLF = 0;
        $ADLLF += ($G1[1] == 0 || $G1[1] == 1) ? 0 : ($G1[1] == 2 ? 1 : ($G1[1] == 3 ? 2 : ($G1[1] == 4 ? 3 : 4)));
        $ADLLF += ($G1[2] == 0 || $G1[2] == 1) ? 0 : ($G1[2] == 2 ? 1 : ($G1[2] == 3 ? 2 : ($G1[2] == 4 ? 3 : 4)));
        $ADLLF += ($G1[3] == 0 || $G1[3] == 1) ? 0 : ($G1[3] == 2 ? 1 : ($G1[3] == 3 ? 2 : ($G1[3] == 4 ? 3 : 4)));
        $ADLLF += ($G1[5] == 0 || $G1[5] == 1) ? 0 : ($G1[5] == 2 ? 1 : ($G1[5] == 3 ? 2 : ($G1[5] == 4 ? 3 : 4)));
        $ADLLF += ($G1[7] == 0 || $G1[7] == 1) ? 0 : ($G1[7] == 2 ? 1 : ($G1[7] == 3 ? 2 : ($G1[7] == 4 ? 3 : 4)));
        $ADLLF += ($G1[8] == 0 || $G1[8] == 1) ? 0 : ($G1[8] == 2 ? 1 : ($G1[8] == 3 ? 2 : ($G1[8] == 4 ? 3 : 4)));
        $ADLLF += ($G1[9] == 0 || $G1[9] == 1) ? 0 : ($G1[9] == 2 ? 1 : ($G1[9] == 3 ? 2 : ($G1[9] == 4 ? 3 : 4)));
        return $ADLLF;
    }

}
