<h1>Danh Sách Biến Thể</h1>
<a href="variants/create" class="btn btn-primary mb-3">Tạo Biến Thể</a>
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Giá Trị</th>
            <th>Loại</th>
            <th>Hành Động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($variants as $variant): ?>
            <tr>
                <td><?= $variant['id'] ?></td>
                <td><?= $variant['value'] ?></td>
                <td><?= $variant['type'] ?></td>
                <td>
                    <!-- <a href="/variants/<?= $variant['id'] ?>" class="btn btn-info btn-sm">Xem</a> -->
                    <a href="variants/edit/<?= $variant['id'] ?>" class="btn btn-warning btn-sm">Chỉnh Sửa</a>
                    <a href="variants/delete/<?= $variant['id'] ?>" class="btn btn-danger btn-sm">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>

        <?php if (empty($variants)): ?>
            <tr>
                <td colspan="4" class="text-center">Không có dữ liệu</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>