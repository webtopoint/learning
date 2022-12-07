<?php
require_once('header.php');
$soc = $this->db->where(array('admin_id'=>CLIENT_ID,'type'=>'social'))->get('utilities');

if($soc->num_rows())
{   
    $res = $soc->row();
    $status = $res->status;

    $data  = json_decode($res->data);

   // $fb = $data->
}
?>

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-browser icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Social Links
                <div class="page-title-subheading">Modify This section.
                </div>
            </div>
        </div>
        <div class="page-title-actions">
	        <!--button class="btn btn-success manage-images">Manage Images</button-->
                                   
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3" style="padding: 20px; font-size: 20px;">
       <b>Status: </b> 
        <select class="form-control" onchange="updateStatus(this.value)"> 
            <option value="1" <?=@$status=='1'?"selected":""?>>Enable</option>
            <option value="0" <?=@$status=='0'?"selected":""?>>Disable</option>
        </select>
    </div>
    <div class="col-md-12">
        <form action="" method="post">
            <input type="hidden" name="task" value="save">
        <div class="mb-3 card text-primary bg-white">
                <div class="card-header">Social Links </div>
                <div class="card-body">
                        <div class="form-group">
                            <label>Facebook Link</label>
                                <div class="input-group"><div class="input-group-prepend"><img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-facebook-m.png" width=""></div>
                                <input type="text" class="form-control" name="facebook" value="<?=@$data->facebook?>">  
                                </div>                 
                            
                         </div>
                         <div class="form-group">
                            <label>Instagram Link</label>
                            <div class="input-group"><div class="input-group-prepend"><img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-instagram-m.png" width=""></div>
                            <input type="text" class="form-control" name="instagram" value="<?=@$data->instagram?>">
                            </div>                   
                            
                         </div>
                         <div class="form-group">
                           <label>Twitter Link</label>
                           <div class="input-group"><div class="input-group-prepend"><img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-twitter-m.png" width=""></div>
                            <input type="text" class="form-control" name="twitter" value="<?=@$data->twitter?>">    
                            </div>               
                           
                         </div>
                         <div class="form-group">
                           <label>LinkedIn Link</label>
                           <div class="input-group"><div class="input-group-prepend"><img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-linkedin-m.png" width=""></div>
                            <input type="text" class="form-control" name="linkedin" value="<?=@$data->linkedin?>"> 
                            </div>                  
                          
                         </div>
                         <div class="form-group">
                           <label>Youtube Link</label>
                           <div class="input-group"><div class="input-group-prepend"><img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-youtube-m.png" width=""></div>
                            <input type="text" class="form-control" name="youtube" value="<?=@$data->youtube?>"> 
                            </div>                  
                           
                        </div>
                        <div class="form-group">
                           <label>Pinterest Link</label>
                           <div class="input-group"><div class="input-group-prepend"><img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-pinterest-m.png" width=""></div>
                            <input type="text" class="form-control" name="pinterest" value="<?=@$data->pinterest?>"> 
                            </div>                  
                        
                        </div>
                        
                        <div class="form-group">
                           <label>Telegram Link</label>
                           <div class="input-group"><div class="input-group-prepend">
                               <svg xmlns="http://www.w3.org/2000/svg" width="36" height="46" fill="currentColor" class="bi bi-telegram" viewBox="0 0 33 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.287 5.906c-.778.324-2.334.994-4.666 2.01-.378.15-.577.298-.595.442-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294.26.006.549-.1.868-.32 2.179-1.471 3.304-2.214 3.374-2.23.05-.012.12-.026.166.016.047.041.042.12.037.141-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8.154 8.154 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629.093.06.183.125.27.187.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.426 1.426 0 0 0-.013-.315.337.337 0 0 0-.114-.217.526.526 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09z"/>
</svg></div>
                            <input type="text" class="form-control" name="telegram" value="<?=@$data->telegram?>"> 
                            </div>                  
                        
                        </div>

                        <hr>

                        <div class="form-group">
                            <label>Position</label>
                            <select class="form-control" name="position">
                                <option value="left" <?=@$data->position=='left'?"selected":""?>>Left</option>
                                <option value="right" <?=@$data->position=='right'?"selected":""?>>Right</option>
                            </select>
                        </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success">Save</button>
                </div>
            </div>
        </div>
    </form>
    </div>


<?php
require_once('footer.php');
?>
<script type="text/javascript">
    function updateStatus(v)
    {   $("#load").show();
        $.ajax({
            url:'<?=site_url('Admin/Utilities/social')?>',
            type:'post',
            data:{task:'updateStatus',status:v},
            success:function(q)
            {  //alert(q);
                $("#load").hide();
            },
            error:function(u,v,w)
            {
                alert(w);
            }
        });
    }
</script>