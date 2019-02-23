<div id="page-carousel" class="carousel site-slide" data-ride="carousel">
    <div class="carousel-inner">
        <?php foreach($header_posts as $key=>$p){ ?>
            <div class="carousel-item <?php echo $key>0?:'active' ?>" style="background-image:url('<?php echo get_the_post_thumbnail_url($p->ID,[1024,768]); ?>')">
                <div class="carousel-overlay">
                    <div class="carousel-content">
                        <h2 class="card-title"><?php echo $p->post_title ?></h2>
                        <p class="card-text"><?php echo $p->post_content ?></p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>