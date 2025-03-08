<?php
include './config.php';

// Lấy danh sách menu từ database
$sql = "SELECT * FROM menu_items ORDER BY order_index ASC";
$result = $conn->query($sql);
?>

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm py-3 py-lg-0 px-3 px-lg-0">
    <a href="index.php" class="navbar-brand ms-lg-5">
        <h1 class="m-0 text-uppercase text-dark"><i class="bi bi-shop fs-1 text-primary me-3"></i>PNTPET 🐱</h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<a href="' . '.' . $row["url"] . '" class="nav-item nav-link">' . $row["title"] . '</a>';
                }
            } else {
                echo '<a class="nav-item nav-link">No Menu</a>';
            }
            ?>
            <a href="contact.php" class="nav-item nav-link nav-contact bg-primary text-white px-5 ms-lg-5"> <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>
</nav>
<!-- Navbar End -->