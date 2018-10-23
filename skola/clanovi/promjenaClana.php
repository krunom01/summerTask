
<?php include_once "../../konfiguracija.php" ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
  <?php include_once "../../predlozak/head.php"?>
  </head>
<?php

if(!isset($_SESSION["bok"])){
  header("location:" . $putanja . "odjava.php");
}

if(isset($_POST["dodaj"])){
  include_once "kontrola.php";
  if(count($errors)==0){
  
  $mob = $_POST["mob1"] . $_POST["mob"];

  $promjenaClana=$veza->prepare("update clan set 
    ime=:ime,
    prezime=:prezime, 
    oib=:oib, 
    datumrodenja=:datumrodenja, 
    mob=:mob, 
    imeroditelja=:imeroditelja, 
    prezimeroditelja=:prezimeroditelja, 
    kategorija=:kategorija where sifra=:sifra");
    $promjenaClana->bindParam(":sifra", $_POST["sifra"]);  
  $promjenaClana->bindParam(":ime", $_POST["ime"]);
  $promjenaClana->bindParam(":prezime", $_POST["prezime"]);
  if($_POST["oib"]===""){
    $promjenaClana->bindValue(":oib",null,PDO::PARAM_INT);
  }
  else{
    $promjenaClana->bindParam(":oib", $_POST["oib"]);
  }
  if($_POST["datumrodenja"]===""){
    $promjenaClana->bindValue(":datumrodenja",null,PDO::PARAM_INT);
  }
  else{
    $promjenaClana->bindParam(":datumrodenja", $_POST["datumrodenja"]);
  }
  $promjenaClana->bindParam(":mob", $mob, PDO::PARAM_STR);
  $promjenaClana->bindParam(":imeroditelja", $_POST["imeroditelja"]);
  $promjenaClana->bindParam(":prezimeroditelja", $_POST["prezimeroditelja"]);
  $promjenaClana->bindParam(":kategorija", $_POST["kategorija"]);
  $promjenaClana->execute();
  header ("location:clanovi.php");

 
  }
} 
else {
$promjenaClan = $veza->prepare("select a.sifra, a.ime, a.prezime, a.oib, a.datumrodenja, a.mob, a.imeroditelja, a.prezimeroditelja,
b.naziv from clan a
inner join kategorija b on b.sifra=a.kategorija
where a.sifra=:sifra");
$promjenaClan->execute($_GET);
$o=$promjenaClan->fetch(PDO::FETCH_OBJ);
}
?>
<body>
<div class="grid-container">
  <?php include_once "../../predlozak/header.php"?>
  <?php include_once "../../predlozak/menu.php"?>
  
   
  <form style="margin-top: 3rem;"  action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">

<div class="grid-x grid-padding-x">
    <div class="large-1 medium-2 cell">
    <a href="clanovi.php"><input class="button expanded" value="Nazad"></a>
    </div> 
  </div>
  <div class="grid-x grid-padding-x">
  <?php if(!isset($errors["ime"])): ?>
    <div class="large-4 cell">
      <label>Ime</label>
      <input type="text" name="ime" value="<?php echo isset($_POST["ime"])? $_POST["ime"] : $o->ime ?>">
    </div>
<?php else: ?>
    <div class="large-4 cell">
    <label class="is-invalid-label">
              Ime
              <input type="text" 
              value="<?php echo  $_POST["ime"]; ?>"
              class="is-invalid-input" aria-describedby="nazivGreska" data-invalid="" 
              aria-invalid="true" autocomplete="off" type="text" id="ime" name="ime" >
              <span class="form-error is-visible" id="nazivGreska">
              <?php echo $errors["ime"]; ?>
              </span>
              </label>
    </div>
    
<?php endif; ?>
<?php if(!isset($errors["prezime"])): ?>
    <div class="large-4 cell">
      <label>Prezime</label>
      <input type="text" name="prezime" value="<?php echo isset($_POST["prezime"])? $_POST["prezime"] : $o->prezime ?>">
    </div>
<?php else: ?>
    <div class="large-4 cell">
    <label class="is-invalid-label">
              Prezime
              <input type="text" 
              value="<?php echo  $_POST["prezime"]; ?>"
              class="is-invalid-input" aria-describedby="nazivGreska" data-invalid="" 
              aria-invalid="true" autocomplete="off" type="text" id="prezime" name="prezime" >
              <span class="form-error is-visible" id="nazivGreska">
              <?php echo $errors["prezime"]; ?>
              </span>
              </label>
    </div>
    
<?php endif; ?>
<?php if(!isset($errors["oib"])): ?>
    <div class="large-4 cell">
      <label>OIB</label>
      <input type="text" name="oib" value="<?php echo isset($_POST["oib"])? $_POST["oib"] : $o->oib ?>">
    </div>
<?php else: ?>
    <div class="large-4 cell">
    <label class="is-invalid-label">
              OIB
              <input type="text" 
              value="<?php echo  $_POST["oib"]; ?>"
              class="is-invalid-input" aria-describedby="nazivGreska" data-invalid="" 
              aria-invalid="true" autocomplete="off" type="text" id="oib" name="oib" >
              <span class="form-error is-visible" id="nazivGreska">
              <?php echo $errors["oib"]; ?>
              </span>
              </label>
    </div>
    
<?php endif; ?>
</div>
  

  <div class="grid-x grid-padding-x">
  <?php if(!isset($errors["datumrodenja"])): ?>
    <div class="large-4 cell">
      <label>Datum rođenja</label>
      <input type="date" name="datumrodenja" value="<?php echo isset($_POST["datumrodenja"])? $_POST["datumrodenja"] : $o->datumrodenja ?>">
    </div>
<?php else: ?>
    <div class="large-4 cell">
    <label class="is-invalid-label">
    Datum rođenja
              <input type="date" 
              value="<?php echo  $_POST["datumrodenja"]; ?>"
              class="is-invalid-input" aria-describedby="nazivGreska" data-invalid="" 
              aria-invalid="true" autocomplete="off" type="text" id="datumrodenja" name="datumrodenja" >
              <span class="form-error is-visible" id="nazivGreska">
              <?php echo $errors["datumrodenja"];  ?>
              </span>
              </label>
    </div>
    
<?php endif; ?>
  
    

<?php if(!isset($errors["imeroditelja"])): ?>
    <div class="large-4 cell">
      <label>Ime roditelja</label>
      <input type="text" name="imeroditelja" value="<?php echo isset($_POST["imeroditelja"])? $_POST["imeroditelja"] : $o->imeroditelja ?>">
    </div>
<?php else: ?>
    <div class="large-4 cell">
    <label class="is-invalid-label">
    Ime roditelja
              <input type="text" 
              value="<?php echo  $_POST["imeroditelja"]; ?>"
              class="is-invalid-input" aria-describedby="nazivGreska" data-invalid="" 
              aria-invalid="true" autocomplete="off" type="text" id="imeroditelja" name="imeroditelja" >
              <span class="form-error is-visible" id="nazivGreska">
              <?php echo $errors["imeroditelja"]; ?>
              </span>
              </label>
    </div>
    
<?php endif; ?>
<?php if(!isset($errors["prezimeroditelja"])): ?>
    <div class="large-4 cell">
      <label>Prezime roditelja</label>
      <input type="text" name="prezimeroditelja" value="<?php echo isset($_POST["prezimeroditelja"])? $_POST["prezimeroditelja"] : $o->prezimeroditelja ?>">
    </div>
<?php else: ?>
    <div class="large-4 cell">
    <label class="is-invalid-label">
    Prezime roditelja
              <input type="text" 
              value="<?php echo  $_POST["prezimeroditelja"]; ?>"
              class="is-invalid-input" aria-describedby="nazivGreska" data-invalid="" 
              aria-invalid="true" autocomplete="off" type="text" id="prezimeroditelja" name="prezimeroditelja" >
              <span class="form-error is-visible" id="nazivGreska">
              <?php echo $errors["prezimeroditelja"]; ?>
              </span>
              </label>
    </div>
    
<?php endif; ?>
</div>

 <div class="grid-x grid-padding-x">
  <div class="large-1 small-3 cell">
    <label>Mobitel</label>
    <select id="mob1" name="mob1" >
    <?php
     $brojMob = $o->mob;
     $prviDio= substr($brojMob,0,3);
     $drugiDio= substr($brojMob,3);
             $pocetniBroj = array("091","092","095","097","098","099"); ?>
             <?php foreach($pocetniBroj as $broj): ?>
             <option <?php if(isset($_POST["mob1"])){ echo $broj===$_POST["mob1"]? ' selected="selected" ':""; }
             else {
                 if ($prviDio===$broj){
                     echo ' selected="selected" ';
                 }
             }
             ?>  value="<?php echo $broj?>"><?php echo $broj;?></option>
             <?php endforeach;?>
              </select>         
              
    </div>
  <?php if(!isset($errors["mob"])): ?>
 
    <div class="large-3 small-9 cell">
      <input style="margin-top:25px;" type="number" name="mob" value="<?php echo isset($_POST["mob"])? $_POST["mob"] : $drugiDio; ?>">
    </div>
<?php else: ?>
<div class="large-3 small-9 cell">
    <label class="is-invalid-label">
    Mobitel
              <input type="text" 
              value="<?php echo  $_POST["mob"]; ?>"
              class="is-invalid-input" aria-describedby="nazivGreska" data-invalid="" 
              aria-invalid="true" autocomplete="off" maxlength="7" type="text" id="mob" name="mob" >
              <span class="form-error is-visible" id="nazivGreska">
              <?php echo $errors["mob"]; ?>
              </span>
              </label>
    </div>
<?php endif; ?>

    <div class="large-4 cell">
    <label
    <?php if(isset($errors["kategorija"])){
              echo ' class="is-invalid-label" ';}?>
     for="Kategorija">Kategorija</label>
     <select id="kategorija" name="kategorija">
              <option value="0">Odaberi kategoriju</option>  
              <?php 
              
              $izraz = $veza->prepare("
              
              select sifra,naziv from kategorija;


              ");
              $izraz->execute();
              $rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
               foreach($rezultati as $red):?>
             <option 
             <?php if(isset($_POST["kategorija"])){ echo $red->sifra===$_POST["kategorija"]? ' selected="selected" ':""; }
                else {
                    if ($o->naziv===$red->naziv){
                        echo ' selected="selected" ';
                    }
                }?>
             value="<?php echo $red->sifra ?>"><?php echo $red->naziv ?></option>  
             
            <?php endforeach;?>
            </select>
            <?php if(isset($errors["kategorija"])): ?>
            <span class="form-error is-visible" id="nazivGreska">
              <?php echo $errors["kategorija"]; ?>
              </span>
              </label>
          <?php endif;?>
    </div>
            
    

    
    <input type="hidden" name="sifra" value="<?php echo isset($_POST["sifra"])? $_POST["sifra"] : $o->sifra; ?>">
<div class="large-4 medium-4 cell">
          <input style="margin-top:24px;"  class="button expanded" type="submit" name="dodaj" value="Dodaj novog člana">
        </div> 
</div> 

</form>
<?php include_once "../../predlozak/footer.php"?>
<?php include_once "../../predlozak/skripte.php"?>

</body>
</html>


