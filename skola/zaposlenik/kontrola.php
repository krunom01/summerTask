<?php
$errors = array();
if (empty($_POST["ime"]) or preg_match('/[^a-zA-Z]+/', $_POST["ime"]))
{
$errors["ime"] = "Krivo upisano ime"; 
}
if (empty($_POST["prezime"]) or preg_match('/[^a-zA-Z]+/', $_POST["prezime"]))
{
$errors["prezime"] = "Krivo upisano prezime"; 
}
if (empty($_POST["oib"]) or strlen($_POST["oib"]) !== 11 or !is_numeric($_POST["oib"]))
{
$errors["oib"] = "Krivo upisan oib"; 
}
if (empty($_POST["email"]))
{
$errors["email"] = "Unesi email"; 
}
if (empty($_POST["mob"]) or !is_numeric($_POST["mob"]))
{
$errors["mob"] = "unesi broj mobitela"; 
}
if (empty($_POST["radnomjesto"]))
{
$errors["radnomjesto"] = "odaberi radno mjesto"; 
}
if (empty($_POST["ziroracun"]) or !is_numeric($_POST["ziroracun"]))
{
$errors["ziroracun"] = "unesi žiroračun"; 
}