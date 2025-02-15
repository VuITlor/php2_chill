<?php
require_once "Database.php";

class UserModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllUsers()
    {
        $query = "SELECT * FROM users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id)
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function register($name, $email, $password, $phone)
    {
        try {
            // Kiểm tra xem email đã tồn tại hay chưa
            $checkQuery = "SELECT COUNT(*) FROM users WHERE email = :email";
            $checkStmt = $this->conn->prepare($checkQuery);
            $checkStmt->bindParam(':email', $email);
            $checkStmt->execute();

            if ($checkStmt->fetchColumn() > 0) {
                // Nếu email đã tồn tại, ném ra ngoại lệ
                throw new Exception("Email đã tồn tại. Vui lòng sử dụng email khác.");
            }

            // Hash mật khẩu
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Chèn người dùng mới
            $query = "INSERT INTO users (name, email, password, phone) VALUES (:name, :email, :password, :phone)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':phone', $phone);

            return $stmt->execute();
        } catch (Exception $e) {
            // Bắt lỗi và trả về thông báo
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }
    public function update($id, $name, $email, $password, $phone)
    {
        $query = "UPDATE users SET name = :name, email = :email, password = :password, phone = :phone WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':phone', $phone);
        return $stmt->execute();
    }
    public function createToken($id, $token, $email)
    {
        $query = "INSERT INTO reset_password (user_id, token, email) VALUES (:user_id, :token, :email)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $id);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':token', $token);
        return $stmt->execute();
    }
    public function getUserByToken($token)
    {
        $query = "SELECT * FROM reset_password WHERE token = :token";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function login($email, $password)
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    public function getUserRoleByEmail($email)
    {
        $stmt = $this->conn->prepare("SELECT role FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $result = $stmt->fetch();
        return $result ? $result['role'] : null;
    }
}
