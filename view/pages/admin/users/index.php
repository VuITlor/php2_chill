<h1>Danh Sách Người Dùng</h1>
<a href="<?= BASE_URL; ?>register/create" class="btn btn-primary mb-3">Tạo Người Dùng</a>
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Vai Trò</th>
            <th>Hành Động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['role'] ?></td>
            <td>
                <a href="<?= BASE_URL; ?>admin/users/edit/<?= $user['id'] ?>" class="btn btn-warning btn-sm">Chỉnh Sửa</a>
                <a href="<?= BASE_URL; ?>admin/users/delete/<?= $user['id'] ?>" class="btn btn-danger btn-sm">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
