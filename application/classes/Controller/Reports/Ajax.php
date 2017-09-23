<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Reports_Ajax
 *
 * @copyright RAIcare
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Reports_Ajax extends Ajax
{

    public function action_getScale()
    {
        $name = Arr::get($_POST,'name');

        $available_names = array('ABS','ADLH','BMI','CHESS','COMM','CPS','DRS','Pain','PURS');

        if (in_array($name, $available_names)) {
            $html = View::factory('reports/scales/' . $name)->render();
            $response = new Model_Response_Reports('REPORT_GET_SUCCESS', 'success', array('html' => $html));
        } else {
            $response = new Model_Response_Reports('REPORT_IS_NOT_AVAILABLE_ERROR', 'error');
        }
        $this->response->body(@json_encode($response->get_response()));
    }


    public function action_getCAP()
    {
        $name = Arr::get($_POST,'name');

        $available_names = array('activities','appropriate-medications','behaviour','cardiorespiratory',
            'cognitive-loss','communication','dehydrodation','delirium','falls','feeding-tube','mood',
            'pain','physical-activities-promotion','physical-restraint','pressure-ulcer','prevention',
            'smoking-drinking','undernutrition','urinary-incontinence');

        if (in_array($name, $available_names)) {
            $title = View::factory('reports/caps/' . $name . '/title')->render();
            $html  = View::factory('reports/caps/' . $name . '/guidelines')->render();
            $response = new Model_Response_Reports('REPORT_GET_SUCCESS', 'success', array('html' => $html, 'title' => $title));
        } else {
            $response = new Model_Response_Reports('REPORT_IS_NOT_AVAILABLE_ERROR', 'error');
        }
        $this->response->body(@json_encode($response->get_response()));
    }

}