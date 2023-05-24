<?php
//--------------- Image creation ------------------------
function my_create_png($tableau)
{
    $img = [];
    foreach($tableau as $key => $value)
    {
        if (exif_imagetype($value) == IMAGETYPE_PNG)
        {
            $img[$key] = imagecreatefrompng($value);
        }
    }
    return $img;
}

//--------- Creating resized images ---------------
function my_create_png_redim($tableau)
{

    $img = [];
    foreach($tableau as $key => $value)
    {
        
        if (exif_imagetype($value) == IMAGETYPE_PNG)
        {
            $img[$key] = redimension(imagecreatefrompng($value));
        }
    }
    return $img;
}
//-------------- Background image creation -------------------
function my_create_image_sprite($img)
{

    $widthSprite = 0;
    $heightSprite = 0;
    global $spritecss;
    global $padding;

    foreach ($img as $value)
    {
        $widthSprite += (imagesx($value) + $padding);
        
        if(imagesy($value) > $heightSprite)
        {
            $heightSprite = imagesy($value);
        }
    }
    $sprite = imagecreatetruecolor($widthSprite + $padding, $heightSprite); // i modified this line and replaced the - with the +
    imagesavealpha($sprite, true);
    $color = imagecolorallocatealpha($sprite, 0, 0, 0, 127);
    imagefill($sprite, 0, 0, $color);
    return $sprite;
    
}

//----------------- Concatenation of images on the background image --------------

function my_merge_image($Image, $sprite)
{
    global $namefilesprite;
    global $padding;
    $positionx = 0;
    for ($i = 0; $i < sizeof($Image); $i++)
    {
        imagecopy ($sprite , $Image[$i], $positionx, 0, 0, 0 , imagesx($Image[$i]) , imagesy($Image[$i]));
        $positionx += (imagesx($Image[$i]) + $padding);
    }

    imagepng($sprite, $namefilesprite.".png");
}
?>
