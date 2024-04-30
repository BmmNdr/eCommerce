<?php
require_once "entity/connection.php";


foreach ($_POST["prods"] as $prod) {
    if($prod == null)
        continue;

    myDB::getInstance()->Insert("UPDATE products SET quantity = ? WHERE id = ?", "ii", [$_POST["quantity"], $prod]);
}

echo "ok";

?>