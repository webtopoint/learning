<?php
if($row->num_rows()):
    $website = $row->result_array()[0];
    
    $file = base_url.'/public/web/assets/images/avatars/9.jpg';
    if($yes = $this->WebsiteModel->getWebsiteData($website['id'])){
        if(file_exists('public/temp/'.$website['id'].'/'.$yes->logo) AND !empty($yes->logo)){
            $file = base_url.'/public/temp/'.$website['id'].'/'.$yes->logo;
        }
    }
    else if(!empty($website['photo'])){
        $file       = base_url.'/public/temp/'.$website['id'].'/'.$website['photo'];
    }
?>

  <div class="card card-minimal-four " style="border:1px solid gray;border-radius:63px 0 0 0;border-top: 5px solid #f31891;">
    <div class="card-header">
      <div class="media pt-4" style="width:100%">
        
        <div class="image-grouped">
                <?php
                echo '<img class="img-xs rounded-circle" style="width: 102px;height: 102px;border: 4px solid #250735;" src="'.$file.'" alt="Logo">';
            
            ?>
        </div>
        
        <div class="media-body">
          <h6><?=$website['name']?></h6>
          <p><?=$website['domain_name']?></p>
        </div><!-- media-body -->
      </div><!-- media -->
    </div><!-- card-header -->
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tr>
                <th>Username</th><td><?=$website['_email']?></td>
            </tr>
            <tr>
                <th>Password</th><td><?=$website['_pass']?></td>
            </tr>
            <tr>
                <th>Create</th><td><?=date('d M Y h:i A',$website['start_time'])?></td>
            </tr>
            <tr>
                <th>Expired</th><td><?
                
                        $date = $website['expire_time'];
                if(empty($website['expire_time']))
                    $date = strtotime( date( 'Y-m-d H:i:s', $website['start_time'] )  . ('+1 year'));
                echo date('d M Y h:i A',$date);
                ?></td>
            </tr>
        </table>
    </div><!-- card-body -->
    <div class="card-footer" style="padding:10px">
      <div class="btn-group">
          <!--<a href="<?=site_url('Admin/expire-websites').'/renew/'.$website['id'].'/'.$website['domain_name']?>"  class="btn btn-success btn-xs btn-sm " ><i class="fa fa-refresh"></i> Renew & Pyament</a>-->
          <!--<a href="<?=site_url('Admin/websites').'/invoices/'.$website['id'].'/'.$website['domain_name']?>"  class="btn btn-primary btn-xs btn-sm " ><i class="fa fa-file-o"></i> Invoice</a>-->
        </div>
    </div><!-- card-footer -->
  </div><!-- card -->
<?php
endif;
?>