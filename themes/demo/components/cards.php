<?php $id=rand(10000,99999); ?>
<div id="cards_widget_<?php echo $id ?>" class="row site-cards">
    <?php foreach($header_posts as $p){ ?>
        <?php $thumbnailURL=get_the_post_thumbnail_url($p->ID,[300,300]); ?>
        <div class="card <?php echo $col_class ?> text-center" style="<?php echo $card_style?:"height:100vh" ?>">
            <div class="card-content">
                <div class="<?php echo $card_image_class?:"rounded" ?>" style="background-image:url('<?php echo $thumbnailURL ?>')" ></div>
                <h2 class="card-title"><?php echo $p->post_title ?></h2>
                <div class="card-text"><?php echo $p->post_content ?></div>
            </div>
        </div>
    <?php } ?>
</div>