<?php 

require_once "entity/connection.php";
require_once "entity/CProduct.php";

class Carrello {

    public $prodotti;
    public $idCarrello;
    public $idUtente;

    public function __construct($idCarrello, $idUtente)
    {
        $this->idCarrello = $idCarrello;
        $this->idUtente = $idUtente;

        $this->prodotti = Product::fromIdCarrello($idCarrello);
    }

    public function out(){
        $string = '<div class="container">
              <div class="row mb-5">
                <form class="col-md-12" method="post">
                  <div class="site-blocks-table">
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="product-thumbnail">Image</th>
                          <th class="product-name">Product</th>
                          <th class="product-price">Price</th>
                          <th class="product-quantity">Quantity</th>
                          <th class="product-total">Total</th>
                          <th class="product-remove">Remove</th>
                        </tr>
                      </thead><tbody>';
                        
        foreach ($this->prodotti as $prodotto) {
          $string .= $prodotto->outCart();
        }
        
                      $string .= '</tbody></table></div></form></div>
        
              <div class="row">
                <div class="col-md-6 pl-5">
                  <div class="row justify-content-end">
                    <div class="col-md-7">
                      <div class="row mb-5">
                        <div class="col-md-6">
                          <span class="text-black">Total</span>
                        </div>
                        <div class="col-md-6 text-right">
                          <strong class="text-black">$230.00</strong>
                        </div>
                      </div>
        
                      <div class="row">
                        <form action="checkout.php"  class="col-md-12">
                          <input type="submit" value="Checkout">
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>';

        return $string;
    }
}

?>