<?php

require_once __DIR__ . "/../dao/UserDao.class.php";

class UserService {
    
    private $user_dao;

    public function __construct()
    {
        $this->user_dao = new UserDao();
    }

    public function get_user_by_email($email){
        return $this->user_dao->get_user_by_email($email);
    }

    public function add_user($user) {
        return $this->user_dao->add($user);
    }
}