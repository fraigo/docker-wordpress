<?php
    $p=get_post();
    $thumbnailURL=get_the_post_thumbnail_url($p->ID,[1024,768]);
    $header_class="page-header";
    if ($thumbnailURL=="") $header_class="empty-header";
?>
<div class="<?php echo $header_class ?>" style="background-image:url('<?php echo $thumbnailURL; ?>')" >
    
</div>

