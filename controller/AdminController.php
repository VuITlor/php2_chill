    <?php
    require_once "model/ProductModel.php";
    require_once "view/helpers.php";
    require_once "model/CategoryModel.php";

    class AdminController
    {
        private $productModel;
        private $categoryModel;

        public function __construct()
        {
            $this->productModel = new ProductModel();
            $this->categoryModel = new CategoryModel();
        }

        public function index()
        {
            renderView("view/pages/admin/index.php", [], "Trang chủ quản lý", );
        }
    }
