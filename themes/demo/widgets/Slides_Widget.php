<?php

require_once(dirname(__FILE__)."/../Base_Widget.php");

class Slides_Widget extends Base_Widget {

    function __construct(){
        
        parent::__construct("slides_widget","Slides Widget");
        
        $this->attributes["height"]=new Base_Prop("Slide Height","input",["type"=>"text"]);
        $this->attributes["post1"]=new Base_Prop("Post 1","input",["type"=>"number"]);
        $this->attributes["post2"]=new Base_Prop("Post 2","input",["type"=>"number"]);
        $this->attributes["post3"]=new Base_Prop("Post 3","input",["type"=>"number"]);
        
        add_action( 'widgets_init', function() {
            register_widget( 'Slides_Widget' );
        });
    }

    function render($instance){
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
        include("$base/components/slides.php");
    }

}