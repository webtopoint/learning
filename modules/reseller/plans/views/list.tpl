

<?php
/*
$temp = $this->db->dbprefix;
$this->db->dbprefix = '';

$get = $this->db->select('*',false)->join(DB_USERNAME.'.plans as M','M.id = R.plan_id')->get(RESELLER_DB_DATABASE.'.rs_plans as R');

//echo $this->db->last_query();

$this->db->dbprefix = $temp;


echo $get->num_rows();
*/
?>

<div class="col-md-12">
    <button class="btn btn-primary sync-all-palns">Sync All Plans</button>
</div>

<script>
    $('.sync-all-palns').click(function(){
        var html = $(this).html(),
            that = this;
        toastr.warning('Please do not refresh the page.');
        $(that).html(loader_btn_html.replace('Loading..','') + 'Please Wait.').prop('disabled',true);
        setTimeout(function(){
            toastr.info('Syncing All Plans Start..');
        },3000)
    });
</script>