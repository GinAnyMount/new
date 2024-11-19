<div class="container-fluid pt-5 mb-3">
    <div class="container">
        <div class="section-title">
            <h4 class="m-0 text-uppercase font-weight-bold">Featured News</h4>
        </div>
        <div class="owl-carousel news-carousel carousel-item-4 position-relative">
            <?php
            $getFeature = $items->getFeatureNew();
            foreach ($getFeature as $key => $item) :
                $cateName = $categories->getnameById($item['category']);
            ?>
                <div class="position-relative overflow-hidden" style="height: 300px;">
                    <img class="img-fluid h-100" src="img/<?php echo $item['image'] ?>" style="object-fit: cover;">
                    <div class="overlay">
                        <div class="mb-2">
                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                href=""><?php echo $cateName[0]['name'] ?></a>
                            <a class="text-white" href=""><small><?php echo date('d-m-Y', strtotime($item['created_at'])); ?></small></a>
                        </div>
                        <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold" href=""><?php echo $item['title'] ?></a>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>