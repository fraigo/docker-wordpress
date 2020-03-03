<?php

require_once(dirname(__FILE__)."/../Base_Widget.php");

class Cards_Widget extends Base_Widget {

    function __construct(){
        
        parent::__construct("cards_widget","Cards Widget");
        
        $this->attributes["height"]=new Base_Prop("Card Height","input",["type"=>"text"]);
        $this->attributes["image_class"]=new Select_Prop("Image Type",["size"=>"1"],["circled"=>"Circle","wided"=>"Wide"],"");
        $this->attributes["post1"]=new Post_Prop("Post 1",["type"=>"text"]);
        $this->attributes["post2"]=new Post_Prop("Post 2",["type"=>"text"]);
        $this->attributes["post3"]=new Post_Prop("Post 3",["type"=>"text"]);
        
        add_action( 'widgets_init', function() {
            register_widget( 'Cards_Widget' );
        });
    }

    function render($instance){
        global $wp_customize;
        $base=dirname(dirname(__FILE__));
        $header_post_numbers=[1,2,3];
        $header_posts=[];
        foreach($header_post_numbers as $num){
            $postId = $instance["post$num"];
            if (is_numeric($postId) && count($header_posts)<3){
                $header_posts[]=get_post($postId);
            }
        }
        if (count($header_posts)){
            $colnum=12/count($header_posts);
        }
        $col_class="col-md-$colnum col-sm-12";
        if ($instance["height"]!=''){
            $card_style="height:{$instance["height"]}";    
        }
        if ($instance["image_class"]!=''){
            $card_image_class=$instance["image_class"];    
        }
        include("$base/components/cards.php");
    }

}