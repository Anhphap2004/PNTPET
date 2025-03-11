<?php
include 'config.php';

// Truy vấn lấy tất cả đánh giá từ bảng reviews
$sql = "SELECT * FROM testimonial ORDER BY created_at DESC";
$result = $conn->query($sql);

// Kiểm tra lỗi truy vấn
if (!$result) {
    die("Lỗi truy vấn: " . $conn->error);
}
?>

<!-- Testimonial Start -->
<div class="container-fluid py-5" style="margin: 45px 0;">
    <div class="container py-5">
        <div class="row align-items-center">
            <!-- Cột chứa ảnh nền -->
            <div class="col-lg-5 d-none d-lg-block bg-testimonial"></div>

            <!-- Cột chứa nội dung testimonial -->
            <div class="col-lg-7">
                <div class="owl-carousel testimonial-carousel bg-white p-5 custom-border">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="testimonial-item text-center">
                            <div class="position-relative mb-4">
                                <img class="img-fluid mx-auto" src="../img/Testimonial/<?= htmlspecialchars($row['image']) ?>" alt="">
                                <div class="position-absolute top-100 start-50 translate-middle d-flex align-items-center justify-content-center bg-white border rounded-circle shadow-sm" style="width: 45px; height: 45px;">
                                    <i class="bi bi-chat-square-quote text-danger"></i>
                                </div>
                            </div>
                            <p><?= htmlspecialchars($row['review_text']) ?></p>
                            <hr class="w-25 mx-auto">
                            <h5 class="text-uppercase text-danger"><?= htmlspecialchars($row['client_name']) ?></h5>
                            <span><?= htmlspecialchars($row['profession']) ?></span>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Testimonial End -->


<?php $conn->close(); ?>