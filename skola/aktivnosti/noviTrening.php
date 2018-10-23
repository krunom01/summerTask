
<?php include_once "../../konfiguracija.php" ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
	<?php include_once "../../predlozak/head.php"?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<!--Load Script and Stylesheet -->
	<script type="text/javascript" src="jquery.simple-dtpicker.js"></script>
	<link type="text/css" href="jquery.simple-dtpicker.css" rel="stylesheet" />
  </head>
<?php


if(!isset($_SESSION["bok"])){
  header("location:" . $putanja . "odjava.php");
}

if(isset($_POST["dodaj"])){

  include_once "kontrola.php";
  if(count($errors)==0){
	$noviTrening=$veza->prepare("insert into trening (mjesto,vrijeme,kategorija) values (:mjesto,:vrijeme,:kategorija);");
	$noviTrening->bindParam(":mjesto", $_POST["mjesto"] );
	$noviTrening->bindParam(":vrijeme", $_POST["date"] );
	$noviTrening->bindParam(":kategorija", $_POST["kategorija"] );
	
	$noviTrening->execute();
	header("location:trening.php");
} 
}
?>
<body>
<div class="grid-container">
  <?php include_once "../../predlozak/header.php"?>
  <?php include_once "../../predlozak/menu.php"?>
  
   
  <form style="margin-top: 3rem;"  action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" >

<div class="grid-x grid-padding-x">
    <div class="large-1 medium-2 cell">
    <a href="trening.php"><input class="button expanded" value="Nazad"></a>
    </div> 
  </div>
  <div class="grid-x grid-padding-x">
  <div class="large-4 cell">
    <label
    <?php if(isset($errors["kategorija"])){
              echo ' class="is-invalid-label" ';}?>
     for="Kategorija">Kategorija</label>
            <select  <?php if(isset($errors["kategorija"])){
              echo ' required="" class="is-invalid-input" data-invalid="" aria-invalid="true" ';
            } ?> id="kategorija" name="kategorija">
              <option value="0">Odaberi kategoriju</option>  
              <?php 
              
              $izraz = $veza->prepare("
              
              select sifra,naziv from kategorija;


              ");
              $izraz->execute();
              $rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
               foreach($rezultati as $red):?>
             <option 
             <?php 
             if(isset($_POST["kategorija"]) && $_POST["kategorija"]==$red->sifra){
               echo ' selected="selected" ';
             }
             ?>
             value="<?php echo $red->sifra ?>"><?php echo $red->naziv ?></option>  
            
            <?php endforeach;?>
            </select>
            <?php if(isset($errors["kategorija"])): ?>
            <span class="form-error is-visible" id="nazivGreska">
              <?php echo $errors["kategorija"]; ?>
              </span>
              </label>
          <?php endif;?>
    </div>
		<div class="large-4 cell">
    <label
    <?php if(isset($errors["mjesto"])){
              echo ' class="is-invalid-label" ';}?>
     for="mjesto">mjesto</label>
            <select  <?php if(isset($errors["mjesto"])){
              echo ' required="" class="is-invalid-input" data-invalid="" aria-invalid="true" ';
            } ?> id="mjesto" name="mjesto">
              <option value="0">Odaberi mjesto</option>  
              <option value="glavni teren">Glavni teren</option> 
              <option value="pomocni teren">Pomoćni teren</option> 
              <option value="teretana">Teretana</option> 
             
            
            </select>
            <?php if(isset($errors["mjesto"])): ?>
            <span class="form-error is-visible" id="nazivGreska">
              <?php echo $errors["mjesto"]; ?>
              </span>
              </label>
					<?php endif;?>
		
    </div>
		<div class="large-4 cell">
<label for="datum">Odaberi datum</label>
			<input type="text" name="date" value="">
	
  
  <script type="text/javascript">
		$(function(){
			$('*[name=date]').appendDtpicker();
		});
	</script>
    </div>
            
    

    

<div class="large-4 medium-4 cell">
          <input style="margin-top:24px;"  class="button expanded" type="submit" name="dodaj" value="Dodaj novi trening">
        </div> 
</div> 

</form>
<?php include_once "../../predlozak/footer.php"?>


</body>
</html>


