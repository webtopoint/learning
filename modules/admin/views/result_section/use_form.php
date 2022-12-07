<?php
$allPage= $this->SiteModel->list_page();
?>


<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-browser icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Use Form
                <div class="page-title-subheading">Modify Form using this section.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="main-card mb-3 card">
        <div class="card-body"><h5 class="card-title">Use Search Result Form on Pages</h5>

            <ul class="list-group">
                <?php
                foreach($result_form as $f)
                {
                    $form_title = $f['forms_css']=='' ? '' : json_decode($f['forms_css'])->form_title;
                    $form_title = $form_title=='' ? '<strong style="color:red">UNKNOWN TITLE</label>' : '<strong style="color:green">'.$form_title.'</label>';
                    echo'<li class="list-group-item">
                        <h5 class="list-group-item-heading"><strong>'.$form_title.'</strong> <small>{ 
                            ';
                            if(is_object( $fields =json_decode($f['fields'])) ){
                                foreach(  $fields as $v => $field){
                                        $name = $field->label==''?'<i>EMPTY</i>':$field->label;
                                        echo '<label style="margin-right:6px" class="badge badge-'.print_random_class().'">'.$name.'</label>';
                                }     
                            }
                            echo '
                            
                        } </small></h5>
                        
                        <p class="list-group-item-text">';
                        foreach ($allPage->result() as $page)
                        {
                            $chk = $this->db->get_where('web_schema',array('type'=>'rform','key_id'=>$f['id'],'page_id'=>$page->id,'admin_id'=>CLIENT_ID))->num_rows()?" checked":"";
                           echo'<div class="custom-checkbox custom-control"><input type="checkbox" id="'.$f['id'].'_'.$page->id.'" class="custom-control-input" onclick="useForm('.$f['id'].','.$page->id.')" '.$chk.'>
                            <label class="custom-control-label" for="'.$f['id'].'_'.$page->id.'">'.$page->page_name.'</label>
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
    function useForm(formid,pageid)
    {  
        var DATA = 'formid='+formid+'&pageid='+pageid+'&status=user_result_form';
        
        $("#load").show();
        $.ajax({
            url:'<?=site_url('Admin/result-section-ajax')?>',
            type:'POST',
            data:DATA,
            dataType:'json',
            success:function(q)
            {
                console.log(q);
                toastr.success("Saved successfully");
                $("#load").hide();
            },
            error:function(a,v,c){
                console.log(a.responseText);
            }
        });
    }
</script>


