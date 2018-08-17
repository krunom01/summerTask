<?php
if(!isset($_POST["korisnik"]))
{
exit;
}
if($_POST["korisnik"]==="")
{
        header("location: login.php");
        exit;
}
if(($_POST["korisnik"]==="a" && $_POST["lozinka"]==="a")){
     //pusti dalje
     session_start();
        $_SESSION["bok"]= $_POST["korisnik"];
        header("location:index.php");
    }
else{
    header("location: login.php");
}
