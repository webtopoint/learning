<?php
$properties = '';
        foreach(json_decode($mar1->properties,true) as $k => $a){
            if($k == 'hoverstop')
                $properties .= ($a=='yes') ? 'onMouseOver="this.stop()" onMouseOut="this.start()" ' :'';
            else
                $properties .= $k.'="'.$a.'" ';
        }
        
        $btn_data = json_decode($mar1->btn_data, true);
        $btn_css = $btn_html = '';
        if($btn_data){
             $btn_css = 'float:'.$btn_data['btn_position'].';';
             
            $btn_html = '
                <div class="btn_css" style="position: relative;margin-top: -63px;'.$btn_css.'">
                    '.$btn_data['btn_title'].'
                </div> 
            ';
        }
        echo '
        <div class="container-fluid" >
           
            <div style=" width:100%;">
             <marquee '. $properties .' style="  margin-top: 20px;">'.$mar1->data.' </marquee>
            </div>
              '.str_replace('</p>','',str_replace('<p>','',$btn_html)).'
            
        </div>';