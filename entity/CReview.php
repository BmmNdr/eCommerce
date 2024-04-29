<?php
require_once "connection.php";
require_once 'CProduct.php';

class Review
{
    public $ID;
    public $nomeProdotto;
    public $nomeUtente;
    public $Commento;
    public $Voto;
    public $Data;

    public function __construct($ID, $IDProdotto, $IDUtente, $Commento, $Voto, $Data)
    {
        $this->ID = $ID;
        $this->nomeProdotto = myDB::getInstance()->Select("SELECT nome FROM ecommerce_prodotti WHERE ID = ?", "i", [$IDProdotto])[0]["nome"];
        $this->nomeUtente = myDB::getInstance()->Select("SELECT username FROM ecommerce_utenti WHERE ID = ?", "i", [$IDUtente])[0]["username"];
        $this->Commento = $Commento;
        $this->Voto = $Voto;
        $this->Data = $Data;
    }

    public static function fromID($ID)
    {
        $new = myDB::getInstance()->Select("SELECT * FROM ecommerce_feedback WHERE ID = ?", "i", [$ID])[0];
        return new Review($new['ID'], $new['IDProdotto'], $new['IDUtente'], $new['Commento'], $new['Voto'], $new['Data']);
    }

    public static function fromRecordSet($recordSet)
    {
        $reviews = [];
        foreach ($recordSet as $record) {
            array_push($reviews, Review::fromID($record['ID']));
        }

        return $reviews;
    }

    //Form per lasciare una recensione
    public static function reviewForm($idProdotto)
    {
        $string = "
        <form action='chkReview.php' method='POST'>
            <h4 class='mb-5 fw-bold'>Leave a Review</h4>
            <div class='row g-4'>
                <input type='hidden' name='idProdotto' value='$idProdotto'>
                <div class='border-bottom rounded my-4'>
                    <textarea name='commento' id='commento' class='form-control border-0' cols='30' rows='8' placeholder='Your Review' spellcheck='false'></textarea>
                </div>
                <div class='slidecontainer'>
                    <input type='range' min='1' max='10' value='5' class='slider' id='myRange' name='voto'>
                    <p>Voto: <span id='demo'></span></p>
                </div>
                <div class='d-flex justify-content-between py-3 mb-5'>
                    <input type='submit' class='btn-product border border-secondary text-primary rounded-pill px-4 py-3' value='Post Comment'>
                </div>
            </div>

            <script>
                var slider = document.getElementById('myRange');
                var output = document.getElementById('demo');
                output.innerHTML = slider.value;

                slider.oninput = function() {
                output.innerHTML = this.value;
                }
            </script>
        </form>";

        return $string;
    }

    //Render della singola recensione nella pagina productDetails.php
    public function outNav()
    {
        $string = "<div class='d-flex'><div><p class='mb-2' style='font-size: 14px;'>" . $this->Data . '</p>';
        $string .= '<div class="d-flex justify-content-between">';
        $string .= '<p><h5>' . $this->nomeUtente . '</h5></p>';
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

    //Render di tutte le recensioni nella pagina productDetails.php
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
            $string .= $review->outNav();
        }
        $string .= '</div></div></div>';

        return $string;
    }

    //Render delle recensioni random nella index.php
    public static function reviewSlider()
    {
        $string = '<div class="testimonial-slider">';

        $reviews = Review::fromRecordSet(myDB::getInstance()->Select("SELECT * FROM ecommerce_feedback"));

        $randomReviewIndex = array_rand($reviews, 3);
        foreach ($randomReviewIndex as $index) {
            $comment = $reviews[$index]->Commento;
            $user = $reviews[$index]->nomeUtente;
            $product = $reviews[$index]->nomeProdotto;

            $string .= "<div class='item'>
                                            <div class='row justify-content-center'>
                                                <div class='col-lg-8 mx-auto'>
                                                    <div class='testimonial-block text-center'>
                                                        <blockquote class='mb-5'>
                                                            <p>&ldquo;$comment&rdquo;</p>
                                                        </blockquote>
                                                        <div class='author-info'>
                                                            <h3 class='font-weight-bold'>$user</h3>
                                                            <span class='position d-block mb-3'>$product</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>";
        }
        $string .= '</div>';

        return $string;
    }
}


?>