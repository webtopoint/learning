<div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">

                                        </i>

                                    </div>

                                    <div> List Result Data

                                        <div class="page-title-subheading">

                                        </div>

                                    </div>

                                </div>  

                            </div>

</div> 
<div class="row">
    <div class="container">
         
        <div class=" card main-card">
            <div class="card-header">List Result Data</div>
            <div class="card-body row">
               
                <table class="mb-0 table table-striped">
                    <tr><th>#</th>
                        <th>Student Name</th>
                        <th>Rool Id</th>
                        <th>Class</th>
                        <th>Action</th>
                        </tr>
                     <?php
                     $i=1;
                        foreach ($result as $std)
                        {
                            $s = $this->db->get_where('students',['admin_id'=>CLIENT_ID,'id'=>$std->student_id])->row();
                            $class = $this->db->get_where('classes',['admin_id'=>CLIENT_ID,'id'=>$std->class_id])->row();
                            $sec = $class->section_name==''?'':' ( '.$class->section_name.' )';
                            $class_name = ucwords($class->class_name).$sec;
                          echo'<tr id="result-data-'.$i.'"><td>'.$i.'.</td>
                                  <td>'.ucwords($s->full_name).'</td>
                                  <td>'.$s->rool_id.'</td>
                                  <td>'.$class_name.'</td>
                                  <td><button class="btn btn-danger btn-sm btn-xs delete-result" data-row_id="'.$i.'" data-id="'.$std->id.'"><i class="fa fa-trash"></i></button></td>
                               </tr>';
                          $i++;
                        }   

                        ?>
                </table>
                
            </div>
        </div>
    </div>
</div>
<script>
    $('.delete-result').click(function(){
        let id = $(this).data('id'),row_id = $(this).data('row_id');
        $('#load').show();
    
        $.confirm({
            type:'red',
            content:'Are You sure for Remove This Result..',
            title:'Confirmation',
            icon:'fa fa-bell',
            buttons:{
                ok:{
                    text:'Delete',
                    btnClass:'btn-danger',
                    action:function(){
                        $('#load').hide();
                        $.ajax({
                            type : 'POST',
                            url : base_url+'Admin/result-section-ajax',
                            data:{status:'delete_result_data',id:id},
                            dataType:'json',
                            success:function(res){
                                $('#result-data-'+row_id).hide();
                                toastr.success('Result data Removed Successfully...');
                            },
                            error:function(re,er,r){
                                console.log(re); console.log(er); console.log(r);
                                $.confirm({type:'red',title:'Error',content:re.responseText});
                            }
                        });
                    }
                },
                cancel:function(){}
            }
        });
    });
</script>