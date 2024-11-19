<?php
include "header.php";

$page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Lấy số trang hiện tại
$count = 2;

if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $searchResult = $items->SearchAndPaginate($keyword, $page, $count);
    $data = $searchResult['data'];
    $total = $searchResult['total'];
    $totalPages = $searchResult['total_pages'];
}
?>
<!-- News With Sidebar Start -->
<div class="container-fluid mt-5 pt-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h4 class="m-0 text-uppercase font-weight-bold">
                                <?php
                                if (isset($total)) {
                                    echo "Result: $total item(s)";
                                } else {
                                    echo "Vui lòng nhập từ khóa";
                                }
                                ?>
                            </h4>
                        </div>
                    </div>
                    <?php
                    if (!empty($data)) {
                        foreach ($data as $value):
                            $cateName = $categories->getnameById($value['category']);
                            $user = $users->getAuthorById($value['author']);
                    ?>
                    <div class="col-lg-6">
                        <div class="position-relative mb-3">
                            <img class="img-fluid w-100" src="img/<?php echo $value['image'] ?>"
                                style="object-fit: cover;">
                            <div class="bg-white border border-top-0 p-4">
                                <div class="mb-2">
                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                        href=""><?php echo $cateName[0]['name'] ?></a>
                                    <a class="text-body"
                                        href=""><small><?php echo date('d-m-Y', strtotime($value['created_at'])); ?></small></a>
                                </div>
                                <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold"
                                    href=""><?php echo $value['title'] ?></a>
                                <p class="m-0"><?php echo $value['excerpt'] ?></p>
                            </div>
                            <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle mr-2" src="img/user.jpg" width="25" height="25" alt="">
                                    <small><?php echo $user[0]['name'] ?></small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <small class="ml-3"><i
                                            class="far fa-eye mr-2"></i><?php echo $value['views'] ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        endforeach;
                    } else {
                        echo "Không có kết quả nào được tìm thấy.";
                    }
                    ?>
                </div>
                <!-- Phân trang -->
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <?php
                                if (isset($totalPages)) {
                                    for ($i = 1; $i <= $totalPages; $i++) {
                                        $active = ($i == $page) ? "class='active'" : "";
                                        echo "<li $active><a href='result.php?keyword=" . urlencode($keyword) . "&page=$i'>$i</a></li>";
                                    }
                                }
                                ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <?php include "social-sidebar.php" ?>
            </div>
        </div>
    </div>
</div>
<!-- News With Sidebar End -->

<!-- Footer Start -->
<?php include "footer.php" ?>
