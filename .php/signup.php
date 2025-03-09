<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Tài Khoản</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            position: relative;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 800px;
            padding: 30px;
            backdrop-filter: blur(10px);
        }

        /* Hình dạng con mèo */
        .cat-shape {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: -1;
        }

        .cat-ear-left,
        .cat-ear-right {
            position: absolute;
            width: 0;
            height: 0;
            border-left: 40px solid transparent;
            border-right: 40px solid transparent;
            border-bottom: 60px solid #ffc7d6;
            top: -30px;
        }

        .cat-ear-left {
            left: 20%;
            transform: rotate(-15deg);
        }

        .cat-ear-right {
            right: 20%;
            transform: rotate(15deg);
        }

        .cat-tail {
            position: absolute;
            width: 100px;
            height: 20px;
            background-color: #ffc7d6;
            border-radius: 20px;
            bottom: -10px;
            right: -50px;
            transform: rotate(-20deg);
        }

        .cat-paw1,
        .cat-paw2 {
            position: absolute;
            width: 50px;
            height: 30px;
            background-color: #ffc7d6;
            border-radius: 50%;
            bottom: -15px;
        }

        .cat-paw1 {
            left: 15%;
        }

        .cat-paw2 {
            left: 30%;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo h1 {
            color: #333;
            font-size: 28px;
            font-weight: 700;
        }

        .logo span {
            display: block;
            color: #764ba2;
            font-size: 16px;
            margin-top: 5px;
        }

        .form-container {
            display: flex;
            gap: 30px;
        }

        .form-column {
            flex: 1;
        }

        .form-group {
            margin-bottom: 15px;
            position: relative;
        }

        .form-group label {
            display: block;
            color: #555;
            margin-bottom: 5px;
            font-weight: 500;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-group input:focus {
            border-color: #764ba2;
            box-shadow: 0 0 0 2px rgba(118, 75, 162, 0.2);
            outline: none;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 33px;
            color: #aaa;
            cursor: pointer;
            font-size: 14px;
        }

        .button-group {
            display: flex;
            margin-top: 20px;
            gap: 10px;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
            flex: 1;
        }

        .btn-primary {
            background-color: #764ba2;
            color: white;
        }

        .btn-primary:hover {
            background-color: #663a91;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(118, 75, 162, 0.4);
        }

        .btn-secondary {
            background-color: #f5f5f5;
            color: #555;
        }

        .btn-secondary:hover {
            background-color: #eaeaea;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .footer {
            text-align: center;
            margin-top: 15px;
            color: #666;
            font-size: 14px;
        }

        .footer a {
            color: #764ba2;
            text-decoration: none;
            font-weight: 500;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Mặt mèo */
        .cat-face {
            position: absolute;
            top: -80px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 80px;
            background-color: #ffc7d6;
            border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: -1;
        }

        .cat-eyes {
            display: flex;
            justify-content: space-around;
            width: 80%;
        }

        .cat-eye {
            width: 15px;
            height: 20px;
            background-color: white;
            border-radius: 50%;
            position: relative;
            overflow: hidden;
        }

        .cat-eye:after {
            content: '';
            position: absolute;
            width: 8px;
            height: 15px;
            background-color: black;
            border-radius: 50%;
            top: 2px;
            left: 3px;
        }

        .cat-nose {
            width: 10px;
            height: 5px;
            background-color: #ff758f;
            border-radius: 50%;
            margin-top: 10px;
        }

        .cat-whiskers {
            display: flex;
            justify-content: space-around;
            width: 120px;
            margin-top: 5px;
        }

        .whisker {
            width: 25px;
            height: 1px;
            background-color: #555;
        }

        @media (max-width: 768px) {
            .form-container {
                flex-direction: column;
                gap: 10px;
            }

            .cat-ear-left,
            .cat-ear-right,
            .cat-tail,
            .cat-paw1,
            .cat-paw2,
            .cat-face {
                display: none;
            }

            .container {
                padding: 20px;
                max-width: 500px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Hình dạng con mèo -->
        <div class="cat-shape">
            <div class="cat-ear-left"></div>
            <div class="cat-ear-right"></div>
            <div class="cat-tail"></div>
            <div class="cat-paw1"></div>
            <div class="cat-paw2"></div>
        </div>

        <!-- Mặt mèo -->
        <div class="cat-face">
            <div class="cat-eyes">
                <div class="cat-eye"></div>
                <div class="cat-eye"></div>
            </div>
            <div class="cat-nose"></div>
            <div class="cat-whiskers">
                <div class="whisker"></div>
                <div class="whisker"></div>
                <div class="whisker"></div>
            </div>
        </div>

        <div class="logo">
            <h1>MyWebsite</h1>
            <span>Tạo tài khoản mới</span>
        </div>

        <form action="process_signup.php" method="POST" id="registerForm">
            <div class="form-container">
                <div class="form-column">
                    <div class="form-group">
                        <label for="full_Name">Họ và tên</label>
                        <input type="text" id="full_Name" name="full_name" required placeholder="Nhập họ và tên của bạn">
                    </div>

                    <div class="form-group">
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" id="username" name="username" required placeholder="Chọn tên đăng nhập">
                    </div>

                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input type="password" id="password" name="password" required placeholder="Tạo mật khẩu">
                        <span class="password-toggle" onclick="togglePassword('password')">👁️</span>
                    </div>
                </div>

                <div class="form-column">
                    <div class="form-group">
                        <label for="email">Địa chỉ email</label>
                        <input type="email" id="email" name="email" required placeholder="example@email.com">
                    </div>

                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="tel" id="phone" name="phone" required placeholder="Nhập số điện thoại">
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword">Xác nhận mật khẩu</label>
                        <input type="password" id="confirmPassword" name="confirm_password" required placeholder="Nhập lại mật khẩu">
                        <span class="password-toggle" onclick="togglePassword('confirmPassword')">👁️</span>
                    </div>
                </div>
            </div>

            <div class="button-group">
                <button type="submit" class="btn btn-primary">Đăng Ký</button>
                <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php'">Trang Chủ</button>
            </div>
        </form>

        <div class="footer">
            <p>Bạn đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></p>
        </div>

    </div>

    <script>
        function togglePassword(id) {
            const passwordInput = document.getElementById(id);
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }

        document.getElementById("registerForm").addEventListener("submit", function(e) {
            e.preventDefault(); // Ngăn chặn form gửi đi ngay lập tức

            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirmPassword").value;

            if (password !== confirmPassword) {
                alert("Mật khẩu xác nhận không khớp!");
                return;
            }

            // Nếu hợp lệ, submit form
            this.submit();
        });
    </script>
</body>

</html>