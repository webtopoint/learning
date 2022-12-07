<div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="fa fa-envelope">

                                        </i>

                                    </div>

                                    <div>Add a New Email

                                        <div class="page-title-subheading">

                                        </div>

                                    </div>

                                </div>  

                            </div>

</div> 
<div class="">
    <div class="row">
         <form class="needs-validation container form-label-left" method="post"  novalidate >
        <div class="mb-3 card main-card">
            <div class="card-header">Add Email</div>
            <div class="card-body row" style="overflow:hidden">
                 <?
                 if(isset($_GET['status']))
                     echo '<div class="col-md-12 alert alert-'.$_GET['status'].'">'.$_GET['message'].'</div>';
                     
                 
                 
                 ?>
                <div class="form-group has-success col-md-4">
                    <label for="success" class="control-label">Email</label>
                
						<div class="input-group">
							<input type="text" name="email" required class="form-control" id="inputSuccess3" placeholder="email">
							<span class="input-group-btn" style="border: 1px solid #ced4da;
    line-height: 2;
    padding-left: 10px;
    padding-right: 10px;
    background: #ced4da;">
                                    @<?=FRESH_DOMAIN?>
							</span>
                		    <div class="invalid-feedback">Provide a valid email</div>
						</div>
						
						
                	
                </div>
                <div class="form-group col-md-4">
						    <label>Password</label>
						    <input type="text" name="password" required class="form-control" placeholder="Enter Password..">
						    <div class="invalid-feedback">Provide a valid password</div>
				</div>
                                                
            </div>
            <div class="card-footer">
                <div class="form-group has-success">
                    <?
                                $emails = $this->db->get_where('emails',['admin_id' => CLIENT_ID ]);
                
                    if($emails->num_rows() >= 2){
                        echo '<div class="alert alert-danger">Your Email Account Limit is Over.</div>';
                    }
                    else{
                    ?>
                    <div class="">
                        <button type="submit" class="btn btn-success btn-labeled">Create Email<span class="btn-label btn-label-right" ><i class="fa fa-check"></i></span></button>
                    </div>
                    <?
                    }
                    ?>
                    
                    
                </div>
            </div>
        </div>
        </form>
        
        <div class="col-md-12">
        
            <div class="mb-3 card main-card">
                <div class="card-header">List Email</div>
                <div class="card-body row" style="overflow:hidden">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#.</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <? $i = 1;
                                foreach($emails->result() as $email){
                                    echo '<tr>
                                            <td>'.$i++.'.</td>
                                            <td>'.$email->email.'</td>
                                            <td>'.$email->password.'</td>
                                            <td><a href="'.base_url.'/Admin/email/delete/'.AJ_ENCODE($email->id).'" onclick="return confirm(\'Are you sure for delete it.\')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a></td>
                                        </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
</div>