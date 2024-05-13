<?php

require_once __DIR__ . "/../dao/CategoriesDao.class.php";

class CategoriesService {
    
    private $categories_dao;

    public function __construct()
    {
        $this->categories_dao = new CategoriesDao();
    }

    public function get_all_categories() {
        return $this->categories_dao->get();
    }

    public function get_category_by_id($category_id) {
        return $this->categories_dao->get_category_by_id($category_id);   
    }

    public function delete_category_by_id($category_id) {
        return $this->categories_dao->delete_category_by_id($category_id);
    }
}