<h1>Create Variant</h1>
<form method="POST">
    <div class="mb-3">
        <label for="value" class="form-label">Value</label>
        <input type="text" class="form-control" id="value" name="value" value="<?= isset($value) ? $value : ''; ?>">
        <?php if (isset($errors['value'])): ?>
            <div class="text-danger"><?= $errors['value']; ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="type" class="form-label">Type</label>
        <select class="form-control" id="type" name="type">
            <option value="Màu sắc" <?= isset($type) && $type == 'Màu sắc' ? 'selected' : ''; ?>>Màu sắc</option>
            <option value="Kích thước" <?= isset($type) && $type == 'Kích thước' ? 'selected' : ''; ?>>Kích thước</option>
        </select>
        <?php if (isset($errors['type'])): ?>
            <div class="text-danger"><?= $errors['type']; ?></div>
        <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-success">Create</button>
    <a href="../variants" class="btn btn-danger">Back to list</a>
</form>