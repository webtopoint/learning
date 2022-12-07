<div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">

                                        </i>

                                    </div>

                                    <div> List Students

                                        <div class="page-title-subheading">

                                        </div>

                                    </div>

                                </div>  

                            </div>

</div> 
<div class="row">
    <div class="container">
         
        <div class=" card main-card">
            <div class="card-header">List Students</div>
            <div class="card-body row">
               
                <table class="mb-0 table table-striped">
                    <tr><th>#</th>
                        <th>Join Date</th>
                        <th>Full Name</th><th>
                        Father Name</th>
                        <th>Mother Name</th>
                        <th>Class</th>
                        <th>Date of Brith</th>
                        <th>Action</th>
                        </tr>
                     <?php
                     $i=1;
                        foreach ($students as $std)
                        {
                        $class = $this->crud_model->get_class_data(['id'=>$std['class_id']])->row();
                        $class_name = $class->class_name .'( '.$class->section_name.' )';
                        echo'<tr><td>'.$i.'</td>
                              <td>'.$std['join_date'].'</td>
                              <td>'.$std['full_name'].'</td>
                              <td>'.$std['father_name'].'</td>
                              <td>'.$std['mother_name'].'</td>
                              <td>'.$class_name.'</td>
                              <td>'.$std['dob'].'</td>
                              <td><button class="btn btn-danger btn-sm btn-xs delete-student" data-id="'.$std['id'].'"><i class="fa fa-trash"></i></button></td>
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
    $('.delete-student').click(function(){
        let id = $(this).data('id');
        $.confirm({
            type:'red',
            title:'Confirmation!',
            icon:'fa fa-bell',
            content:'Are you sure for delete it.',
            buttons:{
                ok:{
                    text:'<i class="fa fa-trash"></i> Delete',
                    btnClass:'btn-danger',
                    action:function(){
                        //manage_students_for_result
                        location.href=""+base_url+'Admin/manage-students-for-result/delete/'+id;
                    }
                },
                cancel:function(){}
            }
        });
    });
</script>