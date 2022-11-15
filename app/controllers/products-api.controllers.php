<?php
require_once './app/models/products.model.php';
require_once './app/views/api.view.php';
require_once './app/helpers/auth-api.helper.php';

class ProductsController {
    private $model;
    private $view;
    private $authHelper;
    private $data;

    public function __construct() {
        $this->model = new ProductsModel();
        $this->view = new ApiView();
        $this->authHelper = new AuthApiHelper();
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }
    // GET PRODUCTS
    function getProducts($params = null) {
        $columns = ["id", "brand", "model", "description", "id_category"];
        // GET BY ALL PARAMS
        if(isset($_GET['page']) && isset($_GET['limit']) && isset($_GET['column']) && isset($_GET['filter']) &&  isset($_GET['sort']) && isset($_GET['order'])){
            $page = $_GET['page'];
            $limit = $_GET['limit'];
            $order = mb_strtolower($_GET['order']);
            $sort = mb_strtolower($_GET['sort']);
            $column = mb_strtolower($_GET['column']);
            $filter = mb_strtolower($_GET['filter']);
            $columnsExists = in_array($sort, $columns);
            $columnFilter = in_array($column, $columns);
            if(!is_numeric($page) || !is_numeric($limit) || ($page == 0 || $page < 0) || ($limit == 0 || $limit < 0)){
                $this->view->response("Debe insertar un número en 'page' y/o 'limit' (mayor a 0)", 400);
                die;
            }
            else if(!$filter || !$columnFilter){
                $this->view->response("La columna: '$column' ó el producto por el que quiere filtrar: '$filter' NO existe.", 400);
                die;
            }
            else if((($order != 'asc') && ($order != 'desc')) || !$columnsExists){
                $this->view->response("La columna $sort ó el ordenamiento $order NO existe. La columnas disponibles son: $columns[0], $columns[1], $columns[2], $columns[3], $columns[4]", 400);
                die;
            }
            else {
                $offset = ($page - 1) * $limit;
                $product = $this->model->getFilter($column, $filter);
                if(!(count($product) > $offset)){
                    $this->view->response("No hay resultados para mostrar.", 400);
                    die;
                }
                else {
                    $getAllParams = $this->model->getAllParams($sort, $order, $column, $filter, $limit, $offset);
                    $this->view->response($getAllParams, 200);
                }
            }
        }
        // GET BY PAGE AND FILTER
        else if(isset($_GET['page']) && isset($_GET['limit']) && isset($_GET['column']) && isset($_GET['filter'])) {
            $page = $_GET['page'];
            $limit = $_GET['limit'];
            $column = mb_strtolower($_GET['column']);
            $filter = mb_strtolower($_GET['filter']);
            $columnFilter = in_array($column, $columns);
            if(!is_numeric($page) || !is_numeric($limit) || ($page == 0 || $page < 0) || ($limit == 0 || $limit < 0)){
                $this->view->response("Debe insertar un número en 'page' y/o 'limit' (mayor a 0)", 400);
                die;
            }
            else if(!$filter || !$columnFilter){
                $this->view->response("La columna: '$column' ó el producto por el que quiere filtrar: '$filter' NO existe.", 400);
                die;
            }
            else {
                $offset = ($page - 1) * $limit;
                $product = $this->model->getFilter($column, $filter);
                if(!(count($product) > $offset)){
                    $this->view->response("No hay resultados para mostrar.", 400);
                    die;
                }
                else {
                    $getPageAndFilter = $this->model->getPageAndFilter($offset, $limit, $column, $filter);
                    $this->view->response($getPageAndFilter, 200);
                }
            }
        }
        // GET BY PAGE AND ORDER
        else if(isset($_GET['page']) && isset($_GET['limit']) && isset($_GET['sort']) && isset($_GET['order'])){
            $page = $_GET['page'];
            $limit = $_GET['limit'];
            $order = mb_strtolower($_GET['order']);
            $sort = mb_strtolower($_GET['sort']);
            $columnsExists = in_array($sort, $columns);
            if(!is_numeric($page) || !is_numeric($limit) || ($page == 0 || $page < 0) || ($limit == 0 || $limit < 0)){
                $this->view->response("Debe insertar un número en 'page' y/o 'limit' (mayor a 0)", 400);
                die;
            }
            else if((($order != 'asc') && ($order != 'desc')) || !$columnsExists){
                $this->view->response("La columna $sort ó el ordenamiento $order NO existe. La columnas disponibles son: $columns[0], $columns[1], $columns[2], $columns[3], $columns[4]", 400);
                die;
            }
            else {
                $offset = ($page - 1) * $limit;
                $product = $this->model->getByOrder($sort, $order);
                if(!(count($product) > $offset)){
                    $this->view->response("No hay resultados para mostrar.", 400);
                    die;
                }
                else {
                    $getPageAndOrder = $this->model->getPageAndOrder($offset, $limit, $sort, $order);
                    $this->view->response($getPageAndOrder, 200);
                }
            }
        }
        // GET BY ORDER AND FILTER
        else if(isset($_GET['sort']) && isset($_GET['order']) &&isset($_GET['column']) && isset($_GET['filter'])){
            $order = mb_strtolower($_GET['order']);
            $sort = mb_strtolower($_GET['sort']);
            $column = mb_strtolower($_GET['column']);
            $filter = mb_strtolower($_GET['filter']);
            $columnsExists = in_array($sort, $columns);
            $columnFilter = in_array($column, $columns);
            if((($order != 'asc') && ($order != 'desc')) || !$columnsExists){
                $this->view->response("La columna $sort ó el ordenamiento $order NO existe. La columnas disponibles son: $columns[0], $columns[1], $columns[2], $columns[3], $columns[4]", 400);
                die;
            }
            else if(!$filter || !$columnFilter){
                $this->view->response("La columna: '$column' ó el producto por el que quiere filtrar: '$filter' NO existe.", 400);
                die;
            }
            else{
                $getOrderAndFilter = $this->model->getOrderAndFilter($sort, $order, $column, $filter);
                $this->view->response($getOrderAndFilter, 200);
            }
        }
        // GET BY PAGE
        else if(isset($_GET['page']) && isset($_GET['limit'])){
            $page = $_GET['page'];
            $limit = $_GET['limit'];
            if(!is_numeric($page) || !is_numeric($limit)){
                $this->view->response("DEBE INSERTAR UN NUMERO EN PAGE Y/O LIMIT", 400);
                die;    
            }
            else if(($page > 0) && ($limit > 0)){
                $offset = ($page - 1) * $limit;
                $productPages = $this->model->getPage($limit, $offset);
                $this->view->response($productPages);
            }
            else {
                $this->view->response("La página $page Ó el limite $limit NO existe", 400);
            }
        }
        // GET BY FILTER
        else if(isset($_GET['column']) && isset($_GET['filter'])){
            $column = mb_strtolower($_GET['column']);
            $filter = mb_strtolower($_GET['filter']);
            $columnsExists = in_array($column, $columns);
            $product = $this->model->getFilter($column, $filter);
            if(!$product || !$columnsExists){
                $this->view->response("La columna: '$column' ó el producto por el que quiere filtrar: '$filter' NO existe.", 400);
            }
            else {
                $productFilter = $this->model->getFilter($column, $filter);
                $this->view->response($productFilter);
            }
        }
        // GET BY ORDER
        else if(isset($_GET['sort']) && isset($_GET['order'])){
            $sort = mb_strtolower($_GET['sort']);
            $order = mb_strtolower($_GET['order']);
            $columnsExists = in_array($sort, $columns);
            if((($order != 'asc') && ($order != 'desc')) || !$columnsExists){
                $this->view->response("La columna $sort ó el ordenamiento $order NO existe. La columnas disponibles son: $columns[0], $columns[1], $columns[2], $columns[3], $columns[4]", 400);
            }
            else {
                $productsOrderBy = $this->model->getByOrder($sort, $order);
                $this->view->response($productsOrderBy);
                
            }
        }
        // GET ALL
        else {
            $getAll = $this->model->getAll();
            $this->view->response($getAll);
        }
    }
    // GET PRODUCT BY ID
    function getProduct($params = null) {
        $id = $params[':ID'];
        $productById = $this->model->getProduct($id);
        if($productById) {
            $this->view->response($productById);
        }
        else {
            $this->view->response("La tarea con el id=$id no existe", 404);
        }
    }
    // POST PRODUCT
    function addProduct($params = null){
        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No estas logueado", 401);
            return;
        }
        $product = $this->getData();
        if (empty($product->brand) || empty($product->model) || empty($product->description) || empty($product->id_category)) {
            $this->view->response("Complete los datos", 400);
        }
        else {
            $brand = $product->brand;
            $model = $product->model;
            $description = $product->description;
            $category = $product->id_category;

            $id = $this->model->insertProduct($brand, $model, $description, $category);
            $product = $this->model->getProduct($id);
            $this->view->response($product, 201);
        }
    }
    // PUT PRODUCT
    function updateProduct($params = null) {
        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No estas logueado", 401);
            return;
        }
        $id = $params[':ID'];
        $product = $this->getData();
        $productById = $this->model->getProduct($id);
        if (empty($product->brand) || empty($product->model) || empty($product->description) || empty($product->id_category)) {
            $this->view->response("Complete los datos", 400);
        }
        else {
            $brand = $product->brand;
            $newModel = $product->model;
            $description = $product->description;
            $category = $product->id_category;
            if($productById) {
                $this->model->updateProduct($id, $brand, $newModel, $description, $category);
                $updateProduct = $this->model->getProduct($id);
                $this->view->response("Producto id = $id actualizado con éxito", 200);
                $this->view->response($updateProduct, 200);
            }
            else {
                $this->view->response("La tarea con el id = $id no existe", 404);
            }
        }
        
    }
    // DELETE PRODUCT
    function deleteProduct($params = null) {
        $id = $params[':ID'];
        $productById = $this->model->getProduct($id);
        if ($productById) {
            $this->model->deleteProductById($id);
            $this->view->response("Producto eliminado con éxito", 200);
        }
        else {
            $this->view->response("La tarea con el id = $id no existe", 404);
        }
    }
}