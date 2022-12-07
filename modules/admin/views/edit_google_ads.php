<?

require_once 'header.php';
//$code='';
$r = $this->db->where(array('admin_id'=>CLIENT_ID))->get('google_adsense')->num_rows();
if(!$r)
{
    echo'<div class="alert alert-danger">First Add Goolge Adsense Credential</div>';
    exit();
}

$data = $this->SiteModel->getGoogleAds(array('id'=>$id));
if($data->num_rows())
{
    $ads = $data->row();
}
else
{
    echo'<div class="alert alert-danger">No Data Found</div>'; exit();
}

?>


<div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">

                                        </i>

                                    </div>

                                    <div>Edit Google Ads

                                         
                                    </div>

                                </div>  
                               

                            </div>
</div>  


<div class="row">
    <div class="col-lg-12">
        <form action="" method="post">
            <div class="form-group">
                <label>Ads Name</label>
                <input class="form-control" name="name" value="<?=$ads->name?>">
            </div>
            <div class="form-group">
                <label>Enter Google Ads Code</label>
                <textarea class="form-control" name="ads_code" rows="10"><?=$ads->ads_code?></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
</div>


<?

require_once 'footer.php';

?>
