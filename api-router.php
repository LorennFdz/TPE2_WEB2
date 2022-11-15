<?php
require_once './libs/Router.php';
require_once './app/controllers/products-api.controllers.php';
require_once './app/controllers/auth-api.controllers.php';
// crea el router
$router = new Router();

// defina la tabla de ruteo
$router->addRoute('products', 'GET', 'ProductsController', 'getProducts');
$router->addRoute('products/:ID', 'GET', 'ProductsController', 'getProduct');
$router->addRoute('products', 'POST', 'ProductsController', 'addProduct');
$router->addRoute('products/:ID', 'PUT', 'ProductsController', 'updateProduct');
$router->addRoute('products/:ID', 'DELETE', 'ProductsController', 'deleteProduct');
$router->addRoute('auth/token', 'GET', 'AuthApiController', 'getToken');

// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);