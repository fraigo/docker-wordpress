<div class="row site-cards">
    <?php foreach($header_posts as $p){ ?>
        <div class="card <?php echo $col_class ?> text-center">
            <div class="card-content">
                <?php echo get_the_post_thumbnail($p->ID,[100,100],["class"=>"rounded"]) ?>
                <h2 class="card-title"><?php echo $p->post_title ?></h2>
                <p class="card-text"><?php echo $p->post_content ?></p>
            </div>
        </div>
    <?php } ?>
</div>