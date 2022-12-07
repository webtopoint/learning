<section class="contact-section" id="form-'<?=($f->id)?>">
        <div class=" auto-container shadow-lg p-4">
          <div class="sec-title text-center">

                <h2><?=$service->service_name?></h2>

                <span class="divider"></span>

            </div>
            <div class="contact-form">

<?php
 echo'
            <form class="bg-white" data-service-id="'.($service->id).'" align="left" onsubmit="FileService(event,this)">';

            $col = (int)12/$f->layout;

            $ck = 0;

            foreach ($fields as $fil)

            {

              if($ck==0)

              echo '<div class="row form-group">';

                      echo'<div class="col-md-'.$col.' mb-3 mb-md-0">'.$fil.'</div>';

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

                      '.$f->btn.'

                      </div>

                    </div>

            </form>

            

          </div>
          </div>
          </section>';