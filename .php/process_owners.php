<?php
include 'config.php';

// Lấy dữ liệu từ bảng owners
$sql = "SELECT * FROM owners";
$result = $conn->query($sql);

// Kiểm tra lỗi
if (!$result) {
    die("Lỗi truy vấn: " . $conn->error);
}
?>

<!-- Bắt đầu phần Đội Ngũ -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="border-start border-5 border-danger ps-5 mb-5" style="max-width: 600px;">
            <h6 class="text-danger text-uppercase">Những Nhà Sáng Lập</h6>
            <h1 class="display-5 text-uppercase mb-0">Chuyên Gia Chăm Sóc Thú Cưng</h1>
        </div>
        <div class="owl-carousel team-carousel position-relative" style="padding-right: 25px;">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="team-item">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="../img/Owners/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                        <div class="team-overlay">
                            <div class="d-flex align-items-center justify-content-start">
                                <?php if (!empty($row['zalo'])): ?>
                                    <a class="btn btn-light btn-square mx-1" href="<?= htmlspecialchars($row['zalo']) ?>" target="_blank">
                                        <i class="bi bi-twitter"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if (!empty($row['facebook'])): ?>
                                    <a class="btn btn-light btn-square mx-1" href="<?= htmlspecialchars($row['facebook']) ?>" target="_blank">
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if (!empty($row['tiktok'])): ?>
                                    <a class="btn btn-light btn-square mx-1" href="<?= htmlspecialchars($row['tiktok']) ?>" target="_blank">
                                        <i class="bi bi-linkedin"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="bg-light text-center p-4">
                        <h5 class="text-uppercase"><?= htmlspecialchars($row['name']) ?></h5>
                        <p class="m-0"><?= htmlspecialchars($row['position']) ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>
<!-- Kết thúc phần Đội Ngũ -->

<?php $conn->close(); ?>