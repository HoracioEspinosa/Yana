<?php

/** @noinspection SpellCheckingInspection */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property IUserService $userservice
 * @property IUserModel $user_model
 * @property CI_Output $output
 */
class User extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('userservice', array($this->user_model));
    }

    public function index()
    {
        $users = $this->userservice->getAll();

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array(
                'code' => 200,
                'payload' => $users
            )))
            ->_display();
    }
    
    public function get($id)
    {
        $user = $this->userservice->getById($id);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array(
                'code' => 200,
                'payload' => $user
            )))
            ->_display();
    }

    public function create()
    {
        $id = $this->userservice->create($this->getRawParameters());
        
        if (!$id) {
            $this->output
                ->set_status_header(422, 'Bad request')
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'code' => 422,
                    'message' => 'Error on create user',
                )))->_display();
        }
        
        $this->get($id);
    }

    public function update($id)
    {
        $this->userservice->update($id, $this->getRawParameters());

        $this->get($id);
    }

    public function delete($id)
    {
        $this->userservice->delete($id);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array(
                'code' => 200,
                'payload' => array()
            )))
            ->_display();
    }
}