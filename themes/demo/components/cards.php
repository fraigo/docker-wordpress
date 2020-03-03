<?php $id=rand(10000,99999); ?>
<div id="cards_widget_<?php echo $id ?>" class="row site-cards">
    <?php foreach($header_posts as $p){ ?>
        <?php $thumbnailURL=get_the_post_thumbnail_url($p->ID,[300,300]); ?>
        <div class="card <?php echo $col_class ?> text-center" style="<?php echo $card_style?:"height:100vh" ?>">
            <div class="card-content">
                <h2 class="card-title"><?php echo $p->post_title ?></h2>
                <div class="<?php echo $card_image_class?:"rounded" ?>" style="background-image:url('<?php echo $thumbnailURL ?>')" ></div>
                <div class="card-text"><?php echo substr($p->post_content,0, strpos($p->post_content,"<!--more-->")?:strlen($p->post_content)) ?></div>
                
            </div>
            <?php if($p->post_excerpt!="") { ?>
                <div class="card-buttons">
                    <a href="<?php echo get_permalink($p) ?>" class="button bgcolor1 color-light"><?php echo $p->post_excerpt ?></a>
                </div>
            <?php } ?>
        </div>
        <?php if(isset( $wp_customize )) { ?>
            <button class="button-edit-post" onclick="if (arguments[0]) arguments[0].preventDefault(); window.open('/wp-admin/post.php?post=<?php echo $p->ID ?>&action=edit','_blank')" target="_blank">Edit</button>
        <?php } ?>
    <?php } ?>
</div>