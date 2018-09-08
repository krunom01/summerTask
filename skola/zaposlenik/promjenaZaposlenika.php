<?php include_once "../../konfiguracija.php";

if(!isset($_SESSION["bok"]))
{
    header("location:" . $putanja . "odjava.php");
}
if(isset($_POST["promjeni"]))
{
    $ime_slike=$_FILES["image"]["name"];
    $tmp_slike=$_FILES["image"]["tmp_name"];
    $upload_datoteka = "../img/zaposlenici/";
    move_uploaded_file($tmp_slike,$upload_datoteka.$ime_slike);
    /* ako je nadredeni 1(uprava),dodaj promjenjene podatke u zaposlenika a obrisi tog zaposlenika iz trenera;
    promjena trenera u upravu */
    if($_POST["radnomjesto"]==1)
    {
    $updateZaposlenika=$veza->prepare(
        "start transaction;
        update zaposlenik set ime=:ime, prezime=:prezime, oib=:oib, email=:email, mob=:mob, 
        radnomjesto=:radnomjesto, ziroracun=:ziroracun, image='$upload_datoteka$ime_slike' where sifra=:sifra;
        delete from trener where zaposlenik=:sifra;
        commit; ");
    unset($_POST["promjeni"]);
    $updateZaposlenika->execute($_POST);
    header("location:zaposlenici.php");
    }
    /* promjena zaposlenika uprave u trenera */
    else
    {
    $updateTreneraiZap=$veza->prepare(
    "start transaction;
    insert into trener (zaposlenik) values (:sifra);
    update zaposlenik set ime=:ime, prezime=:prezime, oib=:oib, email=:email, mob=:mob, 
    radnomjesto=:radnomjesto, ziroracun=:ziroracun, image='$upload_datoteka$ime_slike' where sifra=:sifra;
    commit; ");
    unset($_POST["promjeni"]);
    $updateTreneraiZap->execute($_POST);
    header("location:zaposlenici.php");
    }
    
}
else
{
$promjenaZaposlenika = $veza->prepare("select * from zaposlenik where sifra = :sifra");
$promjenaZaposlenika->execute($_GET);
$o=$promjenaZaposlenika->fetch(PDO::FETCH_OBJ);
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
   <form class="callout text-center" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
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
            <label for="ziroracun">ziroracun</label>
            <input value="<?php echo $o->ziroracun ?>" autocomplete="off" type="text" id="ziroracun" name="ziroracun">
        </div>
        <div class="floated-label-wrapper">
            <label for="radnomjesto">radnomjesto</label>
            <input value="1" <?php if($o->radnomjesto==1){ echo "checked";} ?>  autocomplete="off" type="radio"  id="radnomjesto" name="radnomjesto"  >Uprava</br>
            <input value="2"<?php if($o->radnomjesto==2){ echo "checked";} ?>    autocomplete="off" type="radio"  id="radnomjesto" name="radnomjesto"  >Trener</br>
        </div>
        <div class="floated-label-wrapper">
            <label for="image">Slika</label>
            <input autocomplete="off" type="file"  id="image" name="image">
          </div>
          <input type="hidden" name="sifra" value="<?php echo $o->sifra ?>" />
          <input class="button expanded" type="submit" name="promjeni" value="Promjeni podatke">
        </form>
<?php include_once "../../predlozak/footer.php"?>
<?php include_once "../../predlozak/skripte.php"?>
</body>
</html>
