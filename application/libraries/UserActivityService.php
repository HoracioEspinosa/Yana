<?php

/** @noinspection PhpUnused */
/** @noinspection PhpIncludeInspection */
/** @noinspection SpellCheckingInspection */
    
defined('BASEPATH') OR exit('No direct script access allowed');

require (APPPATH . "interfaces/IUserActivityService.php");

class UserActivityService implements IUserActivityService
{
    /** @var IUserActivityModel $model */
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

    public function getByUId($uid)
    {
        return $this->model->getByUId($uid);
    }

    public function getByUIdAndId($uid, $id)
    {
        return $this->model->getByUIdAndId($uid, $id);
    }

    public function create($data)
    {
        /** @var IUserActivityModel $userActivityModel */
        $userActivityModel = (new User_Activity_model())->fromArray($data);
        
        if ($userActivityModel->getDatetime() == "" || $userActivityModel->getDatetime() == NULL) {
            $userActivityModel->setDatetime((new DateTime())->format('Y-m-d H:i:s'));
        }

        if ($userActivityModel->getTimestamp() == "" || $userActivityModel->getTimestamp() == NULL) {
            $userActivityModel->setTimestamp((string) (new DateTime())->getTimestamp());
        }
        
        return $this->model->create($userActivityModel);
    }

    public function update($id, $data)
    {
        /** @var IUserActivityModel $userActivityModel */
        $userActivityModel = (new User_Activity_model())->fromArray($data);
        $userActivityModel->setId($id);
        
        return $this->model->update($userActivityModel);
    }

    public function delete($id)
    {
        return $this->model->delete($id);
    }
}