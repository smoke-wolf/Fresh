<?php

// Enable error reporting for debugging
error_reporting(0);
ini_set('display_errors', '0');

// Path to the JSON file
$json_file = 'analytics.json';

// Read JSON data
function read_json() {
    global $json_file;
    if (file_exists($json_file)) {
        return json_decode(file_get_contents($json_file), true);
    } else {
        return [];
    }
}

// Get the code and text from the query parameters
$code = isset($_GET['code']) ? $_GET['code'] : '';
$text = isset($_GET['text']) ? $_GET['text'] : 'Visits';

// Optional parameters
$bg = isset($_GET['bg']) ? $_GET['bg'] : '121212';
$bg_fade = isset($_GET['bg_fade']) ? $_GET['bg_fade'] : null;
$text_colour = isset($_GET['text_colour']) ? $_GET['text_colour'] : 'ffffff';
$border_colour = isset($_GET['border_colour']) ? $_GET['border_colour'] : 'ff5722';
$special_effects = isset($_GET['special_effects']) ? $_GET['special_effects'] : null;

// Convert hex colors to RGB
function hex_to_rgb($hex) {
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
    }
    $r = hexdec($hex[0] . $hex[1]);
    $g = hexdec($hex[2] . $hex[3]);
    $b = hexdec($hex[4] . $hex[5]);
    return array($r, $g, $b);
}

// Read the JSON data
$data = read_json();
$visits = isset($data[$code]) ? $data[$code]['visits'] : 0;

// Create an image
$width = 300;
$height = 100;
$image = imagecreatetruecolor($width, $height);

// Colors
list($bg_r, $bg_g, $bg_b) = hex_to_rgb($bg);
$background_color = imagecolorallocate($image, $bg_r, $bg_g, $bg_b);

list($text_r, $text_g, $text_b) = hex_to_rgb($text_colour);
$text_color = imagecolorallocate($image, $text_r, $text_g, $text_b);

list($border_r, $border_g, $border_b) = hex_to_rgb($border_colour);
$border_color = imagecolorallocate($image, $border_r, $border_g, $border_b);

// Fill the background
imagefill($image, 0, 0, $background_color);

// Apply background fade if specified
if ($bg_fade) {
    list($fade_r, $fade_g, $fade_b) = hex_to_rgb($bg_fade);
    for ($i = 0; $i < $height; $i++) {
        $color = imagecolorallocate($image, 
            $bg_r + ($fade_r - $bg_r) * $i / $height, 
            $bg_g + ($fade_g - $bg_g) * $i / $height, 
            $bg_b + ($fade_b - $bg_b) * $i / $height
        );
        imageline($image, 0, $i, $width, $i, $color);
    }
}

// Draw a border
imagerectangle($image, 0, 0, $width - 1, $height - 1, $border_color);

// Text to display
$display_text = $visits . ' ' . $text;

// Font settings
$font_size = 5; // Font size for imagestring()

// Calculate text width
$text_width = imagefontwidth($font_size) * strlen($display_text);
$text_height = imagefontheight($font_size);

// Calculate the position
$x = ($width / 2) - ($text_width / 2);
$y = ($height / 2) - ($text_height / 2);

// Add the text
imagestring($image, $font_size, $x, $y, $display_text, $text_color);

// Apply special effects if specified
if ($special_effects == 'invert') {
    imagefilter($image, IMG_FILTER_NEGATE);
} elseif ($special_effects == 'grayscale') {
    imagefilter($image, IMG_FILTER_GRAYSCALE);
} elseif ($special_effects == 'emboss') {
    imagefilter($image, IMG_FILTER_EMBOSS);
}

// Output the image
header('Content-Type: image/png');
imagepng($image);

// Clean up
imagedestroy($image);
?>
