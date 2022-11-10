<?php 
    
/** @noinspection PhpUnused */
/** @noinspection PhpIncludeInspection */
/** @noinspection SpellCheckingInspection */

// src: application/middlewares/AdminAuthMiddleware.php

// Extends nothing, it's upto you what you want to extend. Completely generic.

/**
 * @property IAuthService $authservice
 * @property IUserModel $user_model
 */
class AuthMiddleware {
    /** @var CI_Controller $controller */
    protected $controller;
    
    /** @var $ci */
    protected $ci;
    
    /** @var IUserService $authservice */
    private $userservice;

    public function __construct($controller, $ci)
    {
        $this->controller = $controller;
        $this->ci = $ci;

        $this->ci->load->library('userservice', array($this->ci->user_model));
        $this->userservice = $this->ci->userservice;
    }

    public function run(){
        try {
            $authorization = $this->ci->input->get_request_header('Authorization');
            
            if ($authorization) {
                list(, $token) = explode(" ", $authorization);
                $decoded = JWT::decode($token);

                if (property_exists($decoded, 'data') && property_exists($decoded->data, 'email')) {
                    $user = $this->userservice->getByEmail($decoded->data->email);
                    Controller::$user = (new User_model())->fromArray((array) $user);

                    return true;
                }
            }
        } catch (Exception $exception) {
            $this->ci->output
                ->set_status_header(422, 'Bad request')
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'code' => 422,
                    'message' => $exception->getMessage(),
                )))->_display();
        }
        
        $this->ci->output
            ->set_status_header(401, 'Unauthorized')
            ->set_content_type('application/json')
            ->set_output(json_encode(array(
                'code' => 401,
                'message' => 'Unauthorized',
            )))->_display();
        
        return false;
    }
}