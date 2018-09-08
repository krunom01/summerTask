<?php include_once "../../konfiguracija.php";
if(!isset($_SESSION["bok"])){
    header("location:" . $putanja . "odjava.php");
}
if(isset($_POST["promjeni"])){
/* update kategorije */
    $updateKategorije=$veza->prepare("update kategorija set naziv=:naziv, trener=:trener, brojpolaznika=:brojpolaznika where sifra=:sifra");
    unset($_POST["promjeni"]);
    $updateKategorije->execute($_POST);
    header("location:kategorija.php");
}
else{
/* select naziv i broj polaznika iz kategorije */
$trener=$veza->prepare("select naziv,broj from kategorija;");
$trener->execute();
$rezTrener=$trener->fetchall(PDO::FETCH_OBJ);
/* select iz razlicitih tablica, a.sifra određuje koja se kategorija mijenja, get metoda */
$promjenaKategorije = $veza->prepare("select a.naziv, a.brojpolaznika, c.ime, c.prezime, a.sifra, a.trener
from kategorija a
inner join trener b on a.trener=b.sifra
inner join zaposlenik c on c.sifra=b.zaposlenik where a.sifra=:sifra;");
$promjenaKategorije->execute($_GET);
$o=$promjenaKategorije->fetch(PDO::FETCH_OBJ);
/* select podataka koji omogucuju pregled svih trenera, njihovo radno mjesto, prezime i ime */
$trener=$veza->prepare("select a.sifra, b.ime, b.prezime
from trener a
inner join zaposlenik b on a.zaposlenik=b.sifra;");
$trener->execute();
$rezTrener=$trener->fetchall(PDO::FETCH_OBJ);
}
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <?php include_once "../../predlozak/head.php"?>
  </head>
  <body>
  <div class="grid-container">
<?php include_once "../../predlozak/header.php"?>
<?php include_once "../../predlozak/menu.php"?>
    <form class="callout text-center" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
        <div class="floated-label-wrapper">
            <label for="naziv">Naziv</label>
            <input value="<?php echo $o->naziv ?>" autocomplete="off" type="text" id="naziv" name="naziv">
        </div> 
        <div class="floated-label-wrapper">

    
            <label for="trener">Trener</label>
            <?php foreach($rezTrener as $kartica): ?>
            
            <input type="radio" id="trener" name="trener" 
            value="<?php echo $kartica->sifra;?>" <?php if($o->trener===$kartica->sifra){ echo "checked";}?>>
            <?php echo  $kartica->ime . " " . $kartica->prezime; ?></br>
            <?php endforeach;?>
          </div>   
        
        <div class="floated-label-wrapper">
            <label for="brojpolaznika">Broj polaznika</label>
            <input value="<?php echo $o->brojpolaznika ?>" autocomplete="off" type="text" id="brojpolaznika" name="brojpolaznika">
         </div>
          <input type="hidden" name="sifra" value="<?php echo $o->sifra ?>"/>    
          <input class="button expanded" type="submit" name="promjeni" value="Promjeni podatke">
    </form>
<?php include_once "../../predlozak/footer.php"?>
<?php include_once "../../predlozak/skripte.php"?>
</body>
</html>
