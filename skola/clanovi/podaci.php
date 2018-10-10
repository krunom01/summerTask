
<form class="callout text-center" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
<div class="floated-label-wrapper">
    <label for="ime">Ime</label>
    <input value="<?php echo $o->ime ?>" autocomplete="off" type="text" id="ime" name="ime">
</div>
<div class="floated-label-wrapper">
    <label for="prezime">Prezime</label>
    <input value="<?php echo $o->prezime ?>" autocomplete="off" type="text" id="prezime" name="prezime">
</div>
<div class="floated-label-wrapper">
    <label for="oib">OIB</label>
    <input value="<?php echo $o->oib ?>" autocomplete="off" type="text" id="oib" name="oib">
</div>
<div class="floated-label-wrapper">
    <label for="mob">mob</label>
    <input value="<?php echo $o->mob ?>" autocomplete="off" type="text" id="mob" name="mob">
</div>
<div class="floated-label-wrapper">
    <label for="imeroditelja">Ime roditelja</label>
    <input value="<?php echo $o->imeroditelja ?>" autocomplete="off" type="text" id="imeroditelja" name="imeroditelja">
</div>
<div class="floated-label-wrapper">
    <label for="imeroditelja">Prezime roditelja</label>
    <input value="<?php echo $o->prezimeroditelja ?>" autocomplete="off" type="text" id="prezimeroditelja" name="prezimeroditelja">
</div>
<div class="floated-label-wrapper">
    <label for="kategorija">Kategorija</label>
    <input value="<?php echo $o->kategorija ?>" autocomplete="off" type="text" id="kategorija" name="kategorija">
</div>

  <input type="hidden" name="sifra" value="<?php echo $o->sifra ?>" />
  <input class="button expanded" type="submit" name="promjeni" value="Promjeni podatke">
</form>