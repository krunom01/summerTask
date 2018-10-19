<?php include_once "../../konfiguracija.php";

if(!isset($_SESSION["bok"]))
{
    header("location:" . $putanja . "odjava.php");
}
if(!isset($_GET["sifra"]) && !isset($_POST["sifra"])){
    header("location: " . $putanja . "odjava.php");
  }

    if(isset($_POST["promjeni"]))
{ 
    include_once "kontrola.php";
    if(count($errors)===0){
    
    if($_POST["radnomjesto"]==1){
    try
    {
        $veza->beginTransaction();
        $updateZaposlenika=$veza->prepare("select * from zaposlenik where sifra=:sifra;"); 
        $updateZaposlenika->execute(array("sifra"=>$_POST["sifra"]));
        $sifraOsobe=$updateZaposlenika->fetchColumn();
        $mob = $_POST["mob1"] . $_POST["mob"];
        $updateZaposlenika=$veza->prepare(
            "update zaposlenik set ime=:ime, prezime=:prezime, oib=:oib, mob=:mob, ziroracun=:ziroracun, radnomjesto=:radnomjesto where sifra=:sifra;");
            $updateZaposlenika->bindParam(":sifra", $sifraOsobe);
            $updateZaposlenika->bindParam(":ime", $_POST["ime"]);
            $updateZaposlenika->bindParam(":prezime", $_POST["prezime"]);
            if($_POST["oib"]===""){
              $updateZaposlenika->bindValue(":oib",null,PDO::PARAM_STR);
            }
            else{
              $updateZaposlenika->bindParam(":oib", $_POST["oib"]);
            }
            $updateZaposlenika->bindParam(":mob", $mob, PDO::PARAM_STR);
            $updateZaposlenika->bindParam(":radnomjesto", $_POST["radnomjesto"]);
            $updateZaposlenika->bindParam(":ziroracun", $_POST["ziroracun"]);
            $updateZaposlenika->execute();  
            $updateZaposlenika=$veza->prepare("delete from trener where zaposlenik=:sifra");
        $updateZaposlenika->execute(array("sifra"=>$_POST["sifra"]));
        $veza->commit();
        header("location: zaposlenici.php");
        
        
        }
    catch(PDOException $e)
    {
        $veza->rollBack();
    }}
    else{
        try
        {
            $veza->beginTransaction();
            $updateZaposlenika=$veza->prepare("select * from zaposlenik where sifra=:sifra;"); 
            $updateZaposlenika->execute(array("sifra"=>$_POST["sifra"]));
            $sifraOsobe=$updateZaposlenika->fetchColumn();
            $mob = $_POST["mob1"] . $_POST["mob"];
            $updateZaposlenika=$veza->prepare(
                "update zaposlenik set ime=:ime, prezime=:prezime, oib=:oib, mob=:mob, ziroracun=:ziroracun, radnomjesto=:radnomjesto  where sifra=:sifra;");
            $updateZaposlenika->execute(array(
                "ime"=>$_POST["ime"],
                "prezime"=>$_POST["prezime"],
                "oib"=>$_POST["oib"],
                "mob"=>$mob,
                "ziroracun"=>$_POST["ziroracun"],
                "radnomjesto"=>$_POST["radnomjesto"],
                "sifra"=>$sifraOsobe
            ));
            
           
            $updateZaposlenika=$veza->prepare("insert into trener (zaposlenik) values(:sifra)");
            $updateZaposlenika->execute(array("sifra"=>$_POST["sifra"]));
           
            $veza->commit();
            header("location: zaposlenici.php");
            
            }
        catch(PDOException $e)
        {
            $veza->rollBack();
        }
    }}}

