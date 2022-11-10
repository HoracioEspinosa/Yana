<?php

/** @noinspection SpellCheckingInspection */

defined('BASEPATH') OR exit('No direct script access allowed');

interface IUserActivityModel
{
    /**
     * Get all activities
     * 
     * @return mixed
     */
    public function getAll();

    /**
     * Get activity by id
     * 
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * Get activity by user id
     * 
     * @param $uid
     * @return mixed
     */
    public function getByUId($uid);

    /**
     * Get activity by user id and id activity
     *
     * @param $uid
     * @param $id
     * @return mixed
     */
    public function getByUIdAndId($uid, $id);

    /**
     * Create activity from default model
     * 
     * @param IUserActivityModel $userActivity
     * @return mixed
     */
    public function create($userActivity);

    /**
     * Update activity from default model
     * 
     * @param IUserActivityModel $userActivity
     * @return mixed
     */
    public function update($userActivity);

    /**
     * Delete activity by id
     * 
     * @param $id
     * @return mixed
     */
    public function delete($id);

    public function getId();
    public function setId($id);
    public function getUId();
    public function setUId($uid);
    public function getMessageText();
    public function setMessageText($messageText);
    public function getMessageFrom();
    public function setMessageFrom($messageFrom);
    public function getDatetime();
    public function setDatetime($datetime);
    public function getTimestamp();
    public function setTimestamp($timestamp);

    public function fromArray($userActivity);
}