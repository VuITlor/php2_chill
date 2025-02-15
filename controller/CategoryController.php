<?php
require_once "model/CategoryModel.php";
require_once "view/helpers.php";

class CategoryController
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }
    public function index()
    {
        $categories = $this->categoryModel->getAllCategories();
        renderView("view/pages/admin/category/index.php", compact('categories'), "Category List");
    }
    public function show($id)
    {
        $category = $this->categoryModel->getCategoryById($id);
        renderView("view/pages/admin/category/show.php", compact('category'), "Category Detail");
    }
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];

            $errors = $this->validateCategory(['name' => $name, 'description' => $description]);
            if (empty($errors)) {
                $this->categoryModel->createCategory($name, $description);
                $_SESSION['message'] = "Danh mục đã được tạo thành công.";
                redirect('/admin/category');
            } else {
                renderView("view/pages/admin/category/create.php", compact('errors', 'name', 'description'), "Create Category");
            }
        } else {
            renderView("view/pages/admin/category/create.php", [], "Create Category");
        }
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->categoryModel->deleteCategory($id);
            $_SESSION['message'] = "Danh mục đã được xóa thành công.";
            redirect('/admin/category');
        } else {
            $category = $this->categoryModel->getCategoryById($id);
            renderView("view/pages/admin/category/delete.php", compact('category'), "Delete Confirmation");
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $errors = $this->validateCategory(['name' => $name, 'description' => $description]);

            if (!empty($errors)) {
                renderView("view/pages/admin/category/edit.php", compact('errors', 'name', 'description'), "Edit Category");
            } else {
                $this->categoryModel->updateCategory($id, $name, $description);
                $_SESSION['message'] = "Danh mục đã được cập nhật thành công.";
                redirect('/admin/category');
            }
        } else {
            $category = $this->categoryModel->getCategoryById($id);
            renderView("view/pages/admin/category/edit.php", compact('category'), "Edit Category");
        }
    }

    private function validateCategory($category)
    {
        $errors = [];
        if (empty($category['name'])) {
            $errors['name'] = "Vui lòng điền tên";
        }
        if (empty($category['description'])) {
            $errors['description'] = "Vui lòng điền mô tả";
        }
        return $errors;
    }
}
