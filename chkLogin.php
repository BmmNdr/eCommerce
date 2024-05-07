<?php
require_once "entity/connection.php";

$result = myDB::getInstance()->Select("SELECT * FROM ecommerce_utenti WHERE password = md5(?) AND username = ?", "ss", [$_POST["password"], $_POST["username"]]);

if (count($result) > 0) {
    session_start();
    $_SESSION["username"] = $result[0]["username"];
    $_SESSION["IDUtente"] = $result[0]["ID"];
    $_SESSION["isAdmin"] = $result[0]["isAdmin"];

    
    $idCarrello =  myDB::getInstance()->Select("SELECT MAX(ID) FROM ecommerce_carrelli WHERE IDUtente = ?", "i", [myDB::getInstance()->Select("SELECT ID FROM ecommerce_utenti WHERE username = ?", "s", [$_SESSION["username"]])[0]["ID"]])[0]["MAX(ID)"];

    if($idCarrello == NULL){
        $idCarrello = myDB::getInstance()->Insert("INSERT INTO ecommerce_carrelli (IDUtente) VALUES (?)", "i", [$_SESSION["IDUtente"]]);
    }

    $_SESSION["IDCarrello"] = $idCarrello;
    
    if(!$_SESSION["isAdmin"])
        header("location: index.php");
    else
        header("location: admin.php");
}
else {
    header("location: login.php?err=Username o Password errati");
}

?>