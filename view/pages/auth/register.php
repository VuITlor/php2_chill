<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
</head>

<div class="register-container">
    <h2 class="text-center mb-4">Đăng Ký</h2>

    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label"><i class="fas fa-user"></i> Họ và Tên</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ và tên">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email của bạn">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label"><i class="fas fa-phone"></i> Số Điện Thoại</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label"><i class="fas fa-lock"></i> Mật Khẩu</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label"><i class="fas fa-check-circle"></i> Xác Nhận Mật Khẩu</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Nhập lại mật khẩu">
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Đăng Ký</button>
        </div>
        <div class="mt-3 text-center login-link">
            <p>Bạn đã có tài khoản? <a href="login">Đăng nhập ngay</a></p>
        </div>
    </form>

    <?php if (isset($_SESSION['register_failed'])): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Lỗi Đăng Ký!',
                text: 'Email hoặc số điện thoại đã tồn tại.',
                confirmButtonText: 'Thử lại'
            });
        </script>
        <?php unset($_SESSION['register_failed']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['register_success'])): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '<?php echo $_SESSION['register_success']; ?>',
                confirmButtonText: 'OK'
            });
        </script>
        <?php unset($_SESSION['register_success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['register_error'])): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: '<?php echo $_SESSION['register_error']; ?>',
                confirmButtonText: 'Thử lại'
            });
        </script>
        <?php unset($_SESSION['register_error']); ?>
    <?php endif; ?>

</div>