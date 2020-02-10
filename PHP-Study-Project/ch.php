<?
function zachet($str, $min = 5, $max = 15) {
  $n = rand($min, $max);
  for ($i = 0; $i < strlen($str); $i++) {
    $str[$i] = chr(ord($str[$i])-$n);
  }
  echo $str;
}

zachet('php is my fav');
echo '<br>';
zachet('i love php', 0, 100);
