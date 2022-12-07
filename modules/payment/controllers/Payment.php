<?php
class Payment extends Tool_Controller{
    function __construct(){
        parent :: __construct();
    }
    
    //rsemAwhviRm8luVaPlmLUWMABaPcoAp5
// JCAsFi
    
    
    function genrate_payuform($data = []){
        $this->pum->init('vi5xgOsKL4','4Ff9Td5F');
        $this->pum->add_field($data);
        return $this->pum->submit_pum_ajax();
    }
    
}

?>