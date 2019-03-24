<?php $id=$id?:rand(10000,99999); ?>
<div id="progress-carousel<?php echo $id ?>" class="carousel slide progress-slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php foreach($progress_steps as $key=>$p){ ?>
            <li data-target="#progress-carousel<?php echo $id ?>" data-slide-to="<?php echo $key ?>" ><?php echo ($key+1) ?></li>
        <?php } ?>
    </ol>
    <div class="carousel-inner">
        <?php foreach($progress_steps as $key=>$step){ ?>
            <div class="carousel-item <?php echo $key>0?:'active' ?>" style="height:<?php echo $height?:"inherit" ?>;color:<?php echo $text_color?:"#fff" ?>;background-color:<?php echo $bgcolor?:"#aaa" ?>;background-image:<?php echo $backgroundImage?:"inherit" ?>">
                <div class="carousel-overlay" style="height:250px">
                    <div class="carousel-content" >
                        <h2 class="slide-title"><?php echo $step["header"] ?></h2>
                        <div class="slide-text"><?php echo $step["text"] ?></div>
                        <?php if($step["button"]!="") { ?>
                            <button class="bgcolor1 color-light"><?php echo $step["button"] ?></button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <a class="carousel-control-prev" href="#progress-carousel<?php echo $id ?>" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#progress-carousel<?php echo $id ?>" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>