<?php
require_once 'header.php';

$allPage= $this->SiteModel->list_page();
$forms = $this->ServiceModel->getFileService();
?>


<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-browser icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Use File Service
                <div class="page-title-subheading">Modify file service using this section.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="main-card mb-3 card">
        <div class="card-body"><h5 class="card-title">Use File Service on Pages</h5>

            <ul class="list-group">
                <?php
                foreach($forms->result() as $f)
                {
                    echo'<li class="list-group-item">
                        <h5 class="list-group-item-heading"><strong>'.$f->service_name.'</strong> </h5>
                        <p class="list-group-item-text">';
                        foreach ($allPage->result() as $page)
                        {
                            $chk = $this->ServiceModel->checkFileServiceUse(array('service_id'=>$f->id,'page_id'=>$page->id))?" checked":"";
                           echo'<div class="custom-checkbox custom-control"><input type="checkbox" id="'.$f->id.'_'.$page->id.'" class="custom-control-input" onclick="usefileService('.$f->id.','.$page->id.')" '.$chk.'>
                            <label class="custom-control-label" for="'.$f->id.'_'.$page->id.'">'.$page->page_name.'</label>
                            </div>';
                        }
                            

                        echo'</p>
                      </li>';
                }
                ?>

            </ul>
        </div>
    </div>
</div>


<script type="text/javascript">
    function usefileService(serviceid,pageid)
    {  
        var DATA = 'serviceid='+serviceid+'&pageid='+pageid+'&status=usefileservice';
        $("#load").show();
        $.ajax({
            url:'<?site_url('Admin/use_file_service')?>',
            type:'POST',
            data:DATA,
            success:function(q)
            {
                toastr.success("Saved successfully");
                $("#load").hide();
            }
        });
    }
</script>


<?php
require_once 'footer.php';
?>
