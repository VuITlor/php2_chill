<h1>Chỉnh Sửa Danh Mục</h1>
<form method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Tên</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $category['name'] ?>">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Mô Tả</label>
        <textarea class="form-control" id="description" name="description" rows="4"><?= $category['description'] ?></textarea>
    </div>
    <button type="submit" class="btn btn-warning">Cập Nhật</button>
</form>
