<?php

require_once(dirname(__FILE__)."/../Base_Widget.php");

class Progress_Widget extends Base_Widget {

    function __construct(){
        
        parent::__construct("progress_widget","Progress Widget");
        
        $this->attributes["bgcolor"]=new Base_Prop("Background color","input",["type"=>"color"]);
        $this->attributes["backgroundImage"]=new Base_Prop("Background image","input",["type"=>"text"]);
        $this->attributes["text_color"]=new Base_Prop("Text color","input",["type"=>"color"]);
        $this->attributes["text_shadow"]=new Base_Prop("Text shadow","input",["type"=>"color"]);
        $this->attributes["post1"]=new Post_Prop("Post 1",["type"=>"text"]);
        
        add_action( 'widgets_init', function() {
            register_widget( 'Progress_Widget' );
        });
    }

    function render($instance){
        $base=dirname(dirname(__FILE__));
        $post=get_post($instance["post1"]);
        $progress_steps=[];
        if($post!=null){
            $title="Title";
            $text=$post->post_content;
            $doc = new DOMDocument();
            $doc->loadHTML('<?xml encoding="utf-8" ?>'.$post->post_content);
            $content = $doc->documentElement->getElementsByTagName("ol")[0];
            if($content){
                for($i=0; $i< $content->childNodes->length ; $i++){
                    $item = $content->childNodes[$i];
                    
                    $title = $item->childNodes[0]->textContent;
                    $title = apply_filters('the_content', $title);
                    
                    $text = $item->childNodes[1]->textContent;
                    $text = apply_filters('the_content', $text);
                    
                    $progress_steps[]=[
                        "header"=>$title,
                        "text"=>$text, 
                    ];
                }
            }
        }
        
        foreach($instance as $key=>$val){
            $$key=$val;
        }
        include("$base/components/progress.php");
    }

}