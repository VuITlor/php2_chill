<h1>Danh Sách Sản Phẩm</h1>
<a href="<?= BASE_URL; ?>admin/products/create" class="btn btn-primary mb-3">Thêm Sản Phẩm</a>
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Tên Sản Phẩm</th>
            <th>Giá</th>
            <th>Mô Tả</th>
            <th>Hành Động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product['id'] ?></td>
                <td><?= $product['name'] ?></td>
                <td><?= $product['price'] ?></td>
                <td><?= $product['description'] ?></td>
                <td>
                    <a href="<?= BASE_URL; ?>admin/products/detail/<?= $product['id'] ?>" class="btn btn-info btn-sm">Xem</a>
                    <a href="<?= BASE_URL; ?>admin/products/edit/<?= $product['id'] ?>" class="btn btn-warning btn-sm">Chỉnh Sửa</a>
                    <a href="<?= BASE_URL; ?>admin/products/delete/<?= $product['id'] ?>" class="btn btn-danger btn-sm">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>