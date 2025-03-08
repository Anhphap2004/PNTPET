<!-- Recent Post Start -->
<div class="mb-5">
    <h3 class="text-uppercase border-start border-5 border-primary ps-3 mb-4">Bài Viết Gần Nhất</h3>
    <?php
    require 'config.php'; // Kết nối database

    // Lấy 5 bài viết mới nhất
    $sql = "SELECT * FROM blog_posts ORDER BY created_at DESC LIMIT 5";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($post = $result->fetch_assoc()) {
            echo '<div class="d-flex overflow-hidden mb-3">
                    <img class="img-fluid" src="../img/Blog/' . htmlspecialchars($post['featured_image']) . '" 
                        style="width: 100px; height: 100px; object-fit: cover;" alt="' . htmlspecialchars($post['title']) . '">
                    <a href="process_blog_detail.php?id=' . $post['post_id'] . '" 
                        class="h6 d-flex align-items-center bg-light px-3 mb-0">' . htmlspecialchars($post['title']) . '
                    </a>
                  </div>';
        }
    } else {
        echo '<p class="text-muted">No recent posts found.</p>';
    }

    $conn->close();
    ?>
</div>
<!-- Recent Post End -->