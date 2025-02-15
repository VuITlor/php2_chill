// Hàm gửi request POST
function addToCart(url, data) {
    return fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams(data)
    })
        .then(response => response.json())
        .catch(error => {
            console.error('Lỗi:', error);
            throw error;
        });
}

function setCountCarts(length, total = 0) {
    const cartCounts = document.querySelectorAll('.cart-count');
    const cartTotals = document.querySelectorAll('.cart-total');
    cartCounts.forEach(cartCount => {
        cartCount.innerText = length;
    });
    cartTotals.forEach(cartTotal => {
        cartTotal.innerText = new Intl.NumberFormat('vi-VN').format(total) + ' ₫';
        console.log(new Intl.NumberFormat('vi-VN').format(total));

    });
}

