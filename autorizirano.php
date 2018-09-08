<?php
if(($_POST["korisnik"]==="a" && $_POST["lozinka"]==="a")){
     //pusti dalje
     session_start();
        $_SESSION["bok"]= $_POST["korisnik"];
        header("location:index.php"); 
    }
    else{
        header("location:login.php?greska=4");
    }
if(empty($_POST["lozinka"]) and empty($_POST["korisnik"])){
    header("location:login.php?greska=1");
    exit;
    }
if(empty($_POST["korisnik"])){
     header("location:login.php?greska=2");
     exit;
}
if(empty($_POST["lozinka"])){
    header("location:login.php?greska=3");
    exit;
}
