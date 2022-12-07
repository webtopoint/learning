<?php
class Cart_model extends CI_Model{
    
    function is_added_to_cart($id, $set = '', $op = ''){
        $carted = $this->cart->contents();
        //var_dump($carted);
        if (count($carted) > 0) {
            foreach ($carted as $items) {
                if ($items['id'] == $id) {
                    
                    if ($set == '') {
                        return true;
                    } else {
                        if($set == 'option'){
                            $option = json_decode($items[$set],true);
                            return $option[$op]['value'];
                        } else {
                            return $items[$set];
                        }
                    }
                }
            }
        } else {
            return false;
        }
    }
    
    
}

?>