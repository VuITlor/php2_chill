<!-- Phần Breadcrumb Begin -->
<style>
    /* Style for size links */
    .size-link {
        padding: 5px 10px;
        border: 1px solid #ccc;
        margin-right: 5px;
        text-decoration: none;
        color: #333;
        /* Default color */
        border-radius: 3px;
        cursor: pointer;
        /* Make it look clickable */
        transition: background-color 0.3s, color 0.3s, border-color 0.3s;
        /* Smooth transitions */
    }

    .size-link:hover {
        background-color: #eee;
    }

    .size-link.active {
        background-color: #ddd;
        border-color: #999;
    }


    /* Style for color options in the dropdown */
    #colorSelect option {
        /* You can add padding, background color, etc. here if needed */
    }

    /* Style to visually link the color with the selected size */
    .size-link.active {
        color: #007bff;
        /* Example: A blue color */
        border-color: #007bff;
    }

    /* More dynamic approach (if you want to use the actual color names) */
    /* This requires you to store color values in your variant data */
    .size-link[data-color="Black"] {
        color: black;
        border-color: black;
    }

    .size-link[data-color="White"] {
        color: white;
        border-color: white;
    }

    .size-link[data-color="Red"] {
        color: red;
        border-color: red;
    }

    /* ... add more color styles as needed ... */

    /* Or even more dynamic if your colors are hex codes */
    /* (You'd need to set the data-color attribute with the hex code) */
    .size-link[data-color^="#"] {
        /* Matches any data-color starting with # */
        color: attr(data-color);
        border-color: attr(data-color);
    }


    /* Style for the "X" (clear) link */
    .heart-icon {
        color: red;
        margin-left: 5px;
        text-decoration: none;
        cursor: pointer;
    }
</style>
<section class="breadcrumb-section set-bg" data-setbg="<?= BASE_URL ?>view/layouts/client/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2><?= $product['name'] ?></h2>
                    <div class="breadcrumb__option">
                        <a href="<?= BASE_URL ?>">Trang chủ</a>
                        <!-- <a href="./index.html">Rau Củ</a> -->
                        <span><?= $product['name'] ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Phần Breadcrumb End -->

