<?php

function renderView($view, $data = [], $title = "My App", $layout = "admin")
{
    extract($data);
    ob_start();
    $carts = isset($_COOKIE["carts"]) ? json_decode($_COOKIE["carts"], true) : [];
    $totalCarts = 0; // Biến để lưu tổng tiền giỏ hàng
    $user = $_SESSION['users'] ?? null;
    // Lặp qua các sản phẩm trong giỏ hàng để tính tổng
    foreach ($carts as $cart) {
        $totalCarts += $cart['price'] * $cart['quantity']; // Tính tổng cho mỗi sản phẩm và cộng dồn
    }
    $product_count = is_array($carts) ? count($carts) : 0;
    require $view;
    $content = ob_get_clean();

    if ($layout == "admin") {
        require "view/layouts/admin/index.php";
    } else if ($layout == "client") {
        require "view/layouts/client/index.php";
    } else if ($layout == "empty") {
        require "view/layouts/empty.php";
    }
}
