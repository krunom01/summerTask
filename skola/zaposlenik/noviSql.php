<?php
    if(count($errors)===0){
      
 
        
      $mob = $_POST["mob1"] . $_POST["mob"];
     
       /* ako je dodan trener  */
      if($_POST["radnomjesto"]==2){
      $noviZaposlenik = $veza->prepare(
        /* dodavanje novog zaposlenika u tablicu zaposlenik te dodavanje 
        novog trenera ako je stavljeno da je novi zaposlenik trener */
      "start transaction;
      insert into zaposlenik (ime, prezime, oib, mob, radnomjesto, ziroracun)
      values	(:ime, :prezime, :oib,  :mob , :radnomjesto, :ziroracun);
      insert into trener (zaposlenik) select max(sifra) from zaposlenik where radnomjesto=2;
      commit;");
      $noviZaposlenik->bindParam(":ime", $_POST["ime"]);
        $noviZaposlenik->bindParam(":prezime", $_POST["prezime"]);
        if($_POST["oib"]===""){
          $noviZaposlenik->bindValue(":oib",null,PDO::PARAM_STR);
        }
        else{
          $noviZaposlenik->bindParam(":oib", $_POST["oib"]);
        }
        $noviZaposlenik->bindParam(":mob", $mob, PDO::PARAM_STR);
        $noviZaposlenik->bindParam(":radnomjesto", $_POST["radnomjesto"]);
        $noviZaposlenik->bindParam(":ziroracun", $_POST["ziroracun"]);
        $noviZaposlenik->execute();  
        header("location:zaposlenici.php");
      
      }
      /* ako je dodana uprava */
      else{
        $noviZaposlenik = $veza->prepare(
          "insert into zaposlenik (ime, prezime, oib, mob, radnomjesto, ziroracun)
          values	(:ime, :prezime, :oib, :mob, :radnomjesto, :ziroracun);");
        $noviZaposlenik->bindParam(":ime", $_POST["ime"]);
        $noviZaposlenik->bindParam(":prezime", $_POST["prezime"]);
        if($_POST["oib"]===""){
          $noviZaposlenik->bindValue(":oib",null,PDO::PARAM_INT);
        }
        else{
          $noviZaposlenik->bindParam(":oib", $_POST["oib"]);
        }
        $noviZaposlenik->bindParam(":mob", $mob, PDO::PARAM_INT);
        $noviZaposlenik->bindParam(":radnomjesto", $_POST["radnomjesto"]);
        $noviZaposlenik->bindParam(":ziroracun", $_POST["ziroracun"]);
        $noviZaposlenik->execute();
        header("location:zaposlenici.php");
        
      }
    }
    
  
