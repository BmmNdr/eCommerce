<?php
session_start();
require_once "entity/connection.php";

if(count(myDB::getInstance()->Select("SELECT username FROM ecommerce_utenti WHERE username = ?", "s", [$_POST["username"]])) == 0){

  $password = md5($_POST["password"]);
  $myDB = myDB::getInstance()->Insert("INSERT INTO ecommerce_utenti (username, password, nome, cognome, numTelefono, email) VALUES (?, ?, ?, ?, ?, ?)", "ssssis", [$_POST["username"], $password, $_POST["nome"], $_POST["cognome"], $_POST["phoneNumber"], $_POST["email"]]);

  header("location: login.php");
} else {

  header("location: register.php?err=Username già esistente");
}
?>