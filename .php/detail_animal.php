<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PET SHOP - Pet Shop Website Template</title>
    <meta comment="width=device-width, initial-scale=1.0" name="viewport">
    <meta comment="Free HTML Templates" name="keywords">
    <meta comment="Free HTML Templates" name="description">
    <link href="https://cdn.leanhduc.pro.vn/utilities/multi-color-star-effects/style.css" rel="stylesheet" />
    <!-- Favicon -->
    <link href="../img/favicon.ico" rel="icon">

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

    <!-- Animal Start -->
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-8">
                <!-- Animal Detail Start -->
                <?php
                include 'config.php';
                if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                    $animal_id = $_GET['id'];

                    // Truy vấn lấy thông tin bài viết
                    $sql = "SELECT * FROM animals WHERE animal_id = $animal_id";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                    } else {
                        die("Bài viết không tồn tại.");
                    }
                } else {
                    die("ID bài viết không hợp lệ.");
                }
                $conn->close();
                ?>

                <!-- Hiển thị bài viết -->
                <div class="mb-5">
                    <img class="img-fluid w-100 rounded mb-5" src="../img/Animal/<?php echo htmlspecialchars($row['image']); ?>" alt="">
                    <h1 class="text-uppercase mb-4"><?php echo htmlspecialchars($row['name']); ?></h1>
                    <p><?php echo ($row['detail']); ?></p>
                    <small>Ngày đăng: <?php echo date("d/m/Y", strtotime($row['created_at'])); ?></small>
                </div>
                <!-- Blog Detail End -->

                <!-- Kết nối đến database -->
                <?php
                require 'config.php'; // File chứa kết nối MySQL

                // Lấy ID bài viết từ URL
                $animal_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

                // Truy vấn lấy danh sách bình luận
                $sql_comments = "SELECT users.profile_image, users.full_name, reviews.* 
                 FROM reviews Left JOIN users ON users.user_id = reviews.user_id 
                 WHERE animal_id = ? 
                 ORDER BY created_at DESC";

                $stmt_comments = $conn->prepare($sql_comments);
                $stmt_comments->bind_param("i", $animal_id);
                $stmt_comments->execute();
                $result_comments = $stmt_comments->get_result();
                ?>

                <!-- Comment List Start -->
                <div class="mb-5">
                    <h3 class="text-uppercase border-start border-5 border-danger ps-3 mb-4">
                        <?php echo $result_comments->num_rows; ?> Người bình luận 💭
                    </h3>

                    <?php while ($comment = $result_comments->fetch_assoc()) : ?>
                        <div class="d-flex mb-4">
                            <?php
                            // Nếu có user_id, lấy ảnh đại diện và tên từ bảng users
                            if (!empty($comment['user_id'])) {
                                $sql_user = "SELECT full_name, profile_image FROM users WHERE user_id = ?";
                                $stmt_user = $conn->prepare($sql_user);
                                $stmt_user->bind_param("i", $comment['user_id']);
                                $stmt_user->execute();
                                $result_user = $stmt_user->get_result();
                                $user = $result_user->fetch_assoc();
                                $stmt_user->close();

                                $display_name = $user['full_name'] ?? 'Người dùng';
                                $profile_image = !empty($user['profile_image']) ? '../img/Username/' . $user['profile_image'] : '../img/Animal/meocon.jpg';
                            } else {
                                // Nếu không có user_id, lấy thông tin từ comment
                                $display_name = $comment['name'];
                                $profile_image = '../img/Animal/meocon.jpg'; // Ảnh mặc định
                            }
                            ?>
                            <img src="<?php echo htmlspecialchars($profile_image); ?>" class="img-fluid rounded-circle"
                                style="width: 45px; height: 45px; object-fit: cover;">
                            <div class="ps-3">
                                <h6>
                                    <a class="text-danger" href="">
                                        <?php echo htmlspecialchars($display_name); ?>
                                    </a>
                                    <small><i><?php echo date("d M Y", strtotime($comment['created_at'])); ?></i></small>
                                </h6>
                                <p><?php echo nl2br(htmlspecialchars($comment['comment'])); ?></p>
                                <button class="btn btn-sm btn-light">Phản Hồi</button>
                            </div>
                        </div>
                    <?php endwhile; ?>


                </div>
                <!-- Comment List End -->
                <?php
                // Đóng statement
                $stmt_comments->close();
                ?>

                <!-- Comment List End -->

                <!-- Comment Form Start -->
                <!-- Comment Form Start -->
                <div class="bg-light rounded p-4 shadow">
                    <h3 class="text-uppercase border-start border-5 border-danger ps-3 mb-4">Leave a comment</h3>
                    <form action="process_review.php" method="POST">
                        <input type="hidden" name="animal_id" value="<?php echo $animal_id; ?>">

                        <div class="row g-3">
                            <?php if (!isset($_SESSION['user_id'])) : ?>
                                <!-- Nếu người dùng chưa đăng nhập -->
                                <div class="col-12 col-sm-6">
                                    <input type="text" name="name" class="form-control bg-white border rounded-pill px-3"
                                        placeholder="Your Name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" required
                                        style="height: 50px;">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="email" name="email" class="form-control bg-white border rounded-pill px-3"
                                        placeholder="Your Email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required
                                        style="height: 50px;">
                                </div>
                            <?php else: ?>
                                <!-- Nếu đã đăng nhập, lấy user_id -->
                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                            <?php endif; ?>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <textarea name="comment" class="form-control bg-white border rounded-3 px-3 py-2"
                                    rows="5" placeholder="Write your comment..." required><?php echo htmlspecialchars($_POST['comment'] ?? ''); ?></textarea>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <button class="btn btn-danger w-100 py-3 rounded-pill fw-bold" type="submit">
                                    🚀 Leave Your Comment
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
                <!-- Comment Form End -->

            </div>

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

                <?php
                // Lấy danh mục động vật bằng JOIN với bảng categories
                $sql = "SELECT animals.*, animal_categories.category_name
        FROM animals
        JOIN animal_categories ON animals.category_id = animal_categories.category_id
        WHERE animal_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $animal_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $category = $result->fetch_assoc();
                $stmt->close();
                ?>

                <!-- DANH MỤC THÚ CƯNG Category Start -->
                <div class="mb-5">
                    <h3 class="text-uppercase border-start border-5 border-danger ps-3 mb-4">DANH MỤC</h3>
                    <div class="d-flex flex-column justify-content-start">
                        <?php if (!empty($category) && isset($category['category_name'])) : ?>
                            <a href="#" class="d-flex align-items-center py-2 px-3 bg-light mb-1">
                                <i class="bi bi-arrow-right text-danger me-2"></i>
                                <span class="fw-bold fs-5 text-danger category-highlight">
                                    <?= htmlspecialchars($category['category_name']) ?>
                                </span>
                            </a>
                        <?php else : ?>
                            <p class="text-muted px-3">Không có danh mục nào.</p>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Category End -->



                <!-- Recent Post Start -->
                <?php
                // Lấy category_id của động vật hiện tại
                $sql = "SELECT category_id FROM animals WHERE animal_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $animal_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $currentAnimal = $result->fetch_assoc();
                $category_id = $currentAnimal['category_id'];
                $stmt->close();

                // Truy vấn danh sách động vật cùng danh mục (loại trừ con hiện tại)
                $sql = "SELECT animal_id, name, image, description 
        FROM animals 
        WHERE category_id = ? AND animal_id != ? 
        LIMIT 5"; // Giới hạn số lượng hiển thị
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ii", $category_id, $animal_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $relatedAnimals = $result->fetch_all(MYSQLI_ASSOC);
                $stmt->close();
                ?>
                <div class="mb-5">
                    <h3 class="text-uppercase border-start border-5 border-danger ps-3 mb-4 text-danger">Động vật liên quan</h3>

                    <?php if (!empty($relatedAnimals)) : ?>
                        <?php foreach ($relatedAnimals as $animal) : ?>
                            <div class="d-flex overflow-hidden mb-3 align-items-start">
                                <img class="img-fluid" src="../img/Animal/<?= htmlspecialchars($animal['image']) ?>" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                                <div class="ms-2">
                                    <a href="detail_animal.php?id=<?= $animal['animal_id'] ?>" class="animal-name text-danger"><?= htmlspecialchars($animal['name']) ?></a>
                                    <p class="animal-desc"><?= htmlspecialchars($animal['description']) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p class="text-muted px-3">Không có động vật liên quan.</p>
                    <?php endif; ?>
                </div>
                <!-- Recent Post End -->

                <!-- Recent Post End -->

                <!-- Image Start -->
                <div class="mb-5">
                    <?php
                    include 'config.php';

                    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                        $animal_id = $_GET['id'];

                        // Dùng Prepared Statement để tránh SQL Injection
                        $stmt = $conn->prepare("SELECT * FROM animals WHERE animal_id = ?");
                        $stmt->bind_param("i", $animal_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $image_path = !empty($row['image']) ? '../img/Animal/' . htmlspecialchars($row['image']) : 'uploads/default.jpg';
                        } else {
                            die("⚠️ Bài viết không tồn tại.");
                        }
                        $stmt->close();
                    } else {
                        die("⚠️ ID bài viết không hợp lệ.");
                    }

                    $conn->close();
                    ?>
                    <img class="img-fluid rounded" src="<?php echo $image_path; ?>" alt="Blog Image">
                </div>
                <!-- Image End -->


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
                    <div class="d-flex flex-column justify-comment-start">
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
                    <div class="d-flex flex-column justify-comment-start">
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

    <script src="https://cdn.leanhduc.pro.vn/jquery/3.6.0.min.js"></script>
    <script src="https://cdn.leanhduc.pro.vn/utilities/multi-color-star-effects/main.js"></script>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
</body>

</html>