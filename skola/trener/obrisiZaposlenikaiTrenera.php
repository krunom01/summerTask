<?php
include_once "../konfiguracija.php";
if(!isset($_SESSION["bok"]))
{
    header("location:" . $putanja . "odjava.php");
}
if(!isset($_GET["sifra"])){
    header("location:" . $putanja . "odjava.php");
}

$brisanjeZaposlenika = $veza->prepare("start transaction;
delete from trener where zaposlenik =:zaposlenik;
delete from zaposlenik where sifra=:sifra;
commit;");
$brisanjeZaposlenika->execute($_GET);
header("location: uprava.php");
