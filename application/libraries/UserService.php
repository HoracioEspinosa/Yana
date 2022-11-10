<?php

/** @noinspection PhpUnused */
/** @noinspection PhpIncludeInspection */
/** @noinspection SpellCheckingInspection */
    
defined('BASEPATH') OR exit('No direct script access allowed');

require (APPPATH . "interfaces/IUserService.php");

class UserService implements IUserService
{
    /** @var IUserModel $model */
    private $model;

    public function __construct($parameters)
    {
        $this->model = $parameters[0];
    }

    public function getAll()
    {
        return $this->model->getAll();
    }

    public function getById($id)
    {
        return $this->model->getById($id);
    }

    public function getByEmail($email)
    {
        return $this->model->getByEmail($email);
    }

    public function create($data)
    {
        /** @var IUserModel $user */
        $user = (new User_model())->fromArray($data);
        
        return $this->model->create($user);
    }

    public function update($id, $data)
    {
        /** @var IUserModel $user */
        $user = (new User_model())->fromArray($data);
        $user->setId($id);

        $userUpdated = $this->getById($id);
        $this->model->update($user);
        
        return false;
    }

    public function delete($id)
    {
        return $this->model->delete($id);
    }
}