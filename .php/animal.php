<?php
include("config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PET SHOP - Pet Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <link href="https://cdn.leanhduc.pro.vn/utilities/multi-color-star-effects/style.css" rel="stylesheet" />
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:wght@700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Icon Font Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
    <Style>
        .card-img-container {
            width: 100%;
            height: 200px;
            /* Chiều cao cố định */
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .card-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Giữ tỉ lệ và căn giữa */
            border-radius: 10px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
    </Style>
</head>

<body>
    <canvas id="canvas" style="position:fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 9999;"></canvas>
    <!-- PHẦN KHỞI TẠO MENU  Start -->
    <?php
    include("process_menu.php");
    ?>
    <!-- MENU End -->
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="border-start border-5 border-danger ps-5 mb-5" style="max-width: 600px;">
                <h6 class="text-danger text-uppercase">THÚ CƯNG</h6>
                <h1 class="display-5 text-uppercase mb-0">THƯ VIỆN THÚ CƯNG</h1>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <?php
            $sql = "SELECT * FROM animals";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-img-container">
                                <img src="../img/Animal/<?= htmlspecialchars($row["image"]) ?>" class="card-img-top img-fluid" alt="<?= htmlspecialchars($row["name"]) ?>">
                            </div>
                            <div class="card-body text-center">
                                <h5 class="card-title">
                                    <a href="detail_animal.php?id=<?= $row['animal_id'] ?>" class="text-decoration-none">
                                        <?= htmlspecialchars($row['name']) ?>
                                    </a>
                                </h5>
                                <p class="card-text text-danger fst-italic"><?= htmlspecialchars($row["breed"]) ?></p>
                                <p class="card-text"><?= htmlspecialchars($row["description"]) ?></p>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p class='text-center'>Không có thú cưng nào.</p>";
            }
            // Đóng kết nối
            $conn->close();
            ?>

        </div>



    </div> <!-- Đóng row đúng chỗ -->



</body>
<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../lib/easing/easing.min.js"></script>
<script src="../lib/waypoints/waypoints.min.js"></script>
<script src="../lib/owlcarousel/owl.carousel.min.js"></script>
<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.leanhduc.pro.vn/jquery/3.6.0.min.js"></script>
<script src="https://cdn.leanhduc.pro.vn/utilities/multi-color-star-effects/main.js"></script>
<!-- Template Javascript -->
<script src="../js/main.js"></script>
</body>

</html>