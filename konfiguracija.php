<?php
session_start();
$nazivAPP = "Nogometna škola";
$putanja = "/summerTask/";
$veza = new PDO("mysql:host=localhost;dbname=aplikacija","edunova","edunova");
$veza->exec("set names utf8;");
