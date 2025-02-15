<section class="breadcrumb-section set-bg" data-setbg="<?= BASE_URL ?>view/layouts/client/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Thanh Toán</h2>
                    <div class="breadcrumb__option">
                        <a href="<?= BASE_URL ?>">Trang Chủ</a>
                        <span>Thanh Toán</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Kết thúc Breadcrumb Section -->

<!-- Bắt đầu phần Thanh Toán -->
<section class="checkout spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h6><span class="icon_tag_alt"></span> Có mã giảm giá? <a href="#">Nhấn vào đây</a> để nhập mã
                </h6>
            </div>
        </div>
        <div class="checkout__form">
            <h4>Chi Tiết Thanh Toán</h4>
            <form action="#">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Tên<span>*</span></p>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Họ<span>*</span></p>
                                    <input type="text">
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Quốc gia<span>*</span></p>
                            <input type="text">
                        </div>
                        <div class="checkout__input">
                            <p>Địa chỉ<span>*</span></p>
                            <input type="text" placeholder="Địa chỉ đường phố" class="checkout__input__add">
                            <input type="text" placeholder="Căn hộ, dãy phòng, v.v. (tùy chọn)">
                        </div>
                        <div class="checkout__input">
                            <p>Thành phố/Thị trấn<span>*</span></p>
                            <input type="text">
                        </div>
                        <div class="checkout__input">
                            <p>Quận/Huyện<span>*</span></p>
                            <input type="text">
                        </div>
                        <div class="checkout__input">
                            <p>Mã bưu điện / ZIP<span>*</span></p>
                            <input type="text">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Số điện thoại<span>*</span></p>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="text">
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input__checkbox">
                            <label for="acc">
                                Tạo tài khoản?
                                <input type="checkbox" id="acc">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <p>Tạo tài khoản bằng cách nhập thông tin bên dưới. Nếu bạn đã có tài khoản, vui lòng đăng nhập ở đầu trang.</p>
                        <div class="checkout__input">
                            <p>Mật khẩu tài khoản<span>*</span></p>
                            <input type="text">
                        </div>
                        <div class="checkout__input__checkbox">
                            <label for="diff-acc">
                                Giao hàng đến địa chỉ khác?
                                <input type="checkbox" id="diff-acc">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="checkout__input">
                            <p>Ghi chú đơn hàng<span>*</span></p>
                            <input type="text" placeholder="Ghi chú về đơn hàng, ví dụ: hướng dẫn giao hàng đặc biệt.">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Đơn Hàng Của Bạn</h4>
                            <div class="checkout__order__products">Sản phẩm <span>Tổng cộng</span></div>
                            <ul>
                                <?php foreach ($carts as $key => $cart) : ?>
                                    <li><?= $cart['name'] . ' x ' . $cart['quantity'] ?> <span>$<?= formatCurrencyVND($cart['price']) ?></span></li>
                                <?php endforeach; ?>
                            </ul>
                            <div class="checkout__order__subtotal">Tạm tính <span><?= formatCurrencyVND($totalCarts ?? 0) ?></span></div>
                            <div class="checkout__order__total">Tổng cộng <span><?= formatCurrencyVND($totalCarts ?? 0) ?></span></div>
                            <div class="checkout__input__checkbox">
                                <label for="acc-or">
                                    Tạo tài khoản?
                                    <input type="checkbox" id="acc-or">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            <div class="checkout__input__checkbox">
                                <label for="payment">
                                    Thanh toán bằng séc
                                    <input type="checkbox" id="payment">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="paypal">
                                    Thanh toán qua Paypal
                                    <input type="checkbox" id="paypal">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <button type="submit" class="site-btn">ĐẶT HÀNG</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>