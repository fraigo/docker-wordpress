<?php

include(dirname(__FILE__)."/options.php");
$theme_values = get_theme_values($theme_options,$theme_values);

function array2attributes(array $array) {
    return implode(' ', array_map(function ($key, $value) {
        if (is_array($value)) {
            $value = implode(' ', $value);
        }

        return $key . '="' . htmlspecialchars($value) . '"';
    }, array_keys($array), $array));
}

$posts=get_posts([
    "numberposts" => 1000,
    "orderby" => "post_title",
    "order" => "ASC",
]);
$post_sel=[];
$post_options=[];
$post_datalist=[];

foreach($posts as $post){
    $post_sel[$post->ID]=$post->post_title;
    $post_options[]="<option value=$post->ID >$post->post_title ($post->ID)</option>";
    $post_datalist[]="<option value='$post->post_title ($post->ID)' >";
}


?>
<h2>Options</h2>
<form method="POST" >
<datalist id="posts"><?php echo implode("",$post_options) ?></datalist>
<?php 
    foreach($theme_options as $option=>$item){ 
     $attributes = $item["attributes"];
     $attributes["name"] = $option;
     $attributes["type"] = $attributes["type"]?:"text";
     $attributes["value"] = $theme_values[$option];

     $htmlAttributes = array2attributes($attributes);
     $control = $item["control"]?:"input";
     $content = $item["content"];
     $closetag = $control=="input"?"":"</$control>"
    ?>
    <h3><?php echo $item["text"] ?></h3>
    <<?php echo $control ?> <?php echo $htmlAttributes ?> ><?php echo $content ?><?php echo $closetag ?>
<?php } ?>
    <br>
    <input type="submit" value="Save">
</form>