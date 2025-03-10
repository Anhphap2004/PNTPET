<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PET SHOP - Pet Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="../img/favicon.ico" rel="icon">
    <link href="https://cdn.leanhduc.pro.vn/utilities/multi-color-star-effects/style.css" rel="stylesheet" />
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:wght@700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="../lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <canvas id="canvas" style="position:fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 9999;"></canvas>
    <!-- Navbar Start -->
    <?php include 'process_menu.php'; ?>
    <!-- Navbar End -->

    <!-- Blog Start -->
    <div class="container py-5">
        <div class="row g-5">
            <?php
            include 'config.php';
            // Số bài viết hiển thị trên mỗi trang
            $posts_per_page = 5;
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $start = ($page - 1) * $posts_per_page;

            // Lấy dữ liệu từ bảng blog_posts
            $sql = "SELECT * FROM blog_posts ORDER BY date DESC LIMIT $start, $posts_per_page";
            $result = $conn->query($sql);
            ?>

            <!-- Blog list Start -->
            <div class="col-lg-8">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="blog-item mb-5">
                        <div class="row g-0 bg-light overflow-hidden">
                            <div class="col-12 col-sm-5 h-100">
                                <img class="img-fluid h-100" src="../img/blog/<?php echo $row['featured_image']; ?>" style="object-fit: cover;">
                            </div>
                            <div class="col-12 col-sm-7 h-100 d-flex flex-column justify-content-center">
                                <div class="p-4">
                                    <div class="d-flex mb-3">
                                        <small class="me-3"><i class="bi bi-bookmarks me-2"></i><?= htmlspecialchars($row['category']) ?></small>
                                        <small><i class="bi bi-calendar-date me-2"></i><?= date("d M, Y", strtotime($row['date'])) ?></small>
                                    </div>
                                    <h5 class="text-uppercase mb-3"><?= htmlspecialchars($row['title']) ?></h5>
                                    <p><?php echo substr($row['excerpt'], 0, 100) . '...'; ?></p>
                                    <a class="text-danger text-uppercase" href="process_blog_detail.php?id=<?php echo $row['post_id']; ?>">Read More<i class="bi bi-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>

                <!-- Pagination -->
                <?php
                // Lấy tổng số bài viết
                $result_total = $conn->query("SELECT COUNT(*) AS total FROM blog_posts");
                $total_posts = $result_total->fetch_assoc()['total'];
                $total_pages = ceil($total_posts / $posts_per_page);
                ?>

                <div class="col-12">
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-lg m-0">
                            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link rounded-0" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                                    <span aria-hidden="true"><i class="bi bi-arrow-left"></i></span>
                                </a>
                            </li>
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                            <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                                <a class="page-link rounded-0" href="?page=<?= $page + 1 ?>" aria-label="Next">
                                    <span aria-hidden="true"><i class="bi bi-arrow-right"></i></span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Blog list End -->

            <?php $conn->close(); ?>


            <!-- Sidebar Start -->
            <div class="col-lg-4">
                <!-- Search Form Start -->
                <div class="mb-5">
                    <div class="input-group">
                        <input type="text" class="form-control p-3" placeholder="Keyword">
                        <button class="btn btn-danger px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
                <!-- Search Form End -->

                <!-- Category Start -->
                <?php include 'process_category_blog.php'; ?>
                <!-- Category End -->

                <!-- Recent Post Start -->
                <?php include 'process_blog_recent.php';  ?>
                <!-- Recent Post End -->

                <!-- Bắt đầu Tags -->
                <div class="mb-5">
                    <h3 class="text-uppercase border-start border-5 border-danger ps-3 mb-4">Từ khoá phổ biến</h3>
                    <div class="d-flex flex-wrap m-n1"> <a href="" class="btn btn-danger m-1">Thiết kế</a> <a href="" class="btn btn-danger m-1">Phát triển</a> <a href="" class="btn btn-danger m-1">Tiếp thị</a> <a href="" class="btn btn-danger m-1">SEO</a> <a href="" class="btn btn-danger m-1">Viết lách</a> <a href="" class="btn btn-danger m-1">Tư vấn</a> <a href="" class="btn btn-danger m-1">Thiết kế</a> <a href="" class="btn btn-danger m-1">Phát triển</a> <a href="" class="btn btn-danger m-1">Tiếp thị</a> <a href="" class="btn btn-danger m-1">SEO</a> <a href="" class="btn btn-danger m-1">Viết lách</a> <a href="" class="btn btn-danger m-1">Tư vấn</a> </div>
                </div> <!-- Kết thúc Tags -->

                <!-- Bắt đầu Nội dung Văn bản -->
                <div>
                    <h3 class="text-uppercase border-start border-5 border-danger ps-3 mb-4">Nội dung Văn bản</h3>
                    <div class="bg-light text-center" style="padding: 30px;">
                        <p>Chào mừng bạn đến với trang của chúng tôi! Hãy khám phá những bài viết mới nhất và những thông tin hữu ích về chủ đề bạn quan tâm.</p>
                        <a href="" class="btn btn-danger py-2 px-4">Đọc thêm</a>
                    </div>
                </div>
                <!-- Kết thúc Nội dung Văn bản -->
            </div>
            <!-- Sidebar End -->
        </div>
    </div>
    <!-- Blog End -->


    <!-- Bắt Đầu Chân Trang -->
    <div class="container-fluid bg-light mt-5 py-5">
        <div class="container pt-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase border-start border-5 border-danger ps-3 mb-4">Liên Hệ</h5>
                    <p class="mb-4">Chúng tôi luôn sẵn sàng hỗ trợ bạn. Liên hệ ngay để được tư vấn tốt nhất!</p>
                    <p class="mb-2"><i class="bi bi-geo-alt text-danger me-2"></i>309 Nguyễn Thiếp, TP VINH, Việt Nam</p>
                    <p class="mb-2"><i class="bi bi-envelope-open text-danger me-2"></i>Pntpet@example.com</p>
                    <p class="mb-0"><i class="bi bi-telephone text-danger me-2"></i>+84 339 573 127</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase border-start border-5 border-danger ps-3 mb-4">Liên Kết Nhanh</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-danger me-2"></i>Trang Chủ</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-danger me-2"></i>Về Chúng
                            Tôi</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-danger me-2"></i>Dịch Vụ</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-danger me-2"></i>Đội Ngũ</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-danger me-2"></i>Blog</a>
                        <a class="text-body" href="#"><i class="bi bi-arrow-right text-danger me-2"></i>Liên Hệ</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase border-start border-5 border-danger ps-3 mb-4">Liên Kết Phổ Biến</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-danger me-2"></i>Trang Chủ</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-danger me-2"></i>Về Chúng
                            Tôi</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-danger me-2"></i>Dịch Vụ</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-danger me-2"></i>Đội Ngũ</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-danger me-2"></i>Blog</a>
                        <a class="text-body" href="#"><i class="bi bi-arrow-right text-danger me-2"></i>Liên Hệ</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase border-start border-5 border-danger ps-3 mb-4">Bản Tin</h5>
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control p-3" placeholder="Nhập Email của bạn">
                            <button class="btn btn-danger">Đăng Ký</button>
                        </div>
                    </form>
                    <h6 class="text-uppercase mt-4 mb-3">Theo Dõi Chúng Tôi</h6>
                    <div class="d-flex">
                        <a class="btn btn-outline-danger btn-square me-2" href="#"><i class="bi bi-twitter"></i></a>
                        <a class="btn btn-outline-danger btn-square me-2" href="#"><i class="bi bi-facebook"></i></a>
                        <a class="btn btn-outline-danger btn-square me-2" href="#"><i class="bi bi-linkedin"></i></a>
                        <a class="btn btn-outline-danger btn-square" href="#"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
                <div class="col-12 text-center text-body">
                    <a class="text-body" href="#">Điều Khoản & Điều Kiện</a>
                    <span class="mx-1">|</span>
                    <a class="text-body" href="#">Chính Sách Bảo Mật</a>
                    <span class="mx-1">|</span>
                    <a class="text-body" href="#">Hỗ Trợ Khách Hàng</a>
                    <span class="mx-1">|</span>
                    <a class="text-body" href="#">Thanh Toán</a>
                    <span class="mx-1">|</span>
                    <a class="text-body" href="#">Trợ Giúp</a>
                    <span class="mx-1">|</span>
                    <a class="text-body" href="#">Câu Hỏi Thường Gặp</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white-50 py-4">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-md-0">&copy; <a class="text-white" href="#">PNTPET</a>. Mọi quyền được bảo lưu.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Thiết kế bởi <a class="text-white" href="https://facebook.com/Anhphap2004">AnhhPhapp</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Kết Thúc Chân Trang -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-danger py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="https://cdn.leanhduc.pro.vn/jquery/3.6.0.min.js"></script>
    <script src="https://cdn.leanhduc.pro.vn/utilities/multi-color-star-effects/main.js"></script>
    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
</body>

</html>