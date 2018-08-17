<?php include_once "../konfiguracija.php" ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
  <?php include_once "../predlozak/head.php"?>
  </head>
  <body>
  <?php
  if(isset($_POST["dodaj"]))
  {
    /* odabir i premjestanje odabrane slike u img/zaposlenici */
    $ime_slike=$_FILES["image"]["name"];
    $tmp_slike=$_FILES["image"]["tmp_name"];
    $upload_datoteka = "../img/zaposlenici/";
    move_uploaded_file($tmp_slike,$upload_datoteka.$ime_slike); 
     /* ako je dodan trener  */
    if($_POST["nadredeni"]==2){
    $noviZaposlenik = $veza->prepare(
      /* dodavanje novog zaposlenika u tablicu zaposlenik te dodavanje 
      novog trenera ako je stavljeno da je novi zaposlenik trener */
    "start transaction;
    insert into zaposlenik ( ime, prezime, oib, email, mob, radnomjesto, nadredeni, ziroracun, image)
    values	(:ime, :prezime, :oib, :email, :mob, :radnomjesto, :nadredeni, :ziroracun, '$upload_datoteka$ime_slike');
    insert into trener (zaposlenik) select max(sifra) from zaposlenik where nadredeni=2;
    commit;");
    unset($_POST["dodaj"]);
    $noviZaposlenik->execute($_POST);  
    header("location:uprava.php");
    }
    /* ako je dodana uprava */
    else{
      $noviZaposlenik = $veza->prepare(
        "insert into zaposlenik ( ime, prezime, oib, email, mob, radnomjesto, nadredeni, ziroracun, image)
        values	(:ime, :prezime, :oib, :email, :mob, :radnomjesto, :nadredeni, :ziroracun, '$upload_datoteka$ime_slike');");
        unset($_POST["dodaj"]);
        $noviZaposlenik->execute($_POST);  
        header("location:uprava.php");
    }
  }
  ?>
  <div class="grid-container">
  <?php include_once "../predlozak/header.php"?>
  <?php include_once "../predlozak/menu.php"?>
   <form class="callout text-center" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
   <div class="floated-label-wrapper">
            <label for="ime">Ime</label>
            <input autocomplete="off" type="text" id="ime" name="ime">
          </div>
          <div class="floated-label-wrapper">
            <label for="prezime">Prezime</label>
            <input autocomplete="off" type="text"  id="prezime" name="prezime" >
          </div>
          <div class="floated-label-wrapper">
            <label for="oib">OIB</label>
            <input autocomplete="off" type="number"  id="oib" name="oib" >
          </div>
          <div class="floated-label-wrapper">
            <label for="email">email</label>
            <input autocomplete="off" type="email"  id="email" name="email" >
          </div>
          <div class="floated-label-wrapper">
            <label for="mob">Mob</label>
            <input autocomplete="off" type="number"  id="mob" name="mob" >
          </div>
          <div class="floated-label-wrapper">
            <label for="radnomjesto">Naziv radnog mjesta</label>
            <input autocomplete="off" type="text"  id="radnomjesto" name="radnomjesto" >
          </div>
          <div class="floated-label-wrapper">
            <label for="nadredeni">Radno mjesto</label>
            <input autocomplete="off" type="radio"  id="nadredeni" name="nadredeni" value="2">Trener</br>
            <input autocomplete="off" type="radio"  id="nadredeni" name="nadredeni" value="1">Uprava</br>
          </div>
          <div class="floated-label-wrapper">
            <label for="ziroracun">Žiroracun</label>
            <input autocomplete="off" type="number"  id="ziroracun" name="ziroracun" >
          </div>
          <div class="floated-label-wrapper">
            <label for="image">Slika</label>
            <input autocomplete="off" type="file"  id="image" name="image" >
          </div>
          <input class="button expanded" type="submit" name="dodaj" value="Dodaj novog zaposlenika">
        </form>
<?php include_once "../predlozak/footer.php"?>
<?php include_once "../predlozak/skripte.php"?>
</body>
</html>
