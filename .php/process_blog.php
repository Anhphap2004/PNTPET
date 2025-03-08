<?php
include 'config.php';

$sql = 'select * from blog_posts';
$result = $conn->query($sql);

?>
<!-- Blog Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
            <h6 class="text-primary text-uppercase">Bài Viết</h6>
         
        </div>
        <div class="row g-5">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="col-lg-6">
                    <div class="blog-item">
                        <div class="row g-0 bg-light overflow-hidden">
                            <div class="col-12 col-sm-5 h-100">
                                <img class="img-fluid h-100" src="../img/blog/<?php echo $row['featured_image']; ?>" style="object-fit: cover;">
                            </div>
                            <div class="col-12 col-sm-7 h-100 d-flex flex-column justify-content-center">
                                <div class="p-4">
                                    <div class="d-flex mb-3">
                                        <small class="me-3"><i class="bi bi-bookmarks me-2"></i><?php echo $row['category']; ?></small>
                                        <small><i class="bi bi-calendar-date me-2"></i><?php echo date("d M, Y", strtotime($row['created_at'])); ?></small>
                                    </div>
                                    <h5 class="text-uppercase mb-3"><?php echo $row['title']; ?></h5>
                                    <p><?php echo substr($row['excerpt'], 0, 100) . '...'; ?></p>
                                    <a class="text-primary text-uppercase" href="process_blog_detail.php?id=<?php echo $row['post_id']; ?>">Read More<i class="bi bi-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- Blog End -->

<?php $conn->close();
?>