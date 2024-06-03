<?php
require_once __DIR__ . '/BaseDao.class.php';

class BlogDao extends BaseDao {
    public function __construct() {
        parent::__construct('blogs');
    }

    public function get() {
        return $this->get_all(0, 10);
    }

    public function add($blog) {
        return $this->insert('blogs', $blog);
    }

    public function get_blog_by_id($blog_id){
        return $this->query_unique("SELECT * FROM blogs WHERE id = :id", ["id" => $blog_id]);
    }

    public function delete_blog_by_id($blog_id) {
        $this->execute("DELETE FROM blogs WHERE id = :id", ["id" => $blog_id]);
    }

    public function get_all_comments_by_blog_id($blog_id) {
        return $this->query("SELECT c.id, c.content FROM blogs b
                       JOIN comments c ON c.blog_id = b.id
                       WHERE b.id = :blog_id
                       ORDER BY c.created_at DESC", ["blog_id" => $blog_id]);
    }
}