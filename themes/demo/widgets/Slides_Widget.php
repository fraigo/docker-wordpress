<?php

require_once(dirname(__FILE__)."/../Base_Widget.php");

class Slides_Widget extends Base_Widget {

    function __construct(){
        
        parent::__construct("slides_widget","Slides Widget");
        
        $this->attributes["height"]=new Base_Prop("Slide Height","input",["type"=>"text"]);
        $this->attributes["vertical_align"]=new Select_Prop("Vertical Align",["size"=>"1"],["flex-end"=>"Bottom","flex-start"=>"Top"],"");
        $this->attributes["only_content"]=new Select_Prop("Content type",["size"=>"1"],["0"=>"Title and content","1"=>"Only content"],"");
        $this->attributes["background_image"]=new Base_Prop("Background-image","input",["type"=>"text","placeholder"=>"url('image-url')"]);
        $this->attributes["opacity"]=new Base_Prop("Background opacity","input",["type" => "range",
        "min" => "0",
        "max" => "1",
        "step" => "0.1",
        "onmouseover" => "this.title=this.value"]);
        $this->attributes["post1"]=new Post_Prop("Post 1",["type"=>"text"]);
        $this->attributes["post2"]=new Post_Prop("Post 2",["type"=>"text"]);
        $this->attributes["post3"]=new Post_Prop("Post 3",["type"=>"text"]);
        $this->attributes["post4"]=new Post_Prop("Post 4",["type"=>"text"]);
        $this->attributes["post5"]=new Post_Prop("Post 5",["type"=>"text"]);
        
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
        $card_styles=[];
        if ($instance["height"]!=''){
            $card_styles[]="height:{$instance["height"]}";    
        }
        if ($instance["vertical_align"]!=''){
            $card_styles[]="justify-content:{$instance["vertical_align"]}";    
        }
        foreach($instance as $var=>$value){
            $$var=$value;
        }
        $card_styles[]="background-color: rgba(128,128,128,{$opacity});";    
        $card_style=implode(";",$card_styles);
        $opacity=$instance["opacity"]==""?"0.4":$instance["opacity"];
        include("$base/components/slides.php");
    }

}