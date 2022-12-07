<?php
if(!$data->num_rows())
       {
       		echo $key.' Not found';
       		return false;
       }
        $drow = $data->row();



        $de = json_decode($drow->details);

        $sp = array('verySlow'=>5000,
                      'slow'=>4000,
                      'normal'=>2000,
                      'fast'=>1000,
                      'veryFast'=>500,
              );
        echo '<style>
                    #carousel-height-000'.$drow->id.'{
                        height: '.$de->height.'px;
                    }
                    @media only screen and (max-width: 600px) {
                       #carousel-height-000'.$drow->id.'{
                            height: 200px;
                        }
                    }
                </style>';
        echo'<div style="width: 100%;  overflow:hidden;" id="carousel-height-000'.$drow->id.'">
              <div class="swiper-container-'.$drow->id.'">
                <div class="swiper-wrapper">';
                
                
                if($drow->images)
                {
                    foreach (json_decode($drow->images) as $img)
                    {
                        echo'<div class="swiper-slide" id="carousel-height-000'.$drow->id.'" style="background-image: url('.$img.'); background-size:100% 100%; background-repeate:none; width:100%">
                            </div>';
                    }
                }
                else
                {
                  echo'<center> <font color="red">No Photos</font></center>';
                }
        
        
         echo'</div>
              <!--  <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>-->
            </div>
          </div>
          <script>  
             var swiper = new Swiper(".swiper-container-'.$drow->id.'", {
             
              slidesPerView: '.$de->perSlide.',
              spaceBetween: 30,
              autoplay: {
                delay: '.$sp[$de->speed].',
                disableOnInteraction: false,
              },
               breakpoints: {
                   300: {
                    slidesPerView: 1,
                    spaceBetween: 5,
                  },
                  640: {
                    slidesPerView: 1,
                    spaceBetween: 10,
                  },
                  768: {
                    slidesPerView: 4,
                    spaceBetween: 40,
                  },
                  1024: {
                    slidesPerView: '.$de->perSlide.',
                    spaceBetween: 10,
                  },
                }
            });
            
          </script>
          ';
?>