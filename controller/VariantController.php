    <?php
    require_once "model/VariantModel.php";
    require_once "view/helpers.php";
    require_once "functions.php";
    class VariantController {
        private $variantModel;

        public function __construct() {
            $this->variantModel = new VariantModel();
        }

        public function index() {
            $variants = $this->variantModel->getAllVariants();
            renderView("view/pages/admin/variants/index.php", compact('variants'), "Product List");
        }

        public function show($id) {
            $product = $this->variantModel->getVariantById($id);
            renderView("view/products/show.php", compact('product'), "Product Detail");
        }    

        public function create() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $value = $_POST['value'];
                $type = $_POST['type'];
        
                $errors = $this->validateVariant(['value' => $value, 'type' => $type]);
                if (!empty($errors)) {
                    renderView("view/pages/admin/variants/create.php", compact('errors', 'value', 'type',), "Create Variant");
                } else {
                    $this->variantModel->createVariant($value, $type);
                    $_SESSION['message'] = "Biến thể đã được tạo thành công.";
                    redirect("/admin/variants");
                }
            } else {
                renderView("view/pages/admin/variants/create.php", [], "Create Variant");
            }
        }
        

        public function edit($id) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $value = $_POST['value'];
                $type = $_POST['type'];
        
                $this->variantModel->updateVariant($id, $value, $type);
                $_SESSION['message'] = "Variant đã được cập nhật thành công.";
                redirect("/admin/variants");
            } else {
                $variant = $this->variantModel->getVariantById($id);
                renderView("view/pages/admin/variants/edit.php", compact('variant'), "Edit Variant");
            }
        }
        
        public function delete($id) {
            $this->variantModel->deleteVariant($id);
            $_SESSION['message'] = "Biến thể đã được xóa thành công.";
            redirect("/admin/variants");
        }
        
        private function validateVariant($product) {
            $errors = [];
            if (empty($product['value'])) {
                $errors['value'] = "Vui lòng nhập giá trị biến thể";
            }
            if (empty($product['type'])) {
                $errors['type'] = "Vui lòng nhập loại biến thể";
            }
            return $errors;
        }
    }