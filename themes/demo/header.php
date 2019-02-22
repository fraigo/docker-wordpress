<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Demo
 * @since Demo 1.0
 */

include(dirname(__FILE__)."/options.php");
$theme_values = get_theme_values($theme_options);
$themepath=esc_url(home_url() . "/wp-content/themes/" . basename(dirname(__FILE__)));

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php if ($theme_values["demo_google_font"]) { ?>
	<link href="https://fonts.googleapis.com/css?family=<?php echo $theme_values["demo_google_font"] ?>" rel="stylesheet">
	<?php } ?>
	<link rel="stylesheet" href="<?php echo $themepath ?>/css/bootstrap.min.css" >
	<?php wp_head(); ?>
	<style>
	body, td, input, select, textarea {
		font-family: <?php echo $theme_values["demo_font_family"] ?>;
		font-size: <?php echo $theme_values["demo_font_size"] ?>pt;
		color: <?php echo $theme_values["demo_font_color"] ?>;
	}
	a:link, a:visited, a:hover, a:active {
		color: <?php echo $theme_values["demo_font_color"] ?>;
	}
	</style>
</head>
<?php
	$logo=get_custom_logo();
	$menuLocations = get_nav_menu_locations(); 
	$menuID = $menuLocations['primary']; 
	$primaryNav = wp_get_nav_menu_object($menuID);
	$primaryMenu = wp_get_nav_menu_items( $primaryNav->term_id);
	$categories = get_categories();
	$tags = get_tags();
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$logourl = wp_get_attachment_url( $custom_logo_id );
	$showCategories = false;
	$showTags = false;
	if (!$primaryNav) {
		$showCategories = true;
		$showTags = true;
		$primaryMenu=[
			(object)[
				"link" => esc_url( home_url() ),
				"title" => "Home"
			]
		];
	}

	//250,253,1168
	$header_post_numbers=[1,2,3];
	$header_posts=[];
	foreach($header_post_numbers as $num){
		$postId = $theme_values["demo_header$num"];
		if (is_numeric($postId) && count($header_posts)<3){
			$header_posts[]=get_post($postId);
		}
	}
	if (count($header_posts)){
		$colnum=12/count($header_posts);
	}
	$col_class="col-sm-$colnum";
	
	


?>
<body <?php body_class(); ?> >
	<div class="main-page" style="background-image:url(<?php echo $theme_values["demo_background_image"] ?>)">
	<nav id="site-navbar" class="navbar site-navbar navbar-expand-md <?php echo $theme_values["demo_navbar_class"] ?> sticky-top" 
	style="background-color:<?php echo $theme_values["demo_background_color"]?>" >
		<div class="navbar site-brand <?php echo $theme_values["demo_navbar_class"] ?> col-md-auto ">
			<a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>" rel="home">
			<div class="row">
				<div class="col-xs-auto">
					<img class="custom-logo" src="<?php echo esc_url($logourl) ?>" >
				</div>
				<div class="site-brand col-xs-auto ml-2">
					<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
					<?php if (get_bloginfo( 'description', 'display' )){ ?>
					<div  class="site-subtitle"><?php echo get_bloginfo( 'description', 'display' ); ?></div>
					<?php } ?>
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
									<div class="dropdown-menu" aria-labelledby="dropdown_categories">
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
									<div class="dropdown-menu" aria-labelledby="dropdown_tags">
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
							<div class="dropdown-menu" aria-labelledby="menu_<?php echo $menu->ID ?>">
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
	<div class="main-content">
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
	</div>
	</div>
 <main role="main">
	 <div class="container">
			<div class="row p-0">
				<?php /*
				<div class="col-md-4 p-3 bg-light">
					<div id="sidebar" class="sidebar">
						
						<?php get_sidebar(); ?>
					</div>
				</div>
				*/ ?>
				<div class="col-md-12 order-first">
					<div id="content" class="site-content">
					
						

