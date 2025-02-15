<?php
require_once "Database.php";

class ProductModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllProducts()
    {
        $query = "SELECT products.*, categories.name AS category_name 
        FROM products 
        LEFT JOIN categories ON products.category = categories.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id)
    {
        $query = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createProduct($name, $description, $price, $thumbnail, $quantity, $base_price, $category)
    {
        $query = "INSERT INTO products (name, description, price, thumbnail, quantity, base_price, category) 
        VALUES (:name, :description, :price, :thumbnail, :quantity, :base_price, :category)";

        $stmt = $this->conn->prepare($query);

        // Bind parameters to the query
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':thumbnail', $thumbnail);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':base_price', $base_price);
        $stmt->bindParam(':category', $category);

        // Execute the statement and return the result
        return $stmt->execute();
    }

    public function updateProduct($id, $name, $description, $price, $thumbnail, $quantity, $base_price, $category)
    {
        $query = "UPDATE products 
                  SET name = :name, description = :description, price = :price, thumbnail = :thumbnail, 
                      quantity = :quantity, base_price = :base_price, category = :category 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':thumbnail', $thumbnail);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':base_price', $base_price);
        $stmt->bindParam(':category', $category);

        return $stmt->execute();
    }

    public function deleteProduct($id)
    {
        $query = "DELETE FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
