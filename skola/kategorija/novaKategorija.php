<?php include_once "../../konfiguracija.php" ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
  
    <?php include_once "../../predlozak/head.php"?>
 
  </head>
  <body>
  <?php
  /* select svih trenera */
  $trener=$veza->prepare("select a.sifra, b.ime, b.prezime
  from trener a
  inner join zaposlenik b on a.zaposlenik=b.sifra;");
  $trener->execute();
  $rezTrener=$trener->fetchall(PDO::FETCH_OBJ);
/* dodavanje u kategoriju */
  if(isset($_POST["dodaj"])){
    include_once "kontrola.php";
      if(count($errors)==0){
      $novaKategorija=$veza->prepare("insert into kategorija (naziv, trener)
                                values(:naziv,:trener)");
    unset($_POST["dodaj"]);
    $novaKategorija->execute($_POST);
    header("location:kategorija.php");
      }
  }
  ?>
  <div class="grid-container">
  <?php include_once "../../predlozak/header.php"?>
  <?php include_once "../../predlozak/menu.php"?>
  <div class="grid-x grid-padding-x align-center" style="margin-top:3rem;">
  <div class="large-4  cell">
    <form class="callout text-center" action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">
          <div class="floated-label-wrapper">
          <?php if(!isset($errors["naziv"])): ?>
    <div class="large-4 cell">
      <label>Naziv</label>
      <input type="text" name="naziv" value="<?php echo isset($_POST["naziv"])? $_POST["naziv"] : "" ?>">
    </div>
<?php else: ?>
    <div class="large-4 cell">
    <label class="is-invalid-label">
    Naziv Kategorije
              <input type="text" 
              value="<?php echo  $_POST["naziv"]; ?>"
              class="is-invalid-input" aria-describedby="nazivGreska" data-invalid="" 
              aria-invalid="true" autocomplete="off" type="text" id="naziv" name="naziv" >
              <span class="form-error is-visible" id="nazivGreska">
              <?php echo $errors["naziv"]; ?>
              </span>
              </label>
    </div>
    
<?php endif; ?>
          </div>
          
          <div class="floated-label-wrapper">
          <label
    <?php if(isset($errors["trener"])){
              echo ' class="is-invalid-label" ';}?>
     for="Trener">Trener</label>
            <select  <?php if(isset($errors["trener"])){
              echo ' required="" class="is-invalid-input" data-invalid="" aria-invalid="true" ';
            } ?> id="trener" name="trener">
              <option value="0">Odaberi trenera</option>  
             
               <?php foreach($rezTrener as $red):?>
             <option 
             <?php 
             if(isset($_POST["trener"]) && $_POST["trener"]==$red->sifra){
               echo ' selected="selected" ';
             }
             ?>
             value="<?php echo $red->sifra ?>"><?php echo $red->ime . " ". $red->prezime; ?></option>  
            
            <?php endforeach;?>
            </select>
            <?php if(isset($errors["trener"])): ?>
            <span class="form-error is-visible" id="nazivGreska">
              <?php echo $errors["trener"]; ?>
              </span>
              </label>
          <?php endif;?>
          </div>


      
          <div class="floated-label-wrapper">
          <input class="button expanded" type="submit" name="dodaj" value="Dodaj novu kategoriju">
      </form>
      </div>
      </div>
      </div>
      
    <?php include_once "../../predlozak/footer.php"?>
 <?php include_once "../../predlozak/skripte.php"?>
</body>
</html>
