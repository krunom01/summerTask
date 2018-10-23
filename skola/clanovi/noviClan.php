
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

  $noviZaposlenik=$veza->prepare("insert into clan(ime, prezime, oib, datumrodenja, mob, imeroditelja, prezimeroditelja,  kategorija) 
  values(:ime, :prezime, :oib, :datumrodenja, :mob, :imeroditelja, :prezimeroditelja, :kategorija)");
  $noviZaposlenik->bindParam(":ime", $_POST["ime"]);
  $noviZaposlenik->bindParam(":prezime", $_POST["prezime"]);
  if($_POST["oib"]===""){
    $noviZaposlenik->bindValue(":oib",null,PDO::PARAM_INT);
  }
  else{
    $noviZaposlenik->bindParam(":oib", $_POST["oib"]);
  }
  if($_POST["datumrodenja"]===""){
    $noviZaposlenik->bindValue(":datumrodenja",null,PDO::PARAM_INT);
  }
  else{
    $noviZaposlenik->bindParam(":datumrodenja", $_POST["datumrodenja"]);
  }
  $noviZaposlenik->bindParam(":mob", $mob, PDO::PARAM_STR);
  $noviZaposlenik->bindParam(":imeroditelja", $_POST["imeroditelja"]);
  $noviZaposlenik->bindParam(":prezimeroditelja", $_POST["prezimeroditelja"]);
 
  $noviZaposlenik->bindParam(":kategorija", $_POST["kategorija"]);
  $noviZaposlenik->execute();
  header("location:clanovi.php");

 
  }
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
      <input type="text" name="ime" value="<?php echo isset($_POST["ime"])? $_POST["ime"] : "" ?>">
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
      <input type="text" name="prezime" value="<?php echo isset($_POST["prezime"])? $_POST["prezime"] : "" ?>">
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
      <input type="text" name="oib" value="<?php echo isset($_POST["oib"])? $_POST["oib"] : "" ?>">
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
      <input type="date" name="datumrodenja" value="<?php echo isset($_POST["datumrodenja"])? $_POST["datumrodenja"] : "" ?>">
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
      <input type="text" name="imeroditelja" value="<?php echo isset($_POST["imeroditelja"])? $_POST["imeroditelja"] : "" ?>">
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
      <input type="text" name="prezimeroditelja" value="<?php echo isset($_POST["prezimeroditelja"])? $_POST["prezimeroditelja"] : "" ?>">
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
    <?php $pocetniBroj = array("091","092","095","097","098","099"); ?>
                <?php foreach($pocetniBroj as $broj): ?>
                <option <?php if(isset($_POST["dodaj"])){ echo $broj===$_POST["mob1"]? ' selected="selected" ':""; }?>  value="<?php echo $broj?>"><?php echo $broj;?></option>
                <?php endforeach;?>
              </select>         
              
    </div>
  <?php if(!isset($errors["mob"])): ?>
 
    <div class="large-3 small-9 cell">
      <input style="margin-top:25px;" type="number" name="mob" value="<?php echo isset($_POST["mob"])? $_POST["mob"] : "" ?>">
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
            <select  <?php if(isset($errors["kategorija"])){
              echo ' required="" class="is-invalid-input" data-invalid="" aria-invalid="true" ';
            } ?> id="kategorija" name="kategorija">
              <option value="0">Odaberi kategoriju</option>  
              <?php 
              
              $izraz = $veza->prepare("
              
              select sifra,naziv from kategorija;


              ");
              $izraz->execute();
              $rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
               foreach($rezultati as $red):?>
             <option 
             <?php 
             if(isset($_POST["kategorija"]) && $_POST["kategorija"]==$red->sifra){
               echo ' selected="selected" ';
             }
             ?>
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
            
    

    

<div class="large-4 medium-4 cell">
          <input style="margin-top:24px;"  class="button expanded" type="submit" name="dodaj" value="Dodaj novog člana">
        </div> 
</div> 

</form>
<?php include_once "../../predlozak/footer.php"?>
<?php include_once "../../predlozak/skripte.php"?>

</body>
</html>


