<?php
include_once "../konfiguracija.php";
if(!isset($_SESSION["bok"])){
    header("location:" . $putanja . "odjava.php");
}
if(!isset($_GET["sifra"])){
    header("location:" . $putanja . "odjava.php");
}
$brisanjeZaposlenika = $veza->prepare("delete from kategorija where sifra=:sifra");
$brisanjeZaposlenika->execute($_GET);
header("location: kategorija.php");