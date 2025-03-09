<?php
include 'config.php';

// Lấy dữ liệu từ bảng about (giả sử chỉ có 1 dòng dữ liệu)
$sql = "SELECT * FROM about LIMIT 1";
$result = $conn->query($sql);

// Kiểm tra lỗi truy vấn
if (!$result) {
    die("Lỗi truy vấn: " . $conn->error);
}

// Lấy dữ liệu từ kết quả truy vấn
$row = $result->fetch_assoc();

// Đóng kết nối
$conn->close();
?>

<div class="container-fluid py-5">
    <div class="container">
        <div class="row gx-5">
            <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100 rounded"
                        src="../img/<?= htmlspecialchars($row['image'] ?? '../img/about.jpg') ?>"
                        style="object-fit: cover;">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="border-start border-5 border-primary ps-5 mb-5">
                    <h6 class="text-primary text-uppercase">Về Chúng Tôi</h6>
                    <h1 class="display-6 text-uppercase mb-0">
                        <?= htmlspecialchars($row['title'] ?? 'Chúng tôi luôn mang lại niềm vui cho thú cưng của bạn') ?>
                    </h1>
                </div>
                <h5 class="text-body mb-4">
                    <?= htmlspecialchars($row['description'] ?? 'Chưa có mô tả.') ?>
                </h5>
                <div class="bg-light p-4">
                    <ul class="nav nav-pills justify-content-between mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item w-50" role="presentation">
                            <button class="nav-link text-uppercase w-100 active" id="pills-1-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-1" type="button" role="tab" aria-controls="pills-1"
                                aria-selected="true">Sứ mệnh của chúng tôi</button>
                        </li>
                        <li class="nav-item w-50" role="presentation">
                            <button class="nav-link text-uppercase w-100" id="pills-2-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-2" type="button" role="tab" aria-controls="pills-2"
                                aria-selected="false">Tầm nhìn của chúng tôi</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab">
                            <p class="mb-0"><?= nl2br(htmlspecialchars($row['content'] ?? 'Chưa có nội dung về sứ mệnh.')) ?></p>
                        </div>
                        <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
                            <p class="mb-0">Chưa có nội dung về tầm nhìn.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>