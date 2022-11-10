<?php

/** @noinspection PhpUnused */
/** @noinspection PhpIncludeInspection */
/** @noinspection SpellCheckingInspection */
    
defined('BASEPATH') OR exit('No direct script access allowed');

require (APPPATH . "interfaces/IAuthService.php");

class AuthService implements IAuthService
{
    /** @var IUserModel $model */
    private $model;

    public function __construct($parameters)
    {
        $this->model = $parameters[0];
    }

    public function login($email, $password)
    {
        $user = $this->model->login($email, $password);
        
        if (sizeof($user) > 0) {
            $data = array( 'email' => ((object) $user)->email );
            $accessToken = JWT::encode($data);

            return array(
                'access_token' => $accessToken,
            );
        }
        
        return array();
    }
}