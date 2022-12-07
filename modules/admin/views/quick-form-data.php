<div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="fa fa-envelope">

                                        </i>

                                    </div>

                                    <div>Quick Form Data

                                        <div class="page-title-subheading">

                                        </div>

                                    </div>

                                </div>  

                            </div>

</div> 
<div class="">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <table class="table table-bordered table-striped">
                    <thead>
                        <th>#.</th>
                        <th>Time</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?
                        $i = 1;
                        foreach($records as $s){
                            $data = json_decode($s['form_data']);
                            echo '<tr class="tab-'.$s['id'].'">
                                    <td>'.$i++.'.</td>
                                    <td>'.date('d-M-Y h:i A',strtotime($s['timestamp'])).'</td>
                                    <td>'.$data->name.'</td>
                                    <td>'.$data->contact.'</td>
                                    <td>'.$data->email.'</td>
                                    <td>'.$data->message.'</td>
                                    <td><a href="javascript:void(0)" class="btn btn-danger btn-xs delete-quick " data-id="'.($s['id']).'"><i class="fa fa-trash"></i></a></td>
                                </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $('.delete-quick').click(function(){
        var d = $(this).data('id');
        $.confirm({
            type:'red',
            title:'Confirmation!',
            icon:'fa fa-bell',
            content:'Are you sure for delete it.',
            buttons:{
                ok:{
                    text:'<i class="fa fa-trash"></i> delete',
                    btnClass:'btn-danger',
                    action:function(){
                        $.ajax({
                            type:'POST',
                            url:'<?=base_url?>/Home/ajax',
                            data:{status:'delete-quick',id:d},
                            dataType:'json',
                            success:function(res){
                                $('.tab-'+d).remove();
                                toastr.success('Data Delete Successfully.');
                            }
                        });
                        
                    }
                },
                cancel:function(){}
            }
        });
    });
</script>