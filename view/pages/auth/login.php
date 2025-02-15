    <div class="login-container">
        <h2 class="text-center mb-4">Đăng Nhập</h2>

        <form method="POST">
            <div class="mb-3">
                <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email của bạn">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label"><i class="fas fa-lock"></i> Mật Khẩu</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu của bạn">
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Đăng Nhập</button>
            </div>
            <div class="mt-3 text-center register-link">
                <p>Bạn chưa có tài khoản? <a href="register">Đăng ký ngay</a></p>
            </div>
            <div class="mt-3 text-center register-link">
                <p>Bạn quên mật khẩu? <a href="forgot-password">Lấy lại mật khẩu</a></p>
            </div>
            <div class="mt-3 text-center register-link">
                <a href="<?= $url ?>"><i class="bi bi-google"></i></a>
            </div>
        </form>

    </div>