<?php
require_once 'header.php';
$pro = $this->GalleryModel->getProductQuery(array('product_query.id'=>$qid));
if(!$pro->num_rows())
{
    echo'<div class="alert alert-danger">No Data found.</div>'; exit();
}

$data = $pro->row();
$info = json_decode($data->form_data);
?>


<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-browser icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Product Query Details
                <div class="page-title-subheading">Modify Form using this section.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="main-card mb-3 card">
        <div class="card-body>">
            <ul class="list-group">
                <li class="list-group-item"><i class="fa fa-clock-o"></i> Date: <?=date('d-M-y',strtotime($data->timestamp))?> |  Time : <?=date('h:i:s A',strtotime($data->timestamp))?> </li>
                <li class="list-group-item"><center>
                    <img src="<?=base_url.'/public/temp/'.CLIENT_ID.'/'.$data->img?>" style="max-width:300px;"></center></li>
                <?php
                foreach ($info as $key => $value)
                {
                    echo'<li class="list-group-item" ><strong style="text-transform:capitalize">'.$key.' : </strong> &nbsp;'.$value .'</li>';
                }
                
                ?>
            </ul>
        </div>
    </div>
</div>

<?php
require_once 'footer.php';
?>