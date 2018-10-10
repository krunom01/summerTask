<?php
$errors = array();
if (empty($_POST["ime"]) or preg_match('/[^a-zA-Z]+/', $_POST["ime"]))
{
$errors["ime"] = "Krivo upisano ime"; 
}
if (empty($_POST["imeroditelja"]) or preg_match('/[^a-zA-Z]+/', $_POST["imeroditelja"]))
{
$errors["imeroditelja"] = "Krivo upisano ime roditelja"; 
}
if (empty($_POST["prezimeroditelja"]) or preg_match('/[^a-zA-Z]+/', $_POST["prezimeroditelja"]))
{
$errors["prezimeroditelja"] = "Krivo upisano ime"; 
}
if (empty($_POST["prezime"]) or preg_match('/[^a-zA-Z]+/', $_POST["prezime"]))
{
$errors["prezime"] = "Krivo upisano prezime"; 
}
if (empty($_POST["oib"]) or strlen($_POST["oib"]) !== 11 or !is_numeric($_POST["oib"]))
{
$errors["oib"] = "Krivo upisan oib"; 
}

$datum = $_POST["datumrodenja"];
$godina = date("Y",strtotime(" . $datum . "));
$godina1=date("Y");
$rezultat=$godina1 - $godina;

if (empty($_POST["datumrodenja"]) or $rezultat<4)
{

$errors["datumrodenja"] = "krivo unesen datum (osoba ne smije biti mlađa od 4 godine!)"; 
}


if (empty($_POST["mob"]) or !is_numeric($_POST["mob"]))
{
$errors["mob"] = "unesi broj mobitela"; 
}
if (empty($_POST["kategorija"]))
{
$errors["kategorija"] = "odaberi kategoriju"; 
}
