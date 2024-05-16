<?php
require_once __DIR__ . '/BaseDao.class.php';

class CommentsDao extends BaseDao {
    public function __construct() {
        parent::__construct('comments');
    }
}