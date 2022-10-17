<?php 
require_once "basic_doc.php";

class ProductDoc extends BasicDoc {
    protected function addActionForm($action, $buttonLabel, $nextPage, $productId = null) {
        if(isUserLoggedIn()) {
            echo '<form method="post" action="index.php">
            <input type="hidden" name="page" value="'.$nextPage.'">
            <input type="hidden" name="action" value="'.$action.'">
            <input type="hidden" name="productId" value="'.$productId.'">
            <input type="hidden" name="submit" class="btn-btn" value="'.$buttonLabel.'">
            </form>';
        }
    }
}

?>