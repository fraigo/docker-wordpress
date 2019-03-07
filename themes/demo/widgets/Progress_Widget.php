<?php

require_once(dirname(__FILE__)."/../Base_Widget.php");

class Progress_Widget extends Base_Widget {

    function __construct(){
        
        parent::__construct("progress_widget","Progress Widget");
        
        $this->attributes["step1"]=new Textarea_Prop("step1",["rows"=>"3"]);
        $this->attributes["step2"]=new Textarea_Prop("step2",["rows"=>"3"]);
        $this->attributes["step3"]=new Textarea_Prop("step3",["rows"=>"3"]);
        $this->attributes["step4"]=new Textarea_Prop("step4",["rows"=>"3"]);
        $this->attributes["step5"]=new Textarea_Prop("step5",["rows"=>"3"]);
        $this->attributes["step6"]=new Textarea_Prop("step6",["rows"=>"3"]);
        $this->attributes["step7"]=new Textarea_Prop("step7",["rows"=>"3"]);
        $this->attributes["step8"]=new Textarea_Prop("step8",["rows"=>"3"]);
        
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
        include("$base/components/progress.php");
    }

}