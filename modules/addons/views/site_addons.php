<div class="'row">
        <?php
        $all_addons = $this->system_model->client_module();
        if($all_addons->num_rows()){
            foreach($all_addons->result() as $row){
            echo '<div class="col-md-3">
                        
                        <div class="card bounce-in" data-id="'.$row->id.'">
                            <div class="card-header">
                                <h3 class="card-title">'.ucwords($row->title).'</h3>
                            </div>
                            <div class="card-body">
                                '.$row->description.'
                                
                                <br>
                            </div>
                            <div class="card-footer">';
                                if($row->status)
                                    echo '<b class="text-success">Active</b>';
                                else
                                    echo '<b class="text-danger">In-Active</b>';
                                
                            echo '</div>
                        </div>
            
            
            
                    </div>';
        }
        }
        else
            echo "<div class='alert alert-danger'>You don't have any <b>Modules</b>.</div>";
        
        ?>
        
</div>

<hr>
<div class="row">
    <div class="col-md-12">
        <h3>List of Module(s)</h3>
    </div>
    <?php
    $all = $this->system_model->get();
    if($all->num_rows()){
        foreach($all->result() as $row){
            $price = $row->price ? '<b>Price :- </b> '.$row->price .' <i class="fa fa-rupee"></i>' : 'Free';
            echo '<div class="col-md-3">
                        
                        <div class="card" data-id="'.$row->id.'">
                            <div class="card-header">
                                <h3 class="card-title">'.ucwords($row->title).'</h3>
                            </div>
                            <div class="card-body">
                                '.$row->description.'
                                
                                <br>
                            </div>
                            <div class="card-footer">';
                                $check = $this->system_model->client_module($row->id);
                                if($check->num_rows()){
                                    $amount = isJson($check->row()->data) ? json_decode($check->row()->data,true)['amount'] : 0;
                                    
                                    echo '<b class="text-success">'.$amount.' You have already Purchased.</b>';
                                }
                                else
                                    echo '<button class="btn btn-success pull-right purchase" >'.$price.' Purchase</button>';
                                
                            echo '</div>
                        </div>
            
            
            
                    </div>';
        }
        
        // print_r($this->Admin);
    }
    else
        echo '<div class="alert alert-danger">System Addons are not available..</div>';
    ?>
</div>




<script>
    $('.purchase').click(function(){
        
    
        var id = $(this).closest('.card').data('id');
        $.ajax({
            type : 'POST',
            data : { id : id},
            url : '<?=base_url('addons/go_to_payment')?>',
            dataType :'json',
            success:function(res){
                if(res.form.status){
                    console.log(res.form.html);
                    var form = $(res.form.html);
				        $('body').append(form); 
				        form.submit();
                }
                else{
                    $.confirm({
                        title :'Notification!',
                        icon :'fa fa-bell',
                        content : res.form.html,
                    })
                }
            },
            error:function(r,v,c){
                console.warn(r.responseText);
            }
        });
    });
    
</script>