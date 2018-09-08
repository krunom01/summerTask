<?php
function login($name, $password){
  if(!isset($name, $password) && $name && $password == "" || " " ){
      return false;
  }
  else{
      return true;
  }
}
