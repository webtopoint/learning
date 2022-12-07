<?php
 echo'<br>
            <div class="row" data-aos="fade" >
            <div class="unit-7 pricing-table-modern__item" style="    width: 100%;
    margin-left: 30px;
    margin-right: 30px;">
              <div class="pricing-table__item-header">
                <div class="pricing-table__item-header-bg">
                  <div class="pricing-table__item-header-bg-inner"></div>
                </div>
                <p class="pricing-table__item-title mb-0"><i class="fa fa-picture-o"></i> '.$g->gallery_name.'</p>
              </div>
              <div class="pricing-table__item-main" align="center" style="padding:3px;">'; 
                        if($files->num_rows())
                        {
                            echo '<div class="post-entry bg-white col-sm-12 col-md-6 col-lg-'.$width.'" style=" margin:1px;  min-height:'.$height.'px; display:inline-block;  ">
                                 <table class="table table-bordered table-bordered">
                                   <thead>
                                        <tr>
                                            <th>File</th>
                                            <th>Action</th>
                                        </tr>
                                   </thead>
                                   <tbody>';
                            foreach ($files->result() as $file)
                            {
                              
                              echo'
                                <tr>
                                    <td>'.$file->file_name.'</td>
                                    <td><a href="'.base_url.'/public/temp/'.CLIENT_ID.'/'.$file->link.'" target="_blank" class=""><i class="fa fa-cloud-download"></i> Download</a></td>
                                </tr>
                              ';
                            }
                            echo '</tbody>
                                </table></div>';
                        //echo'<div class="pricing-table__item-control" style="margin:5px;">
                           // <a class="btn btn-secondary rounded-0 py-2 px-4" href="#">More</a></div>';
                        }
                        else
                        {
                          echo'<font color="red">No Data Available</font>';
                        }
                    echo'</div>
                      </div>
                   </div>
        <br>';