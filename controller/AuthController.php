<?php
session_start();
require_once "model/UserModel.php";
require_once "view/helpers.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class AuthController
{
    private $UserModel;
    private $client;
    private $clientID;
    private $clientSecret;
    private $redirectUri;
    private $mail;

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->client = new Google_Client();
        $this->clientID = "";
        $this->clientSecret = "";
        $this->redirectUri = "http://localhost/php2/login";
        $this->mail = new PHPMailer(true);

        // create Client Request to access Google API

    }
    public function index()
    {
        $users = $this->UserModel->getAllUsers();
        renderView("view/pages/admin/users/index.php", compact('users'), "Danh sách người dùng");
    }
    public function delete($id)
    {
        $this->UserModel->delete($id);
        redirect("/admin/users");
    }
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $phone = trim($_POST['phone']);
            $password = trim($_POST['password']);
            $confirm_password = trim($_POST['confirm_password']);

            if (empty($name) || empty($email) || empty($phone) || empty($password) || empty($confirm_password)) {
                $_SESSION['register_error'] = 'Vui lòng điền đầy đủ thông tin.';
                header('Location: /register');
            }

            if ($password !== $confirm_password) {
                $_SESSION['register_error'] = 'Mật khẩu xác nhận không khớp.';
                header('Location: /register');
            }

            $result = $this->UserModel->register($name, $email, $password, $phone);
            if ($result) {
                $_SESSION['register_success'] = 'Đăng ký thành công! Vui lòng đăng nhập.';
                redirect('/login');
            } else {
                $_SESSION['register_error'] = 'Đăng ký thất bại. Email đã tồn tại.';
                redirect('/register');
            }
        } else {
            renderView('view/pages/auth/register.php', [], 'Đăng ký', 'empty');
        }
    }

    public function login()
    {
        $this->client->setClientId($this->clientID);
        $this->client->setClientSecret($this->clientSecret);
        $this->client->setRedirectUri($this->redirectUri);
        $this->client->addScope("email");
        $this->client->addScope("profile");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->UserModel->login($email, $password);
            if ($user) {
                $role = $this->UserModel->getUserRoleByEmail($email);

                $_SESSION['users'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'phone' => $user['phone'],
                    'role' => $role
                ];
                $_SESSION['success'] = 'Đăng nhập thành công';

                redirect('/');
            } else {
                $_SESSION['error'] = 'Đăng nhập thất bại';
                redirect('/login');
            }
        } else if (isset($_GET['code'])) {
            $token = $this->client->fetchAccessTokenWithAuthCode($_GET['code']);
            if (isset($token['error'])) {
                $_SESSION['error'] = 'Đăng nhập thất bại';
                redirect('/login');
            }
            $this->client->setAccessToken($token['access_token']);
            // get profile info
            $google_oauth = new Google_Service_Oauth2($this->client);
            $google_account_info = $google_oauth->userinfo->get();
            $email =  $google_account_info->email;
            $name =  $google_account_info->name;
            $exists = $this->UserModel->getUserByEmail($email);
            if ($exists) {
                $_SESSION['users'] = [
                    'id' => $exists['id'],
                    'name' => $exists['name'],
                    'email' => $exists['email'],
                    'phone' => $exists['phone'],
                    'role' => $exists['role']
                ];
                $_SESSION['success'] = 'Đăng nhập thành công';
                if ($exists['role'] == 'admin') {
                    redirect('/admin');
                }
                redirect('/');
            } else {
                $new_user = $this->UserModel->register($name, $email, '', '');
                $user = $this->UserModel->getUserByEmail($email);
                $_SESSION['users'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'phone' => $user['phone'],
                    'role' => $user['role']
                ];
                $_SESSION['success'] = 'Đăng nhập thành công';
                if ($user['role'] == 'admin') {
                    redirect('/admin');
                }
                redirect('/');
            }
        } else {
            $url =    $this->client->createAuthUrl();
            renderView('view/pages/auth/login.php', compact('url'), 'Đăng nhập', 'empty');
        }
    }
    public function forgotPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];

            $user = $this->UserModel->getUserByEmail($email);
            if ($user) {
                $token = bin2hex(random_bytes(50));
                $this->UserModel->createToken($user['id'], $token, $email);
                $body = '
            <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                        padding: 20px;
                    }
                    .container {
                        background-color: #ffffff;
                        padding: 30px;
                        border-radius: 8px;
                        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                    }
                    .btn {
                        background-color: #4CAF50;
                        color: white;
                        padding: 15px 32px;
                        text-align: center;
                        text-decoration: none;
                        border-radius: 5px;
                        display: inline-block;
                        font-size: 16px;
                        margin-top: 20px;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <h2>Chào bạn,</h2>
                    <p>Chúng tôi nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn. Để thay đổi mật khẩu, vui lòng nhấp vào nút dưới đây:</p>
                    <a href="' . BASE_URL . 'forgot-password?token=' . $token . '&email=' . urlencode($email) . '" class="btn">Đặt lại mật khẩu</a>
                    <p>Nếu bạn không yêu cầu thay đổi mật khẩu, hãy bỏ qua email này.</p>
                    <p>Trân trọng,<br>Nhóm Hỗ trợ</p>
                </div>
            </body>
            </html>
        ';
                $this->sendMail($email,  'Đặt lại mật khẩu', $body);
                $_SESSION['success'] = 'Vui lý kiểm tra email';
                redirect('/forgot-password');
            } else {
                $_SESSION['error'] = 'Không tìm thấy email';
                redirect('/forgot-password');
            }
        } else if (isset($_GET['token'])) {
            $token = $_GET['token'];
            $email = urldecode($_GET['email']);
            $check = $this->UserModel->getUserByToken($token);
            if ($check) {
                if ($check['email'] == $email) {
                    $newPassword = bin2hex(random_bytes(8));
                    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                    $user = $this->UserModel->getUserByEmail($email);
                    $this->UserModel->update($user['id'], $user['name'], $user['email'], $hashedPassword, $user['phone']);
                    $this->mail->Subject = 'Mật khẩu mới của bạn';  // Tiêu đề email

                    // Nội dung HTML của email
                    $body = '
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                padding: 20px;
            }
            .container {
                background-color: #ffffff;
                padding: 30px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }
            .btn {
                background-color: #4CAF50;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                border-radius: 5px;
                display: inline-block;
                font-size: 16px;
                margin-top: 20px;
            }
            .password-box {
                background-color: #f9f9f9;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 5px;
                font-family: monospace;
                font-size: 16px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Chào bạn,</h2>
            <p>Chúng tôi muốn thông báo rằng mật khẩu của bạn đã được thay đổi thành công. Dưới đây là mật khẩu mới của bạn:</p>
            <div class="password-box">
                <strong>Mật khẩu mới: </strong> ' . $newPassword . '
            </div>
            <p>Vui lòng sử dụng mật khẩu này để đăng nhập vào tài khoản của bạn. Nếu bạn gặp bất kỳ vấn đề nào, vui lòng liên hệ với bộ phận hỗ trợ.</p>
            <p>Nếu bạn không thay đổi mật khẩu, vui lòng bỏ qua email này.</p>
            <p>Trân trọng,<br>Nhóm Hỗ trợ</p>
        </div>
    </body>
    </html>
';
                    $title = 'Mật khâu mới';

                    $this->sendMail($email, $title, $body);
                    $_SESSION['success'] = 'Mật khẩu mới được thay đổi thành công';
                    redirect('/login');
                } else {
                    $_SESSION['error'] = 'Không tìm thấy email';
                    redirect('/forgot-password');
                }
            } else {
                $_SESSION['error'] = 'Yêu cầu không hợp lệ';
                redirect('/forgot-password');
            }
        } else {
            renderView('view/pages/auth/forgot-password.php', [], 'Forgot Password', 'empty');
        }
    }
    public function unauthorized()
    {
        renderView('view/unauthorized.php', [], 'Unauthorized', 'empty');
    }
    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        $_SESSION['success'] = 'Đăng xuất thành công';
        redirect('/login');
    }
    public function sendMail($email, $title, $body)
    {
        $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Bật chế độ debug để kiểm tra thông tin lỗi
        $this->mail->isSMTP();                                            // Gửi qua SMTP
        $this->mail->Host       = 'smtp.gmail.com';                        // Địa chỉ máy chủ SMTP, ví dụ Gmail
        $this->mail->SMTPAuth   = true;                                    // Kích hoạt xác thực SMTP
        $this->mail->Username   = 'nguyenvu.cusue@gmail.com';              // Tên đăng nhập SMTP
        $this->mail->Password   = 'tnts btul joqo snqj';                          // Mật khẩu ứng dụng (nếu bật xác thực 2 yếu tố)
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;             // Sử dụng mã hóa SSL/TLS (Implicit SSL)
        $this->mail->Port       = 465;                              //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $this->mail->setFrom('nguyenvu.cusue@gmail.com', 'Vũ đẹp trai chưa có ny');
        $this->mail->addAddress($email);               //Name is optional
        $this->mail->addReplyTo('nguyenvu.cusue@gmail.com',  'Vũ đẹp trai chưa có ny');

        //Attachments
        // $this->mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $this->mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        $this->mail->SMTPDebug = 0; 
        //Content
        $this->mail->isHTML(true);                                  //Set email format to HTML
        $this->mail->Subject = $title;  // Tiêu đề email

        // Nội dung HTML của email
        $this->mail->Body    = $body;

        // Nội dung plain text (cho các email clients không hỗ trợ HTML)
        // $this->mail->AltBody = 'Chào bạn,\n\nChúng tôi nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn. Để thay đổi mật khẩu, vui lòng truy cập vào liên kết sau: https://www.yourwebsite.com/reset-password?token=YOUR_UNIQUE_TOKEN\n\nNếu bạn không yêu cầu thay đổi mật khẩu, hãy bỏ qua email này.\n\nTrân trọng,\nNhóm Hỗ trợ';


        $this->mail->send();
        return true;
    }
}
