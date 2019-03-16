<nav id="site-navbar" class="navbar site-navbar navbar-expand-md <?php echo $theme_values["demo_navbar_class"] ?> sticky-top" 
 style="background-image:<?php echo $theme_values["demo_background_image"] ?>; background-color:<?php echo $theme_values["demo_background_color"]?>" >
    <div class="navbar site-brand <?php echo $theme_values["demo_navbar_class"] ?> col-md-auto ">
        <a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>" rel="home">
        <div class="row">
            <div class="col-xs-auto">
                <img class="custom-logo" src="<?php echo esc_url($logourl) ?>" >
            </div>
            <div class="site-brand col-xs-auto ml-2">
                <?php if ($logourl=='' || $theme_settings["demo_theme_show_text"]=='1') : ?>
                    <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
                    <?php if (get_bloginfo( 'description', 'display' )){ ?>
                    <div  class="site-subtitle"><?php echo get_bloginfo( 'description', 'display' ); ?></div>
                    <?php } ?>
                <?php endif; ?>
            </div>
        </div>
        </a>
    </div>
    <div class="col-md">
        <div class="row site-menu navbar <?php echo $theme_values["demo_navbar_class"] ?> navbar-expand ">
            <ul class="navbar-nav ">
                <?php 
                    $subitems=[];
                    foreach( $primaryMenu as $idx => $menu) {
                        if (!$subitems[$menu->menu_item_parent]){
                            $subitems[$menu->menu_item_parent]=[];
                        }
                        $subitems[$menu->menu_item_parent][]=$menu;
                    }
                    foreach( $primaryMenu as $idx => $menu) {
                        if ($menu->title=="Categories"){
                            ?>
                            <li class="nav-item dropdown text-nowrap">
                                <a class="nav-link dropdown-toggle" href="" id="dropdown_categories" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
                                <div class="nav-submenu dropdown-menu" aria-labelledby="dropdown_categories">
                                    <?php foreach( get_categories() as $item) {?>
                                    <a class="dropdown-item" href="<?php echo esc_url(home_url() . "/category/" . $item->slug) ?>"><?php echo $item->name ?></a>
                                    <?php } ?>
                                </div>
                            </li>
                            <?php
                            continue;
                        }
                        if ($menu->title=="Tags"){
                            ?>
                            <li class="nav-item dropdown text-nowrap">
                                <a class="nav-link dropdown-toggle" href="" id="dropdown_tags" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tags</a>
                                <div class="nav-submenu dropdown-menu" aria-labelledby="dropdown_tags">
                                    <?php foreach( $tags as $item) {?>
                                    <a class="dropdown-item" href="<?php echo esc_url(home_url() . "/tag/" . $item->slug) ?>"><?php echo $item->name ?></a>
                                    <?php } ?>
                                </div>
                            </li>
                            <?php
                            continue;
                        }
                        if ($menu->menu_item_parent>0){
                            continue;
                        }
                        if (@count($subitems[$menu->ID])){
                ?>
                    <li class="nav-item dropdown text-nowrap <?php echo $menu->active ?>">
                        <a class="nav-link dropdown-toggle" href="#" id="menu_<?php echo $menu->ID ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $menu->title ?></a>
                        <div class="nav-submenu dropdown-menu" aria-labelledby="menu_<?php echo $menu->ID ?>">
                            <?php foreach( $subitems[$menu->ID] as $submenu) {?>
                            <a class="dropdown-item" href="<?php echo $submenu->url ?>"><?php echo $submenu->title ?></a>
                            <?php } ?>
                        </div>
                    </li>
                <?php				
                            continue;
                        }
                ?>
                    <li class="nav-item text-nowrap <?php echo $menu->active ?>">
                        <a class="nav-link" href="<?php echo $menu->url ?>"><?php echo $menu->title ?></a>
                    </li>
                <?php } ?>
            </ul>
            <?php if ($showSearch) { ?>
            <?php get_search_form(["header"=>false]) ?>
            <?php } ?>
        </div>
    </div>
</nav>