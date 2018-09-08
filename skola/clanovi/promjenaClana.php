<?php include_once "../../konfiguracija.php";

if(!isset($_SESSION["bok"]))
{
    header("location:" . $putanja . "odjava.php");
}
if(isset($_POST["promjeni"]))
{
    $updateClana=$veza->prepare(
    "update clan set ime=:ime, prezime=:prezime, oib=:oib, email=:email, mob=:mob, 
    imeroditelja=:imeroditelja, prezimeroditelja=:prezimeroditelja, kategorija=:kategorija ");
    unset($_POST["promjeni"]);
    $updateClana->execute($_POST);
    header("location:clanovi.php");
}
else
{
$clan = $veza->prepare("select * from clan where sifra = :sifra");
$clan->execute($_GET);
$o=$clan->fetch(PDO::FETCH_OBJ);
}
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <?php include_once "../../predlozak/head.php"?>
  </head>
<body>
  <div class="grid-container">
<?php include_once "../../predlozak/header.php"?>
<?php include_once "../../predlozak/menu.php"?>
<form class="callout text-center" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
<div class="floated-label-wrapper">
    <label for="ime">Ime</label>
    <input value="<?php echo $o->ime ?>" autocomplete="off" type="text" id="ime" name="ime">
</div>
<div class="floated-label-wrapper">
    <label for="prezime">Prezime</label>
    <input value="<?php echo $o->prezime ?>" autocomplete="off" type="text" id="prezime" name="prezime">
</div>
<div class="floated-label-wrapper">
    <label for="oib">OIB</label>
    <input value="<?php echo $o->oib ?>" autocomplete="off" type="text" id="oib" name="oib">
</div>
<div class="floated-label-wrapper">
    <label for="email">email</label>
    <input value="<?php echo $o->email ?>" autocomplete="off" type="text" id="email" name="email">
</div>
<div class="floated-label-wrapper">
    <label for="mob">mob</label>
    <input value="<?php echo $o->mob ?>" autocomplete="off" type="text" id="mob" name="mob">
</div>
<div class="floated-label-wrapper">
    <label for="imeroditelja">Ime roditelja</label>
    <input value="<?php echo $o->imeroditelja ?>" autocomplete="off" type="text" id="imeroditelja" name="imeroditelja">
</div>
<div class="floated-label-wrapper">
    <label for="imeroditelja">Prezime roditelja</label>
    <input value="<?php echo $o->prezimeroditelja ?>" autocomplete="off" type="text" id="prezimeroditelja" name="prezimeroditelja">
</div>
<div class="floated-label-wrapper">
    <label for="kategorija">Kategorija</label>
    <input value="<?php echo $o->kategorija ?>" autocomplete="off" type="text" id="kategorija" name="kategorija">
</div>

  
  <input class="button expanded" type="submit" name="promjeni" value="Promjeni podatke">
</form>
<input type="hidden" name="sifra" value="<?php echo $o->sifra ?>" />
<?php include_once "../../predlozak/footer.php"?>
<?php include_once "../../predlozak/skripte.php"?>
</body>
</html>
