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
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="stylesheet" href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" >
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<nav class="navbar navbar-expand-md navbar-dark sticky-top bg-dark">
		<div class="navbar navbar-dark col-md-4 ">
			<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<h1><?php bloginfo( 'name' ); ?></h1>
				<small><?php echo get_bloginfo( 'description', 'display' ); ?></small>
			</a>
		</div>
		<div class="col-md-8 ">
			<div class="row navbar navbar-dark  navbar-expand ">
				<ul class="navbar-nav mx-auto">
					<li class="nav-item active">
						<a class="nav-link" href="./">Home <span class="sr-only">(current)</span></a>
					</li>
					<?php foreach( [] as $link) {?>
						<li class="nav-item">
							<a class="nav-link" href="#">Link</a>
						</li>
					<?php } ?>
					<li class="nav-item dropdown text-nowrap">
						<a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
						<div class="dropdown-menu" aria-labelledby="dropdown01">
							<?php foreach( get_categories() as $cat) {?>
							<a class="dropdown-item" href="<?php echo get_home_url() . "/category/" . $cat->slug ?>"><?php echo $cat->name ?></a>
							<?php } ?>
						</div>
					</li>
				</ul>
				<?php get_search_form() ?>
			</div>
		</div>
	</nav>
 <main role="main">
	 <div class="container">
			<div class="row p-0">
				<div class="col-md-4 p-3 bg-light">
					<div id="sidebar" class="sidebar">
						
						<?php get_sidebar(); ?>
					</div>
				</div>
				<div class="col-md-8">
					<div id="content" class="site-content">


