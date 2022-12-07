<div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">

                                        </i>

                                    </div>

                                    <div> List Subjects

                                        <div class="page-title-subheading">

                                        </div>

                                    </div>

                                </div>  

                            </div>

</div> 
<div class="row">
    <div class="container">
         
        <div class=" card main-card">
            <div class="card-header">List Subjects</div>
            <div class="card-body row">
               
                <table class="mb-0 table table-striped">
                    <tr><th>#</th><th>Subject Name</th><th>
                        Subject Code</th>
                        <th>Action</th></tr>
                     <?php
                     $i=1;
                        foreach ($subjects as $f)
                        {
                          echo'<tr><td>'.$i.'</td><td>'.$f['subject_name'].'</td><td>'.$f['subject_code'].'</td>
                          <td>
                             <button class="btn btn-danger btn-xs btn-sm delete-subject" data-id="'.$f['id'].'"><i class="fa fa-trash"></i></button>
                          </td></tr>';
                          $i++;
                        }   

                        ?>
                </table>
                
            </div>
        </div>
    </div>
</div>
<script>
    $('. delete-subject').click(function(){
        let id = $(this).data('id');
        $.confirm({
            title:'Confimation',
            type:'red',
            icon:'fa fa-bell',
            content:'Are you sure for delete this subject.',
            buttons:{
                delete:{
                    text:'<i class="fa fa-trash"></i> Delete',
                    btnClass:'btn-danger',
                    action:function(){
                        alert(0);
                    }
                },
                cancel:function(){}
            }
        });
    });
</script>