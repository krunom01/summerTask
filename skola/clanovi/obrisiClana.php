<?php include_once "../../konfiguracija.php";
if(!isset($_SESSION["bok"]))
{
    header("location:" . $putanja . "odjava.php");
}
if(!isset($_GET["sifra"])){
    header("location:" . $putanja . "odjava.php");
}
$brisanjeClana = $veza->prepare("delete from clan where sifra=:sifra");
$brisanjeClana->execute($_GET);
header("location: clanovi.php");