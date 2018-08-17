<?php include_once "konfiguracija.php"  ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <?php include_once "predlozak/head.php"?>
  </head>
  <body>
  <div class="grid-container">
  <?php include_once "predlozak/header.php"?>
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
                    <li><a href="<?php echo $putanja;?>/skola/kategorija.php">Kategorije</a></li>
                    <?php if(isset($_SESSION["bok"])): ?>
                    <li><a href="<?php echo $putanja;?>/skola/uprava.php">Zaposlenici</a></li>
                    <?php else:?>
                    <li><a href="<?php echo $putanja;?>/skola/uprava.php">Uprava</a></li>
                    <?php endif;?>
                    <li><a href="<?php echo $putanja;?>/skola/treneri.php">Treneri</a></li>
                  </ul>
                </li>
              </ul>
                <li><a href="<?php echo $putanja; ?>kontakt.php">Kontakt</a></li>
                
  </ul>
</div>
</div>
  <div class="grid-x grid-padding-x" >
   <form class="log-in-form" action="autorizirano.php" method="post" style=" margin: 0 auto;">
  <label>Name
    <input type="text" name="korisnik">
  </label>
  <label>Password
    <input type="text" name="lozinka">
  </label>
  <p><input type="submit" class="button expanded" value="Log in"></input></p>
</form>
</div>
  <div style="text-align: center;">
    <?php include_once "predlozak/footer.php"?>
 </div>
 <?php include_once "predlozak/skripte.php"?>
  </body>
</html>
