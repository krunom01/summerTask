<?php
include_once "../../konfiguracija.php" ;
if(!isset($_SESSION["bok"])){
  return;
}

$img = $_POST['slika']; // Your data 'data:image/png;base64,AAAFBfj42Pj4';
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);


file_put_contents("../../img/kategorije/" . $_POST["sifra"] . ".png", 
        $data);


echo "OK";