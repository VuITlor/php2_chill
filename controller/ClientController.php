    <?php
    require_once "model/ProductModel.php";
    require_once "view/helpers.php";
    require_once "model/CategoryModel.php";
    require_once "model/ProductVariantModel.php";

    class ClientController
    {
        private $productModel;
        private $categoryModel;
        private $productVariantModel;

        public function __construct()
        {
            $this->productModel = new ProductModel();
            $this->categoryModel = new CategoryModel();
            $this->productVariantModel = new ProductVariantModel();
        }

        public function index()
        {
            $products = $this->productModel->getAllProducts();
            renderView("view/index.php", compact('products'), "Trang chủ", "client");
        }


        public function shop()
        {
            $products = $this->productModel->getAllProducts();
            $categories = $this->categoryModel->getAllCategories();

            renderView("view/pages/client/products/shop.php", compact('products', 'categories'), "Sản phẩm", "client");
        }
        public function showProduct($id)
        {
            $products = $this->productModel->getAllProducts();
            $product = $this->productModel->getProductById($id);
            $categories = $this->categoryModel->getAllCategories();
            $variants = $this->productVariantModel->getVariantsByProductId($id);
            renderView("view/pages/client/products/show.php", compact('product', 'categories', 'products', 'variants'), $product['name'], "client");
        }
        public function carts()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = json_decode(file_get_contents("php://input"), true);
                $id = $_POST['id'] ?? null;
                $quantity = $_POST['quantity'] ?? null;
                $price = $_POST['price'] ?? null;
                $name = $_POST['name'] ?? null;
                $base_price = $_POST['base_price'] ?? null;
                $thumbnail = $_POST['thumbnail'] ?? null;
                $carts = isset($_COOKIE['carts']) ? json_decode($_COOKIE['carts'], true) : [];
                // die();
                if ($id && $quantity) {
                    $exists = false;
                    foreach ($carts as &$item) {
                        if ($item['id'] === $id) {
                            $item['quantity'] += $quantity; // Tăng số lượng nếu đã tồn tại
                            $exists = true;
                            break;
                        }
                    }

                    // Thêm mới sản phẩm nếu chưa có
                    if (!$exists) {
                        $carts[] = [
                            'id' => $id,
                            'name' => $name,
                            'quantity' => $quantity,
                            'price' => $price,
                            'base_price' => $base_price,
                            'thumbnail' => $thumbnail
                        ];
                    }

                    setcookie('carts', json_encode($carts), time() + (30 * 24 * 60 * 60), '/');

                    $response = [
                        'status' => 'success',
                        'message' => 'Sản phẩm đã được thêm vào giỏ hàng',
                        'data' => $carts
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Thiếu các trường dữ liệu bắt buộc'
                    ];
                }

                // Trả về kết quả JSON
                header('Content-Type: application/json');
                echo json_encode($response);
            } else    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
                $data = json_decode(file_get_contents('php://input'), true);
                $id = $data['id'] ?? null;
                $carts = isset($_COOKIE['carts']) ? json_decode($_COOKIE['carts'], true) : [];
                foreach ($carts as $index => $cart) {
                    if ($cart['id'] == $id) {
                        array_splice($carts, $index, 1);
                        break;
                    }
                }
                setcookie('carts', json_encode($carts), time() + (30 * 24 * 60 * 60), '/');
                header('Content-Type: application/json');
                echo json_encode($carts);
            } else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
                $data = json_decode(file_get_contents('php://input'), true);
                $carts = isset($_COOKIE['carts']) ? json_decode($_COOKIE['carts'], true) : [];

                if (!is_array($carts)) {
                    $carts = [];
                }

                // Cập nhật giỏ hàng
                foreach ($data['data'] as $updatedItem) {
                    // Ép kiểu `id` và `quantity` để đảm bảo chúng là số nguyên
                    $updatedItem['id'] = (int) $updatedItem['id']; // Ép kiểu id thành số nguyên
                    $updatedItem['quantity'] = (int) $updatedItem['quantity']; // Ép kiểu quantity thành số nguyên

                    foreach ($carts as $index => $cart) {
                        // Kiểm tra nếu id trong giỏ hàng trùng với id của sản phẩm cần cập nhật
                        if ($cart['id'] == $updatedItem['id']) {
                            // Cập nhật quantity
                            $carts[$index]['quantity'] = $updatedItem['quantity'];
                            break; // Thoát khỏi vòng lặp nếu đã tìm thấy và cập nhật
                        }
                    }
                }
                // luu vao cookie 30date30date
                setcookie('carts', json_encode($carts), time() + (30 * 24 * 60 * 60), '/');
                // chuyen du lieu thanh
                header('Content-Type: application/json');
                echo json_encode($carts);
            } else {
                $carts = isset($_COOKIE['carts']) ? json_decode($_COOKIE['carts'], true) : [];
                renderView("view/pages/client/carts.php", compact('carts'), "Giỏ hàng", "client");
            }
        }
        public function checkout()
        {
            $carts = isset($_COOKIE['carts']) ? json_decode($_COOKIE['carts'], true) : [];
            if (empty($carts) || count($carts) == 0) {
                $_SESSION['error'] = "Giỏ hàng trống";
                redirect("/carts");
            }
            renderView("view/pages/client/checkout.php", compact('carts'), "Thanh toán", "client");
        }
        private function validateProduct($product)
        {
            $errors = [];
            if (empty($product['name'])) {
                $errors['name'] = "Vui lòng nhập tên sản phẩm";
            }
            if (empty($product['description'])) {
                $errors['description'] = "Vui lòng nhập mô tả sản phẩm";
            }
            if (empty($product['price'])) {
                $errors['price'] = "Vui lòng nhập giá sản phẩm";
            }
            return $errors;
        }
    }
