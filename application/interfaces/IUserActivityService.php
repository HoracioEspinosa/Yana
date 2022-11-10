<?php
    
/** @noinspection SpellCheckingInspection */

defined('BASEPATH') OR exit('No direct script access allowed');

interface IUserActivityService
{
    public function getAll();
    public function getById($id);
    public function getByUId($uid);
    public function getByUIdAndId($uid, $id);
    public function create($data);
    public function update($id, $data);
    public function delete($id);
}