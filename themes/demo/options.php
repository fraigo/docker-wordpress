<?php
//https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyBFpyQBebeLr_zQUKvjDMiV7xZWJj5nTIc
$google_fonts=json_decode(file_get_contents(dirname(__FILE__)."/json/webfonts.json"),true);
$font_options=[];
$families=[];
$families["serif"]="Georgia, Times, serif";
$families["sans-serif"]="Arial, Helvetica, sans-serif";
$families["monospace"]="Courier New, Courier, monospace";
$font_options_groups=[];

foreach($google_fonts["items"] as $font){
    if ($font["category"]=="display") continue;
    $family=$families[$font["category"]]?:$font["category"];
    $font_options_groups[$font["category"]][]="<option value='{$font["family"]}'>'{$font["family"]}', {$family}</option>";
}
foreach($font_options_groups as $grp=>$items){
    $font_options[]="<optgroup label=\"$grp\">".implode("",$items)."</optgroup>";
}

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
        "control" => "select",
        "text" => "<hr>Load Google Font <a href=https://fonts.google.com >(Examples)</a>",
        "attributes" => [
            "size" => "1",
            "onchange" => "updateFont(this)"
        ],
        "content" => implode("",$font_options),
        "default" => "Lora",
        "post" => "
        <script>
        function updateFont(sel){
            var text=sel.options[sel.selectedIndex].text;
            document.getElementById('demo_font_family').value=text;
            var w=window.open('','fontpreview');
            w.document.write('<link href=\"https://fonts.googleapis.com/css?family='+sel.value+':400,700\" rel=\"stylesheet\">');
            w.document.write('<div style=\"font-family:'+text+';font-size:18px\" >'+sel.value+' ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmnopqrstuvwxyz 1234567890</div>');
        }
        </script>
        <br>
        <iframe id=fontpreview style=width:100% name=fontpreview ></iframe>
        ",
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
    "demo_content_color" => [
        "text" => "Content color",
        "attributes" => [
            "type" => "color",
            "size" => "20",
        ],
        "default" => "#000",
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
    "demo_header_type" => [
        "text" => "Header type",
        "control" => "select",
        "attributes" => [
            "size" => "1",
        ],
        "content" => "<option value=cards >Cards</option><option value=slides >Slides</option>",
        "default" => "cards",
        "post" => "",
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


