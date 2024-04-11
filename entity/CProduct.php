<?php
require_once "entity/connection.php";
require_once 'entity/CReview.php';
require_once "entity/CReview.php";

class Product
{
    public $ID;
    public $nome;
    public $descrizione;
    public $prezzo;
    public $quantita;
    public $dataAggiunta;
    public $images;
    public $reviews;


    public function __construct($ID, $nome, $descrizione, $prezzo, $quantita, $dataAggiunta)
    {
        $this->ID = $ID;
        $this->nome = $nome;
        $this->descrizione = $descrizione;
        $this->prezzo = $prezzo;
        $this->quantita = $quantita;
        $this->dataAggiunta = $dataAggiunta;

        $this->images = myDB::getInstance()->Select("SELECT Path FROM ecommerce_foto WHERE IDProdotto = ?", "i", [$ID]);

        $this->reviews = Review::fromRecordSet(myDB::getInstance()->Select("SELECT * FROM ecommerce_feedback WHERE IDProdotto = ?", "i", [$ID]));
    }

    public static function fromID($ID)
    {
        $new = myDB::getInstance()->Select("SELECT * FROM ecommerce_prodotti WHERE ID = ?", "i", [$ID])[0];
        return new Product($new['ID'], $new['nome'], $new['descrizione'], $new['prezzo'], $new['quantita'], $new['dataAggiunta']);
    }

    public static function fromIDCarrello($IDCarrello)
    {
        $new = myDB::getInstance()->Select("SELECT * FROM ecommerce_prodotti JOIN ecommerce_aggiunta ON ecommerce_prodotti.ID = ecommerce_aggiunta.IDProdotto WHERE ecommerce_aggiunta.IDCarrello = ?", "i", [$IDCarrello]);

        $products = [];
        foreach ($new as $record) {
            array_push($products, new Product($record['ID'], $record['nome'], $record['descrizione'], $record['prezzo'], $record['quantita'], $record['dataAggiunta']));
        }

        return $products;
    }

    public static function fromRecordSet($recordSet)
    {
        $products = [];
        foreach ($recordSet as $record) {
            array_push($products, Product::fromID($record['ID']));
        }

        return $products;
    }

    public function outShop()
    {
        $productImage = "images/products/" . myDB::getInstance()->Select("SELECT Path FROM ecommerce_foto WHERE IDProdotto = " . $this->ID . " LIMIT 1")[0]['Path'];
        $productPage = "productDetails.php?id=" . $this->ID;

        $string = "<div class='col-12 col-md-4 col-lg-3 mb-5'>
                        <a class='product-item' href='$productPage'>
                            <img src='$productImage' class='img-fluid product-thumbnail'>
                            <h3 class='product-title'>$this->nome</h3>
                            <strong class='product-price'>$this->prezzo $</strong>
                            <span class='icon-cross'><img src='images/cross.svg' class='img-fluid'></span>
                        </a>
                    </div>";

        return $string;
    }

    public function outDetails()
    {
        $string = "<div class='container py-5'><div class='row g-4 mb-5'><div class='row g-4'><div class='col-lg-6 slideshow-container'>";

        foreach ($this->images as $image) {
            $imagePath = "images/products/" . $image['Path'];
            $string .= "<div class='mySlides'><img src='$imagePath' style='width:100%'></div>";
        }

        $string .= "<a class='prev' onclick='plusSlides(-1)'>&#10094;</a><a class='next' onclick='plusSlides(1)'>&#10095;</a></div>
        <form action='chkAddCart.php' method='POST' class='col-lg-6 text-center'>
           <input type='hidden' name='id' value='$this->ID'>
           <h4 class='fw-bold mb-3'>$this->nome</h4>
           <h5 class='fw-bold mb-3'>$this->prezzo $</h5>
           <p class='mb-4'>$this->descrizione</p>
           <div class='input-group quantity mb-5' style='width: 200px; margin: 0 auto;'>
              <div class='input-group-btn'>
                 <input type='button' class='btn-product btn-sm btn-minus rounded-circle bg-light border'onclick='addQuantity(-1)' value='-' style='width: 50px; height: 50px'>
                 </input>
              </div>
              <input type='number' style='background-color: #eff2f1;'
                 class='form-control form-control-sm text-center border-0' name='quantity' id='selectedQuantity' value='1'>
              <div class='input-group-btn'>
                 <input type='button' class='btn-product btn-sm btn-plus rounded-circle bg-light border'
                    onclick='addQuantity(1)' value='+' style='width: 50px; height: 50px'>
                 </input>
              </div>
           </div>
           <input type='submit' class='btn-toCart btn-product border border-secondary text-primary rounded-pill px-4 py-3' value='Add to Cart'>
        </form>";



        $string .= Review::navReview($this->reviews);



        if (isset($_SESSION["username"])) {
            $string .= Review::reviewForm($this->ID);
        }
        $string .= "</div></div></div></div>";

        return $string;
    }

    public function outCart()
    {
        $totale = $this->quantita * $this->prezzo;
        $string .= '<tr><td class="product-thumbnail"><img src="images/products/' . $this->images[0]['Path'] . '" alt="Image" class="img-fluid">
                          </td>
                          <td class="product-name">
                            <h2 class="h5 text-black">' . $this->nome . '</h2>
                          </td>
                          <td>' . $this->prezzo . '</td>
                          <td>' . $this->quantita . '</td>
                          <td>' . $this->totale . ' $</td>
                          <td><a href="#" class="btn btn-black btn-sm">X</a></td>
                        </tr>';

        return $string;
    }

}

?>