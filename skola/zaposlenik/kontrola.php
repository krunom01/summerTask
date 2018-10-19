<?php
$errors = array();
    if (empty($_POST["ime"]) or preg_match('/[^a-z ćčžđš A-Z]+/', $_POST["ime"]))
    {
    $errors["ime"] = "Krivo upisano ime"; 
    }
    if (empty($_POST["prezime"]) or preg_match('/[^a-zA-Z]+/', $_POST["prezime"]))
    {
    $errors["prezime"] = "Krivo upisano prezime"; 
    }
    if (empty($_POST["oib"]) or strlen($_POST["oib"]) !== 11 or !is_numeric($_POST["oib"]))
    {
    $errors["oib"] = "Krivo upisan oib (potrebno upisati 11 brojeva)"; 
    }
    if (empty($_POST["mob"]) or !is_numeric($_POST["mob"]) or strlen($_POST["mob"]) > 7 or strlen($_POST["mob"]) < 6 or $_POST["mob"] < 0)
    {
    $errors["mob"] = "Krivo upisan broj mobitela"; 
    }
    if (empty($_POST["radnomjesto"]))
    {
    $errors["radnomjesto"] = "odaberi radno mjesto"; 
    }
    else{
        if($_POST["radnomjesto"] != "2" and $_POST["radnomjesto"] != "1"  ){
            $errors["radnomjesto"] = "Kriva vrijednost!"; 
        }
    }
    if (empty($_POST["ziroracun"]) or !is_numeric($_POST["ziroracun"]))
    {
    $errors["ziroracun"] = "unesi žiroračun"; 
    }
?>