<?php

namespace Resellerclub;

require_once __DIR__ . '/../core/Core.php';

class Resellers extends Core {
    function promo_details(){
        return $this->callApi(METHOD_GET, 'resellers', 'promo-details',[]);
    }
}
?>