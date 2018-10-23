
<?php include_once "../../konfiguracija.php" ?>
<!doctype html>
  <html class="no-js" lang="en" dir="ltr">
  <style>

      .slika{
        max-width: 10rem;
        
      }

      
    
  </style>
  <head>
<?php include_once "../../predlozak/head.php"?>
  </head>
  <body>
<div class="grid-container">
<?php include_once "../../predlozak/header.php"?>
<?php include_once "../../predlozak/menu.php"?>
<!--Povezivanje s tablicom zaposlenik-->
   <?php
    $zaposlenik=$veza->prepare("select a.ime, a.prezime, a.sifra
    from zaposlenik a 
    inner join trener b on a.sifra=b.zaposlenik
    where a.radnomjesto = 2;");
    $zaposlenik->execute();
    $rezZaposlenik=$zaposlenik->fetchall(PDO::FETCH_OBJ);
    ?>
<h3>Uprava</h3>
<div class="grid-x grid-padding-x small-up-1 medium-up-3">
  <?php foreach($rezZaposlenik as $red): ?>
  

    <div class="cell">
      <div class="card">
      <img title="Klik na sliku za promjenu" class="slika" id="s_<?php echo $red->sifra;?>" src="<?php 
         if(file_exists("../../img/zaposlenici/" . $red->sifra . ".png")){
          echo $putanja . "img/zaposlenici/" . $red->sifra . ".png";
          }else{
            echo $putanja . "img/zaposlenici/nepoznato.png";
          }
          
          ?>" alt="<?php echo $red->ime . " " . $red->prezime ?>" />
          <div class="card-section">
            <h4><?php echo $red->ime." " . $red->prezime;?></h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sit amet lorem condimentum, tincidunt dui eu, volutpat erat. Duis ultricies pretium sapien. Ut malesuada velit augue, id sodales nisl ultrices nec. Duis nulla quam, hendrerit eget ligula vestibulum, congue fermentum est. Sed tempor
               congue purus vitae luctus. Vivamus at leo ut ligula euismod tempus. Vestibulum nec sodales diam, vel placerat sem.</p>
          </div>
      </div>
    </div>
    
          
  <?php endforeach ;?>    
</div>
<?php include_once "../../predlozak/footer.php"?>
</div>
<?php include_once "../../predlozak/skripte.php"?>
  </body>
  </html>
