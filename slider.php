<!-- Main News Slider Start -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-7 px-0">
            <div class="owl-carousel main-carousel position-relative">
                <?php
                $get3NewItem = $items->getNewItems(0, 3);
                foreach ($get3NewItem as $key => $item) :
                    $cateName = $categories->getnameById($item['category']);
                ?>
                    <div class="position-relative overflow-hidden" style="height: 500px;">
                        <img class="img-fluid h-100" src="img/<?php echo $item['image'] ?>" style="object-fit: cover;">
                        <div class="overlay">
                            <div class="mb-2">
                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                    href=""><?php echo $cateName[0]['name'] ?></a>
                                <a class="text-white" href=""><small><?php echo date('d-m-Y', strtotime($item['created_at'])); ?></small></a>
                            </div>
                            <a class="h2 m-0 text-white text-uppercase font-weight-bold"
                                href=""><?php echo $item['title'] ?></a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <div class="col-lg-5 px-0">
            <div class="row mx-0">
                <?php
                $get4newItem = $items->getNewItems(0, 4);
                foreach ($get4newItem as $key => $item) :
                    $cateName = $categories->getnameById($item['category']);
                ?>
                    <div class="col-md-6 px-0">
                        <div class="position-relative overflow-hidden" style="height: 250px;">
                            <img class="img-fluid w-100 h-100" src="img/<?php echo $item['image'] ?>" style="object-fit: cover;">
                            <div class="overlay">
                                <div class="mb-2">
                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                        href=""><?php echo $cateName[0]['name'] ?></a>
                                    <a class="text-white" href=""><small><?php echo date('d-m-Y', strtotime($item['created_at'])); ?></small></a>
                                </div>
                                <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold" href=""><?php echo $item['title'] ?></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
<!-- Main News Slider End -->