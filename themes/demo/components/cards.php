<?php $id=rand(10000,99999); ?>
<div id="cards_widget_<?php echo $id ?>" class="row site-cards">
    <?php foreach($header_posts as $p){ ?>
        <div class="card <?php echo $col_class ?> text-center" style="<?php echo $card_style?:"height:100vh" ?>">
            <div class="card-content">
                <?php echo get_the_post_thumbnail($p->ID,[100,100],["class"=>$card_image_class?:"rounded"]) ?>
                <h2 class="card-title"><?php echo $p->post_title ?></h2>
                <div class="card-text"><?php echo $p->post_content ?></div>
            </div>
        </div>
    <?php } ?>
</div>