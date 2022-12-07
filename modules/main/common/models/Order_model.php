<?php
class Order_model extends CI_Model{
    
   function create($data){
       if(is_array($data)){
           
           $this->db->insert('orders',$data);
           $order_id = $data['order_id'];
           
           foreach($this->cart->contents() as $rowId => $item){
               $this->db->insert('order_items',[
                        'item_name' => $item['name'],
                        'type' => $item['type'],
                        'duration' => $item['duration'],
                        'duration_type' => $item['duration_type'],
                        'price' => $item['price'],
                        'order_id' => $order_id
                   ]);
                 $this->cart->remove($rowId);
           }
           
       }
   }
    
}

?>