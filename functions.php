<?php
function redirect($path)
{
    $url = BASE_URL . ltrim($path, '/'); // Loại bỏ dấu `/` nếu có
    header("Location: $url");
    exit;
};
function resetAutoIncrement($conn, $table)
{
    // Kiểm tra xem bảng có bản ghi nào không
    $stmt = $conn->query("SELECT COUNT(*) FROM $table");
    $rowCount = $stmt->fetchColumn();

    if ($rowCount > 0) {
        // Cập nhật lại ID để không bị nhảy số
        $conn->exec("SET @count = 0;");
        $conn->exec("UPDATE $table SET id = (@count := @count + 1) ORDER BY id;");

        // Lấy ID lớn nhất hiện có
        $stmt = $conn->query("SELECT MAX(id) FROM $table");
        $maxId = $stmt->fetchColumn();

        // Nếu MAX(id) là NULL (trường hợp bảng rỗng), đặt AUTO_INCREMENT về 1
        $nextId = ($maxId !== null) ? $maxId + 1 : 1;
        $conn->exec("ALTER TABLE $table AUTO_INCREMENT = $nextId;");
    } else {
        // Nếu bảng rỗng, đặt AUTO_INCREMENT về 1
        $conn->exec("ALTER TABLE $table AUTO_INCREMENT = 1;");
    }
}
function formatCurrencyVND($amount)
{
    // Định dạng số với dấu phân cách hàng nghìn và không có chữ số thập phân
    $formattedAmount = number_format($amount, 0, ',', '.');
    return $formattedAmount . ' ₫';
}
function uploadImage($file, $uploadDir = 'uploads/', $maxSize = 5000000, $allowedExts = ['jpg', 'jpeg', 'png', 'gif']) {
    // Lấy thông tin chi tiết của tệp tin
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    // Lấy phần mở rộng của tệp tin
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Kiểm tra xem phần mở rộng của tệp có được phép không
    if (!in_array($fileExt, $allowedExts)) {
        return "Loại tệp không hợp lệ! Chỉ cho phép các tệp " . implode(", ", $allowedExts) . ".";
    }

    // Kiểm tra lỗi tải lên
    if ($fileError !== 0) {
        return "Đã có lỗi khi tải tệp lên.";
    }

    // Kiểm tra kích thước tệp
    if ($fileSize > $maxSize) {
        return "Tệp quá lớn! Kích thước tối đa là " . ($maxSize / 1000000) . "MB.";
    }

    // Tạo một tên ngẫu nhiên duy nhất cho ảnh
    $randomName = bin2hex(random_bytes(16));  // Tạo một chuỗi ngẫu nhiên dài 32 ký tự
    $newFileName = $randomName . '.' . $fileExt;

    // Đặt thư mục lưu trữ tệp tin
    $fileDestination = $uploadDir . $newFileName;

    // Tạo thư mục nếu nó không tồn tại
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Di chuyển tệp đã tải lên đến thư mục đích
    if (move_uploaded_file($fileTmpName, $fileDestination)) {
        $_SESSION['image'] = 'uploads/' . $newFileName; // Lưu tên ảnh vào session
        return true;
    } else {
        return "Đã có lỗi khi di chuyển tệp đã tải lên.";
    }
}
?>