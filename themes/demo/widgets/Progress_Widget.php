<?php

require_once(dirname(__FILE__)."/../Base_Widget.php");

class Progress_Widget extends Base_Widget {

    function __construct(){
        
        parent::__construct("progress_widget","Progress Widget");
        
        $this->attributes["height"]=new Base_Prop("Content Height","input",["type"=>"text"]);
        $this->attributes["bgcolor"]=new Base_Prop("Background color","input",["type"=>"color"]);
        $this->attributes["backgroundImage"]=new Base_Prop("Background image","input",["type"=>"text"]);
        $this->attributes["text_color"]=new Base_Prop("Text color","input",["type"=>"color"]);
        $this->attributes["text_shadow"]=new Base_Prop("Text shadow","input",["type"=>"color"]);
        $this->attributes["post1"]=new Post_Prop("Post 1",["type"=>"text"]);
        $this->attributes["separator"]=new Base_Prop("Item Separator","input",["type"=>"text"]);
        $this->attributes["separator2"]=new Base_Prop("Content Separator","input",["type"=>"text"]);
        
        add_action( 'widgets_init', function() {
            register_widget( 'Progress_Widget' );
        });
    }

    function render($instance){
        global $wp_customize;
        $sep=@$instance["separator"]?:"<br />";
        $sep2=@$instance["separator2"]?:".";
        $base=dirname(dirname(__FILE__));
        $post=get_post($instance["post1"]);
        $progress_steps=[];
        if($post!=null){
            $title="Title";
            $text=$post->post_content;
            $items=explode($sep,$text);
            foreach($items as $item){
                $parts=explode($sep2,$item);
                $progress_steps[]=[
                    "header"=>$parts[0],
                    "text"=>$parts[1], 
                ];
            }
            
        }
        
        foreach($instance as $key=>$val){
            $$key=$val;
        }
        include("$base/components/progress.php");
    }

}