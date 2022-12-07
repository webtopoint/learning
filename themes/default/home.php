<div class="container-fluid" style="overflow-x:hidden">
    <?php
        
        /*
        
        $schema = $this->SiteModel->getPageSchema(array('page_id'=>$page_id,'admin_id'=>CLIENT_ID));
        $result;
        if($schema->num_rows())
        {
        	$result = $schema->result();
        
        	if($result[0]->type=='slider')
        	{
        			echo'<div class="" style="margin-top:0px; padding-top:0px;">';
        		 getCarousel($result[0]->key_id);
        			echo '</div>';
        		unset($result[0]);
        	}
        }
        else
        {
        	$result=array();
        }
        */
        
    ?>
    <div class="container-fluid" style="overflow-x:hidden">
        <!--<img src="<?=base_url('assets/file/product_1.jpg')?>">-->
        	<div class="row" style="margin:0">
        	    <?php
        	    if(isset($pageData->heading_image) && $pageData->heading_image!='')
        	    {
        	    ?>
        	    <div class="col-md-12" style="background:url('<?=client_file($pageData->heading_image)?>') no-repeat;background-size:100% 100%;width:100%;height:<?=$pageData->heading_height?>px">
        	    	
        	    </div>
        		<?php
        	    }
        	    
        	    
        				if($leftSide->num_rows())
        				{	echo'<div class="col-sm-'.$lw.'" style="padding: 5px;">';
        					foreach ($leftSide->result() as $le)
        					{
        							echo getWidget($le->widget_id);
        					}
        					echo'</div>';
        				}
        				
        			?>
        
        <div class="col-sm-<?=$cw?> main-cn-main" >
             {_content_}
        </div>
        
        		
        			<?php
        				if($rightSide->num_rows()){
        				    
        					echo'<div class="col-sm-'.$rw.'" style="padding: 5px;">';
        					foreach ($rightSide->result() as $re)
        						echo getWidget($re->widget_id);
        					echo'</div>';
        					
        				}
        			?>
        		</div>
        	</div>
        	
        	
        	
        </div>
</div>