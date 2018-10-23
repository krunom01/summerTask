
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
<div class="top-bar-right">
  <ul class="menu">
  <?php if(isset($_SESSION["bok"])): ?> 
  <a class="button" href="<?php echo $putanja; ?>odjava.php" style="width:100%; text-align: center; ">Odjava</a>
  <?php else:?>
  <a class="button" href="<?php echo $putanja; ?>login.php" style="width:100%; text-align: center; ">prijava</a>
  <?php endif?>
  </ul>
</div>
</div>