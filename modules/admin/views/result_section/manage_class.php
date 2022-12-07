<div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">

                                        </i>

                                    </div>

                                    <div> List Class

                                        <div class="page-title-subheading">

                                        </div>

                                    </div>

                                </div>  

                            </div>

</div> 
<div class="row">
    <div class="container">
         
        <div class=" card main-card">
            <div class="card-header">List Classes</div>
            <div class="card-body row">
               
                <table class="mb-0 table table-striped">
                    <tr><th>#</th><th>Class Name</th><th>
                        Class Name in Numeric</th>
                        <th>Section</th></tr>
                     <?php
                     $i=1;
                        foreach ($classes as $f)
                        {
                          echo'<tr><td>'.$i.'</td><td>'.$f['class_name'].'</td><td>'.$f['class_numeric_name'].'</td>
                          <td>'.$f['section_name'].'</td></tr>';
                          $i++;
                        }   

                        ?>
                </table>
                
            </div>
        </div>
    </div>
</div>