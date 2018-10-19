
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

  
 
 
 
 

  $noviZaposlenik=$veza->prepare("insert into trening(mjesto, vrijeme, kategorija, trener) 
  values(:mjesto, :vrijeme, :kategorija, :trener)");

  $noviZaposlenik->execute();
  header("location:trening.php");

 
  }

?>
<body>
<div class="grid-container">
  <?php include_once "../../predlozak/header.php"?>
  <?php include_once "../../predlozak/menu.php"?>
  
   
  <form style="margin-top: 3rem;"  action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">

<div class="grid-x grid-padding-x">
    <div class="large-1 medium-2 cell">
    <a href="trening.php"><input class="button expanded" value="Nazad"></a>
    </div> 
  </div>
  <div class="grid-x grid-padding-x">

    <div class="large-4 cell">
      <label>Mjesto</label>
      <input type="text" name="ime" value="">
    </div>

    <div class="large-4 cell">
    <label>Kategorija</label>
     <select name="kategorija">
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
    </div>
    <div class="large-4 cell">
      <label>Ime</label>
      <input type="text" name="ime" value="">
    </div>

</div> 

</form>
<?php include_once "../../predlozak/footer.php"?>
<?php include_once "../../predlozak/skripte.php"?>

</body>
</html>


