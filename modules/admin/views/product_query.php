<?php
require_once 'header.php';
$pro = $this->GalleryModel->getProductQuery();
?>


<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-browser icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Product Query
                <div class="page-title-subheading">List your Product Queries.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="main-card mb-3 card">
        <div class="card-body">
            <h5 class="card-title">All Query Received.</h5>

            <table class="table table-striped table-bordered table-hover">
                <tr><th>#</th>
                    <th>Date</th>
                    <th>Product Image<br><small>Click on Image for product Details</small></th>
                    <th>Query Data</th>
                    <th>More</th>

                </tr>
                <?php
                $i=$pro->num_rows();

                foreach ($pro->result() as $res) 
                {   
                    
                    $q = json_decode($res->form_data,true);


                    echo'<tr>
                    <td>'.$i--.'</td>
                    <td>'.date('d-M-y @ h:i A',strtotime($res->timestamp)).'</td>
                    <td><a href="'.site_url("Admin/product-gallery/".AJ_ENCODE($res->product_id)."/edit-product").'"><img src="'.base_url.'/public/temp/'.CLIENT_ID.'/'.$res->img.'" style="width:170px;"></a></td>
                    <td>
                    <ul class="list-group">';
                        if(is_array($q)){
                            foreach($q as $key => $v){
                                echo "<li class='list-group-item'><strong>$key   :</strong> ".print_ddd($v)."</li>";
                            }
                        }
                        /*
                        <li class="list-group-item"><strong>Name   :</strong> '.$q->name.'</li>
                        <li class="list-group-item"><strong>Contact:</strong> '.$q->contact.'</li>
                        */
                        echo '
                    </ul>
                    </td>
                    <td><a href="'.site_url().'Admin/product-query/'.AJ_ENCODE($res->id).'"><button class="btn btn-info"><i class="fa fa-eye"></i> View </button></a> 
                        <a href="'.site_url().'Admin/product-query/'.AJ_ENCODE($res->id).'/delete-query"><button class="btn btn-danger"><i class="fa fa-trash "></i> Delete</button> </a></td></tr>';
                }

                ?>
            </table>
        </div>
    </div>
</div>

<?php
require_once 'footer.php';

?>