<!-- Phần Chi Tiết Sản Phẩm Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large" id="productImage"
                            src="<?= BASE_URL . $product['thumbnail'] ?>" alt="<?= $product['name'] ?>">
                    </div>
                    <!-- <div class="product__details__pic__slider owl-carousel">
                        <img data-imgbigurl="<?= BASE_URL ?>view/layouts/client/img/product/details/product-details-2.jpg"
                             src="img/product/details/thumb-1.jpg" alt="">
                        <img data-imgbigurl="<?= BASE_URL ?>view/layouts/client/img/product/details/product-details-3.jpg"
                             src="img/product/details/thumb-2.jpg" alt="">
                        <img data-imgbigurl="<?= BASE_URL ?>view/layouts/client/img/product/details/product-details-5.jpg"
                             src="img/product/details/thumb-3.jpg" alt="">
                        <img data-imgbigurl="<?= BASE_URL ?>view/layouts/client/img/product/details/product-details-4.jpg"
                             src="img/product/details/thumb-4.jpg" alt="">
                    </div> -->
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3><?= $product['name'] ?></h3>
                    <div class="product__details__rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <span>(18 đánh giá)</span>
                    </div>
                    <div class="product__details__price"><?= formatCurrencyVND($product['price']) ?></div>
                    <!-- <p>Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vestibulum ac diam sit amet quam
                        vehicula elementum sed sit amet dui. Sed porttitor lectus nibh. Vestibulum ac diam sit amet
                        quam vehicula elementum sed sit amet dui. Proin eget tortor risus.</p> -->
                    <div class="product__details__quantity">
                        <div class="quantity">
                            <div class="pro-qty">
                                <input type="text" value="1" id="quantity" min="1">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="productId" value="<?= $product['id'] ?>">
                    <input type="hidden" id="productName" value="<?= $product['name'] ?>">
                    <input type="hidden" id="productPrice" value="<?= $product['price'] ?>">
                    <input type="hidden" id="productBasePrice" value="<?= $product['base_price'] ?>">
                    <input type="hidden" id="productThumbnail" value="<?= $product['thumbnail'] ?>">
                    <a href="#" class="primary-btn" id="addToCart">THÊM VÀO GIỎ</a>
                    <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                    <div class="size">
                        <b>Kích thước</b>
                        <div>
                        </div>
                    </div>
                    <div class="color">
                        <b>Màu sắc</b>
                        <div id="colorSelect">
                        </div>
                    </div>
                    <ul>
                        <li><b>Tình trạng</b> <span>Còn hàng</span></li>
                        <li><b>Vận chuyển</b> <span>Giao hàng trong 01 ngày. <samp>Nhận hàng miễn phí hôm nay</samp></span></li>
                        <li><b>Cân nặng</b> <span>0.5 kg</span></li>
                        <li><b>Chia sẻ trên</b>
                            <div class="share">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab" aria-selected="true">Mô tả</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab" aria-selected="false">Thông tin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab" aria-selected="false">Đánh giá <span>(1)</span></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Thông tin sản phẩm</h6>
                                <?= $product['description'] ?>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Thông tin sản phẩm</h6>
                                <?= $product['description'] ?>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Thông tin sản phẩm</h6>
                                <?= $product['description'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Phần Chi Tiết Sản Phẩm End -->

<!-- Phần Sản Phẩm Liên Quan Begin -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Sản phẩm liên quan</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="product__discount__slider owl-carousel">
                <?php foreach ($products as $product): ?>
                    <div class="col-lg-4">
                        <div class="product__discount__item">
                            <div class="product__discount__item__pic set-bg"
                                data-setbg="<?= BASE_URL . $product['thumbnail'] ?> ">
                                <!-- <div class="product__discount__percent">-20%</div> -->
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="<?= BASE_URL . 'products/' . $product['id'] ?>"><i class="fa fa-eye"></i></a></li>
                                    <li class="product-item" data-id="<?= $product['id'] ?>">
                                        <a>
                                            <i class="fa fa-shopping-cart"></i>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                            <div class="product__discount__item__text">
                                <span><?= $product['category_name'] ?></span>
                                <h5><a href="#"><?= $product['name'] ?></a></h5>
                                <div class="product__item__price"><?= formatCurrencyVND($product['price']) ?> <span><?= formatCurrencyVND($product['base_price']) ?></span></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<!-- Phần Sản Phẩm Liên Quan End -->

<script>
    const BASE_URL = <?= json_encode(BASE_URL) ?>;
    const variants = <?= json_encode($variants) ?>;
    const products = <?= json_encode($products) ?>;

    /** Lấy danh sách kích thước duy nhất */
    function getUniqueSizes(variants) {
        return [...new Set(variants.map(variant => variant.size))];
    }

    /** Lọc màu theo kích thước */
    function filterColorsBySize(variants, size) {
        return [...new Set(variants.filter(variant => variant.size === size).map(variant => variant.color))];
    }

    /** Cập nhật danh sách kích thước */
    function renderSizes(variants) {
        const sizeContainer = document.querySelector(".size > div");
        sizeContainer.innerHTML = "";

        getUniqueSizes(variants).forEach(size => {
            const sizeLink = document.createElement("a");
            sizeLink.href = "#";
            sizeLink.textContent = size;
            sizeLink.classList.add("size-link");
            sizeLink.addEventListener("click", (event) => {
                event.preventDefault();
                document.querySelectorAll('.size-link').forEach(link => link.classList.remove('active'));
                sizeLink.classList.add('active');
                updateColorsAndImage(size);
            });

            sizeContainer.appendChild(sizeLink);
            sizeContainer.appendChild(document.createTextNode(" "));
        });

        if (sizeContainer.children.length > 0) {
            sizeContainer.firstChild.click();
        }
    }

    /** Cập nhật danh sách màu sắc và hình ảnh */
    function updateColorsAndImage(selectedSize) {
        const colorSelect = document.getElementById("colorSelect");
        colorSelect.innerHTML = "";
        filterColorsBySize(variants, selectedSize).forEach(color => {
            const option = document.createElement("option");
            option.value = color;
            option.textContent = color;
            colorSelect.appendChild(option);
        });

        colorSelect.addEventListener("change", () => {
            updateImage(selectedSize, colorSelect.value);
        });

        updateImage(selectedSize, colorSelect.value || "");
    }

    /** Cập nhật hình ảnh sản phẩm */
    function updateImage(selectedSize, selectedColor) {
        const productImage = document.getElementById("productImage");
        const variant = variants.find(v => v.size === selectedSize && (!selectedColor || v.color === selectedColor));

        if (variant) {
            productImage.src = BASE_URL + variant.img_url;
            productImage.alt = `Ảnh sản phẩm - ${variant.color || "Không xác định"} - ${variant.size}`;
            document.querySelector('.product__details__price').innerText = variant.price.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        } else {
            productImage.src = "placeholder_image.jpg";
            productImage.alt = "Không có ảnh";
        }
    }

    /** Xử lý thêm vào giỏ hàng */
    function addToCartHandler(event) {
        event.preventDefault();
        const url = `${BASE_URL}carts`;
        const data = {
            id: document.getElementById('productId').value,
            quantity: document.getElementById('quantity').value,
            name: document.getElementById('productName').value,
            price: document.getElementById('productPrice').value,
            thumbnail: document.getElementById('productThumbnail').value,
            base_price: document.getElementById('productBasePrice').value
        };

        addToCart(url, data).then(updateCartUI).catch(() => showToast("Có lỗi xảy ra, vui lòng thử lại!", "red"));
    }

    /** Xử lý thêm sản phẩm liên quan vào giỏ hàng */
    function addRelatedToCartHandler(event) {
        event.preventDefault();
        const productId = this.getAttribute('data-id');
        const product = products.find(product => product.id == productId);

        if (product) {
            const url = `${BASE_URL}carts`;
            const data = { id: product.id, quantity: 1, name: product.name, price: product.price, thumbnail: product.thumbnail, base_price: product.base_price };

            addToCart(url, data).then(updateCartUI).catch(() => showToast("Có lỗi xảy ra, vui lòng thử lại!", "red"));
        }
    }

    /** Cập nhật giỏ hàng UI */
    function updateCartUI(result) {
        if (result.status === 'success') {
            let total = result.data.reduce((sum, item) => sum + item.price * item.quantity, 0);
            setCountCarts(result.data.length, total);
            showToast("Thêm vào giỏ hàng thành công", "green");
        } else {
            showToast("Thêm vào giỏ hàng thất bại", "red");
        }
    }

    /** Hiển thị thông báo Toastify */
    function showToast(message, bgColor) {
        Toastify({
            text: message,
            duration: 3000,
            gravity: "top",
            position: "right",
            style: { background: bgColor },
        }).showToast();
    }

    // Khởi tạo danh sách kích thước và sự kiện thêm giỏ hàng
    document.getElementById('addToCart').addEventListener('click', addToCartHandler);
    document.querySelectorAll('.product-item').forEach(item => item.addEventListener('click', addRelatedToCartHandler));
    renderSizes(variants);
</script>
