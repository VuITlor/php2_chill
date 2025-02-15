<h1>Danh sách biến thể</h1>
<a href="product-variants/create" class="btn btn-primary mb-3">Tạo biến thể</a>
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Sản phẩm</th>
            <th>SKU</th>
            <th>Màu</th>
            <th>Kích thước</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($variants as $variant): ?>
            <tr>
                <td><?= $variant['id'] ?></td>
                <td><?= $variant['product_name'] ?></td>
                <td><?= $variant['sku'] ?></td>
                <td><?= $variant['color'] ?></td>
                <td><?= $variant['size'] ?></td>
                <td><?= $variant['quantity'] ?></td>
                <td><?= formatCurrencyVND($variant['price']) ?></td>
                <td>
                    <!-- <a href="/variants/<?= $variant['id'] ?>" class="btn btn-info btn-sm">View</a> -->
                    <a href="product-variants/edit/<?= $variant['id'] ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-fill"></i></a>
                    <a href="product-variants/delete/<?= $variant['id'] ?>" class="btn btn-danger btn-sm"><i class="bi bi-archive-fill"></i></a>
                </td>
            </tr>

        <?php endforeach; ?>
        <?php if (empty($variants)): ?>
            <tr>
                <td colspan="8" class="text-center">Không có dữ liệu!</td>
            </tr>
        <?php endif; ?>

    </tbody>
</table>