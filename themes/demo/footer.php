<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Demo
 * @since Demo 1.0
 */
$themepath=esc_url(home_url() . "/wp-content/themes/" . basename(dirname(__FILE__)));
$currentPost = get_post();
?>
				</div>
			</div>
		</div>
	</div><!-- .site-content -->
	</main>

	<div class="main-page" >
		<div class="main-content">
			<?php if ( is_active_sidebar( $currentPost->post_name .'-widgets' ) ) : ?>
						<div id="<?php echo $currentPost->post_name .'widget-area' ?>" class="custom-widget-area widget-area" role="complementary">
							<?php dynamic_sidebar( $currentPost->post_name .'-widgets' ); ?>
						</div>
			<?php endif; ?>
		</div>
	</div>
  <footer id="footer">
			<?php if ( is_active_sidebar( 'custom-footer-widget' ) ) : ?>
				<div id="custom-footer-area" class="chw-widget-area widget-area" role="complementary">
					<?php dynamic_sidebar( 'custom-footer-widget' ); ?>
				</div>
			<?php endif; ?>
      <div class="container">
				<div class="site-info">
				<small>
					<?php
					if ( function_exists( 'the_privacy_policy_link' ) ) {
						the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>&nbsp;' );
					}
					?>
					<a href="<?php echo esc_url( __( 'https://franciscoigor.me/', 'demo' ) ); ?>" class="imprint">
						<?php printf( __( 'Theme by %s', 'demo' ), 'Francisco Igor' ); ?>
					</a>
				</small>
			</div><!-- .site-info -->
      </div>
    </footer>

<?php wp_footer(); ?>
<script src="<?php echo $themepath ?>/js/jquery-3.3.1.slim.min.js"></script>
<script src="<?php echo $themepath ?>/js/popper.min.js" ></script>
<script src="<?php echo $themepath ?>/js/bootstrap.min.js" ></script>
<script>
function updateNav(ev){
	var el=document.documentElement;
	var adminBar=document.getElementById("wpadminbar");
	var top= el.pageYOffset !== undefined ? el.pageYOffset : el.scrollTop;
	var nav=document.getElementById("site-navbar");
	var classNames=nav.className.split(" ");
	var pos=classNames.indexOf("scrolling");
	if (top>0){
		if (pos==-1){
			classNames.push("scrolling");
		}
		if (adminBar){
			adminBar.style.position='inherit';
		}
	}else{
		if (pos>=0){
			classNames.splice(pos,1);
		}
		if (adminBar){
			adminBar.style.position='fixed';
			adminBar.style.opacity=0.7;
		}
	}
	nav.className=classNames.join(" ");
}
window.onscroll=updateNav;
window.onload=updateNav;
</script>
</body>
</html>
