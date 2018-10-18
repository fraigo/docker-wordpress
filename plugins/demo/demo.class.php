<?php

class Demo {
	
	private static $initiated = false;
	
	public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
		}
	}

	/**
	 * Initializes WordPress hooks
	 */
	private static function init_hooks() {
		self::$initiated = true;

		add_action( 'wp_head', array("Demo",'header') );
		add_action( 'admin_head', array("Demo",'header') );
		
    /*
		add_action( 'wp_insert_comment', array( 'Demo', 'wp_insert_comment' ), 10, 2 );
		add_filter( 'preprocess_comment', array( 'Demo', 'preprocess_comment' ), 1 );
		add_action( 'comment_form',  array( 'Demo',  'add_comment_nonce' ), 1 );
		add_action( 'comment_form', array( 'Demo', 'comment_form' ) );
		add_filter( 'script_loader_tag', array( 'Demo', 'script_loader_tag' ), 10, 3 );
		add_filter( 'comment_moderation_recipients', array( 'Demo', 'comment_moderation_recipients' ), 1000, 2 );
		add_filter( 'pre_comment_approved', array( 'Demo', 'pre_comment_approved' ), 10, 2 );
		add_action( 'transition_comment_status', array( 'Demo', 'transition_comment_status' ), 10, 3 );
		add_action( 'xmlrpc_call', array( 'Demo', 'pre_check_pingback' ) );
		add_filter( 'jetpack_options_whitelist', array( 'Demo', 'jetpack_options_whitelist' ) );
		add_action( 'update_option_wordpress_api_key', array( 'Demo', 'update_option_wordpress_api_key' ), 10, 2 );
		add_action( 'add_option_wordpress_api_key', array( 'Demo', 'add_option_wordpress_api_key' ), 10, 2 );
    add_action( 'comment_form_after',  array( 'Demo',  'comment_form_after' ) );
    */
	}
	
  /**
	 * Write extra header
	 * @static
	 */
	public static function header(){
		echo "<script src='https://fraigo.github.io/js-event-logger/event-logger.js'></script>";
	}

  /**
	 * Attached to activate_{ plugin_basename( __FILES__ ) } by register_activation_hook()
	 * @static
	 */
	public static function plugin_activation() {
		if ( version_compare( $GLOBALS['wp_version'], DEMOPLUGIN__MINIMUM_WP_VERSION, '<' ) ) {
			load_plugin_textdomain( 'demo' );
			
			$message = '<strong>'.sprintf(esc_html__( 'Demo %s requires WordPress %s or higher.' , 'demo'), DEMOPLUGIN_VERSION, DEMOPLUGIN__MINIMUM_WP_VERSION ).
			'</strong>'.sprintf(__('Please <a href="%1$s">upgrade WordPress</a> to a current version', 'demo'), 'https://codex.wordpress.org/Upgrading_WordPress');

			Demo::bail_on_activation( $message );
		}
	}

	/**
	 * Removes all connection options
	 * @static
	 */
	public static function plugin_deactivation( ) {
		
		$timestamp = wp_next_scheduled( "demo_cron_event" );
		if ( $timestamp ) {
			wp_unschedule_event( $timestamp, "demo_cron_event" );
		}
	
	}

	/**
	 * Show warning and deactivate plugin 
	 * @static
	 */
	private static function bail_on_activation( $message, $deactivate = true ) {
		include( DEMOPLUGIN__PLUGIN_DIR . 'message.html');
		if ( $deactivate ) {
			self::deactivate_plugin();
		}
		exit;
	}

	/**
	 * Deactivate current plugin
	 * @static
	 */
	private static function deactivate_plugin(){
		$plugins = get_option( 'active_plugins' );
		$current = plugin_basename( DEMOPLUGIN__PLUGIN_DIR . 'demo.php' );
		$update  = false;
		foreach ( $plugins as $i => $plugin ) {
			if ( $plugin === $current ) {
				$plugins[$i] = false;
				$update = true;
			}
		}

		if ( $update ) {
			update_option( 'active_plugins', array_filter( $plugins ) );
		}
	}
		


}