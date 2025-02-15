<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani </title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="<?= BASE_URL ?>view/layouts/client/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?= BASE_URL ?>view/layouts/client/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?= BASE_URL ?>view/layouts/client/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="<?= BASE_URL ?>view/layouts/client/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="<?= BASE_URL ?>view/layouts/client/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="<?= BASE_URL ?>view/layouts/client/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?= BASE_URL ?>view/layouts/client/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="<?= BASE_URL ?>view/layouts/client/css/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="<?= BASE_URL ?>"><img src="<?= BASE_URL ?>view/layouts/client/img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="<?= BASE_URL ?>carts"><i class="fa fa-shopping-bag"></i> <span class="cart-count"><?= $product_count ?? 0 ?></span></a></li>
            </ul>
            <div class="header__cart__price">Tổng: <span class="cart-total"><?= formatCurrencyVND($totalCarts ?? 0) ?></span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="<?= BASE_URL ?>view/layouts/client/img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
            <div class="header__top__right__auth">
                <a href="<?= BASE_URL ?>login"><i class="fa fa-user"></i> </a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="<?= BASE_URL ?>">Home</a></li>
                <li><a href="<?= BASE_URL ?>shop">Shop</a></li>
                <li><a href="<?= BASE_URL ?>blog">Blog</a></li>
                <li><a href="<?= BASE_URL ?>contact">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                <li>Free Shipping for all Order of $99</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                                <li>Free Shipping for all Order of $99</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            <div class="header__top__right__language">
                                <img src="<?= BASE_URL ?>view/layouts/client/img/language.png" alt="">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">Spanis</a></li>
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div>
                            <div class="header__top__right__auth">
                                <?php if (!isset($_SESSION['users'])): ?>
                                    <a href="<?= BASE_URL ?>login"><i class="fa fa-user"></i> Đăng nhập</a>
                                <?php else : ?>
                                    <div class="d-flex gap-2">
                                        <?php if (isset($user['role']) && $user['role'] === 'admin'): ?>
                                            <a href="<?= BASE_URL ?>admin"><i class="fa fa-user-shield"></i> Admin</a>
                                        <?php else: ?>
                                            <a href="<?= BASE_URL ?>user"><i class="fa fa-user"></i> <?= htmlspecialchars($user['name'] ?? '') ?></a>
                                        <?php endif; ?>
                                        <a href="<?= BASE_URL ?>logout"><i class="fa fa-sign-out"></i> Đăng xuất</a>
                                    </div>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="<?= BASE_URL ?>"><img src="<?= BASE_URL ?>view/layouts/client/img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="<?= BASE_URL ?>">Home</a></li>
                            <li><a href="<?= BASE_URL ?>shop">Shop</a></li>
                            <li><a href="<?= BASE_URL ?>blog">Blog</a></li>
                            <li><a href="<?= BASE_URL ?>contact">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                            <li><a href="<?= BASE_URL ?>carts"><i class="fa fa-shopping-bag"></i> <span class="cart-count"><?= $product_count ?? 0 ?></span></a></li>
                        </ul>
                        <div class="header__cart__price">Tổng: <span class="cart-total"> <?= formatCurrencyVND($totalCarts ?? 0) ?></span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <?= $content ?>
    <!-- Hero Section Begin -->


    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="<?= BASE_URL ?>"><img src="<?= BASE_URL ?>view/layouts/client/img/logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Địa chỉ: 60-49 Đường 11378 New York</li>
                            <li>Điện thoại: +65 11.188.888</li>
                            <li>Email: hello@colorlib.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Liên Kết Hữu Ích</h6>
                        <ul>
                            <li><a href="#">Giới Thiệu</a></li>
                            <li><a href="#">Về Cửa Hàng Của Chúng Tôi</a></li>
                            <li><a href="#">Mua Sắm An Toàn</a></li>
                            <li><a href="#">Thông Tin Giao Hàng</a></li>
                            <li><a href="#">Chính Sách Bảo Mật</a></li>
                            <li><a href="#">Sơ Đồ Trang Web</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Chúng Tôi Là Ai</a></li>
                            <li><a href="#">Dịch Vụ Của Chúng Tôi</a></li>
                            <li><a href="#">Dự Án</a></li>
                            <li><a href="#">Liên Hệ</a></li>
                            <li><a href="#">Đổi Mới</a></li>
                            <li><a href="#">Khách Hàng Nhận Xét</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Tham Gia Nhận Bản Tin Của Chúng Tôi</h6>
                        <p>Nhận các cập nhật qua E-mail về cửa hàng và ưu đãi đặc biệt của chúng tôi.</p>
                        <form action="#">
                            <input type="text" placeholder="Nhập email của bạn">
                            <button type="submit" class="site-btn">Đăng Ký</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text">
                            <p><!-- Không được xóa liên kết đến Colorlib. Template được cấp phép theo CC BY 3.0. -->
                                Bản quyền &copy;<script>
                                    document.write(new Date().getFullYear());
                                </script> Tất cả quyền được bảo lưu | Mẫu này được thực hiện với <i class="fa fa-heart" aria-hidden="true"></i> bởi <a href="https://colorlib.com" target="_blank">Colorlib</a>
                                <!-- Không được xóa liên kết đến Colorlib. Template được cấp phép theo CC BY 3.0. -->
                            </p>
                        </div>
                        <div class="footer__copyright__payment">
                            <img src="<?= BASE_URL ?>view/layouts/client/img/payment-item.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="<?= BASE_URL ?>view/layouts/client/js/jquery-3.3.1.min.js"></script>
    <script src="<?= BASE_URL ?>view/layouts/client/js/bootstrap.min.js"></script>
    <script src="<?= BASE_URL ?>view/layouts/client/js/jquery.nice-select.min.js"></script>
    <script src="<?= BASE_URL ?>view/layouts/client/js/jquery-ui.min.js"></script>
    <script src="<?= BASE_URL ?>view/layouts/client/js/jquery.slicknav.js"></script>
    <script src="<?= BASE_URL ?>view/layouts/client/js/mixitup.min.js"></script>
    <script src="<?= BASE_URL ?>view/layouts/client/js/owl.carousel.min.js"></script>
    <script src="<?= BASE_URL ?>view/layouts/client/js/main.js"></script>
    <script src="<?= BASE_URL ?>view/layouts/client/js/request.js"></script>
    <?php if (isset($_SESSION['success'])): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '<?= $_SESSION['success'] ?>',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Thất bại!',
                text: '<?= $_SESSION['error'] ?>',
                timer: 2000,
                // showConfirmButton: false
            });
        </script>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

</body>

</html>