<?php

if(web_plugin('IS_PRIMARY_PAGE')){
    $sliders = $this->SiteModel->extra_setting('slider','all');
    if($sliders):
    ?>
    <!--Main Slider-->
     <section class=" ">
        <div id="demo" class="carousel slide" data-ride="carousel">
        
          <!-- Indicators -->
          <ul class="carousel-indicators">
            <?php $i = 0;
            foreach($sliders->result() as $row){
                $active = !$i ? 'active' : '';
                echo '<li data-target="#demo" data-slide-to="'.$i++.'" class="'.$active.'"></li>';
            }
            ?>
          </ul>
          
          <!-- The slideshow -->
          <div class="carousel-inner">
            <?php $i = 0;
            foreach($sliders->result() as $row){
                $active = !$i++ ? 'active' : '';
                echo '<div class="carousel-item '.$active.'">
                          <img src="'.base_url('assets/file/'.$row->value).'" alt=""  >
                        </div>';
            }
            ?>
                                                                                                                                                       
            
          </div>
          
          <!-- Left and right controls -->
          <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </a>
          <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
          </a>
        </div>

    </section>
    
    <?php
    echo $this->SiteModel->extra_setting('slider_bottom_section',true,$this->ThemeModel->get_theme_templates(11,'content'));
    endif;
}
else{
?>

<section class="page-title" style="background-image: url('<?=web_plugin('head_image')?>');">
        <div class="anim-icons full-width">
            <span class="icon icon-bull-eye"></span>
            <span class="icon icon-dotted-circle"></span>
        </div>
        <div class="auto-container">
            <div class="title-outer">
                <h1>{_page_name_}</h1>
                <ul class="page-breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li>{_page_name_}</li>
                </ul> 
            </div>
        </div>
    </section>
<?php
}

?>
<section class="about-section">{_content_}</section>



