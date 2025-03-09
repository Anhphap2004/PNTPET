<?php
include("config.php");

// Truy vấn dữ liệu từ bảng gallery
$sql = "SELECT * FROM gallery";
$result = $conn->query($sql);

// Kiểm tra lỗi truy vấn
if (!$result) {
    die("Lỗi truy vấn: " . $conn->error);
}

// Hiển thị gallery nếu có dữ liệu
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
        <div class="team-item">
            <div class="position-relative overflow-hidden">
                <img class="img-fluid w-100" src="<?= htmlspecialchars($row["image_path"]) ?>" alt="">
                <div class="team-overlay"></div>
            </div>
            <div class="bg-light text-center p-4">
                <h5 class="text-uppercase"><?= htmlspecialchars($row["title"]) ?></h5>
                <p class="m-0"><?= htmlspecialchars($row["description"]) ?></p>
            </div>
        </div>
<?php
    }
} else {
    echo "<p class='text-center'>Chưa có hình ảnh nào trong thư viện.</p>";
}

// Đóng kết nối
$conn->close();
?>