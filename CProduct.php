<?php
include "connection.php";

class Product{
    public $ID;
    public $nome;
    public $descrizione;
    public $prezzo;
    public $quantita;
    public $dataAggiunta;

    public function __construct($ID, $nome, $descrizione, $prezzo, $quantita, $dataAggiunta){
        $this->ID = $ID;
        $this->nome = $nome;
        $this->descrizione = $descrizione;
        $this->prezzo = $prezzo;
        $this->quantita = $quantita;
        $this->dataAggiunta = $dataAggiunta;
    }

    public function fromID($ID){
        $new = myDB::getInstance()->Select("SELECT * FROM ecommerce_prodotti WHERE ID = ?", "i", [$ID])[0];
        return new Product($new['ID'], $new['nome'], $new['descrizione'], $new['prezzo'], $new['quantita'], $new['dataAggiunta']);
    }

    public function outShop(){
        $productImage = "images/products/" . myDB::getInstance()->Select("SELECT Path FROM ecommerce_foto WHERE IDProdotto = " . $product['ID'] . " LIMIT 1")[0]['Path'];
        $productPage = "productDetails.php?id=" . $product['ID'];

        $string = """
                    <div class="col-12 col-md-4 col-lg-3 mb-5">
                        <a class="product-item" href=<?php echo $productPage; ?>>
                            <img src="<?php echo $productImage; ?>" class="img-fluid product-thumbnail">
                            <h3 class="product-title">
                                <?php echo $productName; ?>
                            </h3>
                            <strong class="product-price">$
                                <?php echo $productPrice; ?>
                            </strong>

                            <span class="icon-cross">
                                <img src="images/cross.svg" class="img-fluid">
                            </span>
                        </a>
                    </div>
                    """;
    }

}

?>