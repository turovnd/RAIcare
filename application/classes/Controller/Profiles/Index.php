<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Profiles_Index
 *
 * @copyright RAIcare
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Profiles_Index extends Dispatch
{
    public $template = 'main';

    /** Organization */
    protected $organization = null;

    public function before()
    {
        parent::before();

        $org_uri = Request::$subdomain;

        $this->organization = Model_Organization::getByFieldName('uri', $org_uri);

        if (!$this->organization->id && !in_array($org_uri, self::PRIVATE_SUBDOMIANS)) {
            throw new HTTP_Exception_404();
        }

        if (!self::isLogged()) self::gotoLoginPage();

        $this->organization = Model_Organization::getByFieldName('uri', $org_uri);

        if (in_array($this->user->role,self::ORG_AVAILABLE_ROLES) || $this->user->role == self::ROLE_ORG_CREATOR) {
            $this->organization->pensions = Model_Pension::getByOrganizationID($this->organization->id, true);
        } else {
            $this->organization->pensions = Model_UserPension::getPensions($this->user->id, true);
        }

        if ($this->user->organization != $this->organization->id && !($this->user->role == 1 || $this->user->role == 2)) {
            throw new HTTP_Exception_403;
        }

        $data = array(
            'aside_type'=> 'profile',
            'pensions'  => $this->organization->pensions,
            'action'    => 'profile',
        );

        $this->template->aside = View::factory('global-blocks/aside', $data);

    }

    public function action_profile()
    {
        $profile = new Model_User($this->user->id);

        $profile->role = new Model_Role($profile->role);
        $profile->can_edit = true;

        $this->template->title = "Профиль " . $profile->name;
        $this->template->section = View::factory('profiles/pages/profile')
            ->set('profile', $profile);
    }

}