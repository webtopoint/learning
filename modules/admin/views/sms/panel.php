
<style>
    .form-group{
        text-align:left;
    }
</style>
<div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">

                                        </i>

                                    </div>

                                    <div> SMS Panel

                                        <div class="page-title-subheading">

                                        </div>

                                    </div>

                                </div>  

                            </div>

</div> 


<div class="row">
    <div class="container">
        <?
        if($s = $this->session->flashdata('success'))
            echo '<div class="alert alert-success">'.$s.'</div>';
        ?>
        <form class="mb-3 text-center card main-card" method="post">
            <div class="card-header">
                <h3></h3><i class="fa fa-edit"></i> Update API </h3>
            </div>
            <div class="card-body row">
                
                    <div class="form-group col-md-4">
                        <label>Enter Username</label>
                        <input type="text" name="username" placeholder="Enter Username.." class="form-control" value="<?=$username?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Enter Password</label>
                        <input type="text" name="password" placeholder="Enter Password.." class="form-control" value="<?=$password?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Enter Sender Id</label>
                        <input type="text" name="sender_id" placeholder="Enter Sender Id.." class="form-control" value="<?=$sender_id?>">
                    </div>
                    
            </div>
            <div class="card-footer">
                <button class="btn btn-success"><i class="fa fa-edit"></i> Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    $('.sms-panel-btn').addClass('active');
</script>