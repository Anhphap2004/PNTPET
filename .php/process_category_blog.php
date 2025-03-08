<!-- Category Start -->
<div class="mb-5">
    <h3 class="text-uppercase border-start border-5 border-primary ps-3 mb-4">Danh Mục</h3>
    <div class="d-flex flex-column justify-content-start">
        <?php
        require 'config.php'; // Kết nối database
        $sql = "SELECT * FROM blog_posts";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<a class="h5 bg-light py-2 px-3 mb-2" href="#">
                        <i class="bi bi-arrow-right me-2"></i>' . htmlspecialchars($row['category']) . '
                      </a>';
            }
        } else {
            echo '<p class="text-muted">No categories found.</p>';
        }
        $conn->close();
        ?>
    </div>
</div>
<!-- Category End -->