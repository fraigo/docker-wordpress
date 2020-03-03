<div class="container">
<div class="post-item post-content" style="<?php echo $style ?>" >
    <div class="post-title"><?php echo $show_title?$post->post_title:"" ?></div>
    <div class="post-content"><?php echo $post->post_content ?></div>
    <?php if(isset( $wp_customize )) { ?>
        <button onclick="if (arguments[0]) arguments[0].preventDefault(); window.open('/wp-admin/post.php?post=<?php echo $post->ID ?>&action=edit','_blank')" target="_blank">Edit post</button>
    <?php } ?>
</div>
</div>
