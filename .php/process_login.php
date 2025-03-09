<?php
session_start();
include 'config.php'; // Kết nối CSDL

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Chuẩn bị truy vấn SQL
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $username); // Gán giá trị cho dấu ?
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashed_password = $row["password"];

            // Kiểm tra mật khẩu
            if (password_verify($password, $hashed_password)) {
                $_SESSION["user_id"] = $row["id"];
                $_SESSION["username"] = $row["username"];

                header("Location: index.php"); // Chuyển hướng sau khi đăng nhập thành công
                exit();
            } else {
                echo "<script>alert('Sai mật khẩu!'); window.location.href='login.php';</script>";
            }
        } else {
            echo "<script>alert('Tài khoản không tồn tại!'); window.location.href='login.php';</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Lỗi hệ thống!'); window.location.href='login.php';</script>";
    }

    $conn->close();
}
