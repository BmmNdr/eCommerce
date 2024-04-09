<?php
class Review
{

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
}


?>