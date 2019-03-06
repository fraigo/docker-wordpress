<?php

require_once(dirname(__FILE__)."/../Base_Widget.php");

class Cards_Widget extends Base_Widget {

    function __construct(){
        
        parent::__construct("cards_widget","Cards Widget");
        
        $this->attributes["height"]=new Widget_Prop("Card Height","input",["type"=>"text"]);
        $this->attributes["type"]=new Widget_Prop("Card Type","select",["size"=>"1"],"<option>cards</option><option>slides</option>");
        $this->attributes["post1"]=new Widget_Prop("Post 1","input",["type"=>"number"]);
        $this->attributes["post2"]=new Widget_Prop("Post 2","input",["type"=>"number"]);
        $this->attributes["post3"]=new Widget_Prop("Post 3","input",["type"=>"number"]);
        
        add_action( 'widgets_init', function() {
            register_widget( 'Cards_Widget' );
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
        $type="cards";
        if ($instance["type"]!=''){
            $type=$instance["type"];
        }
        include("$base/components/$type.php");
    }

}