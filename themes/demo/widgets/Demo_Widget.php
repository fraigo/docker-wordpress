<?php

require_once(dirname(__FILE__)."/../Base_Widget.php");

class Demo_Widget extends Base_Widget {

    function __construct(){
        
        parent::__construct("demo_widget","Demo Widget");
        
        $this->attributes["text"]=new Widget_Prop("Content","textarea",["rows"=>"10"]);
        
        add_action( 'widgets_init', function() {
            register_widget( 'Demo_Widget' );
        });
    }

    function render($instance){
        echo esc_html__( $instance['text'], 'text_domain' );
    }

}