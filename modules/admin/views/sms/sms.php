    
    
    <div class="col-md-3 form-group">
        <label>Select Fields <i class="text-danger"> { Like. MOBILE } </i> </label>
        <div>
                <?
    		      
    		    $data = C::get_label_AND_input_AND_type_field($html);
    		    
    		    $FinalLabels = $data['finalLabel'];
    		    $labels = C::get_label_AND_input_AND_type_field($html,'file',true)['label'];
    		    
    		        foreach ($FinalLabels as $key => $value)
		            {
		                echo '<span class="d-block menu-option"><label><input name="key[]" type="checkbox" value="field_'.$key.'">&nbsp;
                                        '.$value.'</label></span>'; //$value.',';
		            }
    		        
            	?>
        </div>
    </div>
    
    
    <div class="col-md-12 form-group">
        <label>Enter Message</label>
        <textarea class="form-control" cols="20" class="content" name="content"></textarea>
    </div>
    
    
    
    
   