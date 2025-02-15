<section class="breadcrumb-section set-bg" data-setbg="<?= BASE_URL ?>view/layouts/client/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Giỏ Hàng</h2>
                    <div class="breadcrumb__option">
                        <a href="<?= BASE_URL ?>">Trang Chủ</a>
                        <span>Giỏ Hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="cart-items">
                            <?php foreach ($carts as $cart) { ?>
                                <tr data-id="<?= $cart['id'] ?>">
                                    <td class="shoping__cart__item">
                                        <img style="height: 40px; width: 40px; object-fit: cover;" src="<?= BASE_URL . $cart['thumbnail'] ?>" alt="">
                                        <h5><?= $cart['name'] ?></h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        <?= formatCurrencyVND($cart['price']) ?>
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value=<?= $cart['quantity'] ?> class="cart-quantity">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        <?= formatCurrencyVND($cart['price'] * $cart['quantity']) ?>
                                    </td>
                                    <td class="shoping__cart__item__close" data-id="<?= $cart['id'] ?>">
                                        <span class="icon_close"></span>
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php if (empty($carts)) { ?>
                                <tr>
                                    <td colspan="5" style="text-align: center;">Không có sản phẩm nào trong giỏ hàng</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns d-flex justify-content-between">
                    <a href="<?= BASE_URL ?>shop" class="primary-btn cart-btn">TIẾP TỤC MUA SẮM</a>
                    <a href="#" class="primary-btn " id="update-cart">
                        Cập nhật giỏ hàng</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__continue">
                    <div class="shoping__discount">
                        <h5>Mã giảm giá</h5>
                        <form action="#">
                            <input type="text" placeholder="Nhập mã giảm giá của bạn">
                            <button type="submit" class="site-btn">ÁP DỤNG</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php
            $total_price = 0;
            foreach ($carts as $cart) {
                $total_price += $cart['price'] * $cart['quantity'];
            }
            ?>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Tổng giỏ hàng</h5>
                    <ul>
                        <li>Tạm tính <span><?= formatCurrencyVND($total_price) ?></span></li>
                        <li>Tổng cộng <span><?= formatCurrencyVND($total_price) ?></span></li>
                    </ul>
                    <a href="<?= BASE_URL ?>checkout" class="primary-btn">TIẾN HÀNH THANH TOÁN</a>
                </div>

            </div>
        </div>
    </div>
</section>
<script>
    const url = "<?= BASE_URL . 'carts' ?>";

    document.getElementById('update-cart').addEventListener('click', function() {
        let cartData = [];

        document.querySelectorAll('#cart-items tr').forEach(row => {
            let id = row.getAttribute('data-id');
            let quantity = row.querySelector('.cart-quantity').value;

            // Thêm vào danh sách
            cartData.push({
                id,
                quantity: parseInt(quantity)
            });
        });
        fetch(url, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    data: cartData
                }) // Chuyển object thành JSON string
            })
            .then(response => response.json())
            .then(data => {
                console.log(data); // Kiểm tra kết quả

                Toastify({
                    text: "Cập nhật giỏ hàng thành công",
                    duration: 3000,
                    newWindow: true,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover

                    style: {
                        background: "green",
                    },
                    onClick: function() {} // Callback after click
                }).showToast();
                window.location.reload();

            });
        // updateCart(cartData); // Gửi dữ liệu lên server
    });

    document.querySelectorAll('.shoping__cart__item__close').forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault();
            const id = this.getAttribute('data-id');
            fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id: id
                    }) // Chuyển object thành JSON string
                })
                .then(response => response.json())
                .then(data => {
                    Toastify({
                        text: "Thêm vào giỏ hàng thành công",
                        duration: 3000,
                        newWindow: true,
                        close: true,
                        gravity: "top", // `top` or `bottom`
                        position: "right", // `left`, `center` or `right`
                        stopOnFocus: true, // Prevents dismissing of toast on hover

                        style: {
                            background: "green",
                        },
                        onClick: function() {} // Callback after click
                    }).showToast();
                    window.location.reload();
                });
        });
    });
</script>