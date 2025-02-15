<h1>Edit Variant</h1>
<form method="POST">
    <div class="mb-3">
        <label for="value" class="form-label">Value</label>
        <input type="text" class="form-control" id="value" name="value" value="<?= $variant['value'] ?>">
    </div>
    <div class="mb-3">
        <label for="type" class="form-label">Type</label>
        <select class="form-control" id="type" name="type" value="<?= $variant['type'] ?>">
            <option value="Màu sắc" <?= isset($type) && $type == 'Màu sắc' ? 'selected' : ''; ?>>Màu sắc</option>
            <option value="Kích thước" <?= isset($type) && $type == 'Kích thước' ? 'selected' : ''; ?>>Kích thước</option>
        </select>
        <?php if (isset($errors['type'])): ?>
            <div class="text-danger"><?= $errors['type']; ?></div>
        <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-warning">Update</button>
</form>