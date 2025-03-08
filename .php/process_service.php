<?php
include 'config.php'; 
?>

<!-- Services Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
            <h6 class="text-primary text-uppercase">Dịch Vụ</h6>
            <h1 class="display-5 text-uppercase mb-0">Dịch Vụ Chăm Sóc Thú Cưng Tốt Nhất</h1>
        </div>
        <div class="row g-5">
            <?php
            $sql = "SELECT * FROM services limit 6";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-6">';
                    echo '    <div class="service-item bg-light d-flex p-4">';
                    echo '        <i class="' . $row["Icon"] . ' display-1 text-primary me-4"></i>';
                    echo '        <div>';
                    echo '            <h5 class="text-uppercase mb-3">' . $row["service_name"] . '</h5>';
                    echo '            <p>' . $row["description"] . '</p>';
                    echo '            <a class="text-primary text-uppercase" href="#">Xem thêm<i class="bi bi-chevron-right"></i></a>';
                    echo '        </div>';
                    echo '    </div>';
                    echo '</div>';
                }
            } else {
                echo "<p>Không có dịch vụ nào.</p>";
            }

            // Đóng kết nối
            $conn->close();
            ?>
        </div>
    </div>
</div>
<!-- Services End -->