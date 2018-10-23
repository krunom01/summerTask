<?php
include_once "../../konfiguracija.php";
if(!isset($_SESSION["bok"]) or !isset($_GET["sifra"]))
{
    header("location:" . $putanja . "odjava.php");
}

switch (true){
    case $_GET["sifra"]:
        $brisanjeZaposlenika = $veza->prepare("delete from zaposlenik where sifra=:sifra");
        $brisanjeZaposlenika->execute($_GET);
        header("location: zaposlenici.php");
    default:
        $brisanjeZaposlenika = $veza->prepare("start transaction;
delete from trener where zaposlenik =:zaposlenik;
delete from zaposlenik where sifra=:sifra;
commit;");
$brisanjeZaposlenika->execute($_GET);
header("location: zaposlenici.php");
}

