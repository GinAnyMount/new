<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h4 class="m-0 text-uppercase font-weight-bold">Latest News</h4>
                            <a class="text-secondary font-weight-medium text-decoration-none" href="">View All</a>
                        </div>
                    </div>
                    <?php $getLastNew = $items->getLastNew(10);
                    foreach ($getLastNew as $key => $item) :
                        $cateName = $categories->getnameById($item['category']);
                        $user = $users->getAuthorById($item['author']); ?>

                        <div class="col-lg-6">
                            <div class="position-relative mb-3">
                                <img class="img-fluid w-100" src="img/<?php echo $item['image'] ?>" style="object-fit: cover;">
                                <div class="bg-white border border-top-0 p-4">
                                    <div class="mb-2">
                                        <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                            href=""><?php echo $cateName[0]['name'] ?></a>
                                        <a class="text-body" href=""><small><?php echo date('d-m-Y', strtotime($item['created_at'])); ?></small></a>
                                    </div>
                                    <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold" href=""><?php echo $item['title'] ?></a>
                                    <p class="m-0"><?php echo $item['excerpt'] ?></p>
                                </div>
                                <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle mr-2" src="img/user.jpg" width="25" height="25" alt="">
                                        <small><?php echo $user[0]['name'] ?></small>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <small class="ml-3"><i class="far fa-eye mr-2"></i><?php echo $item['views'] ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>

            <div class="col-lg-4">
                <?php include "social-sidebar.php" ?>
            </div>
        </div>
    </div>
</div>