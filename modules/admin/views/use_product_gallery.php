<?php
require_once 'header.php';

$allPage= $this->SiteModel->list_page();
$Gal = $this->GalleryModel->product_gallery();
?>


<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-browser icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Use Product Gallery
                <div class="page-title-subheading">Modify Product Gallery using this section.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="main-card mb-3 card">
        <div class="card-body"><h5 class="card-title">Use Product Gallery on Pages</h5>

            <ul class="list-group">
                <?php
                foreach($Gal->result() as $gal)
                {
                    echo'<li class="list-group-item">
                        <h5 class="list-group-item-heading"><strong>'.$gal->gallery_name.'</strong> 
                            <a href="'.site_url('Admin/product-gallery/'.AJ_ENCODE($gal->id).'/view-products').'" target="_blank"><button class="mb-2 mr-2 border-0 btn-transition btn btn-outline-primary"> View 
                                        </button></a>
                        </h5>
                        <p class="list-group-item-text">';
                        foreach ($allPage->result() as $page)
                        {
                            $chk = $this->GalleryModel->checkProductGalleryUse(array('gal_id'=>$gal->id,'page_id'=>$page->id))?" checked":"";
                           echo'<div class="custom-checkbox custom-control"><input type="checkbox" id="'.$gal->id.'_'.$page->id.'" class="custom-control-input" onclick="useProductGallery('.$gal->id.','.$page->id.')" '.$chk.'>
                            <label class="custom-control-label" for="'.$gal->id.'_'.$page->id.'">'.$page->page_name.'</label>
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
    function useProductGallery(galid,pageid)
    {  
        var DATA = 'galid='+galid+'&pageid='+pageid+'&status=useproductgallery';
        $("#load").show();
        $.ajax({
            url:'<?site_url('Admin/use_product_gallery')?>',
            type:'POST',
            data:DATA,
            success:function(q)
            {
                toastr.success("Saved successfully");
                $("#load").hide();
            }
        });
    }
    $(".use_product_gallery").addClass(" mm-active");
    $(".gallery_setting").addClass(" mm-active");
</script>

<?php

require_once 'footer.php';
?>