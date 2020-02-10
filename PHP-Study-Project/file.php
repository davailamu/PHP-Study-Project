<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Каталог</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC&display=swap" rel="stylesheet">
  </head>
  <body>
    <?
    require 'html/header.html';

    $file = urldecode($_REQUEST["file"]);
    $filepath = "catalogs/design/" . $file;

    echo ('<iframe src="'.$filepath.'"
    style="position:absolute; top: 115px; left: 150px; width: 1300px; height: 670px;" frameborder="0">Ваш браузер не поддерживает фреймы</iframe>');
    echo ('<a style="position:absolute; top: 120px; right: 20px; text-decoration:none; font-size: 30px" href = "catalog.php"><- Назад</a>')
    ?>
  </body>
</html>
