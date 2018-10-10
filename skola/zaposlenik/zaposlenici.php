<?php include_once "../../konfiguracija.php" ?>
<!doctype html>
  <html class="no-js" lang="en" dir="ltr">
  <head>
<?php include_once "../../predlozak/head.php"?>
  </head>
  <body>
<div class="grid-container">
<?php include_once "../../predlozak/header.php"?>
<?php include_once "../../predlozak/menu.php"?>


<!--Povezivanje s tablicom zaposlenik ako je korisnik prijavljen.
Left join kako bi mogli obrisati i trenera koji je zaposlenik -->
   <?php
    $zaposlenik=$veza->prepare("select a.sifra, b.zaposlenik, a.ime, a.prezime, a.oib,
     a.mob, a.radnomjesto, a.image
    from zaposlenik a
    left join trener b on b.zaposlenik=a.sifra;");
    $zaposlenik->execute();
    $zaposlenik=$zaposlenik->fetchall(PDO::FETCH_OBJ);


/* prikazivanje samo uprave ako korisnik nije prijavljen */
    $zaposlenik1=$veza->prepare("select * from zaposlenik where radnomjesto=1;");
    $zaposlenik1->execute();
    $zaposlenik1=$zaposlenik1->fetchall(PDO::FETCH_OBJ);      
    ?>
<!--Ako je korisnik prijavljen-->
<?php if(isset($_SESSION["bok"])): ?>
<a class="button" href="<?php echo $putanja; ?>skola/zaposlenik/noviZaposlenik.php" style="width:100%; text-align: center; ">Dodaj novog zaposlenika </a>
<table class="responsive-card-table unstriped">

  <thead>
    <tr>
        <th></th>
        <th>Ime</th>
        <th>Prezime</th>
        <th>Mobitel</th>
        <th>Radno mjesto</th>
        <th >Izmjena/brisanje</th>    
    </tr>
  </thead>
  <tbody>
  
  
    <?php foreach($zaposlenik as $kartica): ?>
    
    <tr>
      <td>
      <img src="<?php if($kartica->image!=null){ echo $kartica->image;}
                      else{ echo "../../img/zaposlenici/nepoznato.png" ;} ?>"
  
       alt="<?php echo $kartica->prezime ?>" style="width=50px; height=50px;" ></td>

      <td data-label="Ime"><?php echo $kartica->ime ?></td>
      <td data-label="Prezime" title="<?php echo "OIB: " . $kartica->oib; ?>"><?php echo $kartica->prezime; ?></td>
      <td data-label="Mobitel"><?php echo $kartica->mob ?></td>
      <td data-label="Radno mjesto"><?php echo $kartica->radnomjesto==="2" ?  "Trener" : "Uprava"; ?></td>
      <td data-label="Izmjena/brisanje" >
      <input type="hidden" name="radnomjesto" value="<?php echo $kartica->radnomjesto ?>">
      
      <a href="promjenaZaposlenika.php?sifra=<?php echo $kartica->sifra ?>" style="text-decorations:none; color:inherit;"><i class="far fa-edit fa-2x"></i></a>
              <a style="text-decorations:none; color:inherit;"
              <?php if($kartica->radnomjesto==1):?>
              onclick="return confirm('Želite li sigurno obrisati zaposlenika <?php echo $kartica->ime . " " . $kartica->prezime; ?>')"
              href="obrisiZaposlenika.php?sifra=<?php echo $kartica->sifra ?>"
              <?php else: ?>
              onclick="return confirm('Želite li sigurno obrisati trenera i zaposlenika <?php echo $kartica->ime . " " . $kartica->prezime; ?>')"
              href="obrisiZaposlenika.php?sifra=<?php echo $kartica->sifra."&zaposlenik=".$kartica->zaposlenik ?>"
              <?php endif;?>
              >
      <i class="far fa-trash-alt fa-2x" style="color: rgba(201,12,15,.9);"></i></a>
      
      </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
    </table>
   
<!--ako korisnik nije prijavljen -->
<?php else:?>
<h3>Uprava</h3>
<div class="grid-x grid-padding-x small-up-1 medium-up-3">
  <?php foreach($zaposlenik1 as $kartica): ?>
    <div class="cell">
      <div class="card">
        <img src="../<?php echo $kartica->image;?>">
          <div class="card-section">
            <h4><?php echo $kartica->ime." " . $kartica->prezime;?></h4>
              <p><?php echo $kartica->radnomjesto ?></p>
          </div>
      </div>
    </div>
  <?php endforeach ?>    
</div>
<?php endif; ?>
<?php include_once "../../predlozak/footer.php"?>
</div>
<?php include_once "../../predlozak/skripte.php"?>
</body>
</html>
