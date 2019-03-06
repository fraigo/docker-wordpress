<?php $id=rand(10000,99999); ?>
<div id="page-carousel<?php echo $id ?>" class="carousel slide site-slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php foreach($header_posts as $key=>$p){ ?>
            <li data-target="#page-carousel<?php echo $id ?>" data-slide-to="<?php echo $key ?>" ></li>
        <?php } ?>
    </ol>
    <div class="carousel-inner">
        <?php foreach($header_posts as $key=>$p){ ?>
            <div class="carousel-item <?php echo $key>0?:'active' ?>" style="background-image:url('<?php echo get_the_post_thumbnail_url($p->ID,[1024,768]); ?>')">
                <div class="carousel-overlay" style="<?php echo $card_style?:"height:100vh" ?>">
                    <div class="carousel-content" onclick="document.location=this.dataset.url" data-url="<?php echo get_permalink($p) ?>">
                        <h2 class="slide-title"><?php echo $p->post_title ?></h2>
                        <p class="slide-text"><?php echo $p->post_content ?></p>
                        <?php if($p->post_excerpt!="") { ?>
                            <button class="bgcolor1 color-light"><?php echo $p->post_excerpt ?></button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <a class="carousel-control-prev" href="#page-carousel<?php echo $id ?>" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#page-carousel<?php echo $id ?>" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>