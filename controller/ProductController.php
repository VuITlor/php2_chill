    <?php
    require_once "model/ProductModel.php";
    require_once "view/helpers.php";
    require_once "model/CategoryModel.php";

    class ProductController
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
            $products = $this->productModel->getAllProducts();
            //compact: gom bien dien thanh array
            renderView("view/pages/admin/products/index.php", compact('products'), "Product List");
        }

        public function indexHome()
        {
            $products = $this->productModel->getAllProducts();
            renderView("view/index.php", compact('products'), "Product List", "client");
        }

        public function show($id)
        {
            $product = $this->productModel->getProductById($id);
            renderView("view/pages/admin/products/show.php", compact('product'), "Product Detail");
        }

        public function create()
        {
            $categories = $this->categoryModel->getAllCategories();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $file = $_FILES['image'];
                $result = uploadImage($_FILES['image']);
                $name = $_POST['name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $base_price = $_POST['base_price'];
                $quantity = $_POST['quantity'];
                $category = $_POST['category'];

                $errors = $this->validateProduct(['name' => $name, 'description' => $description, 'price' => $price, 'base_price' => $base_price, 'quantity' => $quantity, 'category' => $category]);
                if ($result !== true) {
                    $errors['image'] = $result;
                }

                if (!empty($errors)) {
                    renderView("view/pages/admin/products/create.php", compact('errors', 'categories', 'name', 'description', 'price', 'base_price', 'quantity', 'category'), "Thêm sản phẩm");
                } else {
                    $this->productModel->createProduct($name, $description, $price, $_SESSION['image'], $quantity, $base_price, $category);
                    $_SESSION['message'] = "Sản phẩm đã được tạo thành công.";
                    redirect("/admin/products");
                }
            } else {
                renderView("view/pages/admin/products/create.php", compact('categories'), "Create Product");
            }
        }


        public function edit($id)
        {
            $categories = $this->categoryModel->getAllCategories();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $file = $_FILES['image'];
                $result = uploadImage($_FILES['image']);
                $name = $_POST['name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $base_price = $_POST['base_price'];
                $quantity = $_POST['quantity'];
                $category = $_POST['category'];
                $errors = $this->validateProduct(['name' => $name, 'description' => $description, 'price' => $price, 'base_price' => $base_price, 'quantity' => $quantity, 'category' => $category]);
                if ($result !== true) {
                    $errors['image'] = $result;
                }
                if (!empty($errors)) {
                    $product = $this->productModel->getProductById($id);
                    renderView("view/pages/admin/products/edit.php", compact('errors', 'categories', 'product', 'categories', 'name', 'description', 'price', 'base_price', 'quantity', 'category'), "Sua sản phẩm");
                } else {
                    $this->productModel->updateProduct($id, $name, $description, $price, $_SESSION['image'], $quantity, $base_price, $category);
                    $_SESSION['message'] = "Sản phẩm đã được cập nhật thành công.";
                    redirect("/admin/products");
                }
            } else {
                $product = $this->productModel->getProductById($id);
                renderView("view/pages/admin/products/edit.php", compact('product', 'categories',), "Chỉnh sửa sản phẩm");
            }
        }

        public function delete($id)
        {
            $this->productModel->deleteProduct($id);
            $_SESSION['message'] = "Sản phẩm đã được xóa thành công.";
            redirect("/admin/products");
        }

        private function validateProduct($product)
        {
            $errors = [];

            // Validate Product Name
            if (empty($product['name'])) {
                $errors['name'] = "Vui lòng nhập tên sản phẩm";
            }

            // Validate Product Description
            if (empty($product['description'])) {
                $errors['description'] = "Vui lòng nhập mô tả sản phẩm";
            }

            // Validate Product Price
            if (empty($product['price'])) {
                $errors['price'] = "Vui lòng nhập giá sản phẩm";
            } elseif (!is_numeric($product['price']) || $product['price'] <= 0) {
                $errors['price'] = "Giá sản phẩm phải là số dương";
            }

            if (empty($product['quantity'])) {
                $errors['quantity'] = "Vui lòng nhập số lượng sản phẩm";
            } elseif (!is_numeric($product['quantity']) || $product['quantity'] < 1) {
                $errors['quantity'] = "Số lượng phải là số nguyên dương";
            }

            // Validate Base Price
            if (!is_numeric($product['base_price']) || $product['base_price'] <= 0) {
                $errors['base_price'] = "Giá cơ bản phải là số dương";
            }

            // Validate Product Category
            if (empty($product['category'])) {
                $errors['category'] = "Vui lòng chọn danh mục sản phẩm";
            }

            return $errors;
        }
    }
