<?php 
    
/** @noinspection PhpIncludeInspection */
/** @noinspection SpellCheckingInspection */

defined('BASEPATH') OR exit('No direct script access allowed');

require (APPPATH . "interfaces/IUserActivityModel.php");

/**
 * @property $db
 */
class User_Activity_model extends CI_Model implements IUserActivityModel {
    private $table = 'user_activities';
    
    public $id;
    public $uid;
    public $messageText;
    public $messageFrom;
    public $datetime;
    public $timestamp;

    public function __construct()
    {
        parent::__construct();
        $this->db->db_debug = TRUE;
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
    public function getByUId($uid)
    {
        $query = $this->db->get_where($this->table, array('uid' => $uid));
        return $query->result();
    }

    /**
     * @inheritDoc
     */
    public function getByUIdAndId($uid, $id)
    {
        $query = $this->db->get_where($this->table, array('uid' => $uid, 'id' => $id));
        return $query->result();
    }

    /**
     * @inheritDoc
     */
    public function create($userActivity)
    {
        $this->db->insert($this->table, $this->cleanArray((array)$userActivity));

        return $this->db->insert_id();
    }

    /**
     * @inheritDoc
     */
    public function update($userActivity)
    {
        $this->db->where('id', $userActivity->getId());
        $this->db->update($this->table, $this->cleanArray((array)$userActivity));

        return $userActivity->getId();
    }

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        $this->db->delete($this->table, array('id' => $id));
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

    public function getUid()
    {
        return $this->uid;
    }

    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }

    public function getMessageText()
    {
        return $this->messageText;
    }

    public function setMessageText($messageText)
    {
        $this->messageText = $messageText;
        return $this;
    }

    public function getMessageFrom()
    {
        return $this->messageFrom;
    }

    public function setMessageFrom($messageFrom)
    {
        $this->messageFrom = $messageFrom;
        return $this;
    }

    public function getDatetime()
    {
        return $this->datetime;
    }

    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;
        return $this;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
        return $this;
    }

    public function fromArray($userActivity)
    {
        return $this::arrayToModel((new self), $userActivity);
    }
}