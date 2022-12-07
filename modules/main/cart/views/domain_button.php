<?php
$class = !empty($todo) ? $todo : 'checkout'; 
?>
<button class="btn primary-solid-btn btn-add-to-cart  btn-sm <?=$class?>" data-whois="0" data-domain="<?=$domain?>">
    
    <span class="loading" style="display: none;">
        <i class="fas fa-spinner fa-spin"></i> Loading...
    </span>

    <span class="added" style="display: <?= condition_with_return($class,'checkout')?>"><i class="fas fa-shopping-bag"></i> Checkout</span>

    <span class="to-add" style="display: <?= condition_with_return($class,'to-add')?>;"><i class="fa fa-shopping-cart"></i> Add to Cart</span>

    <span class="unavailable" style="display: <?= condition_with_return($class,'taken')?>;">Taken</span>


</button>