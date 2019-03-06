<?php

class Widget_Prop {
    var $label;
    var $control;
    var $attributes;
    var $content;
    
    function __construct($label,$control,$attributes=[],$content="") {
        $this->label=$label;
        $this->control=$control;
        $this->attributes=$attributes;
        $this->content=$content;
    }
}

class Base_Widget extends WP_Widget {

    var $attributes=[];
    
    function __construct($id,$name) {
 
        parent::__construct(
            $id,  // Base ID
            $name   // Name
        );
    
        $this->attributes["title"]=new Widget_Prop("Title","input",["type"=>"text"]);
 
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
            $attrs = [];
            foreach($attr->attributes as $name=>$val){
                $attrs[] = " $name=\"$val\" ";
            }
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( $field ) ); ?>"><?php esc_attr_e( $attr->label .':', 'text_domain' ); ?></label>
                <<?php echo $attr->control?> class="widefat" id="<?php echo esc_attr( $this->get_field_id( $field ) ); ?>" 
                    name="<?php echo esc_attr( $this->get_field_name( $field ) ); ?>"  <?php echo implode(" ",$attrs) ?> 
                    value="<?php echo esc_attr( $value ); ?>"><?php echo $attr->content?></<?php echo $attr->control?>> 
            </p>
            <?php
        }

    }
 
    public function update( $new_instance, $old_instance ) {
 
        $instance = array();
 
        foreach($this->attributes as $field=>$attr){
            $instance[$field] = ( !empty( $new_instance[$field] ) ) ? strip_tags( $new_instance[$field] ) : '';
        }
        return $instance;
    }
 
}


