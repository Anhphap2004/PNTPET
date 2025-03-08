<?php
include 'config.php'; // Nhúng file config để kết nối database

$sql = "SELECT * FROM Price_Service";
$result = $conn->query($sql);
?>

<!-- Pricing Plan Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
            <h6 class="text-primary text-uppercase">Bảng Giá Dịch Vụ</h6>

        </div>
        <div class="row g-5">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="col-lg-4">
                    <div class="bg-light text-center pt-5">
                        <h2 class="text-uppercase"><?php echo htmlspecialchars($row['title']); ?></h2>
                        <br><br>
                        <div class="text-center bg-primary p-4 mb-2">
                            <h1 class="display-6 text-white mb-0"> <!-- Đổi từ display-4 sang display-6 để làm nhỏ hơn -->
                                <small class="align-top" style="font-size: 18px; line-height: 35px;">₫</small>
                                <?php echo number_format($row['Price'], 0, ',', '.'); ?>
                                <small class="align-bottom" style="font-size: 14px; line-height: 30px;">/ Tháng</small>
                            </h1>

                        </div>
                        <div class="text-center p-4">
                         
                                <?php echo '  <span>' . htmlspecialchars($row["Content"]) . ' ✔️</span>'; ?>
                       
                          
                            <a href="#" class="btn btn-primary text-uppercase py-2 px-4 my-3">Order Now</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- Pricing Plan End -->

<?php
$conn->close(); // Đóng kết nối sau khi sử dụng
?>