<?

require_once 'header.php';
$code='';
$r = $this->db->where(array('admin_id'=>CLIENT_ID))->get('google_adsense');
if($r->num_rows())
{
    $code = $r->row()->code;
}
?>


<div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">

                                        </i>

                                    </div>

                                    <div>Add Google Adsense

                                         
                                    </div>

                                </div>  
                               

                            </div>
</div>  


<div class="row">
    <div class="col-lg-12">
        <form action="" method="post">
            <div class="form-group">
                <label>Enter Google Adsense Credential </label>
                <textarea class="form-control" name="code" rows="10"><?=$code?></textarea>
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