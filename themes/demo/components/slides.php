<?php $id=rand(10000,99999); ?>
<div id="page-carousel<?php echo $id ?>" class="carousel slide site-slide" data-ride="carousel" style="background-image:<?php echo $background_image ?>">
    <ol class="carousel-indicators">
        <?php foreach($header_posts as $key=>$p){ ?>
            <li data-target="#page-carousel<?php echo $id ?>" data-slide-to="<?php echo $key ?>" ></li>
        <?php } ?>
    </ol>
    <div class="carousel-inner">
        <?php foreach($header_posts as $key=>$p){ ?>
            <div class="carousel-item <?php echo $key>0?:'active' ?>" style="background-image:url('<?php echo get_the_post_thumbnail_url($p->ID,[1024,768]); ?>')">
                <div class="carousel-overlay" style="<?php echo $card_style?:"height:100vh" ?>">
                    <div class="carousel-content" >
                        <h2 class="slide-title"><?php echo $only_content=="1" ? "" : $p->post_title ?></h2>
                        <div class="slide-text"><?php echo substr($p->post_content,0, strpos($p->post_content,"<!--more-->")?:strlen($p->post_content)) ?></div>
                        <?php if($p->post_excerpt!="") { ?>
                            <a href="<?php echo get_permalink($p) ?>" class="button bgcolor1 color-light"><?php echo $p->post_excerpt ?></a>
                        <?php } ?>
                        <?php if(isset( $wp_customize )) { ?>
                            <button class="button-edit-post" onclick="if (arguments[0]) arguments[0].preventDefault(); window.open('/wp-admin/post.php?post=<?php echo $p->ID ?>&action=edit','_blank')" target="_blank">Edit</button>
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