<?php
require_once 'header.php';
if($wData->num_rows())
{   $widget=$wData->row();
    $meta = json_decode($widget->widget_metadata);
?>

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-browser icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Modify <?=$widget->widget_title?> &nbsp;<small><div class="mb-2 mr-2 badge badge-primary"><?php echo strtoupper($widget->widget_type)?></div></small>
                <div class="page-title-subheading">Modify Widget using this section.
                </div>
            </div>
        </div>
    </div>
</div>


<div class="mb-3 card">
    <div class="card-header-tab card-header">
        <!-- <div class="card-header-title">
            <i class="header-icon lnr-bicycle icon-gradient bg-love-kiss"> </i>
            Modify Widget
        </div> -->
        <ul class="nav">
           
            <li class="nav-item"><a data-toggle="tab" href="#tab-eg5-0" class="nav-link active show">Modify Widget</a></li>
            <?php 
            if($widget->widget_type=='informative')
            {
            echo'<li class="nav-item"><a data-toggle="tab" href="#tab-eg5-1" class="nav-link show">Add Data</a></li>
            <li class="nav-item"><a data-toggle="tab" href="#tab-eg5-2" class="nav-link  show">View Data</a></li>';
            }
            ?>
           
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
           
            <div class="tab-pane active show" id="tab-eg5-0" role="tabpanel">
              <form class="modify-widget-form">
                <div class="form-row">
                  <div class="col-md-12 mb-3">
                      <label>Widget Title</label>
                      <input type="text" class="form-control" name="widget_title" value="<?=$widget->widget_title?>">
                  </div>
                  <div class="col-md-12 mb-3">
                      <label>Widget Color</label>
                      <input type="color" class="form-control" name="backColor" value="<?=$meta->backColor?>">
                  </div>
                  <div class="col-md-12 mb-3">
                      <label>Widget Text Color</label>
                      <input type="color" class="form-control" name="textColor" value="<?=$meta->textColor?>" placeholder="">
                      
                  </div>
                   <div class="col-md-12 mb-3">
                                <label>Widget Border</label>
                                <div class="row">
                                <div class="col-sm-6">
                                <label>Size</label>
                                   <input type="number" class="form-control" name="Bsize" value="<?=$meta->Bsize?>" placeholder="in px">
                                </div>
                                <div class="col-sm-6">
                                  <label>Style</label>
                                  <select class="form-control" name="Bstyle">

                                  <option value="none" <?=$meta->Bstyle=='none'?'selected':''; ?>>None</option>

                                  <option value="solid" <?=$meta->Bstyle=='solid'?'selected':''; ?>>Solid</option>

                                  <option value="double" <?=$meta->Bstyle=='double'?'selected':''; ?>>Double</option>

                                  <option value="dashed" <?= $meta->Bstyle=='dashed'?'selected':''; ?>>Dashed</option>

                                  <option value="dotted" <?= $meta->Bstyle=='dotted'?'selected':''; ?>>Dotted</option>

                                  <option value="groove" <?= $meta->Bstyle=='groove'?'selected':''; ?>>Groove</option>

                                  <option value="ridge" <?= $meta->Bstyle=='ridge'?'selected':''; ?>>Ridge</option>

                                  <option value="inset" <?= $meta->Bstyle=='inset'?'selected':''; ?>>Inset</option>
                                  
                                  <option value="outset" <?= $meta->Bstyle=='outset'?'selected':''; ?>  >Outset</option>
                                  
                              </select>
                                    
                                </div>
                                </div>
                  </div>

                  <div class="col-md-12 mb-3 row">

                    <div class="col-md-4 form-group">
                        <label>Font Size</label>
                        <div class="input-group">
                          <input type="number" class="form-control" name="Fsize" placeholder="Font Size" value="<?=$meta->Fsize?>" required="">
                          <div class="input-group-append">
                            <span class="input-group-text">px</span>
                          </div>
                        </div>
                    </div>
                      <?
                      $Fstyle = isset($meta->Fstyle)?$meta->Fstyle:'';
                      $Ffamily = isset($meta->Ffamily)?$meta->Ffamily:'';
                      ?>
                    <div class="col-md-4 form-group">
                        <label>Font Style</label>
                        <select id="font-style-select" class="form-control" data-cur="<?=$Fstyle?>" name="Fstyle"></select>
                    </div>
                    
                    <div class="col-md-4 form-group">
                        <label>Font Family</label>
                       <select id="font-family-select" class="form-control" data-cur="<?=$Ffamily?>" name="Ffamily"></select>
                    </div>
                    
                  </div>

                   <div class="col-md-12 mb-3">
                            <label>Widget Opacity (0% to 100%)</label>
                              <input type="number" class="form-control" name="opacity" value="<?=$meta->opacity?>">
                  </div>



                  <?php 
                  switch ($widget->widget_type)
                  {
                      case 'informative':
                          echo'<div class="col-md-12 mb-3">
                                     <label>Data Scroll</label>
                                     <div class="">
                                        <label>
                                              <input type="radio" name="scroll" checked value="0" '.($meta->scroll?"":"checked").'> No
                                        </label>
                                         <label>
                                              <input type="radio" name="scroll" value="1" '.($meta->scroll?"checked":"").'> Yes
                                        </label>
                                     </div>
                                  </div>
                              <div class="col-md-12 mb-3">
                                      <label>Widget Height</label>
                                      <input type="number" class="form-control" name="height" value="'.$meta->height.'" placeholder="Enter Height..">
                                       <p>This height in px.</p>
                              </div>
                          ';
                      break;
                      case 'g_map':

                      echo'   <div class="col-md-12 mb-3">
                                <xmp style="display:none;">'.$meta->mapCode.'</xmp></label>
                                     <label>Enter New MapCode</label>
                                              <input type="text" class="form-control" name="mapCode" value="">                              
                                        </label>
                                  </div>
                                  
                                 
                               <div class="col-md-12 mb-3">
                                 <label>Height</label>
                                          <input type="number" class="form-control" name="mapHeight" value='.$meta->mapHeight.'>                              
                                  </label>
                              </div>
                                 ';

                        break;
                        case 'fb_page':
                          echo'<div class="col-md-12 mb-3">
                                <xmp style="display:none;">'.$meta->fbPageLink.'</xmp></label>
                                     <label>Enter New Facebook Page Link</label>
                                              <input type="text" class="form-control" name="fbPageLink" value="'.$meta->fbPageLink.'">                              
                                        </label>
                                  </div>
                                  
                                 
                               <div class="col-md-12 mb-3">
                                 <label>Height</label>
                                          <input type="number" class="form-control" name="height" value='.$meta->height.'>                              
                                  </label>
                              </div>';
                        break;
                        case 'social_links':
                      echo'<div class="col-md-12 mb-3">
                          <label>Facebook Link</label>
                            <div class="input-group"><div class="input-group-prepend"><img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-facebook-m.png" width=""></div>
                                  <input type="text" class="form-control" name="facebook" value="'.$meta->facebook.'">  
                               </div>                 
                          </div>
                          <div class="col-md-12 mb-3">
                                <label>Instagram Link</label>
                                <div class="input-group"><div class="input-group-prepend"><img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-instagram-m.png" width=""></div>
                                <input type="text" class="form-control" name="instagram" value="'.$meta->instagram.'">
                                </div>                   
                          </div>
                          <div class="col-md-12 mb-3">
                               <label>Twitter Link</label>
                               <div class="input-group"><div class="input-group-prepend"><img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-twitter-m.png" width=""></div>
                                <input type="text" class="form-control" name="twitter" value="'.$meta->twitter.'">    
                                </div>               
                          </div>
                          <div class="col-md-12 mb-3">
                               <label>LinkedIn Link</label>
                               <div class="input-group"><div class="input-group-prepend"><img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-linkedin-m.png" width=""></div>
                                <input type="text" class="form-control" name="linkedin" value="'.$meta->linkedin.'"> 
                                </div>                  
                          </div>
                          <div class="col-md-12 mb-3">
                               <label>Youtube Link</label>
                               <div class="input-group"><div class="input-group-prepend"><img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-youtube-m.png" width=""></div>
                                <input type="text" class="form-control" name="youtube" value="'.$meta->youtube.'"> 
                                </div>                  
                          </div>
                          <div class="col-md-12 mb-3">
                               <label>Pinterest Link</label>
                               <div class="input-group"><div class="input-group-prepend"><img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-pinterest-m.png" width=""></div>
                                <input type="text" class="form-control" name="pinterest" value="'.$meta->pinterest.'"> 
                                </div>                  
                          
                            </div>';

                      break;

                      case 'text_box':


                        //echo $this->w999->view('admin/widget/text_box',['meta'=> $meta ],true);
                        echo'<div class="col-md-12 mb-3"> 
                        <textarea id="aryaeditor" name="info">'.$meta->info.'</textarea>
                       </div>
                        <div class="col-md-12 mb-3">
                              <label>Widget Height</label>
                              <input type="number" class="form-control" name="height" value="'.$meta->height.'" placeholder="Enter Height..">
                               <p>This height in px.</p>
                              </div>';

                      break;

                      case 'menu_widget':

                      echo'<div class="col-md-12 mb-3">
                          <label>Add Pages to Menu</label>';
                      
                      $pages = $this->SiteModel->list_page();
                      if($pages->num_rows())
                      { 
                        foreach ($pages->result() as $p)
                        {
                          $chk = in_array($p->id, $meta->pageList)?"checked":"";

                          echo'<p><input type="checkbox" name="pageList[]" value="'.$p->id.'" '.$chk.'> &nbsp; '.$p->page_name.'</p>';
                        }
                      
                      }
                      echo' 
                        </div>
                        <div class="col-md-12 mb-3">
                                      <label>Widget Height</label>
                                      <input type="number" class="form-control" name="height" value="'.$meta->height.'" placeholder="Enter Height..">
                                       <p>This height in px.</p>
                              </div>';

                      break;
                  }
                 ?>
        
                </div>
                <button class="btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> Save</button>
            </form>
            </div>
            <div class="tab-pane show" id="tab-eg5-1" role="tabpanel">
            
                <form action="<?php site_url('admin/modify_widget')?>" class="addWidgetData" method="post">
                      <input type="hidden" name="status" value="add_widget_data" >
                       <div class="col-md-12 mb-3">
                        <label>Enter Title</label>

                        <input type="text" name="data_title" class="form-control" placeholder="Enter Title">

                      </div>  

                      <div class="col-md-12 mb-3">
                        <label>Enter Content</label>

                        <textarea cols="80" id="aryaeditor" name="widget_data" rows="10"></textarea>

                      </div> 
                       <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Add</button>
                  </form>

            </div>
           <div class="tab-pane show" id="tab-eg5-2" role="tabpanel">
                
              <?php
              if($widget_data->num_rows())
              { 
                 echo'<ul class="list-group">';
                  foreach ($widget_data->result() as $w)
                  {
                      $time = date('d-m-Y h:i A',strtotime($w->timestamp));
                    $title = strlen($w->data_title)>100?(substr($w->data_title,0,97)."..."):$w->data_title;
                    echo' <li class="justify-content-between list-group-item">'.$title.'
                    <div class="pull-right">
                      <a href="'.site_url("Admin/edit-post/").AJ_ENCODE($w->id).'" target="_blank"><button class="mb-2 mr-2 btn-transition btn btn-outline-info"><i class="pe-7s-pen"></i></button></a>
                      <button class="mb-2 mr-2 btn-transition btn btn-outline-danger" onclick="postDelete('.$w->id.',this)"><i class="fa fa-trash"></i></button>
                    <span class="badge badge-secondary badge-pill">'.$time.'</span>
                    </div>
                    </li>';
                  }
                echo'</ul>';
              }
              else
              {
                echo'<div class="alert alert-info">No Data to Show</div>';
              }
            ?>   

            </div>
        </div>
    </div>
</div>

              <script>
                   function CKupdate(){
                      for ( instance in CKEDITOR.instances )
                          CKEDITOR.instances[instance].updateElement();
                  }

                        $(".modify-widget-form").submit(function(event){
                           // alert("CHK");

                           CKupdate();
                            event.preventDefault();
                           $("#load").show();
                            $.ajax({
                                type:"POST",
                                url:base_url+"/Admin/modify_widget/<?php echo AJ_ENCODE($widget->id)?>",
                                data:$(this).serialize()+"&status=modify_widget_form",
                                success:function(res){
                                   $("#load").hide();
                                   //if(res=='1')
                                   toastr.success("Changes Saved Successfully");
                                    //else
                                      //  toastr.error("Unable to Save");
                                }
                                
                            });
                        });
                      </script>

<script>
  $("xmp").on("click",function(){
      $("input[name=mapCode]").val(this.innerHTML);
  });

  $("xmp").click();


function postDelete(pid,ele)
{
    if(confirm("Are you sure?"))
    {
      $.ajax({
        url:'<?=site_url("Admin/deletePost")?>',
        type:'POST',
        data:{'post_id':pid},
        success:function(q)
        {
          if(q=='1')
          {
            $(ele).parent().parent().hide(400);
            toastr.success("Post Deleted");
          }
          else
            toastr.error("Error");
        }
      });
    }
}  
</script>
<script type="text/javascript" src="<?=site_url('public/custom/ckeditor.js')?>"> </script>
<script type="text/javascript" src="<?=base_url.'/public/custom/add-widget.js'?>"></script>
<?php
}
require_once 'footer.php';
?>