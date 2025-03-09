<?php
session_start();
include 'config.php'; // Kết nối database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $animal_id = $_POST["animal_id"];
    $comment = trim($_POST["comment"]);

    if (empty($comment)) {
        die("Nội dung bình luận không được để trống!");
    }

    if (isset($_SESSION["user_id"])) {
        // Người dùng đã đăng nhập
        $user_id = $_SESSION["user_id"];
        $sql = "INSERT INTO reviews (animal_id, user_id, comment) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $animal_id, $user_id, $comment);
    } else {
        // Người dùng chưa đăng nhập, cần name và email
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);

        if (empty($name) || empty($email)) {
            die("Tên và email không được để trống!");
        }

        $sql = "INSERT INTO reviews (animal_id, name, email, comment) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $animal_id, $name, $email, $comment);
    }

    if ($stmt->execute()) {
        header("Location: detail_animal.php?id=" . $animal_id . "#comments"); // Chuyển về trang chi tiết
        exit();
    } else {
        echo "Lỗi khi gửi bình luận!";
    }

    $stmt->close();
    $conn->close();
}
