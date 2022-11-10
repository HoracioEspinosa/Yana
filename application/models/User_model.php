<?php 
    
/** @noinspection PhpIncludeInspection */
/** @noinspection SpellCheckingInspection */

defined('BASEPATH') OR exit('No direct script access allowed');

require (APPPATH . "interfaces/IUserModel.php");

/**
 * @property CI_DB_mysqli_driver $db
 */
class User_model extends CI_Model implements IUserModel {
    private $table = 'users';

    public $id;
    public $email;
    public $password;
    
    public function __construct()
    {
        parent::__construct();
        $this->db->db_debug = FALSE;
    }

    /**
     * @inheritDoc
     */
    public function getAll()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    /**
     * @inheritDoc
     */
    public function getById($id)
    {
        $query = $this->db->get_where($this->table, array('id' => $id));
        return $query->first_row();
    }

    /**
     * @inheritDoc
     */
    public function getByEmail($email)
    {
        $query = $this->db->get_where($this->table, array('email' => $email));
        return $query->first_row();
    }

    /**
     * @inheritDoc
     */
    public function create($user)
    {
        $this->db->insert($this->table, $user);
        
        return $this->db->insert_id();
    }

    /**
     * @inheritDoc
     */
    public function update($user)
    {
        $this->db->where('id', $user->getId());
        $this->db->update($this->table, $this->cleanArray((array)$user));

        return $user->getId();
    }

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        $this->db->delete($this->table, array('id' => $id));
    }

    /**
     * @inheritDoc
     */
    public function login($email, $password)
    {
        $query = $this->db->get_where($this->table, array('email' => $email));
        $result = $query->result();
        
        if (sizeof($result) > 0) {
            $result = $result[0];

            if (property_exists($result, 'password')) {
                $passwordHash = $result->password;
                
                return password_verify($password, $passwordHash) ? (array) $result : array();
            }
        }
        
        return array();
    }


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        return $this;
    }

    public function fromArray($user)
    {
        return $this::arrayToModel((new self), $user);
    }
}