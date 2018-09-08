<?php include_once "../../konfiguracija.php" ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
  
    <?php include_once "../../predlozak/head.php"?>
 
  </head>
  <body>
  <?php
  /* select svih trenera */
  $trener=$veza->prepare("select a.sifra, b.radnomjesto, b.ime, b.prezime
  from trener a
  inner join zaposlenik b on a.zaposlenik=b.sifra;");
  $trener->execute();
  $rezTrener=$trener->fetchall(PDO::FETCH_OBJ);
/* dodavanje u kategoriju */
  if(isset($_POST["dodaj"])){
    include_once "kontrola.php";
      if(count($errors)==0){
      $novaKategorija=$veza->prepare("insert into kategorija (naziv, brojpolaznika, trener)
                                values(:naziv, :brojpolaznika, :trener)");
    unset($_POST["dodaj"]);
    $novaKategorija->execute($_POST);
    header("location:kategorija.php");
      }
  }
  ?>
  <div class="grid-container">
  <?php include_once "../../predlozak/header.php"?>
  <?php include_once "../../predlozak/menu.php"?>
    <form class="callout text-center" action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">
          <div class="floated-label-wrapper">
            <label for="naziv">Naziv nove kategorije
            <?php if(isset($errors["naziv"])){echo $errors["naziv"];} ?></label>
            <input autocomplete="off" type="text" id="naziv" name="naziv">
          </div>
          <div class="floated-label-wrapper">
            <label for="trener">Popis svih trenera
            <?php if(isset($errors["trener"])){echo $errors["trener"];} ?></label>
            <?php foreach($rezTrener as $kartica): ?>
            <input type="radio" id="trener" name="trener" value="<?php echo $kartica->sifra ?>">
            <?php echo  $kartica->ime . " " . $kartica->prezime; ?></br>
            <?php endforeach;?>
          </div>
          <div class="floated-label-wrapper">
            <label for="brojpolaznika">Broj polaznika
            <?php if(isset($errors["brojpolaznika"])){echo $errors["brojpolaznika"];} ?></label>
            <input autocomplete="off" type="number"  id="brojpolaznika" name="brojpolaznika">
          </div>
          <div class="floated-label-wrapper">
          <input class="button expanded" type="submit" name="dodaj" value="Dodaj novu kategoriju">
      </form>
    <?php include_once "../../predlozak/footer.php"?>
 <?php include_once "../../predlozak/skripte.php"?>
</body>
</html>
