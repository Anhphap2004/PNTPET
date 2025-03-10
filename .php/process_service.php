<?php
include 'config.php';
?>

<!-- Services Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div style="border-color: #dc3545;" class="border-start border-5 ps-5 mb-5" style="max-width: 600px;">
            <h6 style="color: #dc3545;" class="text-uppercase">Dịch Vụ</h6>
            <h5 style="color: #dc3545;" class="display-7 text-uppercase mb-0">Dịch Vụ Chăm Sóc Thú Cưng Tốt Nhất</h5>
        </div>
        <div class="row g-5">
            <?php
            $sql = "SELECT * FROM services limit 6";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-6">';
                    echo '    <div class="service-item  d-flex p-4">';
                    echo '        <i style="color: #dc3545;" class="' . $row["Icon"] . ' display-1 me-4"></i>';
                    echo '        <div>';
                    echo '            <h5 style="color: #dc3545;" class="text-uppercase mb-3">' . $row["service_name"] . '</h5>';
                    echo '            <p>' . $row["description"] . '</p>';
                    echo '            <a style="color: #dc3545;" class="text-uppercase" href="#">Xem thêm<i style="color: #dc3545;" class="bi bi-chevron-right"></i></a>';
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