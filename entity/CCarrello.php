<?php

require_once "entity/connection.php";
require_once "entity/CProduct.php";

class Carrello
{
  //prodotti nel carrello (Array di Product)
  public $prodotti;
  public $idCarrello;
  public $idUtente;

  public $totale;

  public function __construct($idCarrello, $idUtente)
  {
    $this->idCarrello = $idCarrello;
    $this->idUtente = $idUtente;

    $this->prodotti = Product::fromIdCarrello($idCarrello); //recupero i prodotti dal carrello

    $this->totale = 0;

    foreach ($this->prodotti as $product) {
      $this->totale += $product->prezzo * $product->quantita;
    }
  }

  //Render carrello nella pagina carrello.php
  public function out()
  {
    $string = '<div class="container">
              <div class="row mb-5">
                <div class="col-md-12">
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

    $string .= '</tbody></table></div></div></div>
        <div class="row">
        <div class="col-md-6">
          <div class="row mb-5">
            <div class="col-md-6">
              <button class="btn btn-outline-black btn-sm btn-block"><a href="index.php" style="color: white">Continue Shopping</a></button>
            </div>
          </div>
        </div>
        <div class="col-md-6 pl-5">
          <div class="row justify-content-end">
            <div class="col-md-7">
              <div class="row">
                <div class="col-md-12 text-right border-bottom mb-5">
                  <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                </div>
              </div>
              <div class="row mb-5">
                <div class="col-md-6">
                  <span class="text-black">Total</span>
                </div>
                <div class="col-md-6 text-right">
                  <strong class="text-black">' . $this->totale . '</strong>
                </div>
              </div>

              <div class="row">
                <form action="checkout.php" method="POST">
                  <button class="btn btn-black btn-lg py-3 btn-block">Proceed To Checkout</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div><br><br>';

    return $string;
  }

  //Render carrello nella pagina checkout.php
  public function checkout()
  {
    $string = '<div class="untree_co-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="border p-4 rounded" role="alert">
                    Returning customer? <a href="login.php">Click here</a> to login
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-5 mb-md-0">
                <h2 class="h3 mb-3 text-black">Billing Details</h2>
                <div class="p-3 p-lg-5 border bg-white">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="c_fname" class="text-black">First Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="c_fname" name="c_fname">
                        </div>
                        <div class="col-md-6">
                            <label for="c_lname" class="text-black">Last Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="c_lname" name="c_lname">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="c_address" class="text-black">Address <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="c_address" name="c_address"
                                placeholder="Street address">
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <input type="text" class="form-control"
                            placeholder="Apartment, suite, unit etc. (optional)">
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="c_state_country" class="text-black">State / Country <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="c_state_country" name="c_state_country">
                        </div>
                        <div class="col-md-6">
                            <label for="c_postal_zip" class="text-black">Posta / Zip <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="c_postal_zip" name="c_postal_zip">
                        </div>
                    </div>

                    <div class="form-group row mb-5">
                        <div class="col-md-6">
                            <label for="c_email_address" class="text-black">Email Address <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="c_email_address" name="c_email_address">
                        </div>
                        <div class="col-md-6">
                            <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="c_phone" name="c_phone"
                                placeholder="Phone Number">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row mb-5">
                    <div class="col-md-12">
                        <h2 class="h3 mb-3 text-black">Your Order</h2>
                        <div class="p-3 p-lg-5 border bg-white">
                            <table class="table site-block-order-table mb-5">
                                <thead>
                                    <th>Product</th>
                                    <th>Total</th>
                                </thead>
                                <tbody>';

    foreach ($this->prodotti as $prodotto) {
      $string .= '<tr><td>' . $prodotto->nome . '<strong class="mx-2">x</strong> ' . $prodotto->quantita . '</td><td>$' . $prodotto->prezzo * $prodotto->quantita . '</td></tr>';
    }

    $string .= '<tr><td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td><td class="text-black font-weight-bold"><strong>$' . $this->totale . '</strong></td></tr>';


    $string .= '</tbody>
                            </table>

                            <form class="form-group" action="chkcheckout.php" method="POST">
                                <button class="btn btn-black btn-lg py-3 btn-block">Place Order</button>
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