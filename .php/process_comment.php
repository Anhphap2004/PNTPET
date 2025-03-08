<?php
require 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận dữ liệu từ form
    $post_id = isset($_POST['post_id']) ? (int)$_POST['post_id'] : 0;
    $content = trim($_POST['content']);
    $created_at = date("Y-m-d H:i:s");

    // Kiểm tra nội dung bình luận có rỗng không
    if (empty($content)) {
        die("Vui lòng nhập nội dung bình luận.");
    }

    if (isset($_SESSION['user_id'])) {
        // Người dùng đã đăng nhập
        $user_id = $_SESSION['user_id'];
        $stmt = $conn->prepare("INSERT INTO blog_comments (post_id, user_id, content, created_at) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $post_id, $user_id, $content, $created_at);
    } else {
        // Người dùng chưa đăng nhập, yêu cầu nhập tên và email
        $author_name = trim($_POST['author_name'] ?? '');
        $author_email = trim($_POST['author_email'] ?? '');

        // Kiểm tra xem tên và email có rỗng không
        if (empty($author_name) || empty($author_email)) {
            die("Họ tên và email là bắt buộc.");
        }

        // Kiểm tra định dạng email
        if (!filter_var($author_email, FILTER_VALIDATE_EMAIL)) {
            die("Email không hợp lệ.");
        }

        $stmt = $conn->prepare("INSERT INTO blog_comments (post_id, author_name, author_email, content, created_at) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $post_id, $author_name, $author_email, $content, $created_at);
    }

    // Thực thi truy vấn và kiểm tra kết quả
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: process_blog_detail.php?id=" . $post_id);
        exit();
    } else {
        echo "Lỗi khi lưu bình luận.";
    }
}
