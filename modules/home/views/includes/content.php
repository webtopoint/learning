<?
$ci = get_instance();
    echo '<div class="row">';
    $data =  json_decode( $ci->db->get_where('content',['id'=>$key])->row()->data , true );
  
    foreach($data['index'] as $first){
        
        echo '<div class="'.$data['class'][$first].'">';
            if(isset($data['type'][$first])):
            foreach($data['type'][$first] as $k => $rec){
                $newData = $data['content'][$first][$k];
                switch($rec){
                    
                    case 'content':
                        echo $newData;
                    break;
                    
                    case 'form':
                        if(function_exists('getForm'))
    						getForm($newData);
                    break;
                    case 'tform':
    					if(function_exists('getTransactionForm'))
    						  getTransactionForm($newData);
					break;
					
					case 'newsSlider':  case 'titleNewsList': case 'thumbnailNewsList':
					    //echo $rec;
					    if(function_exists('get_'.$rec)){
					        
					        $fun = 'get_'.$rec;
					        echo $fun($newData);
					    }
					break;
                    
                }
                
            }
            endif;
            
        echo '</div>';
        
    }
    
    echo '</div>';

?>