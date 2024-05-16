<?php
require_once __DIR__ . '/BaseDao.class.php';

class CategoriesDao extends BaseDao {
    public function __construct() {
        parent::__construct('categories');
    }

    public function get() {
        return $this->get_all(0, 10);
    }

    public function get_category_by_id($category_id){
        return $this->query_unique("SELECT * FROM categories WHERE id = :id", ["id" => $category_id]);
    }

    public function delete_category_by_id($category_id) {
        $this->execute("DELETE FROM categories WHERE id = :id", ["id" => $category_id]);
    }
}