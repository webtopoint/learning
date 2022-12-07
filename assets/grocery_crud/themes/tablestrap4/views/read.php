<div class="card card-default">
	<div class="card-header">
    	<h3 class="card-title"><?php echo $this->l('list_record'); ?> <?php echo $subject?></h3>
  	</div>
    <div class="card-body">
	<!-- Start of hidden inputs -->
		<?php
			foreach($hidden_fields as $hidden_field){
				echo $hidden_field->input;
			}
		?>
    	<!-- End of hidden inputs -->
    	<?php if ($is_ajax) { ?><input type="hidden" name="is_ajax" value="true" /><?php }?>
    	<div class='line-1px'></div>
    	<div id='report-error' class='report-div error'></div>
    	<div id='report-success' class='report-div success'></div>
    
    	<div class="table-responsive">
    		<table class="table table-striped">
    			<?php foreach ($fields as $field){ ?>
    				<tr class='form-field-box' id="<?php echo $field->field_name; ?>_field_box">
    					<th class='form-display-as-box' style="width:25% !important;" id="<?php echo $field->field_name; ?>_display_as_box">
    						<?php echo $input_fields[$field->field_name]->display_as . 
    						($input_fields[$field->field_name]->required ? "*" : ""); ?>
    					</th>
    					<td class='form-input-box' id="<?php echo $field->field_name; ?>_input_box">
    						<?php echo $input_fields[$field->field_name]->input?>
    					</td>
    				</tr>
    			<?php } ?>
    		</table>
    	</div>
    </div>
	<div class="card-footer">
    	<a href="<?php echo $list_url?>" class="btn btn-danger">
			<?php echo $this->l('form_back_to_list'); ?>
		</a>
  	</div>
</div>