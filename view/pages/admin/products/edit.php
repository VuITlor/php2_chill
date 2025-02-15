<h1 class="text-center my-4">Tạo Sản Phẩm</h1>
<form method="POST" enctype="multipart/form-data">
    <div class="container">
        <div class="row">
            <!-- Product Name -->
            <div class="col-md-12 mb-3">
                <label for="name" class="form-label">Tên Sản Phẩm</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= isset($product['name']) ? $product['name'] : ''; ?>">
                <?php if (isset($errors['name'])): ?>
                    <div class="text-danger"><?= $errors['name']; ?></div>
                <?php endif; ?>
            </div>
            <div class="col-md-6 mb-3">
                <label for="price" class="form-label">Giá</label>
                <input type="number" class="form-control" id="price" name="price" value="<?= isset($product['price']) ? $product['price'] : ''; ?>" step="0.01">
                <?php if (isset($errors['price'])): ?>
                    <div class="text-danger"><?= $errors['price']; ?></div>
                <?php endif; ?>
            </div>
            <div class="col-md-6 mb-3">
                <label for="base_price" class="form-label">Giá cơ bản(Dành cho sản phẩm giảm giá)</label>
                <input type="number" class="form-control" id="base_price" name="base_price" value="<?= isset($product['base_price']) ? $product['base_price'] : ''; ?>" step="0.01">
                <?php if (isset($errors['base_price'])): ?>
                    <div class="text-danger"><?= $errors['base_price']; ?></div>
                <?php endif; ?>
            </div>
            <div class="col-md-6 mb-3">
                <label for="quantity" class="form-label">Giá cơ bản(Dành cho sản phẩm giảm giá)</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="<?= isset($product['quantity']) ? $product['quantity'] : ''; ?>" step="0.01">
                <?php if (isset($errors['quantity'])): ?>
                    <div class="text-danger"><?= $errors['quantity']; ?></div>
                <?php endif; ?>
            </div>
            <div class="col-md-6 mb-3">
            <label for="category" class="form-label">Danh muc</label>
            <select class="form-control" id="category" name="category">
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id']; ?>" <?= isset($product['category']) && $product['category'] == $category['id'] ? 'selected' : ''; ?>>
                        <?= $category['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($errors['category'])): ?>
                <div class="text-danger"><?= $errors['category']; ?></div>
            <?php endif; ?>
        </div>

            <!-- Product Description -->
            <div class="col-md-12 mb-3">
                <label for="description" class="form-label">Mô Tả</label>
                <textarea class="form-control" id="description" name="description" rows="4"><?= isset($product['description']) ? $product['description'] : ''; ?></textarea>
                <?php if (isset($errors['description'])): ?>
                    <div class="text-danger"><?= $errors['description']; ?></div>
                <?php endif; ?>
            </div>
            <div class="col-md-12 mb-3">
                <label for="image" class="form-label">Chọn Ảnh</label>
                <input type="file" class="form-control" name="image" id="image" accept="image/*">
                <?php if (isset($errors['image'])): ?>
                    <div class="text-danger"><?= $errors['image']; ?></div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Submit and Back Buttons -->
        <div class="row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-success w-100">Cập nhật</button>
            </div>
            <div class="col-md-6">
                <a href="<?= BASE_URL; ?>admin/products/" class="btn btn-danger w-100">Quay Lại Danh Sách</a>
            </div>
        </div>
    </div>
</form>