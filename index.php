<?php
define('BASE_URL', 'http://localhost/php2/');
require_once "controller/ProductController.php";
require_once "controller/CategoryController.php";
require_once "controller/Controller.php";
require_once "controller/ClientController.php";
require_once "controller/AuthController.php";
require_once "controller/ProductVariantController.php";
require_once "controller/VariantController.php";
require_once "router/Router.php";
require_once "controller/AdminController.php";
require_once "middleware.php";
require_once 'functions.php';
require_once 'vendor/autoload.php';
$router = new Router();
$productController = new ProductController();
$categoryController = new CategoryController();
$productVariantsController = new ProductVariantController();
$authController = new AuthController();
$variantController = new VariantController();
$clientController = new ClientController();
$controller = new Controller();
$adminController = new AdminController();

$router->addMiddleware('logRequest');

$router->addRoute("/admin", [$adminController, "index"], ['checkLogin', 'checkAdmin']);
$router->addRoute("/admin/products", [$productController, "index"], ['checkLogin', 'checkAdmin']);
$router->addRoute("/admin/products/detail/{id}", [$productController, "show"], ['checkLogin', 'checkAdmin']);
$router->addRoute("/admin/products/create", [$productController, "create"], ['checkLogin', 'checkAdmin']);
$router->addRoute("/admin/products/edit/{id}", [$productController, "edit"], ['checkLogin', 'checkAdmin']);
$router->addRoute("/admin/products/delete/{id}", [$productController, "delete"], ['checkLogin', 'checkAdmin']);

$router->addRoute("/admin/category", [$categoryController, "index"], ['checkLogin', 'checkAdmin']);
$router->addRoute("/admin/category/create", [$categoryController, "create"], ['checkLogin', 'checkAdmin']);
$router->addRoute("/admin/category/edit/{id}", [$categoryController, "edit"], ['checkLogin', 'checkAdmin']);
$router->addRoute("/admin/category/delete/{id}", [$categoryController, "delete"], ['checkLogin', 'checkAdmin']);

$router->addRoute("/admin/variants", [$variantController, "index"], ['checkLogin', 'checkAdmin']);
$router->addRoute('admin/variants/create', [$variantController, 'create'], ['checkLogin', 'checkAdmin']);
$router->addRoute("/admin/variants/edit/{id}", [$variantController, "edit"], ['checkLogin', 'checkAdmin']);
$router->addRoute("/admin/variants/delete/{id}", [$variantController, "delete"], ['checkLogin', 'checkAdmin']);
$router->addRoute("/admin/product-variants", [$productVariantsController, "index"], ['checkLogin', 'checkAdmin']);
$router->addRoute("/admin/product-variants/create", [$productVariantsController, "create"], ['checkLogin', 'checkAdmin']);
$router->addRoute("/admin/product-variants/edit/{id}", [$productVariantsController, "edit"], ['checkLogin', 'checkAdmin']);
$router->addRoute("/admin/product-variants/delete/{id}", [$productVariantsController, "delete"], ['checkLogin', 'checkAdmin']);

$router->addRoute("/admin/users", [$authController, "index"], ['checkLogin', 'checkAdmin']);
$router->addRoute("/admin/users/edit/{id}", [$authController, "edit"], ['checkLogin', 'checkAdmin']);
$router->addRoute("/admin/users/delete/{id}", [$authController, "delete"], ['checkLogin', 'checkAdmin']);

// client 
$router->addRoute("/login", [$authController, "login"]);
$router->addRoute("/register", [$authController, "register"]);
$router->addRoute("/forgot-password", [$authController, "forgotPassword"]);
$router->addRoute("/logout", [$authController, "logout"]);
$router->addRoute("/unauthorized", [$authController, "unauthorized"]);

$router->addRoute("/", [$clientController, "index"]);

$router->addRoute("/shop", [$clientController, "shop"]);
$router->addRoute("/products/{id}", [$clientController, "showProduct"]);

$router->addRoute("/carts", [$clientController, "carts"]);
$router->addRoute("/checkout", [$clientController, "checkout"]);

$router->dispatch();
