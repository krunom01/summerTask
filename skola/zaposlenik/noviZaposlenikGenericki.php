<?php include_once "../../konfiguracija.php" ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
  <?php include_once "../../predlozak/head.php"?>
</head>
  <body>
    <?php
      $izraz=$veza->prepare("describe zaposlenik");
      $izraz->execute();
      $rezultati=$izraz->fetchall(PDO::FETCH_OBJ);
      $polja=array();
      foreach($rezultati as $red)
      {
          if($red->Field=="sifra")
          {
              continue;
          }
          $polja[]=$red->Field; 
      }
  if(isset($_POST["dodaj"]))
  {
    $ime_slike=$_FILES["image"]["name"];
    $tmp_slike=$_FILES["image"]["tmp_name"];
    $upload_datoteka = "../../img/zaposlenici/";
    move_uploaded_file($tmp_slike,$upload_datoteka.$ime_slike); 
    $inputIme="";
    $inputVrijednost="";
    foreach($polja as $polje){
        $inputIme.= $polje . ",";
    }
    $inputime=substr($inputIme,0,strlen($inputIme)-1);
    $noviZaposlenik = $veza->prepare("insert into zaposlenik (" . $inputime .  ")
    values (:ime, :prezime, :oib, :email, :mob, :radnomjesto, :nadredeni, :ziroracun,'$upload_datoteka$ime_slike')");
    unset($_POST["dodaj"]);
    $noviZaposlenik->execute($_POST);
    print_r($_POST["dodaj"]);
  }
  ?>
  <div class="grid-container">
  <?php include_once "../../predlozak/header.php"?>
  <?php include_once "../../predlozak/menu.php"?>
  <?php if(isset($errors)){if($errors>0){ echo "<p style=color:blue;>došlo je do pogreške,molim Vas pokušajte ponovo.</p>";}} ?>

<div class="translucent-form-overlay">
  <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
    <?php foreach($polja as $polje): ?>
      <?php if($polje != "radnomjesto" and $polje != "image" ): ?>
      <div class="row columns">
        <label  for="<?php echo $polje ?>"><?php echo $polje ?>
        <input autocomplete="off" type="text"  id="<?php echo $polje ?>" name="<?php echo $polje ?>">
        </label>
      </div>
      <?php elseif($polje === "radnomjesto"): ?>
      <div class="row columns">
        <label  for="<?php echo $polje ?>"><?php echo $polje ?>
        <input autocomplete="off" type="text"  id="<?php echo $polje ?>" name="<?php echo $polje ?>">
        </label>
      </div>
      <?php else: ?>
      <label  for="<?php echo $polje ?>">Slika
        <input autocomplete="off" type="file"  id="<?php echo $polje ?>" name="<?php echo $polje ?>">
        </label>
      <?php endif; ?>
    <?php endforeach; ?>
    
        <input class="button expanded" type="submit" name="dodaj" value="Dodaj novog zaposlenika">
  </form>
</div>
<?php include_once "../../predlozak/footer.php"?>
<?php include_once "../../predlozak/skripte.php"?>
<style>
.translucent-form-overlay {
  max-width: 500px;
  width: 100%;
  margin: 0 auto;
  background-color: black;
  padding: 20px;
  color: #fefefe;
}

.translucent-form-overlay .columns.row {
  display: block;
}

..translucent-form-overlay label {
  color: #fefefe;
}

.translucent-form-overlay input, .translucent-form-overlay select {
  color: black;
}

.translucent-form-overlay input::-webkit-input-placeholder {
  color: #fefefe;
}

.translucent-form-overlay input:-ms-input-placeholder {
  color: #fefefe;
}

.translucent-form-overlay input::placeholder {
  color: #fefefe;
}
</style>
</body>
</html>
