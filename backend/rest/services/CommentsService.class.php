<?php

require_once __DIR__ . "/../dao/CommentsDao.class.php";

class CommentsService {
    
    private $comments_dao;

    public function __construct()
    {
        $this->comments_dao = new CommentsDao();
    }
}