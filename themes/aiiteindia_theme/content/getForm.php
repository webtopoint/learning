<section class="contact-section" id="form-'<?=($f->id)?>">
        <div class=" auto-container shadow-lg p-4">
          <div class="sec-title text-center">

                <h2><?=$f->title?></h2>

                <span class="divider"></span>

            </div>
            <div class="contact-form">
                <?php
                echo isset($form_script)
                            ? $form_script :
                     ' <form action="" class="bg-white" data-id="'.AJ_ENCODE($f->id).'" align="left" onsubmit="DataFormSubmit (event,this)">';
                
            $col = (int)12/$f->layout;

            $ck = 0;
            foreach ($fields as $fil)

            {

              if($ck==0)

              echo '<div class="row ">';

                      echo'<div class="col-md-'.$col.' form-group mb-3 mb-md-0">'.$fil.'</div>';

                      $ck  +=  $col;

              if($ck==12)

              {

                echo'</div>'; $ck=0;

              }

              

            }

              if($ck>0)

                echo '</div>';
                
                
                ?>
                <!--</div>-->
                  <div class="button-outer d-flex mt-4">
                    <?=$f->btn?>
                  </div>
                </form>
            </div>
        </div>
    </section>