<?php
include("config.php");

// Lấy dữ liệu từ SQL
$sql = "SELECT * FROM animals";
$result = $conn->query($sql);

// Xử lý lỗi
if (!$result) {
    die("Lỗi truy vấn: " . $conn->error);
}

// Hiển thị gallery
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="pb-5">
                <div class="product-item position-relative bg-light d-flex flex-column text-center">
                    <div class="image-container">
                        <img class="img-fluid mb-4" src="../img/Animal/' . htmlspecialchars($row["image"]) . '" alt="">
                    </div>
                    <a href="detail_animal.php?id=' . $row['animal_id'] . '" class="text-decoration-none">
                        <h6 style="color: #dc3545;" class="text-uppercase">' . htmlspecialchars($row["name"]) . '</h6>
                        <span style="color:rgb(220, 114, 53);  font-family: Montserrat, sans-serif;" class="mb-0">' . htmlspecialchars($row["description"]) . '</span>
                    </a>
                </div>
              </div>';
    }
} else {
    echo "Không có ảnh gallery nào cả";
}