else
{
$promjenaZaposlenika = $veza->prepare("select * from zaposlenik where sifra = :sifra");
$promjenaZaposlenika->execute($_GET);
$o=$promjenaZaposlenika->fetch(PDO::FETCH_OBJ);

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
<form style="margin-top: 3rem;"  action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">

<div class="grid-x grid-padding-x">
    <div class="large-1 medium-2 cell">
    <a href="zaposlenici.php"><input class="button expanded" value="Nazad"></a>
    </div> 
  </div>
  <div class="grid-x grid-padding-x">
  <?php if(!isset($errors["ime"])): ?>
    <div class="large-4 cell">
      <label>Ime</label>
      <input type="text" name="ime" value="<?php echo isset($_POST["ime"])? $_POST["ime"] : $o->ime; ?>">
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
      <input type="text" name="prezime" value="<?php echo isset($_POST["prezime"])? $_POST["prezime"] : $o->prezime; ?>">
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
      <input type="text" name="oib" value="<?php echo isset($_POST["oib"])? $_POST["oib"] : $o->oib; ?>">
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
  <div class="large-1 small-3 cell">
    <label>Mobitel</label>
    <select id="mob1" name="mob1" >
    <?php 
        $brojMob = $o->mob;
        $prviDio= substr($brojMob,0,3);
        $drugiDio= substr($brojMob,3);
                $pocetniBroj = array("091","092","095","097","098","099"); ?>
                <?php foreach($pocetniBroj as $broj): ?>
                <option <?php if(isset($_POST["mob1"])){ echo $broj===$_POST["mob1"]? ' selected="selected" ':""; }
                else {
                    if ($prviDio===$broj){
                        echo ' selected="selected" ';
                    }
                }
                ?>  value="<?php echo $broj?>"><?php echo $broj;?></option>
                <?php endforeach;?>
              </select>         
              
    </div>
  <?php if(!isset($errors["mob"])): ?>
    <div class="large-3 small-9 cell">
      <input style="margin-top:25px;" type="number" name="mob" value="<?php echo isset($_POST["mob"])? $_POST["mob"] : $drugiDio; ?>">
    </div>
<?php else: ?>
<div class="large-3 small-9 cell">
    <label class="is-invalid-label">
    Mobitel
              <input type="text" 
              value="<?php echo $drugiDio;?>"
              class="is-invalid-input" aria-describedby="nazivGreska" data-invalid="" 
              aria-invalid="true" autocomplete="off" maxlength="7" type="text" id="mob" name="mob" >
              <span class="form-error is-visible" id="nazivGreska">
              <?php echo $errors["mob"]; ?>
              </span>
              </label>
    </div>
<?php endif; ?>
<?php if(!isset($errors["ziroracun"])): ?>
    <div class="large-4 cell">
      <label>Žiroračun</label>
      <input type="text" name="ziroracun" value="<?php echo isset($_POST["ziroracun"])? $_POST["ziroracun"] : $o->ziroracun; ?>">
    </div>
<?php else: ?>
    <div class="large-4 cell">
    <label class="is-invalid-label">
              Žiroračun
              <input type="text" 
              value="<?php echo $_POST["ziroracun"]; ?>"
              class="is-invalid-input" aria-describedby="nazivGreska" data-invalid="" 
              aria-invalid="true" autocomplete="off" type="text" id="ziroracun" name="ziroracun" >
              <span class="form-error is-visible" id="nazivGreska">
              <?php echo $errors["ziroracun"]; ?>
              </span>
              </label>
    </div>
    
<?php endif; ?>
    <div class="large-4 medium-4 cell">
    <?php if(!isset($errors["radnomjesto"])): ?>
    <label>Radno mjesto:</label></br>
      <input type="radio" name="radnomjesto" value="2" 
      <?php if(isset($_POST["radnomjesto"]))
      {
        if($_POST["radnomjesto"]==2){echo "checked";}
      } 
      else
      {
        if($o->radnomjesto==2){echo "checked";}  
      }
      ?> 
      id="radnomjesto2"><label for="radnomjesto2">Trener</label>
      <input type="radio" name="radnomjesto" value="1" <?php if(isset($_POST["radnomjesto"]))
      {
        if($_POST["radnomjesto"]==1){echo "checked";}
      } 
      else
      {
        if($o->radnomjesto==1){echo "checked";}  
      }
      ?> 
      id="radnomjesto1"><label for="radnomjesto1">Uprava</label>
    </div>
<?php else: ?>
<div class="large-4 cell">
    <label class="is-invalid-label">Radno mjesto:</label></br>
    <input type="radio" name="radnomjesto" value="2"  id="radnomjesto2"><label for="radnomjesto2">Trener</label>
      <input type="radio" name="radnomjesto" value="1"  id="radnomjesto1"><label for="radnomjesto1">Uprava</label>
      <span class="form-error is-visible" id="nazivGreska"><?php echo $errors["radnomjesto"]; ?> </span>
      </label>
    </div>
    </div>
<?php endif; ?>
</div>
<div class="grid-x grid-padding-x">
<div class="large-4 medium-4 cell">


    </div> 
    <div class="large-4 medium-4 cell">
    <input type="hidden" name="sifra" value="<?php echo isset($_POST["sifra"])? $_POST["sifra"] : $o->sifra; ?>">
    </div> 

    <div class="large-4 medium-4 cell">
    <input style="margin-top:15px;"  class="button expanded" type="submit" name="promjeni" value="Promjeni zaposlenika">
    </div> 
  </div>
</form>
<?php include_once "../../predlozak/footer.php"?>
<?php include_once "../../predlozak/skripte.php"?>
</body>
</html>
