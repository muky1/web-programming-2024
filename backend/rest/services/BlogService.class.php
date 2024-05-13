<?php

require_once __DIR__ . "/../dao/BlogDao.class.php";

class BlogService {
    
    private $blog_dao;

    public function __construct()
    {
        $this->blog_dao = new BlogDao();
    }

    public function get_all_blogs() {
        return $this->blog_dao->get();
    }

    public function add_blog($blog) {
        return $this->blog_dao->add($blog);
    }

    public function get_blog_by_id($blog_id) {
        return $this->blog_dao->get_blog_by_id($blog_id);   
    }

    public function delete_blog_by_id($blog_id) {
        return $this->blog_dao->delete_blog_by_id($blog_id);
    }

    public function get_all_comments_by_blog_id($blog_id) {
        return $this->blog_dao->get_all_comments_by_blog_id($blog_id);
    }
}