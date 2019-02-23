<?php



$theme_options=[
    "demo_background_image" => [
        "text" => "<hr>Navbar Background image",
        "attributes" => [
            "size" => "100"
        ],
        "default" => ""
    ],
    "demo_background_color" => [
        "text" => "Navbar Background color",
        "attributes" => [
            "size" => "20"
        ],
        "default" => "#fff"
    ],
    "demo_navbar_class" => [
        "text" => "Navbar Class",
        "attributes" => [
            "size" => "50"
        ],
        "default" => "demo-navbar"
    ],
    "demo_google_font" => [
        "text" => "<hr>Load Google Font <a href=https://fonts.google.com >(Examples)</a>",
        "attributes" => [
            "size" => "20"
        ],
        "default" => "Lora",
    ],
    "demo_font_family" => [
        "text" => "Default Font",
        "attributes" => [
            "size" => "50"
        ],
        "default" => "Lora, Georgia, Times, serif",
    ],
    "demo_primary_color" => [
        "text" => "Primary color",
        "attributes" => [
            "type" => "color",
            "size" => "20",
        ],
        "default" => "#000",
    ],
    "demo_secondary_color" => [
        "text" => "Secondary color",
        "attributes" => [
            "type" => "color",
            "size" => "20"
        ],
        "default" => "#666",
    ],
    "demo_font_size" => [
        "text" => "Font Size",
        "attributes" => [
            "type" => "range",
            "min" => "10",
            "max" => "20",
            "onmouseover" => "this.title=this.value+'pt'"
        ],
        "content" => " Slide to change",
        "default" => "14",
    ],
    "demo_header1" => [
        "text" => "Home page card 1",
        "attributes" => [
            "size" => "20",
            "list" => "posts",
        ],
        "default" => "",
    ],
    "demo_header2" => [
        "text" => "Home page card 2",
        "attributes" => [
            "size" => "20",
            "list" => "posts",
        ],
        "default" => "",
    ],
    "demo_header3" => [
        "text" => "Home page card 3",
        "attributes" => [
            "size" => "20",
            "list" => "posts",
        ],
        "default" => "",
    ],
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