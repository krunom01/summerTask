<?php include_once "../../konfiguracija.php" ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <?php include_once "../../predlozak/head.php"?>
    <style>
    
.card-info {
  background: #fefefe;
  border: 1px solid #8a8a8a;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
  margin: 1rem 0;
  overflow: hidden;
  border-radius: 0;
  color:black;
}

.card-info .card-info-label {
  border-color: transparent #8a8a8a transparent transparent;
  border-color: rgba(255, 255, 255, 0) #8a8a8a rgba(255, 255, 255, 0) rgba(255, 255, 255, 0);
}

.card-info.primary {
  border-color: #1779ba;
}

.card-info.primary .card-info-label {
  border-color: transparent #1779ba transparent transparent;
  border-color: rgba(255, 255, 255, 0) #1779ba rgba(255, 255, 255, 0) rgba(255, 255, 255, 0);
}

.card-info.secondary {
  border-color: #767676;
}

.card-info.secondary .card-info-label {
  border-color: transparent #767676 transparent transparent;
  border-color: rgba(255, 255, 255, 0) #767676 rgba(255, 255, 255, 0) rgba(255, 255, 255, 0);
}

.card-info.info {
  border-color: #37a0e6;
}

.card-info.info .card-info-label {
  border-color: transparent #37a0e6 transparent transparent;
  border-color: rgba(255, 255, 255, 0) #37a0e6 rgba(255, 255, 255, 0) rgba(255, 255, 255, 0);
}

.card-info.alert {
  border-color: #cc4b37;
}

.card-info.alert .card-info-label {
  border-color: transparent #cc4b37 transparent transparent;
  border-color: rgba(255, 255, 255, 0) #cc4b37 rgba(255, 255, 255, 0) rgba(255, 255, 255, 0);
}

.card-info.success {
  border-color: #3adb76;
}

.card-info.success .card-info-label {
  border-color: transparent #3adb76 transparent transparent;
  border-color: rgba(255, 255, 255, 0) #3adb76 rgba(255, 255, 255, 0) rgba(255, 255, 255, 0);
}

.card-info.warning {
  border-color: #ffae00;
}

.card-info.warning .card-info-label {
  border-color: transparent #ffae00 transparent transparent;
  border-color: rgba(255, 255, 255, 0) #ffae00 rgba(255, 255, 255, 0) rgba(255, 255, 255, 0);
}

.card-info .card-info-label {
  border-style: solid;
  border-width: 0 4.375rem 2.5rem 0;
  float: right;
  height: 0px;
  width: 0px;
  -webkit-transform: rotate(360deg);
      -ms-transform: rotate(360deg);
          transform: rotate(360deg);
}

.card-info .card-info-content {
  padding: 0.5rem 1.5rem 0.875rem;
}

.card-info .card-info-label-text {
  color: #fefefe;
  font-size: 0.75rem;
  font-weight: bold;
  position: relative;
  right: -2.5rem;
  top: 2px;
  white-space: nowrap;
  -webkit-transform: rotate(30deg);
      -ms-transform: rotate(30deg);
          transform: rotate(30deg);
}


    </style>
  </head>
  <body>
  <div class="grid-container">
  <?php include_once "../../predlozak/header.php"?>
   <?php include_once "../../predlozak/menu.php"?>
   <?php 
   $kategorije=$veza->prepare
   ("select c.ime, c.prezime, a.naziv, a.brojpolaznika, a.sifra 
   from kategorija a
   inner join trener b on a.trener=b.sifra
   inner join zaposlenik c on c.sifra=b.zaposlenik;");
   $kategorije->execute();
   $rezKategorije = $kategorije->fetchall(PDO::FETCH_OBJ);
   ?>
  <?php
    if(isset($_SESSION["bok"])):?>
      <a class="button" href="<?php echo $putanja; ?>skola/kategorija/novaKategorija.php" style="width:100%; text-align: center; ">Dodaj novu kategoriju</a>
    <?php endif ?>
    <?php foreach($rezKategorije as $rez): ?>
    <div class="card-info alert">
 
  <div class="card-info-content">
    <h3 class="lead"><?php echo $rez->naziv ?></h3>
    <img style="width: 100px; height:100px;" src="https://img2.wikia.nocookie.net/__cb20090309234126/starwars/images/e/ee/DeathStar2.jpg" alt="death star" />
    <p>The Death Star was a moon-sized Imperial military battlestation armed with a planet-destroying superlaser.</p>
  </div>
  </div>
  <?php endforeach; ?>
</div>
<?php include_once "../../predlozak/footer.php"?>
<?php include_once "../../predlozak/skripte.php"?>
</body>
</html>
