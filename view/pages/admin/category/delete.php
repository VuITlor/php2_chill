<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận xóa</title>
</head>

<body>
    <h1>Xác nhận xóa danh mục</h1>
    <p>Bạn có chắc chắn muốn xóa danh mục: <strong><?= htmlspecialchars($category['name']) ?></strong> không?</p>
    <form method="POST" action="<?= BASE_URL; ?>admin/category/delete/<?= htmlspecialchars($category['id']) ?>">
        <button type="submit">Xóa</button>
        <a href="<?= BASE_URL; ?>admin/category">Hủy</a>
    </form>
</body>

</html>