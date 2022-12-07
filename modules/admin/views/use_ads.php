<?php
require_once 'header.php';

$allPage= $this->SiteModel->list_page();
$Ads = $this->SiteModel->getGoogleAds();
?>


<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-browser icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Use Google Ads
                <div class="page-title-subheading">Modify Ads using this section.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="main-card mb-3 card">
        <div class="card-body"><h5 class="card-title">Use Ads on Pages</h5>

            <ul class="list-group">
                <?php
                foreach($Ads->result() as $car)
                {
                    echo'<li class="list-group-item">
                        <h5 class="list-group-item-heading"><strong>'.$car->name.'</strong></h5>
                        <p class="list-group-item-text">';
                        foreach ($allPage->result() as $page)
                        {
                            $chk = $this->SiteModel->checkAdsUse(array('ads_id'=>$car->id,'page_id'=>$page->id))?" checked":"";
                           echo'<div class="custom-checkbox custom-control"><input type="checkbox" id="'.$car->id.'_'.$page->id.'" class="custom-control-input" onclick="useAds('.$car->id.','.$page->id.')" '.$chk.'>
                            <label class="custom-control-label" for="'.$car->id.'_'.$page->id.'">'.$page->page_name.'</label>
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
    function useAds(adsid,pageid)
    {  
        var DATA = 'adsid='+adsid+'&pageid='+pageid+'&status=useads';
        $("#load").show();
        $.ajax({
            url:'<?site_url('Admin/use_ads')?>',
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