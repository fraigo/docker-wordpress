<?php

require_once(dirname(__FILE__)."/../Base_Widget.php");

class Post_Widget extends Base_Widget {

    function __construct(){
        
        parent::__construct("post_widget","Post Widget");
        
        $this->attributes["height"]=new Base_Prop("Card Height","input",["type"=>"text"]);
        $this->attributes["post1"]=new Post_Prop("Post 1",["type"=>"text"]);
        
        add_action( 'widgets_init', function() {
            register_widget( 'Post_Widget' );
        });
    }

    function render($instance){
        global $wp_customize;
        $base=dirname(dirname(__FILE__));
        $header_post_numbers=[1,2,3];
        $header_posts=[];
        $postId = $instance["post1"];
        $post=get_post($postId);
        if ($instance["height"]!=''){
            $style="height:{$instance["height"]}";    
        }
        include("$base/components/post.php");
    }

}