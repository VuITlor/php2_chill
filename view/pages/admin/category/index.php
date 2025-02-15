<h1>Danh Sách Danh Mục</h1>
<a href="<?= BASE_URL; ?>admin/category/create" class="btn btn-primary mb-3">Tạo Danh Mục</a>
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Mô Tả</th>
            <th>Hành Động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $category): ?>
        <tr>
            <td><?= $category['id'] ?></td>
            <td><?= $category['name'] ?></td>
            <td><?= $category['description'] ?></td>
            <td>
                <!-- <a href="<?= BASE_URL; ?>category/<?= $category['id'] ?>" class="btn btn-info btn-sm">Xem</a> -->
                <a href="<?= BASE_URL; ?>admin/category/edit/<?= $category['id'] ?>" class="btn btn-warning btn-sm">Chỉnh Sửa</a>
                <a href="<?= BASE_URL; ?>admin/category/delete/<?= $category['id'] ?>" class="btn btn-danger btn-sm">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
