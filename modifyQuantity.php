<?php
require_once "entity/connection.php";

$i = -1;
foreach ($_POST["prods"] as $prod) {

    $i++;

    if($prod == null)
        continue;

    myDB::getInstance()->Insert("UPDATE ecommerce_prodotti SET quantita = ? WHERE ID = ?", "ii", [$prod, $i]);
}

echo "ok";

?>