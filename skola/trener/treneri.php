<?php include_once "../konfiguracija.php" ?>
<!doctype html>
  <html class="no-js" lang="en" dir="ltr">
  <head>
<?php include_once "../predlozak/head.php"?>
  </head>
  <body>
<div class="grid-container">
<?php include_once "../predlozak/header.php"?>
<?php include_once "../predlozak/menu.php"?>
<!--Povezivanje s tablicom zaposlenik-->
   <?php
    $zaposlenik=$veza->prepare("select a.ime, a.prezime, a.image, a.radnomjesto
    from zaposlenik a 
    inner join trener b on a.sifra=b.zaposlenik
    where a.radnomjesto = 2;");
    $zaposlenik->execute();
    $rezZaposlenik=$zaposlenik->fetchall(PDO::FETCH_OBJ);
    ?>
<?php if(isset($_SESSION["bok"])): ?>
<a class="button" href="<?php echo $putanja; ?>skola/noviTrener.php" style="width:100%; text-align: center; ">Dodaj novog trenera</a>
<?php endif;?>
<h3>Treneri</h3>
<div class="grid-x grid-padding-x small-up-1 medium-up-3">
  <?php foreach($rezZaposlenik as $kartica): ?>
    <div class="cell">
      <div class="card">
        <img src="<?php echo $kartica->image;?>">
          <div class="card-section">
            <h4><?php echo $kartica->ime." " . $kartica->prezime;?></h4>
              <p><?php echo $kartica->radnomjesto ?></p>
          </div>
      </div>
    </div>
  <?php endforeach ?>    
</div>
<?php include_once "../predlozak/footer.php"?>
</div>
<?php include_once "../predlozak/skripte.php"?>
  </body>
  </html>
