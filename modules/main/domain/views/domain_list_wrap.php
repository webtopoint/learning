<div class="domain-list-wrap text-center">
    <ul class="list-inline domain-search-list">
        
        <?php
        $lists = ['com' => 'domcno', 'in' => 'dotin','co_in'=>'thirdleveldotin' ,'in_net' => 'indotnet'];
        foreach($lists as $item => $val){
            $price = Modules :: run('domain/proper_domain_price',$val);
            if(isset($price['addnewdomain'])){
                $price = $price['addnewdomain'][1];
            echo '<li class="list-inline-item bg-white border rounded">
                        <a href="#"><img src="https://bizknowindia.org.in/themes/main/kohost/assets/img/'.$item.'.png" alt="'.str_replace('_','.',$item).'" width="70" class="img-fluid"> <span>'.$price.'</span></a>
                  </li>';
            }
        }
        ?>
        
    </ul>
</div>