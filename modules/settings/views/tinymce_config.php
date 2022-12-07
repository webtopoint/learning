<?php

$get = $this->WidgetModel->getAllWidget(0,[],true);
if($get->num_rows()){
    $html = '';
    foreach($get->result() as $row){
        
        $getOne = $this->WidgetModel->getAllWidget(0,['widget_type' => $row->widget_type]);
        // echo $getOne->num_rows();
        if($getOne->num_rows() > 1){
            
        }
        else{
            
        
            $html .= "{
                          type: 'menuitem',
                          text: '$row->widget_title',
                          icon: 'cog',
                          onAction: function () {
                            editor.insertContent('<thewidget class=\"is-locked\" id=\"$row->id\">$row->widget_title</thewidget>');
                          }
                        },";
        }
        
    }
    echo $html."{
                          type: 'menuitem',
                          text: 'Visitor Counter',
                          icon: 'cog',
                          onAction: function () {
                            editor.insertContent('<thewidget class=\"is-locked\" id=\"visitor_counter\">Visitor Counter</thewidget>');
                          }
                        }";
}


?>