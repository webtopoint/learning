    <?
    $webdata=$this->SiteModel->getWebsiteData();
    $title=$systemEmail="";
    
    if($webdata->num_rows())
    {
        $wdata = $webdata->row();
            
        if($wdata->email)
            $systemEmail= json_decode($wdata->email)[0];
        
        $title = $wdata->title;
    }

    ?>
    
    <div class="col-md-3 form-group">
        <label>Select Fields <i class="text-danger"> { Like. EMAIL } </i> </label>
        <div>
                <?
    		      
    		    $data = C::get_label_AND_input_AND_type_field($html,'email');
    		    
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
    <div class="form-group col-md-4">
        <label>Enter System Name</label>
        <input type="text" class="form-control" placeholder="Enter System Name." name="system_name" value="<?=$title?>" required>
    </div>
    
    <div class="form-group col-md-4">
        <label>Enter Email</label>
        <input type="text" class="form-control" placeholder="Enter System Name." name="from_email" value="<?=$systemEmail?>" required>
    </div>
    
    <div class="form-group col-md-4">
        <label>Enter Subject</label>
        <input type="text" class="form-control" placeholder="Enter System Name." name="subject" value="<?=$form->title?>" required>
    </div>
    
    
    
    
   