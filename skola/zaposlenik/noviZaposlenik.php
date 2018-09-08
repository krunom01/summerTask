
<?php include_once "../../konfiguracija.php" ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
  <?php include_once "../../predlozak/head.php"?>
  </head>
  <body>
  <?php
  if(isset($_POST["dodaj"]))
  {
    include_once "kontrola.php";
  if(count($errors)==0){
    /* odabir i premjestanje odabrane slike u img/zaposlenici */
    $ime_slike=$_FILES["image"]["name"];
    $tmp_slike=$_FILES["image"]["tmp_name"];
    $upload_datoteka = "../img/zaposlenici/";
    move_uploaded_file($tmp_slike,$upload_datoteka.$ime_slike); 
     /* ako je dodan trener  */
    if($_POST["radnomjesto"]==2){
    $noviZaposlenik = $veza->prepare(
      /* dodavanje novog zaposlenika u tablicu zaposlenik te dodavanje 
      novog trenera ako je stavljeno da je novi zaposlenik trener */
    "start transaction;
    insert into zaposlenik ( ime, prezime, oib, email, mob, radnomjesto, ziroracun, image)
    values	(:ime, :prezime, :oib, :email, :mob, :radnomjesto, :ziroracun, '$upload_datoteka$ime_slike');
    insert into trener (zaposlenik) select max(sifra) from zaposlenik where radnomjesto=2;
    commit;");
    unset($_POST["dodaj"]);
    $noviZaposlenik->execute($_POST);  
    header("location:zaposlenici.php");
    }
    /* ako je dodana uprava */
    else{
      $noviZaposlenik = $veza->prepare(
        "insert into zaposlenik ( ime, prezime, oib, email, mob, radnomjesto, ziroracun, image)
        values	(:ime, :prezime, :oib, :email, :mob, :radnomjesto, :ziroracun, '$upload_datoteka$ime_slike');");
        unset($_POST["dodaj"]);
        $noviZaposlenik->execute($_POST);  
        header("location:zaposlenici.php");
    }
  }
}
  ?>
  <div class="grid-container">
  <?php include_once "../../predlozak/header.php"?>
  <?php include_once "../../predlozak/menu.php"?>
  <?php if(isset($errors)){if($errors>0){ echo "<p style=color:blue;>došlo je do pogreške,molim Vas pokušajte ponovo.</p>";}} ?>
   
   <form class="callout text-center" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
   <div class="floated-label-wrapper">
            <label for="ime">Ime<?php if(isset($errors["ime"])){ echo "<p style=color:blue;>Krivo upisano ime</p>";} ?></label>
            <input autocomplete="off" type="text" id="ime" name="ime">
            
          </div>
          <div class="floated-label-wrapper">
            <label for="prezime">Prezime<?php if(isset($errors["prezime"])){ echo "<p style=color:blue;>Krivo upisano prezime</p>";} ?></label>
            <input autocomplete="off" type="text"  id="prezime" name="prezime" >
          </div>
          <div class="floated-label-wrapper">
            <label for="oib">OIB<?php if(isset($errors["oib"])){ echo "<p style=color:blue;>Krivo upisan oib</p>";} ?></label>
            <input autocomplete="off" type="number"  id="oib" name="oib" >
          </div>
          <div class="floated-label-wrapper">
            <label for="email">email<?php if(isset($errors["email"])){ echo "<p style=color:blue;>Krivo upisan email</p>";} ?></label>
            <input autocomplete="off" type="email"  id="email" name="email" >
          </div>
          <div class="floated-label-wrapper">
            <label for="mob">Mob<?php if(isset($errors["mob"])){ echo "<p style=color:blue;>Krivo upisan mobitel</p>";} ?></label>
            <input autocomplete="off" type="number"  id="mob" name="mob" >
          </div>
          
          <div class="floated-label-wrapper">
            <label for="radnomjesto">Radno mjesto<?php if(isset($errors["radnomjesto"])){ echo "<p style=color:blue;>Odaberi radno mjesto</p>";} ?></label>
            <input autocomplete="off" type="radio"  id="radnomjesto" name="radnomjesto" value="2">Trener</br>
            <input autocomplete="off" type="radio"  id="radnomjesto" name="radnomjesto" value="1">Uprava</br>
          </div>
          <div class="floated-label-wrapper">
            <label for="ziroracun">Žiroracun<?php if(isset($errors["ziroracun"])){ echo "<p style=color:blue;>Krivo upisan ziroracun</p>";} ?></label>
            <input autocomplete="off" type="number"  id="ziroracun" name="ziroracun" >
          </div>
          <div class="floated-label-wrapper">
            <label for="image">Slika</label>
            <input autocomplete="off" type="file"  id="image" name="image" >
          </div>
          <input class="button expanded" type="submit" name="dodaj" value="Dodaj novog zaposlenika">
        </form>
<?php include_once "../../predlozak/footer.php"?>
<?php include_once "../../predlozak/skripte.php"?>

</body>
</html>
