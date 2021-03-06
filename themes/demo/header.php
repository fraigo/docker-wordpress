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
$header_type=$theme_values["demo_header_type"];
$frontPage = is_front_page();
$theme_settings = get_theme_mods();
$currentPost = get_post();

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php if ($theme_values["demo_google_font"]) { ?>
	<link href="https://fonts.googleapis.com/css?family=<?php echo $theme_values["demo_google_font"] ?>:400,700" rel="stylesheet">
	<?php } ?>
	<link rel="stylesheet" href="<?php echo $themepath ?>/css/bootstrap.min.css" >
	<?php wp_head(); ?>
	<style>
	body, td, input, select, textarea {
		font-family: <?php echo $theme_values["demo_font_family"] ?>;
		font-size: <?php echo $theme_values["demo_font_size"] ?>pt;
		color: <?php echo $theme_values["demo_primary_color"] ?>;
	}
	a:link, a:visited, a:hover, a:active {
		color: <?php echo $theme_values["demo_primary_color"] ?>;
	}
	.color1,a.color1:link, a.color1:visited, a.color1:hover, a.color1:active{
		color: <?php echo $theme_values["demo_primary_color"] ?>;
	}
	.color2,a.color2:link, a.color2:visited, a.color2:hover, a.color2:active{
		color: <?php echo $theme_values["demo_secondary_color"] ?>;
	}
	.color-light,a.color-light:link, a.color-light:visited, a.color-light:hover, a.color-light:active{
		color: #fff;
	}
	.color-dark,a.color-dark:link, a.color-dark:visited, a.color-dark:hover, a.color-dark:active{
		color: #000;
	}
	.bgcolor1{
		background-color: <?php echo $theme_values["demo_primary_color"] ?>;
	}
	.bgcolor2{
		background-color: <?php echo $theme_values["demo_secondary_color"] ?>;
	}
	.bgcolor-light{
		background-color: #fff;
	}
	.bgcolor-dark{
		background-color: #000;
	}
	#content, .post-content {
		color: <?php echo $theme_values["demo_content_color"] ?>;
	}
	#content h1, #content h2, #content h3, #content h4,
	.post-content h1, .post-content h2, .post-content h3, .post-content h4, .post-content h5
	{
		color: <?php echo $theme_values["demo_primary_color"] ?>;
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
	
	if (!is_front_page()){
		$header_type="page";
	}

	$card_style="height:100vh";

?>
<body <?php body_class(); ?> >
	<div class="main-page" >
		<?php include("components/nav.php"); ?>
		<div class="main-content">
			<?php include("components/{$header_type}.php") ?>
			<?php if ( $frontPage && is_active_sidebar( 'custom-header-widget' ) ) : ?>
				<div id="header-widget-area" class="custom-header-widget-area widget-area" role="complementary">
					<?php dynamic_sidebar( 'custom-header-widget' ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
<!-- <?php print_r($currentPost->ID . " " .$currentPost->post_name); ?> -->
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
