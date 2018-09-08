<?php
session_start();
$nazivAPP = "Nogometna škola";
$putanja = "/summerTask/";
$veza = new PDO("mysql:host=localhost;dbname=aplikacija1","edunova","edunova");
$veza->exec("set names utf8;");

