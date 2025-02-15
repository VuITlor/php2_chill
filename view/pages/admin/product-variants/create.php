<h1>Tạo biến thể sản phẩm</h1>
<form method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="product" class="form-label">Sản phẩm</label>
            <select class="form-control" id="product" name="product">
                <?php foreach ($products as $product): ?>
                    <option value="<?= $product['id']; ?>" <?= isset($product) && $product == $product['name'] ? 'selected' : ''; ?>>
                        <?= $product['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($errors['product'])): ?>
                <div class="text-danger"><?= $errors['product']; ?></div>
            <?php endif; ?>
        </div>
        <div class="col-md-6 mb-3">
            <label for="color" class="form-label">Màu</label>
            <select class="form-control" id="color" name="color">
                <?php foreach ($colors as $color): ?>
                    <option value="<?= $color['value']; ?>" <?= isset($color) && $color == $color['value'] ? 'selected' : ''; ?>>
                        <?= $color['value']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($errors['color'])): ?>
                <div class="text-danger"><?= $errors['color']; ?></div>
            <?php endif; ?>
        </div>
        <div class="col-md-6 mb-3">
            <label for="size" class="form-label">Kích thước</label>
            <select class="form-control" id="size" name="size">
                <?php foreach ($sizes as $size): ?>
                    <option value="<?= $size['value']; ?>" <?= isset($size) && $size == $size['value'] ? 'selected' : ''; ?>>
                        <?= $size['value']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($errors['size'])): ?>
                <div class="text-danger"><?= $errors['size']; ?></div>
            <?php endif; ?>
        </div>
        <div class="col-md-6 mb-3">
            <label for="image" class="form-label">Hình ảnh</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            <?php if (isset($errors['image'])): ?>
                <div class="text-danger"><?= $errors['image']; ?></div>
            <?php endif; ?>
        </div>
        <div class="col-md-6 mb-3">
            <label for="price" class="form-label">Giá</label>
            <input type="text" class="form-control" id="price" name="price" value="<?= isset($price) ? $price : ''; ?>">
            <?php if (isset($errors['price'])): ?>
                <div class="text-danger"><?= $errors['price']; ?></div>
            <?php endif; ?>
        </div>
        <div class="col-md-6 mb-3">
            <label for="sku" class="form-label">SKU</label>
            <input type="text" class="form-control" id="sku" name="sku" value="<?= isset($sku) ? $sku : ''; ?>">
            <?php if (isset($errors['sku'])): ?>
                <div class="text-danger"><?= $errors['sku']; ?></div>
            <?php endif; ?>
        </div>
        <div class="col-md-6 mb-3">
            <label for="quantity" class="form-label">Số lượng</label>
            <input type="text" class="form-control" id="quantity" name="quantity" value="<?= isset($quantity) ? $quantity : ''; ?>">
            <?php if (isset($errors['quantity'])): ?>
                <div class="text-danger"><?= $errors['quantity']; ?></div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-success">Create</button>
            <a href="../product-variants" class="btn btn-danger">Back to list</a>
        </div>
    </div>
</form>