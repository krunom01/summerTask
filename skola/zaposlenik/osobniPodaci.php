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
      <input type="text" name="ime" value="<?php echo isset($_POST["ime"])? $_POST["ime"] : "" ?>">
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
      <input type="text" name="prezime" value="<?php echo isset($_POST["prezime"])? $_POST["prezime"] : "" ?>">
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
      <input type="text" name="oib" value="<?php echo isset($_POST["oib"])? $_POST["oib"] : "" ?>">
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
    <?php $pocetniBroj = array("091","092","095","097","098","099"); ?>
                <?php foreach($pocetniBroj as $broj): ?>
                <option <?php if(isset($_POST["dodaj"])){ echo $broj===$_POST["mob1"]? ' selected="selected" ':""; }?>  value="<?php echo $broj?>"><?php echo $broj;?></option>
                <?php endforeach;?>
              </select>         
              
    </div>
  <?php if(!isset($errors["mob"])): ?>
 
    <div class="large-3 small-9 cell">
      <input style="margin-top:25px;" type="number" name="mob" value="<?php echo isset($_POST["mob"])? $_POST["mob"] : "" ?>">
    </div>
<?php else: ?>
<div class="large-3 small-9 cell">
    <label class="is-invalid-label">
    Mobitel
              <input type="text" 
              value="<?php echo  $_POST["mob"]; ?>"
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
      <input type="text" name="ziroracun" value="<?php echo isset($_POST["ziroracun"])? $_POST["ziroracun"] : "" ?>">
    </div>
<?php else: ?>
    <div class="large-4 cell">
    <label class="is-invalid-label">
              Žiroračun
              <input type="text" 
              value="<?php echo  $_POST["ziroracun"]; ?>"
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
      <input type="radio" name="radnomjesto" value="2" <?php if(isset($_POST["radnomjesto"])){if($_POST["radnomjesto"]==2){echo "checked";}} ?> id="radnomjesto2"><label for="radnomjesto2">Trener</label>
      <input type="radio" name="radnomjesto" value="1" <?php if(isset($_POST["radnomjesto"])){if($_POST["radnomjesto"]==1){echo "checked";}} ?> id="radnomjesto1"><label for="radnomjesto1">Uprava</label>
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
    <div class="large-8 medium-4 cell">
    <?php if(!isset($errors["image"])):?>
    <label>Slika</label></br>
    <input id="image" type="file" name="image" >
   <button id="image_alt">Select image</button>
   
    <?php else:?>
    <label class="is-invalid-label">
              Slika
              <input type="file" 
              class="is-invalid-input" aria-describedby="nazivGreska" data-invalid="" 
              aria-invalid="true" autocomplete="off" type="text" id="image" name="image" >
              <span class="form-error is-visible" id="nazivGreska">
              <?php echo $errors["image"]; ?>
              </span>
              </label>

<?php endif;?>
    </div> 


    <div class="large-4 medium-4 cell">
    <input style="margin-top:15px;"  class="button expanded" type="submit" name="dodaj" value="Dodaj novog zaposlenika">
    </div> 
  </div>
</form>