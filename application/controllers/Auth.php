<?php

/** @noinspection PhpUnused */
/** @noinspection PhpIncludeInspection */
/** @noinspection SpellCheckingInspection */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property IAuthService $authservice
 * @property IUserModel $user_model
 * @property CI_Output $output
 */
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('authservice', array($this->user_model));
    }

    public function login()
    {
        $parameters = $this->getRawParameters();
        
        if (!(property_exists($parameters, 'email') && property_exists($parameters, 'password'))) {
            return $this->output
                ->set_status_header(422, 'Bad request')
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'code' => 422,
                    'message' => 'Invalid parameters',
                )));
        }

        $result = $this->authservice->login($parameters->email, $parameters->password);

        if (!sizeof($result)) {
            return $this->output
                ->set_status_header(401, 'Unauthorized')
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'code' => 401,
                    'message' => 'Unauthorized',
                )));
        }

        return $this->output
            ->set_status_header(200, 'OK')
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }
}