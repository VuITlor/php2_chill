<?php
require_once "Database.php";

class VariantModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllVariants()
    {
        $query = "SELECT * FROM variants";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVariantById($id)
    {
        $query = "SELECT * FROM variants WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createVariant($value, $type)
    {
        $query = "INSERT INTO variants (value, type) VALUES (:value, :type)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':type', $type);
        return $stmt->execute();
    }

    public function updateVariant($id, $value, $type)
    {
        $query = "UPDATE variants SET value = :value, type = :type WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':type', $type);
        return $stmt->execute();
    }

    public function deleteVariant($id)
    {
        try {
            // Kiểm tra nếu ID hợp lệ
            if (empty($id) || !is_numeric($id)) {
                throw new Exception("ID không hợp lệ!");
            }

            // Kiểm tra nếu có giao dịch trước khi bắt đầu
            if (!$this->conn->inTransaction()) {
                $this->conn->beginTransaction();
            }

            // Xóa bản ghi
            $query = "DELETE FROM variants WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Kiểm tra xem có bản ghi nào bị xóa không
            if ($stmt->rowCount() === 0) {
                throw new Exception("Không có bản ghi nào bị xóa. Kiểm tra ID có tồn tại không.");
            }

            // Cập nhật lại ID
            resetAutoIncrement($this->conn, 'variants');

            // Commit giao dịch nếu mọi thứ OK
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            // Chỉ rollback nếu giao dịch đang hoạt động
            if ($this->conn->inTransaction()) {
                $this->conn->rollBack();
            }
            error_log("Lỗi xóa variant: " . $e->getMessage()); // Ghi lỗi vào log
            return false;
        }
    }
}