<?php
/*

    <!-- End Main Slider-->
<section class="feature-section-three pt-0">

        <div class="auto-container">

            <div class="row">

                <!--Feature Block-->

                <div class="feature-block-five col-lg-3 col-md-6 col-sm-12 wow fadeInUp">
				<a href="online-application-form-for-admission.html" class="read-more"> 
                    <div class="inner-box box-1">

                        <div class="icon-box"><i class="icon flaticon-meeting"></i></div>

                        <h4>APPLY ONLINE</h4>

                        <p>Apply to our Courses through the online application....</p>

                       

                    </div>
				 </a>
                </div>



                <!--Feature Block-->

                <div class="feature-block-five col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="300ms">
				<a href="track/Web_doc/1656334370.pdf" class="read-more"> 
                    <div class="inner-box box-2">

                        <div class="icon-box"><i class="icon flaticon-file"></i></div>

                        <h4>PROSPECTUS</h4>

                        <p>Download to our all Programme Prospectus...</p>

                        

                    </div>
					</a>
                </div>



                <!--Feature Block-->

                <div class="feature-block-five col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="600ms">
				 <a href="download.html" class="read-more"> 
                    <div class="inner-box box-3">

                        <div class="icon-box"><i class="icon flaticon-certificate-1 "></i></div>

                        <h4>CERTIFICATION
</h4>

                        <p>All Certificate Download from here...</p>

                        

                    </div>
				</a>
                </div>



                <!--Feature Block-->

                <div class="feature-block-five col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="900ms">

                    <div class="inner-box box-4">

                        <div class="icon-box"><i class="icon flaticon-inspiration"></i></div>

                        <h4>INSPIRING  </h4>

                        <p>To be inspired is great, to inspire is incredible.”</p>

                       

                    </div>

                </div>

            </div>

        </div>

    </section>
    

    <!-- About Section -->

    <section class="about-section">

        <div class="auto-container">

            <div class="row">

                <!-- Image Column -->

                <div class="image-column col-lg-6 col-md-12 col-sm-12">

                    <div class="about-image-wrapper">

                        <figure class="image-3 wow zoomIn" data-wow-delay="900ms"><img src="{_theme_url_}images/girl.png" alt=""/></figure>

                        <figure class="image-2 wow zoomIn" data-wow-delay="600ms"><img src="{_theme_url_}images/writer.png" alt=""/></figure>

                        <figure class="image-1 wow zoomIn" data-wow-delay="300ms"><img src="{_theme_url_}images/vector.png" alt=""/></figure>

                      

                    </div>

                </div>



                <!-- Content Column -->

                <div class="content-column col-lg-6 col-md-12 col-sm-12">

                    <div class="inner-column">

                        <div class="sec-title">

                            <span class="sub-title">WELCOME TO  </span>

                            <h2>ALL INDIA INSTITUTE OF  <br>TRAINING AND EDUCATION (AIITE)</h2>

                            <span class="divider"></span>

                        </div>

                        <p class="text-justify"> "ALL INDIA INSTITUTE OF TRAINING AND EDUCATION (AIITE)" is established on this day, 21 October 2013. To accomplish the mission and vision of Father Mr. Rambali & Mother Mrs. Shobhavati Devi, by "ER. DILIP KUMAR" (Founder and Chairman).AII India Institute of Training and Education is AN ISO 9001: 2015 certified Organization Regd. By Govt. of NCT, Delhi (INDIA).

 </p>

                         

                        <div class="btn-box">

                            <a href="about-aiite.html" class="theme-btn btn-style-one"><span class="btn-title">Read More</span></a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- End About Section -->



   <!-- Feature Section -->

    <section class="feature-section pt-0">

        <div class="anim-icons full-width">

            <span class="icon icon-circle-1 wow fadeIn"></span>

        </div>



        <div class="auto-container">

            <div class="sec-title text-center">

                <span class="sub-title">UNIQUE FEATURES OF OUR PROGRAMS</span>

                <h2>WHAT DO YOU WANT TO STUDY?</h2>

                <span class="divider"></span>

            </div>



            <div class="row">

                <!--Feature Block-->

                <div class="feature-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp">

                    <div class="inner-box">

                        <div class="icon-box"><i class="icon flaticon-certificate-1"></i></div>

                        <h4>Online  MBA General</h4>

                        <p>A comprehensive study of modern business...</p>
						<div class="duration">
              <h6>2 Year </h6>
              <span> Courses</span> </div>
                        <a href="aiite-teachers-training-education-academy.html" class="read-more">Read More</a>

                    </div>

                </div>



                <!--Feature Block-->

                <div class="feature-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="300ms">

                    <div class="inner-box">

                        <div class="icon-box"><i class="icon flaticon-idea"></i></div>

                        <h4>Online MBA Operations</h4>

                        <p>A comprehensive study of modern business...</p>
						<div class="duration">
              <h6>2 Year </h6>
              <span> Courses</span> </div>

                        <a href="aiite-teachers-training-education-academy.html" class="read-more">Read More</a>

                    </div>

                </div>



                <!--Feature Block-->

                <div class="feature-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="600ms">

                    <div class="inner-box">

                        <div class="icon-box"><i class="icon flaticon-meeting"></i></div>

                        <h4>Online MBA  Marketing</h4>

                        <p>A comprehensive study of modern business...</p>
						<div class="duration">
              <h6>2 Year </h6>
              <span> Courses</span> </div>

                        <a href="aiite-teachers-training-education-academy.html" class="read-more">Read More</a>
                    </div>

                </div>



                <!--Feature Block-->

                <div class="feature-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="900ms">

                    <div class="inner-box">

                        <div class="icon-box"><i class="icon flaticon-inspiration"></i></div>

                        <h4>Online MBA  Human Resource</h4>

                        <p>A comprehensive study of modern business...</p>
						<div class="duration">
              <h6>2 Year</h6>
              <span> Courses</span> </div>
                        <a href="aiite-teachers-training-education-academy.html" class="read-more">Read More</a>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- End Feature Section -->

 <section class="fun-fact-section">

        <div class="auto-container">
			<div class="sec-title light text-center">

                <span class="sub-title">The Numbers Say it All</span>

                <h2>Why Choose Us</h2>

                <span class="divider"></span>

            </div>
            <div class="fact-counter">

                <div class="row clearfix">

                    <!--Column-->

                    <div class="counter-column col-lg-3 col-md-6 col-sm-12 wow zoomIn">

                        <div class="inner-box">

                            <div class="count-box">

                                <span class="icon bg-1"></span>

                                <span class="count-text" data-speed="3000" data-stop="760">0</span>

                            </div>

                            <span class="counter-title">Certified Courses</span>

                        </div>

                    </div>



                    <!--Column-->

                    <div class="counter-column col-lg-3 col-md-6 col-sm-12 wow zoomIn" data-wow-delay="300ms">

                        <div class="inner-box">

                            <div class="count-box">

                                <span class="icon bg-2"></span>

                                <span class="count-text" data-speed="3000" data-stop="8162">0</span>

                            </div>
					 
                            <span class="counter-title">Students Enrolled </span>

                        </div>

                    </div>



                    <!--Column-->

                    <div class="counter-column col-lg-3 col-md-6 col-sm-12 wow zoomIn" data-wow-delay="600ms">

                        <div class="inner-box">

                            <div class="count-box">

                                <span class="icon bg-3"></span>

                                <span class="count-text" data-speed="3000" data-stop="25">0</span>

                            </div>

                            <span class="counter-title">Academics </span>

                        </div>

                    </div>



                    <!--Column-->

                    <div class="counter-column col-lg-3 col-md-6 col-sm-12 wow zoomIn" data-wow-delay="900ms">

                        <div class="inner-box">

                            <div class="count-box">

                                <span class="icon bg-4"></span>

                                <span class="count-text perct" data-speed="3000" data-stop="100">0</span>

                            </div>

                            <span class="counter-title">Satisfied Students</span>

                        </div>

                    </div>



                </div>

            </div>

        </div>

    </section>

    <!-- Speakers Section -->

    <section class="speakers-section">

        <div class="anim-icons full-width">

            <span class="icon icon-dotted-circle"></span>

        </div>



        <div class="auto-container">

            <div class="sec-title text-center">

                <span class="sub-title">Our SPEAKERS</span>

                <h2>ADVISERY COUNCIL</h2>

               
<a href="Board-of-Advisory.html" class="theme-btn btn-style-two rounded"><span class="btn-title">View All</span></a>
            </div>



            <div class="row">

                <!-- Speaker block -->

                				
                <div class="speaker-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp animated"  >
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="Board-of-Advisory-detail681a.html?id=1"><img src="{_theme_url_}track/Gallery/1649157445.jpg" alt=""></a></figure>
                            <span class="plus-icon fa fa-plus"></span>
                            <div class="social-links">
                                			
		  <a href="https://www.facebook.com/drjpdudeja" target="_blank"><i class="fab fa-facebook"></i></a>
			 
		  <a href="drjpdudeja%40gmail.html" target="_blank"><i class="fab fa-envelope"></i></a>
		  	 
		 <a href="https://www.linkedin.com/in/drjaipaul-dudeja-47700428/" target="_blank"><i class="fab fa-linkedin"></i></a>
		  	 
		   <a href="www.aiiteindia.html" target="_blank"><i class="fab fa-photobucket"></i></a>
		                              </div>
                        </div>
                        <div class="info-box">
                            <h4 class="name"><a href="Board-of-Advisory-detail681a.html?id=1">Prof. (Dr.) Jai Paul Dudeja</a></h4>
                            <span class="designation">ADVISORY COUNCIL MEMBER</span>
                        </div>
                    </div>
                </div>
				
                <div class="speaker-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp animated"  >
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="Board-of-Advisory-detaildcfd.html?id=4"><img src="{_theme_url_}track/Gallery/1649162480.html" alt=""></a></figure>
                            <span class="plus-icon fa fa-plus"></span>
                            <div class="social-links">
                                			
		  <a href="Facebook.html" target="_blank"><i class="fab fa-facebook"></i></a>
			  
		   
		  <a href="Twitter.html" target="_blank"><i class="fab fa-twitter"></i></a>
		  	 
		  <a href="Blog.html" target="_blank"><i class="fab fa-blogger"></i></a>
		  	 
		  <a href="sdhuliya%40gmail.html" target="_blank"><i class="fab fa-envelope"></i></a>
		  	 
		 <a href="Linkedin.html" target="_blank"><i class="fab fa-linkedin"></i></a>
		  	 
		   <a href="www.aiiteindia.html" target="_blank"><i class="fab fa-photobucket"></i></a>
		                              </div>
                        </div>
                        <div class="info-box">
                            <h4 class="name"><a href="Board-of-Advisory-detaildcfd.html?id=4">Prof. (Dr.) Subhash Dhuliya</a></h4>
                            <span class="designation">ADVISORY COUNCIL MEMBER</span>
                        </div>
                    </div>
                </div>
				
                <div class="speaker-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp animated"  >
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="Board-of-Advisory-detaild61c.html?id=5"><img src="{_theme_url_}track/Gallery/1649163105.png" alt=""></a></figure>
                            <span class="plus-icon fa fa-plus"></span>
                            <div class="social-links">
                                			
		  <a href="Facebook.html" target="_blank"><i class="fab fa-facebook"></i></a>
			  
		   
		  <a href="Twitter.html" target="_blank"><i class="fab fa-twitter"></i></a>
		  	 
		  <a href="Blog.html" target="_blank"><i class="fab fa-blogger"></i></a>
		  	 
		 <a href="Linkedin.html" target="_blank"><i class="fab fa-linkedin"></i></a>
		  	 
		   <a href="www.aiiteindia.html" target="_blank"><i class="fab fa-photobucket"></i></a>
		                              </div>
                        </div>
                        <div class="info-box">
                            <h4 class="name"><a href="Board-of-Advisory-detaild61c.html?id=5">Prof. (Dr.) Niraj Kumar</a></h4>
                            <span class="designation">ADVISORY COUNCIL MEMBER</span>
                        </div>
                    </div>
                </div>
				
                <div class="speaker-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp animated"  >
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="Board-of-Advisory-detail8803.html?id=7"><img src="{_theme_url_}track/Gallery/1656053173.jpg" alt=""></a></figure>
                            <span class="plus-icon fa fa-plus"></span>
                            <div class="social-links">
                                	                            </div>
                        </div>
                        <div class="info-box">
                            <h4 class="name"><a href="Board-of-Advisory-detail8803.html?id=7">DR. NALIN BILOCHAN</a></h4>
                            <span class="designation">ADVISORY COUNCIL MEMBER</span>
                        </div>
                    </div>
                </div>
				
                <div class="speaker-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp animated"  >
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="Board-of-Advisory-detailc3c9.html?id=8"><img src="{_theme_url_}track/Gallery/1656069354.jpg" alt=""></a></figure>
                            <span class="plus-icon fa fa-plus"></span>
                            <div class="social-links">
                                	                            </div>
                        </div>
                        <div class="info-box">
                            <h4 class="name"><a href="Board-of-Advisory-detailc3c9.html?id=8">DR. VIKAS KUMAR SINGH</a></h4>
                            <span class="designation">ADVISORY COUNCIL MEMBER</span>
                        </div>
                    </div>
                </div>


 

 

                

            </div>

        </div>

    </section>

    <!-- End Speakers Section -->



    <!-- Schedule Section -->

    <section class="schedule-section">

        <div class="anim-icons full-width">

            <span class="icon icon-circle-2"></span>

        </div>



        <div class="auto-container">

             



            <div class="schedule-tabs tabs-box">

                

                <div class="tabs-content">

                    <!--Tab-->

                    <div class="tab active-tab" id="tab-1">

                        <div class="schedule-timeline">

                            <!-- schedule Block -->

                            <div class="schedule-block">

                                <div class="inner-box">

                                    <div class="inner">

                                        <div class="date">

                                            <span><i class="icon flaticon-idea" style="font-size: 3rem;"></i></span>

                                        </div>

                                        <div class=" ">
											<h4 class="name">STUDENTS STUDY TIME</h4>
										</div>

                                        <p> All india Institute of Training and Education innovate such type of education system where no time boundation for education. Students can learn any time, any where and any situation. All india Institute of Training and Education give freedom in education system for students. Any students can learm in all india institute of training and education</p>

                                    </div>

                                </div>

                            </div>



                            <!-- schedule Block -->

                            <div class="schedule-block even">

                                <div class="inner-box">

                                    <div class="inner">

                                        <div class="date">

                                          <span><i class="icon flaticon-idea" style="font-size: 3rem;"></i></span>

                                        </div>

                                        <div class=" ">
											<h4 class="name">PLACEMENT ASSISTANCE</h4>
										</div>

                                        <p> All india Institute of Training and Education support our student after completion  of education for best opportunities.

</p>

                                    </div>

                                </div>

                            </div>



                            <!-- schedule Block -->

                            <div class="schedule-block">

                                <div class="inner-box">

                                    <div class="inner">

                                        <div class="date">

                                            <span><i class="icon flaticon-idea" style="font-size: 3rem;"></i></span>

                                        </div>

                                         <div class=" ">
											<h4 class="name">EASY TO ACCESS</h4>
										</div>

                                        <p> All india Institute of Training and Education giving easy access to lean education system to our students. All india Institute of Training and Education innovate fantastic way of education.

 </p>

                                    </div>

                                </div>

                            </div>



                            <!-- schedule Block -->

                            <div class="schedule-block even">

                                <div class="inner-box">

                                    <div class="inner">

                                        <div class="date">

                                           <span><i class="icon flaticon-idea" style="font-size: 3rem;"></i></span>

                                        </div>

                                        <div class=" ">
											<h4 class="name">STUDY ON THE GO

</h4>
										</div>

                                        <p> All india Institute of Training and Education creating such type of educational environment for students that they can learn any time, any where and any situation. All india Institute of Training and Education give freedom in education system for students. Any student can learn in all india institute of training and education.

 </p>

                                    </div>

                                </div>

                            </div>
							<!-- schedule Block -->

                            <div class="schedule-block">

                                <div class="inner-box">

                                    <div class="inner">

                                        <div class="date">

                                            <span><i class="icon flaticon-idea" style="font-size: 3rem;"></i></span>

                                        </div>

                                         <div class=" ">
											<h4 class="name">GET AN INNOVATIVE,
IN-DEPTH TRANSITION</h4>
										</div>

                                        <p>All india Institute of Training and Education  provides a unique platform to enhance knowledge in innovative & in-depth way. We provide complete support system access to our students so that they can learn the subject deeply & innovative way.



 </p>

                                    </div>

                                </div>

                            </div>



                            <!-- schedule Block -->

                            <div class="schedule-block even">

                                <div class="inner-box">

                                    <div class="inner">

                                        <div class="date">

                                           <span><i class="icon flaticon-idea" style="font-size: 3rem;"></i></span>

                                        </div>

                                        <div class=" ">
											<h4 class="name">PRACTICAL & INTERACTIVE
PARTICIPATION

</h4>
										</div>

                                        <p> All india Institute of Training and Education emphasis on practical & Interactive participation of students rather than theory. Students learn & grasp more in active participations rather than theory books. Our unique platform enables students to learn in interactive way.



 </p>

                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>



                    <!--Tab-->

                    <div class="tab" id="tab-2">

                        <div class="schedule-timeline">

                            <!-- schedule Block -->

                            <div class="schedule-block">

                                <div class="inner-box">

                                    <div class="inner">

                                        <div class="date">

                                            <span>8.00 AM <br> 10.00 AM</span>

                                        </div>

                                        <div class="speaker-info">

                                            <figure class="thumb">

                                                <img src="{_theme_url_}images/thumb-1.html" alt="">

                                            </figure>

                                            <span class="icon fa fa-microphone"></span>

                                            <h5 class="name">Tripp Mckay</h5>

                                            <span class="designation">Historian</span>

                                        </div>

                                        <h4><a href="schedule-detail.html">Social Profit from Venture (SROI) Gathering</a></h4>

                                    </div>

                                </div>

                            </div>



                            <!-- schedule Block -->

                            <div class="schedule-block even">

                                <div class="inner-box">

                                    <div class="inner">

                                        <div class="date">

                                            <span>10:00 am <br>11:00 am</span>

                                        </div>

                                        <div class="speaker-info">

                                            <figure class="thumb">

                                                <img src="{_theme_url_}images/thumb-2.html" alt="">

                                            </figure>

                                            <span class="icon fa fa-microphone"></span>

                                            <h5 class="name">Milana Myles</h5>

                                            <span class="designation">Art Critic</span>

                                        </div>

                                        <h4><a href="schedule-detail.html">Marine and Oceanic Government Workers</a></h4>

                                    </div>

                                </div>

                            </div>



                            <!-- schedule Block -->

                            <div class="schedule-block">

                                <div class="inner-box">

                                    <div class="inner">

                                        <div class="date">

                                            <span>10:00 am <br>11:00 am</span>

                                        </div>

                                        <div class="speaker-info">

                                            <figure class="thumb">

                                                <img src="{_theme_url_}images/thumb-3.html" alt="">

                                            </figure>

                                            <span class="icon fa fa-microphone"></span>

                                            <h5 class="name">Gabrielle Winn</h5>

                                            <span class="designation">Insurance consultant</span>

                                        </div>

                                        <h4><a href="schedule-detail.html">Home Life Open Entryway Open Occasion of 21</a></h4>

                                    </div>

                                </div>

                            </div>



                            <!-- schedule Block -->

                            <div class="schedule-block even">

                                <div class="inner-box">

                                    <div class="inner">

                                        <div class="date">

                                            <span>12:00 pm <br>01:00 pm</span>

                                        </div>

                                        <div class="speaker-info">

                                            <figure class="thumb">

                                                <img src="{_theme_url_}images/thumb-4.html" alt="">

                                            </figure>

                                            <span class="icon fa fa-microphone"></span>

                                            <h5 class="name">Rene Wells</h5>

                                            <span class="designation">Art Critic</span>

                                        </div>

                                        <h4><a href="schedule-detail.html">Developing Force Legislative issues of Arctics Motivation</a></h4>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>



                    <!--Tab-->

                    <div class="tab" id="tab-3">

                        <div class="schedule-timeline">

                            <!-- schedule Block -->

                            <div class="schedule-block">

                                <div class="inner-box">

                                    <div class="inner">

                                        <div class="date">

                                            <span>8.00 AM <br> 10.00 AM</span>

                                        </div>

                                        <div class="speaker-info">

                                            <figure class="thumb">

                                                <img src="{_theme_url_}images/thumb-1.html" alt="">

                                            </figure>

                                            <span class="icon fa fa-microphone"></span>

                                            <h5 class="name">Tripp Mckay</h5>

                                            <span class="designation">Historian</span>

                                        </div>

                                        <h4><a href="schedule-detail.html">Social Profit from Venture (SROI) Gathering</a></h4>

                                    </div>

                                </div>

                            </div>



                            <!-- schedule Block -->

                            <div class="schedule-block even">

                                <div class="inner-box">

                                    <div class="inner">

                                        <div class="date">

                                            <span>10:00 am <br>11:00 am</span>

                                        </div>

                                        <div class="speaker-info">

                                            <figure class="thumb">

                                                <img src="{_theme_url_}images/thumb-2.html" alt="">

                                            </figure>

                                            <span class="icon fa fa-microphone"></span>

                                            <h5 class="name">Milana Myles</h5>

                                            <span class="designation">Art Critic</span>

                                        </div>

                                        <h4><a href="schedule-detail.html">Marine and Oceanic Government Workers</a></h4>

                                    </div>

                                </div>

                            </div>



                            <!-- schedule Block -->

                            <div class="schedule-block">

                                <div class="inner-box">

                                    <div class="inner">

                                        <div class="date">

                                            <span>10:00 am <br>11:00 am</span>

                                        </div>

                                        <div class="speaker-info">

                                            <figure class="thumb">

                                                <img src="{_theme_url_}images/thumb-3.html" alt="">

                                            </figure>

                                            <span class="icon fa fa-microphone"></span>

                                            <h5 class="name">Gabrielle Winn</h5>

                                            <span class="designation">Insurance consultant</span>

                                        </div>

                                        <h4><a href="schedule-detail.html">Home Life Open Entryway Open Occasion of 21</a></h4>

                                    </div>

                                </div>

                            </div>



                            <!-- schedule Block -->

                            <div class="schedule-block even">

                                <div class="inner-box">

                                    <div class="inner">

                                        <div class="date">

                                            <span>12:00 pm <br>01:00 pm</span>

                                        </div>

                                        <div class="speaker-info">

                                            <figure class="thumb">

                                                <img src="{_theme_url_}images/thumb-4.html" alt="">

                                            </figure>

                                            <span class="icon fa fa-microphone"></span>

                                            <h5 class="name">Rene Wells</h5>

                                            <span class="designation">Art Critic</span>

                                        </div>

                                        <h4><a href="schedule-detail.html">Developing Force Legislative issues of Arctics Motivation</a></h4>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!--End schedule Section -->



    <!-- Call to Action -->

    <section class="call-to-action" style="background-image: url(images/1.jpg);">

        <div class="anim-icons full-width">

            <span class="icon icon-dotted-world left"></span>

            <span class="icon icon-dotted-world right"></span>

        </div>



        <div class="container-fluid">

            <div class="content-box wow fadeInUp">

                <div class="sec-title text-center">

                <span class="sub-title">Our campus have a lot to offer for our students</span>

                <h2>TAKE A CAMPUS TOUR</h2>

                
<a href="gallery.html" class="theme-btn btn-style-two rounded"><span class="btn-title">View All</span></a>
            </div>

                <div class="row">

            <!-- Gallery Block -->
            <div class="gallery-block col-lg-3 col-md-6 col-sm-12">

                <div class="image-box">

                    <figure class="image">
					
					<img src="{_theme_url_}#" alt="">
					<a href="track/Gallery/1600167052.jpg" class="lightbox-image"><img src="{_theme_url_}track/Gallery/1600167052.jpg" alt=""></a>
					
					</figure>

                    <div class="overlay-box">
<a href="track/Gallery/1600167052.jpg" class="lightbox-image">
                         

                        <h3>AIITE INDIA</h3>

                        </a>

                    </div>

                </div>

            </div>

            <div class="gallery-block col-lg-3 col-md-6 col-sm-12">

                <div class="image-box">

                    <figure class="image">
					
					<img src="{_theme_url_}#" alt="">
					<a href="track/Gallery/1600166792.jpg" class="lightbox-image"><img src="{_theme_url_}track/Gallery/1600166792.jpg" alt=""></a>
					
					</figure>

                    <div class="overlay-box">
<a href="track/Gallery/1600166792.jpg" class="lightbox-image">
                         

                        <h3>AIITE INDIA</h3>

                        </a>

                    </div>

                </div>

            </div>

            <div class="gallery-block col-lg-3 col-md-6 col-sm-12">

                <div class="image-box">

                    <figure class="image">
					
					<img src="{_theme_url_}#" alt="">
					<a href="track/Gallery/1600166802.jpg" class="lightbox-image"><img src="{_theme_url_}track/Gallery/1600166802.jpg" alt=""></a>
					
					</figure>

                    <div class="overlay-box">
<a href="track/Gallery/1600166802.jpg" class="lightbox-image">
                         

                        <h3>AIITE INDIA</h3>

                        </a>

                    </div>

                </div>

            </div>

            <div class="gallery-block col-lg-3 col-md-6 col-sm-12">

                <div class="image-box">

                    <figure class="image">
					
					<img src="{_theme_url_}#" alt="">
					<a href="track/Gallery/1600166812.jpg" class="lightbox-image"><img src="{_theme_url_}track/Gallery/1600166812.jpg" alt=""></a>
					
					</figure>

                    <div class="overlay-box">
<a href="track/Gallery/1600166812.jpg" class="lightbox-image">
                         

                        <h3>AIITE INDIA</h3>

                        </a>

                    </div>

                </div>

            </div>

            <div class="gallery-block col-lg-3 col-md-6 col-sm-12">

                <div class="image-box">

                    <figure class="image">
					
					<img src="{_theme_url_}#" alt="">
					<a href="track/Gallery/1600166823.jpg" class="lightbox-image"><img src="{_theme_url_}track/Gallery/1600166823.jpg" alt=""></a>
					
					</figure>

                    <div class="overlay-box">
<a href="track/Gallery/1600166823.jpg" class="lightbox-image">
                         

                        <h3>AIITE INDIA</h3>

                        </a>

                    </div>

                </div>

            </div>

            <div class="gallery-block col-lg-3 col-md-6 col-sm-12">

                <div class="image-box">

                    <figure class="image">
					
					<img src="{_theme_url_}#" alt="">
					<a href="track/Gallery/1648705411.png" class="lightbox-image"><img src="{_theme_url_}track/Gallery/1648705411.png" alt=""></a>
					
					</figure>

                    <div class="overlay-box">
<a href="track/Gallery/1648705411.png" class="lightbox-image">
                         

                        <h3>AIITE INDIA</h3>

                        </a>

                    </div>

                </div>

            </div>

            <div class="gallery-block col-lg-3 col-md-6 col-sm-12">

                <div class="image-box">

                    <figure class="image">
					
					<img src="{_theme_url_}#" alt="">
					<a href="track/Gallery/1648644074.png" class="lightbox-image"><img src="{_theme_url_}track/Gallery/1648644074.png" alt=""></a>
					
					</figure>

                    <div class="overlay-box">
<a href="track/Gallery/1648644074.png" class="lightbox-image">
                         

                        <h3>AIITE INDIA</h3>

                        </a>

                    </div>

                </div>

            </div>

            <div class="gallery-block col-lg-3 col-md-6 col-sm-12">

                <div class="image-box">

                    <figure class="image">
					
					<img src="{_theme_url_}#" alt="">
					<a href="track/Gallery/1648643033.jpg" class="lightbox-image"><img src="{_theme_url_}track/Gallery/1648643033.jpg" alt=""></a>
					
					</figure>

                    <div class="overlay-box">
<a href="track/Gallery/1648643033.jpg" class="lightbox-image">
                         

                        <h3>AIITE INDIA</h3>

                        </a>

                    </div>

                </div>

            </div>

 
           
 

             

        </div>

            </div>

        </div>

    </section>

    <!-- End Call to Action -->



    <!-- Pricing Section -->

    <section class="pricing-section">

       <div class="auto-container">

           <div class="sec-title text-center">

               

               <h2>ACHIEVEMENTS & AWARDS</h2>

              <a href="acheivement-awards.html" class="theme-btn btn-style-two rounded"><span class="btn-title">View All</span></a>

           </div>



           <div class="row">

            

         
		<div class="col-lg-3 col-md-6 d-flex align-items-stretch">
		<a href="acheivement-awards.html">
            <div class="member aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
              <div class="member-img">
               <img src="{_theme_url_}track/Testimonial/1581947339.jpg" class="img-fluid" alt="">
                 
              </div>
             <div class="member-info p-2">
                <h6>GURUKUL AWARD- 2018</h6>
                <span class="text-dark">02/09/2018</span>
              </div>
            </div>
			</a>
          </div>
		     

         
		<div class="col-lg-3 col-md-6 d-flex align-items-stretch">
		<a href="acheivement-awards.html">
            <div class="member aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
              <div class="member-img">
               <img src="{_theme_url_}track/Testimonial/1581947775.jpg" class="img-fluid" alt="">
                 
              </div>
             <div class="member-info p-2">
                <h6>INDIAN EDUCATIONAL ACHIEVERS AWARD 2019-20</h6>
                <span class="text-dark">25/06/2019</span>
              </div>
            </div>
			</a>
          </div>
		     

         
		<div class="col-lg-3 col-md-6 d-flex align-items-stretch">
		<a href="acheivement-awards.html">
            <div class="member aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
              <div class="member-img">
               <img src="{_theme_url_}track/Testimonial/1581947433.jpg" class="img-fluid" alt="">
                 
              </div>
             <div class="member-info p-2">
                <h6>GTF AWARD - 2018</h6>
                <span class="text-dark">29/09/2018</span>
              </div>
            </div>
			</a>
          </div>
		     

         
		<div class="col-lg-3 col-md-6 d-flex align-items-stretch">
		<a href="acheivement-awards.html">
            <div class="member aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
              <div class="member-img">
               <img src="{_theme_url_}track/Testimonial/1581947600.jpg" class="img-fluid" alt="">
                 
              </div>
             <div class="member-info p-2">
                <h6>ASIA – AFRICA ICT EXCELLENCE AWARD – 2018</h6>
                <span class="text-dark">02/12/2018</span>
              </div>
            </div>
			</a>
          </div>
		    		  
			</div>

        </div>

    </section>

    <!-- End Pricing Section -->



     <!-- Testimonial Section -->

    <section class="testimonial-section " style="background:#fff;">

        <div class="auto-container">

            <div class="sec-title text-center">

                <span class="sub-title">Testimonial</span>

                <h2>ALUMNI TESTIMONIALS</h2>

                <span class="divider"></span>

            </div>



            <div class="outer-box">

                <div class="testimonial-carousel owl-carousel owl-theme disable-nav">

                    <!-- Testimonial Block -->
                    <div class="testimonial-block">

                        <div class="inner-box">

                            <div class="text-box">

                                <p>AIITE much beyond just an “Institution” .It actually denotes a “Culture". Culture of excellence, empowerment, and enrichment. Being a part of AIITE, I felt blessed. AIITE has molded my personality and clarified my vision of the future. I am very grateful to the Institute for providing guidelines and motivation to inspire me to achieve my goals.</p>

                            </div>

                            <div class="info-box">
								
                                <div class="thumb"><img src="{_theme_url_}track/Testimonial/1555680372.jpg" alt=""></div>

                               

                                <h5 class="name">RAJ SINGH - PRODUCTION MANAGER & SAFETY CO-ORDINATOR (NAVIN FLUORINE INTERNATIONAL LIMITED) </h5>

                                

                            </div>

                        </div>

                    </div>

                     <div class="testimonial-block">

                        <div class="inner-box">

                            <div class="text-box">

                                <p>All India Institute of Training and Education creating such type of educational environment for students that they can learn any time, any where and any situation. </p>

                            </div>

                            <div class="info-box">
								
                                <div class="thumb"><img src="{_theme_url_}track/Testimonial/1648707398.png" alt=""></div>

                               

                                <h5 class="name">AIITE (ALL INDIA INSTITUTE OF TRAINING AND EDUCATION)</h5>

                                

                            </div>

                        </div>

                    </div>

                     <div class="testimonial-block">

                        <div class="inner-box">

                            <div class="text-box">

                                <p>Very much dedicated trainers and they will lead you through every step in your career even after you complete your course. Lot of people have got a life changing moment in this place</p>

                            </div>

                            <div class="info-box">
								
                                <div class="thumb"><img src="{_theme_url_}track/Testimonial/1648707376.png" alt=""></div>

                               

                                <h5 class="name"> AIITE (ALL INDIA INSTITUTE OF TRAINING AND EDUCATION) Student</h5>

                                

                            </div>

                        </div>

                    </div>

 
                    <!-- Testimonial Block -->
 

                </div>

                

            </div>

        </div>

    </section>

    <!--End Testimonial Section -->





    <!--Clients Section-->

    

    <!--End Clients Section-->





    <!-- Subscribe Section -->

    

    <!--End Subscribe Section -->
*/
?>