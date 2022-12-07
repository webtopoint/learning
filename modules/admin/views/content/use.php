<?php

$allPage= $this->SiteModel->list_page();
$contents = $this->db->get_where('content',['admin_id'=>CLIENT_ID]);
?>


<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-browser icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Use Content in Poge (s)
                <div class="page-title-subheading">Modify Form using this section.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="main-card mb-3 card">
        <div class="card-body"><h5 class="card-title">Use Content on Pages</h5>

            <ul class="list-group">
                <?php
                foreach($contents->result() as $f)
                {
                    echo'<li class="list-group-item">
                        <h5 class="list-group-item-heading"><strong>'.$f->content_title.'</strong> </h5>
                        <p class="list-group-item-text">';
                        foreach ($allPage->result() as $page)
                        {
                            $chk = $this->db->get_where('web_schema',['type'=>'content_category','key_id'=>$f->id,'page_id'=>$page->id,'admin_id'=>CLIENT_ID])->num_rows() ? 'checked' : '';//$this->FormModel->checkFormUse(array('form_id'=>$f->id,'page_id'=>$page->id))?" checked":"";
                           echo'<div class="custom-checkbox custom-control"><input type="checkbox" id="'.$f->id.'_'.$page->id.'" class="custom-control-input" onclick="useContent('.$f->id.','.$page->id.')" '.$chk.'>
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
    function useContent(contentId,pageid)
    {  
        var DATA = 'contentId='+contentId+'&pageid='+pageid+'&status=usecontent';
        $("#load").show();
        $.ajax({
            url:'<?=site_url('Admin/use_content')?>',
            type:'POST',
            data:DATA,
            dataType:'json',
            success:function(q)
            {
                console.log(q);
                toastr.success("Saved successfully");
                $("#load").hide();
            },
            error : function(a,v,c){
                console.log(a.responseText);
            }
        });
    }
</script>

