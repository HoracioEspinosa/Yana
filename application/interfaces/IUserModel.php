<?php

/** @noinspection SpellCheckingInspection */

defined('BASEPATH') OR exit('No direct script access allowed');

interface IUserModel
{
    /**
     * Get all users
     * 
     * @return mixed
     */
    public function getAll();

    /**
     * Get single user by id
     * 
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * Get single user by email
     *
     * @param $email
     * @return mixed
     */
    public function getByEmail($email);

    /**
     * Create a user from default model
     * 
     * @param IUserModel $user
     * @return mixed
     */
    public function create($user);
    
    /**
     * Update a user from default model
     * 
     * @param IUserModel $user
     * @return mixed
     */
    public function update($user);

    /**
     * Login for user with user and password
     *
     * @param string $email
     * @param string $password
     * @return mixed
     */
    public function login($email, $password);

    /**
     * Delete user from id
     * 
     * @param $id
     * @return mixed
     */
    public function delete($id);

    public function getId();
    public function setId($id);
    public function getEmail();
    public function setEmail($email);
    public function getPassword();
    public function setPassword($password);

    public function fromArray($user);
}