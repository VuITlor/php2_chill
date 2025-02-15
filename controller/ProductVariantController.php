    <?php
    require_once "model/ProductVariantModel.php";
    require_once "model/VariantModel.php";
    require_once "model/ProductModel.php";
    require_once "view/helpers.php";
    require_once "functions.php";
    class ProductVariantController
    {
        private $productVariantModel;
        private $productModel;
        private $variantModel;

        public function __construct()
        {
            $this->productVariantModel = new ProductVariantModel();
            $this->productModel = new ProductModel();
            $this->variantModel = new VariantModel();
        }

        public function index()
        {
            $variants = $this->productVariantModel->getAllProductVariants();
            renderView("view/pages/admin/product-variants/index.php", compact('variants'), "Product Variants");
        }

        public function create()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $errors = $this->validateVariant($_POST);
                $file = $_FILES['image'];
                $upload = uploadImage($_FILES['image']);

                if ($upload !== true) {
                    $errors['image'] = $upload;
                }
                if (!empty($errors)) {
                    $products = $this->productModel->getAllProducts();
                    $variants = $this->variantModel->getAllVariants();
                    $colors = array_filter($variants, function ($variant) {
                        return $variant['type'] === 'Màu sắc';
                    });
                    $sizes = array_filter($variants, function ($variant) {
                        return $variant['type'] === 'Kích thước';
                    });
                    $colors = array_values($colors);
                    $sizes = array_values($sizes);
                    renderView("view/pages/admin/product-variants/create.php",  compact('products', 'colors', 'sizes', 'errors',), 'Create Product Variant');
                } else {
                    $this->productVariantModel->createProductVariants($_POST['size'], $_POST['color'], $_POST['price'], $_POST['product'], $_POST['sku'], $_POST['quantity'], $_SESSION['image']);
                    $_SESSION['message'] = "Biến thể đã được tạo thành công.";
                    redirect("/admin/product-variants");
                }
            } else {
                $products = $this->productModel->getAllProducts();
                $variants = $this->variantModel->getAllVariants();
                $colors = array_filter($variants, function ($variant) {
                    return $variant['type'] === 'Màu sắc';
                });
                $sizes = array_filter($variants, function ($variant) {
                    return $variant['type'] === 'Kích thước';
                });
                $colors = array_values($colors);
                $sizes = array_values($sizes);
                renderView("view/pages/admin/product-variants/create.php",  compact('products', 'colors', 'sizes'), 'Create Product Variant');
            }
        }


        public function edit($id)
        {

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $errors = $this->validateVariant($_POST);
                $file = $_FILES['image'];
                $upload = uploadImage($_FILES['image']);
                if ($upload !== true) {
                    $errors['image'] = $upload;
                }
                if (!empty($errors)) {
                    $products = $this->productModel->getAllProducts();
                    $variants = $this->variantModel->getAllVariants();
                    $variant = $this->productVariantModel->getProductVariantsById($id);
                    $colors = array_filter($variants, function ($variant) {
                        return $variant['type'] === 'Màu sắc';
                    });
                    $sizes = array_filter($variants, function ($variant) {
                        return $variant['type'] === 'Kích thước';
                    });
                    $colors = array_values($colors);
                    $sizes = array_values($sizes);
                    renderView("view/pages/admin/product-variants/edit.php",  compact('products', 'colors', 'sizes', 'errors',), 'Create Product Variant');
                } else {
                    $this->productVariantModel->updateProductVariants($id, $_POST['size'], $_POST['color'], $_POST['price'], $_POST['product'], $_POST['sku'], $_POST['quantity'], $_SESSION['image']);
                    $_SESSION['message'] = "Biến thể đã được cập nhật thành công.";
                    redirect("/admin/product-variants");
                }
            } else {
                $products = $this->productModel->getAllProducts();
                $variants = $this->variantModel->getAllVariants();
                $variant = $this->productVariantModel->getProductVariantsById($id);
                $colors = array_filter($variants, function ($variant) {
                    return $variant['type'] === 'Màu sắc';
                });
                $sizes = array_filter($variants, function ($variant) {
                    return $variant['type'] === 'Kích thước';
                });
                $colors = array_values($colors);
                $sizes = array_values($sizes);
                renderView("view/pages/admin/product-variants/edit.php",  compact('products', 'colors', 'sizes', 'variant'), 'Create Product Variant');
            }
        }

        public function delete($id)
        {
            $this->productVariantModel->deleteProductVariants($id);
            $_SESSION['message'] = "Biến thể đã được xóa thành công.";
            redirect("/admin/product-variants");
        }

        private function validateVariant($data)
        {
            $errors = [];
            if (isset($data['color']) && $data['color'] === '') {
                $errors['color'] = "Màu không được để trống.";
            }
            if (isset($data["size"]) && $data["size"] === '') {
                $errors['size'] = "Kích thước không được để trống.";
            }
            if (isset($data["product"]) && $data["product"] === '') {
                $errors['product'] = "Kích thước không được để trống.";
            }

            if (!empty($data['sku'])) {
                if (strlen($data['sku']) > 50) {
                    $errors['sku'] = "SKU không được vượt quá 50 ký tự.";
                }
            } else {
                $errors['sku'] = "SKU không được để trống.";
            }

            if (!empty($data['price'])) {
                if (!is_numeric($data['price'])) {
                    $errors['price'] = "Giá phải là một số.";
                } elseif ($data['price'] < 0) {
                    $errors['price'] = "Giá không được là số âm.";
                }
            } else {
                $errors['price'] = "Giá không được để trống.";
            }

            if (!empty($data['quantity'])) {
                if (!is_numeric($data['quantity'])) {
                    $errors['quantity'] = "Số lượng phải là một số.";
                } elseif ($data['quantity'] < 0) {
                    $errors['quantity'] = "Số lượng không được là số âm.";
                }
            } else {
                $errors['quantity'] = "Số lượng không được để trống.";
            }

            return $errors;
        }
    }
