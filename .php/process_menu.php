<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';
include './config.php';

// Get menu items from database
$sql = "SELECT * FROM menu_items ORDER BY order_index ASC";
$result = $conn->query($sql);

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!-- Improved Navbar Start -->
<nav class="navbar navbar-expand-lg sticky-top py-3" style="background-color: #ffffff; box-shadow: 0 5px 15px rgba(220, 53, 69, 0.08);">
    <div class="container">
        <!-- Logo -->
        <a href="index.php" class="navbar-brand d-flex align-items-center"
            style="text-decoration: none; display: flex; align-items: center; transition: transform 0.3s ease-in-out;"
            onmouseover="this.style.transform='scale(1.1)'"
            onmouseout="this.style.transform='scale(1)'">

            <div class="d-flex align-items-center">
                <i class="fa-solid fa-paw fs-1 me-2" style="color: #dc3545;"></i>
                <h1 class="m-0 text-uppercase fw-bold"
                    style="font-size: 32px; font-weight: bold; letter-spacing: 2px; transition: color 0.3s ease-in-out, text-shadow 0.3s ease-in-out;">

                    <span class="brand-title" style="color: #dc3545; transition: color 0.3s ease-in-out;">PNT</span>
                    <span>PET</span>
                </h1>
            </div>
        </a>


        <!-- Toggle button -->
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0">
                <?php
                $currentPage = basename($_SERVER['PHP_SELF']);
                while ($menu = $result->fetch_assoc()):
                    // Cập nhật đường dẫn với tiền tố "php/"
                    $menuUrl = ltrim($menu['url'], '/');
                    $isActive = (basename($menuUrl) == $currentPage) ? 'active' : '';
                ?>
                    <a style="color: #b31818" href="<?= $menuUrl ?>" class="nav-item fw-bolder text-uppercase nav-link fw-medium mx-2 <?= $isActive ?>">
                        <?= $menu['title'] ?>
                        <?php if ($isActive): ?>
                            <div class="nav-indicator"></div>
                        <?php endif; ?>
                    </a>
                <?php endwhile; ?>
            </div>

            <div class="d-flex align-items-center gap-3">
                <div class="nav-item mx-2" style="position: relative;"
                    onmouseover="document.getElementById('accountDropdown').style.display='block'; document.getElementById('accountDropdown').style.opacity='1'; document.getElementById('accountDropdown').style.transform='translateY(0)';"
                    onmouseout="document.getElementById('accountDropdown').style.display='none'; document.getElementById('accountDropdown').style.opacity='0'; document.getElementById('accountDropdown').style.transform='translateY(10px)';">
                    <a href="#" class="nav-link fw-medium" style="position: relative; overflow: hidden; color: #b31818;">
                        <?php if ($isLoggedIn): ?>
                            Tài khoản <i class="bi bi-person-circle"></i>
                        <?php else: ?>
                            Đăng nhập <i class="bi bi-person"></i>
                        <?php endif; ?>
                        <span
                            style="position: absolute; bottom: 0; left: 0; width: 100%; height: 2px; background: linear-gradient(90deg, transparent, #dc3545, transparent); transform: scaleX(0); transition: transform 0.3s; transform-origin: center;"></span>
                    </a>

                    <!-- Dropdown content -->
                    <div id="accountDropdown"
                        style="display: none; position: absolute; top: 100%; right: 0; min-width: 220px; background-color: white; border-radius: 10px; padding: 15px; box-shadow: 0 15px 35px rgba(220, 53, 69, 0.2); z-index: 1000; opacity: 0; transform: translateY(10px); transition: all 0.3s cubic-bezier(0.68, -0.55, 0.27, 1.55);">

                        <div class="text-center mb-3">
                            <div style="width: 60px; height: 60px; margin: 0 auto; background: linear-gradient(45deg, #dc3545, #ff6b81); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-person-fill" style="font-size: 30px; color: white;"></i>
                            </div>
                            <?php if ($isLoggedIn): ?>
                                <p class="mt-2 mb-3" style="font-size: 14px; color: #666;">Chào, <strong><?php echo $_SESSION['username']; ?></strong></p>
                            <?php else: ?>
                                <p class="mt-2 mb-3" style="font-size: 14px; color: #666;">Đăng nhập để truy cập tài khoản</p>
                            <?php endif; ?>
                        </div>

                        <?php if ($isLoggedIn): ?>
                            <!-- Nếu đã đăng nhập -->
                            <a href="profile.php" class="btn w-100 mb-2"
                                style="background: white; color: #dc3545; border: 2px solid #dc3545; border-radius: 30px; padding: 8px 15px; transition: all 0.3s ease; font-weight: 500;">
                                <i class="bi bi-person-circle me-2"></i> Hồ sơ
                            </a>
                            <a href="orders.php" class="btn w-100 mb-2"
                                style="background: white; color: #dc3545; border: 2px solid #dc3545; border-radius: 30px; padding: 8px 15px; transition: all 0.3s ease; font-weight: 500;">
                                <i class="bi bi-bag-check me-2"></i> Đơn hàng
                            </a>
                            <a href="logout.php" class="btn w-100"
                                style="background: linear-gradient(45deg, #dc3545, #ff6b81); color: white; border: none; border-radius: 30px; padding: 10px 15px; transition: all 0.3s ease; font-weight: 500; box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);">
                                <i class="bi bi-box-arrow-right me-2"></i> Đăng xuất
                            </a>
                        <?php else: ?>
                            <!-- Nếu chưa đăng nhập -->
                            <a href="login.php" class="btn w-100 mb-2"
                                style="background: white; color: #dc3545; border: 2px solid #dc3545; border-radius: 30px; padding: 8px 15px; transition: all 0.3s ease; font-weight: 500;">
                                <i class="bi bi-box-arrow-in-right me-2"></i> Đăng nhập
                            </a>
                            <a href="signup.php" class="btn w-100"
                                style="background: linear-gradient(45deg, #dc3545, #ff6b81); color: white; border: none; border-radius: 30px; padding: 10px 15px; transition: all 0.3s ease; font-weight: 500; box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);">
                                <i class="bi bi-person-plus me-2"></i> Đăng ký
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

            </div>


            <!-- Contact button -->
            <div>
                <a href="contact.php" class="btn px-4 py-2"
                    style="background: linear-gradient(45deg, #dc3545, #ff6b81); color: white; border-radius: 30px; box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3); transition: all 0.3s ease; font-weight: 500;">
                    Liên hệ <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
    </div>
</nav>