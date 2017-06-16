<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Profiles_Index
 *
 * @copyright raisoft
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Profiles_Index extends Dispatch
{
    CONST MODULE_USERS       = 10;
    CONST WATCH_CERTAIN_USER = 11;

    public $template = 'main';

    public function before()
    {
        parent::before();

        if (!self::isLogged()) {
            $this->redirect('login');
        }

        $data = array(
            'action'    => $this->request->action(),
        );

        $this->template->aside = View::factory('global_blocks/aside', $data);

    }

    public function action_users()
    {
        self::hasAccess(self::MODULE_USERS);

        $profiles = Model_User::getAll();

        if (!empty($profiles)) {
            foreach ($profiles as $profile) {
                $profile->role = new Model_Role($profile->role);
                $profile->creator = new Model_User($profile->creator);
            }
        }

        $this->template->title = "Пользователи";
        $this->template->section = View::factory('profiles/pages/all-profiles')
                ->set('profiles', $profiles);

    }

    public function action_profile()
    {
        $id = $this->request->param('id');

        if ($id) {

            self::hasAccess(self::WATCH_CERTAIN_USER);
            $profile = new Model_User($id);

            if (!$profile->id) {
                throw new HTTP_Exception_404;
            }
            $profile->role = new Model_Role($profile->role);
            $permissions = array();
            foreach (json_decode($profile->role->permissions) as $permission) {
                $permissions[] = new Model_Permission($permission);
            }
            $profile->role->permissions = $permissions;
            $profile->can_edit = false;
            $profile->additional_info = true;
            $profile->client = Model_Client::getByUserId($profile->id);

        } else {

            $profile = new Model_User($this->user->id);
            $profile->role = new Model_Role($profile->role);
            $profile->can_edit = true;
            $profile->additional_info = false;

        }

        $this->template->title = "Профиль " . $profile->name;
        $this->template->section = View::factory('profiles/pages/profile')
            ->set('profile', $profile);
    }

}