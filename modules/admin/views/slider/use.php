<?
//print_r($page->num_rows());
$allPage = $this->SiteModel->list_page();


$slider = $this->db->get_where('slider',['admin_id'=>CLIENT_ID]);

?>
<div class="panel-body" id="demo_s">
    <?
    if(!$slider->num_rows()):
        echo '<div class="alert alert-danger">Please first Add Slider Then Use..</div>';
    else:
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header tx-white bg-success">
                    <h1>Use Slider</h1>
                    
                </div>
                <div class="card-body">
                   <ul class="list-group">
                <?php
                    echo'<li class="list-group-item">
                        <h5 class="list-group-item-heading"><strong>Slider</strong></h5>
                        <p class="list-group-item-text">';
                        foreach ($allPage->result() as $page)
                        {
                            $chk = $this->SiteModel->getPageSchema(['type'=>'main_slider','page_id'=>$page->id])->num_rows() ? 'checked' : '';
                           echo'<div class="custom-checkbox custom-control"><input type="checkbox" id="'.$page->id.'" class="custom-control-input" onclick="useMainSlider('.$page->id.')" '.$chk.'>
                            <label class="custom-control-label" for="'.$page->id.'">'.$page->page_name.'</label>
                            </div>';
                        }
                            

                        echo'</p>
                      </li>';
                ?>

            </ul>
                </div>
            </div>
        </div>
    </div>
    <?
    endif;
    ?>
</div>
<script type="text/javascript">
    function useMainSlider(pageid)
    {  
        $("#load").show();
        $.ajax({
            url:'<?=site_url('admin/slider_use_in_schema')?>',
            type:'POST',
            data:{pageid:pageid},
            success:function(q)
            {
                alert(q);
                toastr.success("Saved successfully");
                $("#load").hide();
            }
        });
    }
</script>