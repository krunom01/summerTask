<?php include_once "konfiguracija.php"  ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <?php include_once "predlozak/head.php"?>
  </head>
  <body>
  <div class="grid-container">
  <?php include_once "predlozak/header.php"?>
  <?php 
  if(isset($_POST["login"])){
if(!isset($_POST["korisnik"])){
  echo "unesi korisnika";
}
  }
  ?>
<div class="title-bar" data-responsive-toggle="example-menu" data-hide-for="medium">
<button class="menu-icon" type="button" data-toggle="example-menu"></button>
<div class="title-bar-title"><?php echo $nazivAPP ?></div>
</div>
<div class="top-bar" id="example-menu">
<div class="top-bar-left">
  <ul class="dropdown menu" data-dropdown-menu>
                
                <li><a href="<?php echo $putanja; ?>index.php"><i class="fas fa-home" ></i></a></li>
                <li><a href="<?php echo $putanja; ?>Onama.php">O nama</a></li>
                <ul class="dropdown menu" data-dropdown-menu>
                <li>
                  <a>Klub</a>
                  <ul class="menu vertical">
                 
                    <li><a href="<?php echo $putanja;?>skola/kategorija/kategorija.php">Kategorije</a></li>
                    <?php if(isset($_SESSION["bok"])): ?>
                    <li><a href="<?php echo $putanja;?>skola/zaposlenik/zaposlenici.php">Zaposlenici</a></li>
                    <li><a href="<?php echo $putanja;?>skola/clanovi/clanovi.php">Članovi</a></li>
                    <?php else:?>
                    
                    <li><a href="<?php echo $putanja;?>skola/zaposlenik/zaposlenici.php">Uprava</a></li>
                    <li><a href="<?php echo $putanja;?>skola/zaposlenik/treneri.php">Treneri</a></li>
                    
                                    
                    <?php endif;?>
                    <li><a href="<?php echo $putanja;?>skola/aktivnosti/trening.php">Aktivnosti</a></li>    
                    
                  </ul>
                </li>
                
              </ul>
                <li><a href="<?php echo $putanja; ?>kontakt.php">Kontakt</a></li>
   </ul>
</div>
</div>
  <div class="grid-x grid-padding-x" >
   <form class="log-in-form" method="post" action="autorizirano.php" style=" margin: 0 auto;">
  <label>Ime
    <input type="text" name="korisnik" id="korisnik">
  </label>
  <label>Lozinka
    <input type="text" name="lozinka">
  </label>
  <?php
  if(isset($_GET["greska"])){
    switch($_GET["greska"]){
      case "1": 
      echo "<p class=logingreska>*upiši ime i lozinku</p>";
      break;
      case "2": 
      echo "<p class=logingreska>*upiši ime</p>";
      break;
      case "3": 
      echo "<p class=logingreska>*upiši lozinku</p>";
      break;
      case "4": 
      echo "<p class=logingreska>*upiši ispravno ime i lozinku</p>";
      break;
    } 

  }
  ?>
  <p><input type="submit" class="button expanded" name="login" value="Log in"></input></p>
</form>
</div>
  <div style="text-align: center;">
    <?php include_once "predlozak/footer.php"?>
 </div>
 <?php include_once "predlozak/skripte.php"?>
  </body>
  <style>
   .logingreska {
     text-align:center;
     background-color: blue;
     animation: pulse 1s infinite;
   }
   @keyframes pulse {
  0% {
    background-color: blue;
  }
  100% {
    background-color: #FF4136;
  }
}
  </style>
</html>
