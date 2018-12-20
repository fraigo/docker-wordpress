<?php


$theme_options=[
    "demo_background_image" => [
        "text" => "Background image",
        "attributes" => [
            "size" => "100"
        ],
        "default" => ""
    ],
    "demo_background_color" => [
        "text" => "Background color",
        "attributes" => [
            "size" => "7"
        ],
        "default" => "#fff"
    ],
    "demo_navbar_class" => [
        "text" => "Navbar Class",
        "attributes" => [
            "size" => "7"
        ],
        "default" => ""
    ],
    "demo_font_family" => [
        "text" => "Default Font",
        "attributes" => [
            "size" => "50"
        ],
        "default" => "Georgia, Times, 'Times New Roman', serif",
    ],
    "demo_font_size" => [
        "text" => "Font Size",
        "attributes" => [
            "type" => "range",
            "min" => "10",
            "max" => "20",
            "onmouseover" => "this.title=this.value+'pt'"
        ],
        "default" => "14",
    ],
    "demo_google_font" => [
        "text" => "Google Font",
        "attributes" => [
            "size" => "20"
        ],
        "default" => "",
    ]
];


function get_theme_values($theme_options){
    $theme_values=[];
    foreach($theme_options as $option=>$item){
        if (get_option($option) === false){
            add_option($option, $item["default"] , '', false);
        }
        $postvalue=$_POST[$option];
        if (array_key_exists($option,$_POST)){
            $result =update_option($option,$postvalue,false);
        }
        $theme_values[$option] = get_option($option,$item["default"]);
    }
    return $theme_values;
}