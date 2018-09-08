<?php
$errors = array();
      if (empty($_POST["naziv"]) or preg_match('/[^a-zA-Z]+/', $_POST["naziv"]))
      {
      $errors["naziv"] = "Krivo upisan naziv";
      } 
      if (empty($_POST["trener"]))
      {
      $errors["trener"] = "odaberi trenera";
      }
      if (empty($_POST["brojpolaznika"]) or !is_numeric($_POST["brojpolaznika"]))
      {
      $errors["brojpolaznika"] = "unesi broj polaznika"; 
      }