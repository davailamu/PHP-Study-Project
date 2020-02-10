<?
session_start();

include 'html/body_catalog.php';

echo ("<h2 style='padding-top: 90px; padding-left: 45px'>Hello,". $_SESSION['username'] ."!</h2>");

$path = "catalogs/design";

echo '<div class="files">';
    $filelist = array();
    if($handle = opendir($path)){
        while($entry = readdir($handle)){
          if($entry != '.' && $entry != '..') {
            $name = pathinfo("$entry");
            echo '<a href="file.php?file='.urlencode($entry).'">'.$name['filename'].'</a><br>';
          }
        }

        closedir($handle);
    }
echo '</div>';
