<?php
$errors = array();
        if (empty($_POST["kategorija"]))
        {
        $errors["kategorija"] = "odaberi kategoriju";
        }
        if (empty($_POST["mjesto"]))
        {
        $errors["mjesto"] = "odaberi mjesto";
        }
        
        