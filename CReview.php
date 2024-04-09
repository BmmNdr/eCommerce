<?php
require_once "connection.php";

class Review
{
    public $ID;
    public $IDProdotto;
    public $IDUtente;
    public $Commento;
    public $Voto;
    public $Data;
    public $IDOrdine;

    public function __construct($ID, $IDProdotto, $IDUtente, $Commento, $Voto, $Data, $IDOrdine)
    {
        $this->ID = $ID;
        $this->IDProdotto = $IDProdotto;
        $this->IDUtente = $IDUtente;
        $this->Commento = $Commento;
        $this->Voto = $Voto;
        $this->Data = $Data;
        $this->IDOrdine = $IDOrdine;
    }

    public static function fromID($ID)
    {
        $new = myDB::getInstance()->Select("SELECT * FROM ecommerce_feedback WHERE ID = ?", "i", [$ID])[0];
        return new Review($new['ID'], $new['IDProdotto'], $new['IDUtente'], $new['Commento'], $new['Voto'], $new['Data'], $new['IDOrdine']);
    }

    public static function fromRecordSet($recordSet)
    {
        $reviews = [];
        foreach ($recordSet as $record) {
            array_push($reviews, Review::fromID($record['ID']));
        }

        return $reviews;
    }

    public static function reviewForm($id)
    {
        $string = "<form action='chkReview.php' method='POST'><h4 class='mb-5 fw-bold'>Leave a Review</h4><div class='row g-4'>
        <input type='hidden' name='id' value='$id'><div class='border-bottom rounded my-4'>
        <textarea name='' id='' class='form-control border-0' cols='30' rows='8' placeholder='Your Review *'
                spellcheck='false'></textarea>
        </div>
        <div class='d-flex justify-content-between py-3 mb-5'>

            <a href='#' class='btn-product border border-secondary text-primary rounded-pill px-4 py-3 product-link'>
                Post Comment</a>
        </div>
            </div>
        </form>";

        return $string;
    }

    public function out()
    {
        $string = "<div class='d-flex'><div><p class='mb-2' style='font-size: 14px;'>" . $this->Data . '</p>';
        $string .= '<div class="d-flex justify-content-between">';
        $string .= '<p><h5>' . myDB::getInstance()->Select("SELECT * FROM ecommerce_utenti WHERE ID = ?", "i", [$this->IDUtente])[0]["username"] . '</h5></p>';
        $string .= '<div class="d-flex mb-3">';
        for ($i = 0; $i < $this->Voto; $i++) {
            $string .= '<i class="fa fa-star"></i>';
        }
        $string .= '</div>';
        $string .= '</div>';
        $string .= '<p>' . $this->Commento . '</p>';
        $string .= '</div>';
        $string .= '</div>';

        return $string;
    }

    public static function navReview($reviews)
    {
        $string = "<div class='col-lg-12'>
                    <nav>
                        <div class='nav nav-tabs mb-3'>
                            <button class='nav-link border-white border-bottom-0' type='button' role='tab'
                                id='nav-mission-tab' data-bs-toggle='tab' data-bs-target='#nav-mission'
                                aria-controls='nav-mission' aria-selected='true'>Reviews</button>
                        </div>
                    </nav>
                    <div class='tab-pane' id='nav-mission' role='tabpanel' aria-labelledby='nav-mission-tab'>";

        foreach ($reviews as $review) {
            $string .= $review->out();
        }
        $string .= '</div></div></div>';

        return $string;
    }
}


?>