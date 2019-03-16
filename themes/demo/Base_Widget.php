<?php

require("Base_Prop.php");

class Base_Widget extends WP_Widget {

    var $attributes=[];
    
    function __construct($id,$name) {
 
        parent::__construct(
            $id,  // Base ID
            $name   // Name
        );
    
        $this->attributes["title"]=new Base_Prop("Title","input",["type"=>"text"]);
 
    }
 
    public $args = array(
        'before_title'  => '<h4 class="demo-widget-title">',
        'after_title'   => '</h4>',
        'before_widget' => '<div class="demo-widget-wrap">',
        'after_widget'  => '</div></div>'
    );
 
    public function widget( $args, $instance ) {
 
        echo $args['before_widget'];
 
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
 
        echo '<div class="widget-content">';
 
        $this->render($instance);
 
        echo '</div>';
 
        echo $args['after_widget'];
 
    }

    public function render($instance){

    }
 
    public function form( $instance ) {
 
        foreach($this->attributes as $field=>$attr){
            $value = ! empty( $instance[$field] ) ? $instance[$field] : esc_html__( '', 'text_domain' );
            
            $attr->render($this,$field,$value);
        }

    }
 
    public function update( $new_instance, $old_instance ) {
 
        $instance = array();
 
        foreach($this->attributes as $field=>$attr){
            $instance[$field] = $attr->update($field,$new_instance,$old_instance);
        }
        return $instance;
    }
 
}


