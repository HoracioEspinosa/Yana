<?php 
    
/** @noinspection PhpUnused */
/** @noinspection SpellCheckingInspection */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property IUserActivityService $useractivityservice
 * @property IUserActivityModel $user_activity_model
 * @property CI_Output $output
 */
class UserActivity extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('useractivityservice', array($this->user_activity_model));
    }

    public function index()
    {
        $userActivities = $this->useractivityservice->getAll();

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array(
                'code' => 200,
                'payload' => $userActivities
            )))
            ->_display();
    }
    
    public function get($id)
    {
        $userActivity = $this->useractivityservice->getById($id);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array(
                'code' => 200,
                'payload' => $userActivity
            )))
            ->_display();
    }

    public function create()
    {
        $id = $this->useractivityservice->create($this->getRawParameters());
        $this->get($id);
    }

    public function update($id)
    {
        $id = $this->useractivityservice->update($id, $this->getRawParameters());
        $this->get($id);
    }

    public function delete($id)
    {
        $this->useractivityservice->delete($id);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array(
                'code' => 200,
                'payload' => array()
            )))
            ->_display();
    }

    public function activities($uid)
    {
        $userActivities = $this->useractivityservice->getByUId($uid);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array(
                'code' => 200,
                'payload' => $userActivities
            )))
            ->_display();
    }

    public function activitiesById($uid, $id)
    {
        $userActivities = $this->useractivityservice->getByUIdAndId($uid, $id);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array(
                'code' => 200,
                'payload' => $userActivities
            )))
            ->_display();
    }
}