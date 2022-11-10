<?php
    
/** @noinspection SpellCheckingInspection */

defined('BASEPATH') OR exit('No direct script access allowed');

interface IAuthService
{
    public function login($email, $password);
}