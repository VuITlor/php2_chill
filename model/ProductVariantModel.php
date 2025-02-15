<?php
require_once "Database.php";

class ProductVariantModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllProductVariants()
    {
        $query = "SELECT pv.*, p.name AS product_name 
                  FROM product_variants pv
                  INNER JOIN products p ON pv.product_id = p.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductVariantsById($id)
    {
        $query = "SELECT * FROM product_variants WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getVariantsByProductId($product_id)
    {
        $query = "SELECT * FROM product_variants WHERE product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['product_id' => $product_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function createProductVariants($size, $color, $price, $product_id, $sku, $quantity, $img_url)
    {
        $query = "INSERT INTO product_variants ( size, color, price, product_id, sku, quantity, img_url) VALUES (:size, :color, :price, :product_id, :sku, :quantity, :img_url)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':size', $size);
        $stmt->bindParam(':color', $color);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':img_url', $img_url);
        return $stmt->execute();
    }

    public function updateProductVariants($id, $size, $color, $price, $product_id, $sku, $quantity, $img_url)
    {
        $query = "UPDATE product_variants 
                  SET size = :size, 
                      color = :color, 
                      price = :price, 
                      product_id = :product_id, 
                      sku = :sku, 
                      quantity = :quantity,
                      img_url = :img_url
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':size', $size);
        $stmt->bindParam(':color', $color);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':img_url', $img_url);
        return $stmt->execute();
    }


    public function deleteProductVariants($id)
    {
        $query = "DELETE FROM product_variants WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
