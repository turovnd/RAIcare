<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_StaticFromDB
 *
 * @copyright RAIcare
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_StaticFromDB extends Dispatch
{

    function before() {
        $this->auto_render = false;
        parent::before();
    }

    /**
     * Get JSON data from Table `MKB10`
     */
    public function action_MKB_get()
    {
        $name = $this->request->query('name');
        $items = Model_MKB10::searchByName($name);
        $this->response->body(@json_encode($items));
    }

}
