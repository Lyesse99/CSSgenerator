<?php
function generateCss($images, $output="sprite.png", $redim = null, $padding = null, $tailleOversize = null) {
  $css = "
    .sprite {
      background-image: url($output);
      background-repeat: no-repeat;
      display: block;
    }
  ";
  $tableCss = "";
  $width = 0;

  foreach ($images as $img) {
    $clearName = pathinfo($img);
    $imgName = str_replace(".", "", $clearName['filename']);
    $info = getimagesize($img);
    $width += $info[0];

    if ($redim) {
      $tableCss .= "
        .$imgName {
          width: $tailleOversize px;
          height: $tailleOversize px;
          padding: $padding px;
          background-position: $width px 0px;
        }
      ";
    } else {
      $tableCss .= "
        .$imgName {
          width: $info[0] px;
          height: $info[1] px;
          padding: $padding px;
          background-position: $width px 0px;
        }
      ";
    }
  }

  $contentCss = $css . "\n\n" . $tableCss;
  file_put_contents("style.css", $contentCss);
}

generateCss($images, $output, $redim, $padding, $tailleOversize);