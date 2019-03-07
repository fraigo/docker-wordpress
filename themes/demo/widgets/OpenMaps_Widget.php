<?php

require_once(dirname(__FILE__)."/../Base_Widget.php");

class OpenMaps_Widget extends Base_Widget {

    function __construct(){
        
        parent::__construct("openmaps_widget","OpenMaps Widget");
        
        $this->attributes["zoom"]=new Base_Prop("Zoom level","input",["type"=>"number"]);
        $this->attributes["lat"]=new Base_Prop("Latitude","input",["type"=>"text"]);
        $this->attributes["lng"]=new Base_Prop("Longitude","input",["type"=>"text"]);
        
        add_action( 'widgets_init', function() {
            register_widget( 'OpenMaps_Widget' );
        });
    }

    function render($instance){
        $zoom=$instance["zoom"]?:10;
        $lat=$instance["lat"]?:49.1869;
        $lng=$instance["lng"]?:-123.0633;
        $link="$zoom/$lat/$lng";
        $x1=$lat-($zoom*4);
        $y1=$lng-($zoom*4);
        $x2=$lat+($zoom*4);
        $y2=$lng+($zoom*4);
        $box="$x1%2C$y1%2C$x2%2C$y2";

        ?>
        <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=-123.47152501344682%2C49.03798223789077%2C-122.65441685914996%2C49.335527761868654&amp;layer=mapnik" style="border: 1px solid #fff"></iframe>
        <?php
    }

}
