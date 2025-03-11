<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'config.php'; // Kết nối CSDL

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

$sql = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$avatar = !empty($user['profile_image']) ? $user['profile_image'] : 'default-avatar.jpg';
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>PET SHOP - Trung tâm cá nhân</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Pet Shop, Profile Center" name="keywords">
    <meta content="User Profile Center for Pet Shop" name="description">

    <!-- Favicon -->
    <link href="../img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Icon Font Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">

    <style>
        .profile-wrapper {
            display: flex;
            min-height: calc(100vh - 150px);
            /* Trừ đi chiều cao của footer */
            background-color: #f5f5f5;
        }

        .sidebar {
            width: 260px;
            background-color: white;
            padding: 20px;
            border-right: 1px solid #eee;
            position: sticky;
            top: 0;
            height: 100%;
            overflow-y: auto;
        }

        .profile-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
            text-align: center;
        }

        .profile-pic {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            overflow: hidden;
            margin-bottom: 10px;
            position: relative;
        }

        .profile-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .crown-badge {
            position: absolute;
            bottom: 0;
            right: 0;
            background-color: white;
            border-radius: 50%;
            padding: 3px;
            font-size: 12px;
        }

        .username {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .user-id {
            color: #777;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .user-status {
            color: #777;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .upgrade-btn {
            background-color: #FF6F61;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 14px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .nav-menu {
            margin-top: 20px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 12px 0;
            color: #666;
            text-decoration: none;
            font-size: 14px;
        }

        .nav-item.active {
            color: #7AB730;
        }

        .nav-item i {
            margin-right: 10px;
        }

        .main-content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        .page-title {
            font-size: 22px;
            margin-bottom: 30px;
            color: #333;
            border-left: 5px solid #7AB730;
            padding-left: 15px;
        }

        .social-login {
            margin-bottom: 30px;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .login-title {
            font-size: 16px;
            margin-bottom: 15px;
            color: #333;
            font-weight: 600;
        }

        .social-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 15px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            font-size: 14px;
            flex: 1;
            min-width: 200px;
            transition: all 0.3s ease;
        }

        .social-btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .facebook-btn {
            background-color: #1877F2;
        }

        .google-btn {
            background-color: #DB4437;
        }

        .twitter-btn {
            background-color: #1DA1F2;
        }

        .form-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            margin-bottom: 30px;
        }

        .form-section {
            flex: 1;
            min-width: 300px;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 18px;
            margin-bottom: 20px;
            color: #333;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .required:after {
            content: "*";
            color: red;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #7AB730;
            outline: none;
            box-shadow: 0 0 0 3px rgba(122, 183, 48, 0.2);
        }

        .dropdown {
            position: relative;
        }

        .dropdown-toggle {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            text-align: left;
            background-color: white;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .forgot-password {
            color: #DB4437;
            font-size: 12px;
            text-decoration: none;
            display: block;
            margin-top: 5px;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .notifications {
            margin-top: 30px;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .notification-option {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding: 15px;
            border: 1px solid #eee;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 20px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 20px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #7AB730;
        }

        input:checked+.slider:before {
            transform: translateX(20px);
        }

        .data-policy {
            margin-top: 10px;
            font-size: 12px;
            color: #666;
            line-height: 1.5;
        }

        .save-button {
            background-color: #7AB730;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            float: right;
            margin-top: 20px;
            transition: all 0.3s ease;
        }

        .save-button:hover {
            background-color: #689328;
            transform: translateY(-2px);
        }

        /* Responsive adjustments */
        @media (max-width: 991px) {
            .profile-wrapper {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                border-right: none;
                border-bottom: 1px solid #eee;
            }

            .nav-menu {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
            }

            .nav-item {
                padding: 8px 15px;
                border: 1px solid #eee;
                border-radius: 20px;
                margin-bottom: 10px;
            }
        }

        @media (max-width: 768px) {
            .social-buttons {
                flex-direction: column;
            }

            .form-container {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <!-- Menu Navigation -->
    <?php include 'process_menu.php' ?>

    <div class="profile-wrapper">
        <div class="sidebar">
            <div class="profile-header">
                <div class="profile-pic">
                    <img src="../img/Username/<?= htmlspecialchars($avatar) ?>" alt="Profile Picture">
                    <span class="crown-badge">👑</span>
                </div>
                <h3 class="username"><?= htmlspecialchars($user['username']) ?></h3>
                <p class="user-id">ID: <?= $user_id ?></p>
                <p class="user-status">người sử dụng miễn phí</p>
                <button class="upgrade-btn">Trở thành thành viên</button>
            </div>

            <div class="nav-menu">
                <a href="#" class="nav-item active">
                    <i>👤</i> Trung tâm cá nhân của tôi
                </a>
                <a href="#" class="nav-item">
                    <i>📱</i> Quản lý thiết bị
                </a>
                <a href="#" class="nav-item">
                    <i>📋</i> Theo dõi
                </a>
                <a href="#" class="nav-item">
                    <i>📝</i> Ủy quyền của tôi
                </a>
                <a href="#" class="nav-item">
                    <i>📊</i> Khách hàng của tôi
                </a>
                <a href="#" class="nav-item">
                    <i>❤️</i> Lịch sử lưu trữ của tôi
                </a>
                <a href="#" class="nav-item">
                    <i>⬇️</i> Lịch sử tải về của tôi
                </a>
                <a href="#" class="nav-item">
                    <i>⭐</i> Nhà thiết kế tôi theo dõi
                </a>
                <a href="#" class="nav-item">
                    <i>📁</i> Dự án của tôi
                </a>
                <a href="#" class="nav-item">
                    <i>🔼</i> Tải lên của tôi
                </a>
            </div>
        </div>

        <div class="main-content">
            <h1 class="page-title">Trung tâm cá nhân của tôi</h1>

            <div class="social-login">
                <h2 class="login-title">Tài khoản liên kết</h2>
                <div class="social-buttons">
                    <a href="#" class="social-btn facebook-btn">
                        <span>🔵 Tiếp tục sử dụng Facebook</span>
                    </a>
                    <a href="#" class="social-btn google-btn">
                        <span>🔴 Tiếp tục sử dụng Google</span>
                    </a>
                    <a href="#" class="social-btn twitter-btn">
                        <span>🔵 Tiếp tục sử dụng Twitter</span>
                    </a>
                </div>
            </div>

            <form action="update_profile.php" method="post">
                <div class="form-container">
                    <div class="form-section">
                        <h2 class="section-title">Dữ liệu cá nhân</h2>

                        <div class="form-group">
                            <label class="form-label">Tên thật</label>
                            <input type="text" name="fullname" class="form-control" placeholder="Tên đầy đủ của bạn" value="<?= isset($user['fullname']) ? htmlspecialchars($user['fullname']) : '' ?>">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Chức danh</label>
                            <input type="text" name="job_title" class="form-control" placeholder="Tiêu đề công việc của bạn" value="<?= isset($user['job_title']) ? htmlspecialchars($user['job_title']) : '' ?>">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" name="phone" class="form-control" placeholder="12345678" value="<?= isset($user['phone']) ? htmlspecialchars($user['phone']) : '' ?>">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Địa điểm</label>
                            <select name="location" class="form-control">
                                <option value="">Chọn địa điểm</option>
                                <option value="hanoi" <?= (isset($user['location']) && $user['location'] == 'hanoi') ? 'selected' : '' ?>>Hà Nội</option>
                                <option value="hochiminh" <?= (isset($user['location']) && $user['location'] == 'hochiminh') ? 'selected' : '' ?>>TP Hồ Chí Minh</option>
                                <option value="danang" <?= (isset($user['location']) && $user['location'] == 'danang') ? 'selected' : '' ?>>Đà Nẵng</option>
                                <option value="other" <?= (isset($user['location']) && $user['location'] == 'other') ? 'selected' : '' ?>>Khác</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-section">
                        <h2 class="section-title">Thông tin tài khoản</h2>

                        <div class="form-group">
                            <label class="form-label required">Tên người dùng</label>
                            <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label required">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Mật khẩu mới</label>
                            <input type="password" name="new_password" class="form-control" placeholder="Để trống nếu không muốn thay đổi">
                            <a href="forgot_password.php" class="forgot-password">Quên mật khẩu?</a>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Xác nhận mật khẩu mới</label>
                            <input type="password" name="confirm_password" class="form-control" placeholder="Xác nhận mật khẩu mới">
                        </div>
                    </div>
                </div>

                <div class="notifications">
                    <h2 class="section-title">Thông báo</h2>

                    <div class="notification-option">
                        <div>Tôi muốn nhận thông tin và chương trình khuyến mãi</div>
                        <label class="toggle-switch">
                            <input type="checkbox" name="newsletter" value="1" <?= (isset($user['newsletter']) && $user['newsletter'] == 1) ? 'checked' : '' ?>>
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="data-policy">
                        Thông tin cơ bản về bảo vệ dữ liệu: Chúng tôi thu thập dữ liệu của bạn để cải thiện dịch vụ và, nếu có sự đồng ý, sẽ gửi cho bạn thông tin cập nhật và chương trình khuyến mãi từ công ty.
                    </div>

                    <button type="submit" class="save-button">Lưu thay đổi</button>
                    <div style="clear: both;"></div>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <div class="container-fluid bg-light mt-5 py-5">
        <div class="container pt-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase border-start border-5 border-primary ps-3 mb-4">Liên Hệ</h5>
                    <p class="mb-4">Chúng tôi luôn sẵn sàng hỗ trợ bạn. Liên hệ ngay để được tư vấn tốt nhất!</p>
                    <p class="mb-2"><i class="bi bi-geo-alt text-primary me-2"></i>309 Nguyễn Thiếp, TP VINH, Việt Nam</p>
                    <p class="mb-2"><i class="bi bi-envelope-open text-primary me-2"></i>Pntpet@example.com</p>
                    <p class="mb-0"><i class="bi bi-telephone text-primary me-2"></i>+84 339 573 127</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase border-start border-5 border-primary ps-3 mb-4">Liên Kết Nhanh</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Trang Chủ</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Về Chúng Tôi</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Dịch Vụ</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Đội Ngũ</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Blog</a>
                        <a class="text-body" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Liên Hệ</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase border-start border-5 border-primary ps-3 mb-4">Liên Kết Phổ Biến</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Trang Chủ</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Về Chúng Tôi</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Dịch Vụ</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Đội Ngũ</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Blog</a>
                        <a class="text-body" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Liên Hệ</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase border-start border-5 border-primary ps-3 mb-4">Bản Tin</h5>
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control p-3" placeholder="Nhập Email của bạn">
                            <button class="btn btn-primary">Đăng Ký</button>
                        </div>
                    </form>
                    <h6 class="text-uppercase mt-4 mb-3">Theo Dõi Chúng Tôi</h6>
                    <div class="d-flex">
                        <a class="btn btn-outline-primary btn-square me-2" href="#"><i class="bi bi-twitter"></i></a>
                        <a class="btn btn-outline-primary btn-square me-2" href="#"><i class="bi bi-facebook"></i></a>
                        <a class="btn btn-outline-primary btn-square me-2" href="#"><i class="bi bi-linkedin"></i></a>
                        <a class="btn btn-outline-primary btn-square" href="#"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
                <div class="col-12 text-center text-body">
                    <a class="text-body" href="#">Điều Khoản & Điều Kiện</a>
                    <span class="mx-1">|</span>
                    <a class="text-body" href="#">Chính Sách Bảo Mật</a>
                    <span class="mx-1">|</span>
                    <a class="text-body" href="#">Hỗ Trợ Khách Hàng</a>
                    <span class="mx-1">|</span>
                    <a class="text-body" href="#">Thanh Toán</a>
                    <span class="mx-1">|</span>
                    <a class="text-body" href="#">Trợ Giúp</a>
                    <span class="mx-1">|</span>
                    <a class="text-body" href="#">Câu Hỏi Thường Gặp</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white-50 py-4">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-md-0">&copy; <a class="text-white" href="#">PNTPET</a>. Mọi quyền được bảo lưu.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Thiết kế bởi <a class="text-white" href="https://facebook.com/Anhphap2004">AnhhPhapp</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
</body>

</html>