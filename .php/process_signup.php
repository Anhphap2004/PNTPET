<?php
session_start();
include 'config.php'; // Kết nối CSDL

// Kiểm tra phương thức POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Yêu cầu không hợp lệ!");
}

// Nhận dữ liệu từ form
$full_name = trim($_POST["full_name"]);
$username = trim($_POST["username"]);
$email = trim($_POST["email"]);
$phone = trim($_POST["phone"]);
$password = trim($_POST["password"]);

// Kiểm tra kết nối CSDL
if (!$conn) {
    die("Lỗi kết nối CSDL!");
}

// ✅ Hàm kiểm tra dữ liệu trùng lặp
function isUserExists($conn, $email, $phone, $username) {
    $query = "SELECT user_id FROM users WHERE email = ? OR phone = ? OR username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $email, $phone, $username);
    $stmt->execute();
    $stmt->store_result();
    $exists = $stmt->num_rows > 0;
    $stmt->close();
    return $exists;
}

// Nếu đã tồn tại email, số điện thoại hoặc username => Hiển thị thông báo
if (isUserExists($conn, $email, $phone, $username)) {
    echo "<script>alert('Tên đăng nhập, email hoặc số điện thoại đã tồn tại!'); window.location.href='signup.php';</script>";
    exit();
}

// ✅ Mã hóa mật khẩu
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// ✅ Các giá trị mặc định
$address = "";
$role = "customer";
$profile_image = "default.png";
$created_at = date("Y-m-d H:i:s");
$updated_at = $created_at;
$status = 1;

// ✅ Câu lệnh INSERT
$query = "INSERT INTO users (username, password, email, full_name, phone, address, role, profile_image, created_at, updated_at, last_login, status) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($query);
$stmt->bind_param("sssssssssssi", $username, $hashed_password, $email, $full_name, $phone, $address, $role, $profile_image, $created_at, $updated_at, $last_login, $status);

// ✅ Xử lý kết quả
if ($stmt->execute()) {
    echo "<script>alert('Đăng ký thành công!'); window.location.href='login.php';</script>";
} else {
    echo "<script>alert('Lỗi khi đăng ký: " . addslashes($stmt->error) . "'); window.location.href='signup.php';</script>";
}

// Đóng kết nối
$stmt->close();
$conn->close();
?>
