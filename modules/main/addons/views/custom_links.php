<form action="" method="POST" enctype="">
    <input type="hidden" name="status" value="setting"> 
    <div class="card">
        <div class="card-header">
           <?php
           if($header_input){
           ?>
            <input type="text" name="<?=$name?>_text" class="myINput" placeholder="Enter Some Text.." value="<?=$this->SiteModel->extra_setting($name.'_text',true,$value)?>">
            <?
           }
           else{
              echo $value; 
           }
           ?>
       
        </div>
        <div class="card-body">
        
            <div class="link-box">
                <?
                $links = $this->SiteModel->extra_setting($name,true);
                
                $Links_array = [];
                if(!empty($links)){
                    $jsonLinks = json_decode($links,true);
                    $l = $jsonLinks['link'];
                    foreach($jsonLinks['title'] as $i => $title){
                        $url = $l[$i];
                        echo '<div class="form-group">
                                <input type="text" name="'.$name.'[title][]" required class="form-control" value="'.$title.'" placeholder="Enter Title">
                                <input type="text" name="'.$name.'[link][]" class="form-control" value="'.$url.'" placeholder="Enter link">
                                <button class="btn btn-xs btn-sm btn-danger remove-link" type="button" ><i class="fa fa-trash"></i></button>
                            </div>';
                    }
                }
                else{
                ?>
                
                <div class="form-group">
                    <input type="text" name="<?=$name?>[title][]" required class="form-control" value="" placeholder="Enter Title">
                    <input type="text" name="<?=$name?>[link][]" class="form-control" value="" placeholder="Enter link">
                    <button class="btn btn-xs btn-sm btn-danger remove-link" type="button" ><i class="fa fa-trash"></i></button>
                </div>
                <?
                }
                ?>
            </div>
            
            <button class="btn btn-primary btn-xs btn-sm add-newLInk" data-type="<?=$name?>" type="button"><i class="fa fa-plus"></i> Add New Link</button>
        </div>
    <div class="card-footer">
        <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
    </div>
</div>
</form>