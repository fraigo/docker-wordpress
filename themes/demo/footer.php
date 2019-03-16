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
?>
				</div>
			</div>
		</div>
	</div><!-- .site-content -->

  <footer class="footer">
			<?php if ( is_active_sidebar( 'custom-footer-widget' ) ) : ?>
				<div id="header-footer-area" class="chw-widget-area widget-area" role="complementary">
					<?php dynamic_sidebar( 'custom-footer-widget' ); ?>
				</div>
			<?php endif; ?>
      <div class="container">
				<div class="site-info">
				<?php
					
					do_action( 'demo_credits' );
				?>
				<?php
				if ( function_exists( 'the_privacy_policy_link' ) ) {
					the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
				}
				?>
				<a href="<?php echo esc_url( __( 'https://franciscoigor.me/', 'demo' ) ); ?>" class="imprint">
					<small><?php printf( __( 'Theme by %s', 'demo' ), 'Francisco Igor' ); ?></small>
				</a>
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
