<?php

class Base_Prop {
    var $label;
    var $control;
    var $attributes;
    var $content;
    var $extra;
    
    function __construct($label,$control,$attributes=[],$content="",$extra="") {
        $this->label=$label;
        $this->control=$control;
        $this->attributes=$attributes;
        $this->content=$content;
        $this->extra=$extra;
    }

    function getContent($value){
        return $this->content;
    }

    function render($widget,$field,$value){
            $attrs = [];
            foreach($this->attributes as $name=>$val){
                $attrs[] = " $name=\"$val\" ";
            }
        ?>
            <div>
                <label for="<?php echo esc_attr( $widget->get_field_id( $field ) ); ?>"><?php esc_attr_e( $this->label .':', 'text_domain' ); ?></label>
                <<?php echo $this->control?> class="widefat" id="<?php echo esc_attr( $widget->get_field_id( $field ) ); ?>" 
                    name="<?php echo esc_attr( $widget->get_field_name( $field ) ); ?>"  <?php echo implode(" ",$attrs) ?> 
                    value="<?php echo esc_attr( $value ); ?>"><?php echo $this->getContent($value) ?></<?php echo $this->control?>>
                <script> document.getElementById("<?php echo ( $widget->get_field_id( $field ) ); ?>").value=<?php echo json_encode($value) ?>; </script>
                <?php echo str_replace("{value}","$value",$this->extra) ?>
            </div>
        <?php
    }

    function update($field,$new_instance,$old_instance){
        return ( !empty( $new_instance[$field] ) ) ? strip_tags( $new_instance[$field] ) : '';
    }
}

class Select_Prop extends Base_Prop {
    var $options;
    
    function __construct($label,$attributes=[],$options=[],$extra="") {
        parent::__construct($label,"select",$attributes,"",$extra);
        $this->options=$options;
    }

    function getContent($value){
        $content=[];
        foreach($this->options as $val=>$label){
            $selected = ($value==$val) ? "selected" : "";
            $content[]="<option value=\"$val\" $selected >$label</option>";
        }
        return implode("",$content);
    }
}

class Textarea_Prop extends Base_Prop {
    
    function __construct($label,$attributes=[],$extra="") {
        parent::__construct($label,"textarea",$attributes,"",$extra);
    }

    function getContent($value){
        return htmlentities($value,ENT_COMPAT | ENT_HTML5);
    }

    function update($field,$new_instance,$old_instance){
        if (!empty( $new_instance[$field])){
            $lines=explode("\n",$new_instance[$field]);
            foreach($lines as $key=>$line){
                $lines[$key]=trim($lines[$key]);
            }
            return implode("\n",$lines);
        }
        return '';
    }
}

class Post_Prop extends Base_Prop {

    static $list_created;

    function __construct($label,$attributes=[],$extra="") {
        $post_list="posts_list";
        $attributes["list"]=$post_list;
        $posts=get_posts([
            "numberposts" => 1000,
            "orderby" => "post_title",
            "order" => "ASC",
        ]);
        $post_options=[];
        foreach($posts as $post){
            $post_options[]="<option value=$post->ID >$post->post_title ($post->ID)</option>";
        }
        $extra="<datalist id='$post_list'>". implode("",$post_options) ."</datalist>";
        
        parent::__construct($label,"input",$attributes,"",$extra);

    }

}



