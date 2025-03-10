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
    <?php include 'process_menu.php'; ?>

    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="border-start border-5 border-danger ps-5 mb-5" style="max-width: 600px;">
                <h6 class="text-danger text-uppercase">Liên lạc</h6>
                <h1 class="display-5 text-uppercase mb-0">Xin vui lòng liên hệ với chúng tôi</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-7">
                    <form action="process_contact.php" method="POST">
                        <div class="row g-3">
                            <div class="col-12">
                                <input type="text" name="name" class="form-control bg-light border-0 px-4" placeholder="Your Name" style="height: 55px;" required>
                            </div>
                            <div class="col-12">
                                <input type="email" name="email" class="form-control bg-light border-0 px-4" placeholder="Your Email" style="height: 55px;" required>
                            </div>
                            <div class="col-12">
                                <input type="text" name="subject" class="form-control bg-light border-0 px-4" placeholder="Subject" style="height: 55px;" required>
                            </div>
                            <div class="col-12">
                                <textarea name="message" class="form-control bg-light border-0 px-4 py-3" rows="8" placeholder="Message" required></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-danger w-100 py-3" type="submit">Gửi Tin Nhắn</button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="col-lg-5">
                    <div class="bg-light mb-5 p-5">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-geo-alt fs-1 text-danger me-3"></i>
                            <div class="text-start">
                                <h6 class="text-uppercase mb-1">Văn Phòng Chúng Tôi</h6>
                                <span>309, Nguyễn Thiếp, Phường Trung Đô, Thành Phố Vinh</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-envelope-open fs-1 text-danger me-3"></i>
                            <div class="text-start">
                                <h6 class="text-uppercase mb-1">Địa Chỉ Email </h6>
                                <span>PNTP_ET@example.com</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-phone-vibrate fs-1 text-danger me-3"></i>
                            <div class="text-start">
                                <h6 class="text-uppercase mb-1">Liên Hệ</h6>
                                <span>+84 339 573 127</span>
                            </div>
                        </div>
                        <div>
                            <iframe class="position-relative w-100"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                                frameborder="0" style="height: 205px; border:0;" allowfullscreen="" aria-hidden="false"
                                tabindex="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

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
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-danger me-2"></i>Về Chúng Tôi</a>
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
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-danger me-2"></i>Về Chúng Tôi</a>
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
                    <p class="mb-0">Thiết kế bởi <a class="text-white" href="https://facebook.com/Anhphap2004">AnhhPhapp</a></p>
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