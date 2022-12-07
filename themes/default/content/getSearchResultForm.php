<?php

echo '<div class="col-lg-12 unit-7 pricing-table-modern__item" align="none">



              <div class="pricing-table__item-header">

                <div class="pricing-table__item-header-bg">

                  <div class="pricing-table__item-header-bg-inner"></div>

                </div>

                <p class="pricing-table__item-title mb-0">'.$form_css->form_title.'</p>

              </div> 



            <form action="" class="p-5 bg-white findResultBySomeFields" data-id="'.AJ_ENCODE($f->id).'" align="left" >';

            $col = (int)12/$f->layout;

            $ck = 0;

            foreach ($fields as $fil => $value){

              if($ck==0)

              echo '<div class="row form-group">';

                      echo'<div class="col-md-'.$col.' mb-3 mb-md-0">
                            <div class="form-group">
                                <lable>'.$value->label.'</label>';
                                switch($fil){
                                    
                                    case 'dob':
                                        echo '<input type="date" placeholder="'.$value->placeholder.'" required class="form-control" name="'.$fil.'">';
                                    break;
                                    
                                    default:
                                        echo '<input type="" placeholder="'.$value->placeholder.'" required class="form-control" name="'.$fil.'">';
                                }
                      echo '</div>
                          </div>';

                      $ck+=$col;

              if($ck==12)

              {

                echo'</div>'; $ck=0;

              }

              

            }

              if($ck>0)
                echo '</div>';



              echo '<div class="row form-group">

                      <div class="col-md-12 mb-3 mb-md-0">
                            <button class="resultSearchForm-Button-'.$f->id.'">
                            '.$form_css->button_name.'
                            </button>
                      </div>

                    </div>

            </form>

            

          </div>';
          
          ?>