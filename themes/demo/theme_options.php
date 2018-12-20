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

?>
<h2>Options</h2>
<form method="POST" >
<?php 
    foreach($theme_options as $option=>$item){ 
     $attributes = $item["attributes"];
     $attributes["name"] = $option;
     $attributes["type"] = $attributes["type"]?:"text";
     $attributes["value"] = $theme_values[$option];

     $htmlAttributes = array2attributes($attributes);
    ?>
    <h3><?php echo $item["text"] ?></h3>
    <input <?php echo $htmlAttributes ?> >
<?php } ?>
    <br>
    <input type="submit" value="Save">
</form>