<?php include_once "konfiguracija.php" ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <?php include_once "predlozak/head.php"?>
  </head>
  <body>
  <div class="grid-container">
  <?php include_once "predlozak/header.php"?>
  <?php include_once "predlozak/menu.php"?>
  <div class="grid-x grid-padding-x align-center" style="margin-top:3rem;">
  <div class="large-8  cell">
  <div class="orbit" role="region" aria-label="Favorite Space Pictures" data-orbit>
  <div class="orbit-wrapper">
    <div class="orbit-controls">
      <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
      <button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
    </div>
    <ul class="orbit-container">
      <li class="is-active orbit-slide">
        <figure class="orbit-figure">
          <img class="orbit-image" src="https://placehold.it/1200x600/999?text=Vijest-1" alt="Space">
          <figcaption class="orbit-caption">Vijest</figcaption>
        </figure>
      </li>
      
      <li class="orbit-slide">
        <figure class="orbit-figure">
          <a href="<?php echo $putanja; ?>skola/aktivnosti/trening.php"><img class="orbit-image" src="https://placehold.it/1200x600/777?text=Klikni za raspored treninga" alt="Space"></a>
          <figcaption class="orbit-caption">Raspored treninga</figcaption>
        </figure>
      </li>
      
    </ul>
  </div>
  <nav class="orbit-bullets">
    <button class="is-active" data-slide="0"><span class="show-for-sr">First slide details.</span><span class="show-for-sr">Current Slide</span></button>
    <button data-slide="1"><span class="show-for-sr">Second slide details.</span></button>
   
  </nav>
</div>
</div>
</div>
  <?php include_once "predlozak/footer.php"?>
  </div>
  <?php include_once "predlozak/skripte.php"?>
  <script src="/js/vendor/foundation.js"></script>
  
  </body>
</html>
