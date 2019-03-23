<?php

require_once(dirname(__FILE__)."/../Base_Widget.php");

class Progress_Widget extends Base_Widget {

    function __construct(){
        
        parent::__construct("progress_widget","Progress Widget");
        
        $this->attributes["bgcolor"]=new Base_Prop("Background color","input",["type"=>"color"]);
        $this->attributes["backgroundImage"]=new Base_Prop("Background image","input",["type"=>"text"]);
        $this->attributes["text_color"]=new Base_Prop("Text color","input",["type"=>"color"]);
        $this->attributes["text_shadow"]=new Base_Prop("Text shadow","input",["type"=>"color"]);
        $this->attributes["step1"]=new Textarea_Prop("Step1",["rows"=>"3"]);
        $this->attributes["step2"]=new Textarea_Prop("Step2",["rows"=>"3"]);
        $this->attributes["step3"]=new Textarea_Prop("Step3",["rows"=>"3"]);
        $this->attributes["step4"]=new Textarea_Prop("Step4",["rows"=>"3"]);
        $this->attributes["step5"]=new Textarea_Prop("Step5",["rows"=>"3"]);
        $this->attributes["step6"]=new Textarea_Prop("Step6",["rows"=>"3"]);
        $this->attributes["step7"]=new Textarea_Prop("Step7",["rows"=>"3"]);
        $this->attributes["step8"]=new Textarea_Prop("Step8",["rows"=>"3"]);
        
        add_action( 'widgets_init', function() {
            register_widget( 'Progress_Widget' );
        });
    }

    function render($instance){
        $base=dirname(dirname(__FILE__));
        $step_numbers=[1,2,3,4,5,6,7,8];
        $progress_steps=[];
        foreach($step_numbers as $num){
            list($header,$text) = explode("\n",$instance["step$num"]);
            if ($text){
                $progress_steps[]=["header"=>$header,"text"=>$text];
            }
        }
        foreach($instance as $key=>$val){
            $$key=$val;
        }
        include("$base/components/progress.php");
    }

}