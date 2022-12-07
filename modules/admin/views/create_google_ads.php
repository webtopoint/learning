<?

require_once 'header.php';
//$code='';
$r = $this->db->where(array('admin_id'=>CLIENT_ID))->get('google_adsense')->num_rows();
if(!$r)
{
    echo'<div class="alert alert-danger">First Add Goolge Adsense Credential</div>';
    exit();
}
?>


<div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">

                                        </i>

                                    </div>

                                    <div>Create Google Ads

                                         
                                    </div>

                                </div>  
                               

                            </div>
</div>  


<div class="row">
    <div class="col-lg-12">
        <form action="" method="post">
            <div class="form-group">
                <label>Ads Name</label>
                <input class="form-control" name="name">
            </div>
            <div class="form-group">
                <label>Enter Google Ads Code</label>
                <textarea class="form-control" name="ads_code" rows="10"></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-success">
            <div class="card-header">Available Ads</div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <tr><th>#</th><th>Name</th><th>Action</th></tr>
                    <?php
                        $list = $this->SiteModel->getGoogleAds();
                        $i=1;
                        foreach ($list->result() as $val)
                        {
                           echo'<tr><td>'.$i++.'</td><td>'.$val->name.'</td><td><a href="'.site_url('Admin/edit-ads/'.AJ_ENCODE($val->id)).'"><label class="badge badge-info"><i class="fa fa-edit"></i> Edit</label></a> &nbsp; &nbsp; <label class="badge badge-danger" onclick="deleteAds(this)" data-id="'.AJ_ENCODE($val->id).'"><i class="fa fa-trash"></i> Delete</label></td></tr>';
                        }
                    ?>
                    
                </table>
            </div>
        </div>
    </div>
</div>

<?

require_once 'footer.php';

?>
<script type="text/javascript">
    function deleteAds(e)
    {
        if(confirm("Delete Ads?"))
        {
            location.href="<?=site_url('Admin/delete-ads/')?>"+$(e).data('id');
        }
    }
</script>