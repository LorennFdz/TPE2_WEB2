<?php

class ProductsModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_tpe;charset=utf8', 'root', '');
    }
    // GET ALL
    function getAll() {
        $query = $this->db->prepare('SELECT p.*, c.* FROM products p INNER JOIN category c ON p.id_category = c.id_category');
        $query->execute();
        $productsJoinCategories = $query->fetchAll(PDO::FETCH_OBJ);
        return $productsJoinCategories;
    }
    // GET PRODUCT BY ID
    function getProduct($id){
        $query = $this->db->prepare('SELECT * FROM products WHERE id = ?');
        $query->execute([$id]);
        $productsById = $query->fetch(PDO::FETCH_OBJ);
        return $productsById;
    }
    // GET ALL PARAMS
    function getAllParams($sort, $order, $column, $filter, $limit, $offset){
        $query = $this->db->prepare("SELECT * FROM `products` WHERE `$column` LIKE '$filter%' ORDER BY $sort $order LIMIT $limit OFFSET $offset");
        $query->execute();
        $allParams = $query->fetchAll(PDO::FETCH_OBJ); 
        return $allParams;
    }
    // GET PAGE AND FILTER
    function getPageAndFilter($offset, $limit, $column, $filter){
        $query = $this->db->prepare("SELECT * FROM `products` WHERE `$column` LIKE '$filter%' LIMIT $limit OFFSET $offset");
        $query->execute();
        $pageAndFilter = $query->fetchAll(PDO::FETCH_OBJ); 
        return $pageAndFilter;
    }
    // GET PAGE AND ORDER
    function getPageAndOrder($offset, $limit, $sort, $order){
        $query = $this->db->prepare("SELECT * FROM `products` ORDER BY $sort $order LIMIT $limit OFFSET $offset");
        $query->execute();
        $pageAndOrder = $query->fetchAll(PDO::FETCH_OBJ); 
        return $pageAndOrder;
    }
    // GET ORDER AND FILTER
    function getOrderAndFilter($sort, $order, $column, $filter){
        $query = $this->db->prepare("SELECT * FROM `products` WHERE `$column` LIKE '$filter%' ORDER BY $sort $order");
        $query->execute();
        $orderAndFilter = $query->fetchAll(PDO::FETCH_OBJ); 
        return $orderAndFilter;
    }
    // GET BY ORDER
    function getByOrder($sort, $order) {
        $query = $this->db->prepare("SELECT * FROM `products` ORDER BY $sort $order");
        $query->execute();
        $productsOrderBy = $query->fetchAll(PDO::FETCH_OBJ);
        return $productsOrderBy;
    }
    // GET BY FILTER
    function getFilter($column, $filter) {
        $query = $this->db->prepare("SELECT * FROM `products` WHERE `$column` LIKE '$filter%'");
        $query->execute();
        $filters = $query->fetchAll(PDO::FETCH_OBJ); 
        return $filters;
    }
    // GET BY PAGE
    function getPage($limit, $offset){
        $query = $this->db->prepare("SELECT * FROM `products` LIMIT $limit OFFSET $offset");
        $query->execute();
        $pages = $query->fetchAll(PDO::FETCH_OBJ); 
        return $pages;
    }
    // POST PRODUCT
    function insertProduct($brand, $model, $description, $category) {
        $query = $this->db->prepare('INSERT INTO products (brand, model, description, id_category) VALUES (?, ?, ?, ?)');
        $query->execute([$brand, $model, $description, $category]);
        return $this->db->lastInsertId();
    }
    // PUT PRODUCT
    function updateProduct($id, $brand, $model, $description, $category) {
        $query = $this->db->prepare('UPDATE `products` SET `brand` = ?, `model` = ?, `description` = ?, `id_category` = ? WHERE  `id`  = ?');
        $query->execute([$brand, $model, $description, $category, $id]);
    }
    // DELETE PRODUCT
    function deleteProductById($id){
        $query = $this->db->prepare('DELETE FROM products WHERE id = ?');
        $query->execute([$id]);
    }
}