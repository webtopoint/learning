<?php
if(web_plugin('IS_PRIMARY_PAGE')){
    $sliders = $this->SiteModel->extra_setting('slider','all');
    if($sliders):
    ?>
     <section class="main-slider revolution-slider">
    	
        <div class="tp-banner-container">
            <div class="tp-banner">
                <ul>
                <?php $i = 0;
                foreach($sliders->result() as $row){
                    $active = !$i ? 'slidedown' : '';
                    $image = client_file($row->value);
                    echo '<li data-transition="'.$active.'" data-slotamount="1" data-masterspeed="1000" data-thumb="'.$image.'"  data-saveperformance="off"  data-title="'.$row->title.'">
                            <img src="'.$image.'"  alt=""  data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                                '.$row->content.'
                            </li>';
                    //echo '<li data-target="#demo" data-slide-to="'.$i++.'" class="'.$active.'"></li>';
                }
                ?>
                    
                </ul>
    
            </div>
        </div>
    </section>



    <?php
    endif;
}
else{
    ?>
    <section class="page-title" style="background-image:url({_head_image_});">
    	<div class="auto-container">
        	<div class="sec-title">
                <h1>{_page_name_}</h1>
                <div class="bread-crumb"><a href="index-2.html">Home</a> / <a href="#" class="current">{_page_name_}</a></div>
            </div>
        </div>
    </section>
    <?php
}
?>

    {_content_}
    <?php
    /*
    <!--Events Section-->
    <section class="welcome-section bg-color-fc tp-pt70 tp-pb70">
        <div class="auto-container">

            <div class="row clearfix">
                
                <!--Cause Column-->
                <div class="column default-featured-column links-column col-lg-4 col-md-12">
                    <article class="inner-box tp-mb-zm60">
                        <div class="vertical-links-outer events-post">
                            <div class="text-uppercase bg-black-grey tp-p20 tp-mb5">
                                <h2 class="white_color fw-b fs-24 tp-mr-zx80 tp-mr-zxs0">Join <span class="theme_color">our event</span> &amp; helping us by donation</h2>
                            </div>

                            <div class="bx-event-carousel">
                                <div class="link-block">
                                    <div class="default inner">
                                        <figure class="image-thumb"><img src="{_theme_url_}images/event/1.jpg" alt=""></figure>
                                        <h4 class="title">Charity For Education</h4>
                                        <ul class="event-held">
                                            <li><i class="fa fa-clock-o"></i> at 6.00 pm - 8.30 pm</li>
                                            <li> <i class="fa fa-map-marker"></i> 25 Newyork City.</li>
                                        </ul>
                                        <ul class="event-date">
                                            <li class="event-day">28</li>
                                            <li class="event-month">Aug</li>
                                        </ul>
                                    </div>
                                    <div class="alternate">
                                        <p class="desc">Lorem ipsum dolor sit amet et siu amet sio audiam si copiosaei mei purto </p>
                                        <a class="theme-btn btn-style-five btn-xs tp-mr10" href="#">Read More</a>
                                        <a class="theme-btn btn-style-two btn-xs tp-mr10" href="#">Join Now</a>
                                    </div>
                                </div>

                                <div class="link-block">
                                    <div class="default inner">
                                        <figure class="image-thumb"><img src="{_theme_url_}images/event/2.jpg" alt=""></figure>
                                        <h4 class="title">Urgent Clothe Needed</h4>
                                        <ul class="event-held">
                                            <li><i class="fa fa-clock-o"></i> at 6.00 pm - 8.30 pm</li>
                                            <li> <i class="fa fa-map-marker"></i> 25 Newyork City.</li>
                                        </ul>
                                        <ul class="event-date">
                                            <li class="event-day">28</li>
                                            <li class="event-month">Aug</li>
                                        </ul>
                                    </div>
                                    <div class="alternate">
                                        <p class="desc">Lorem ipsum dolor sit amet et siu amet sio audiam si copiosaei mei purto </p>
                                        <a class="theme-btn btn-style-five btn-xs tp-mr10" href="#">Read More</a>
                                        <a class="theme-btn btn-style-two btn-xs tp-mr10" href="#">Join Now</a>
                                    </div>
                                </div>

                                <div class="link-block">
                                    <div class="default inner">
                                        <figure class="image-thumb"><img src="{_theme_url_}images/event/1.jpg" alt=""></figure>
                                        <h4 class="title">Charity For Education</h4>
                                        <ul class="event-held">
                                            <li><i class="fa fa-clock-o"></i> at 6.00 pm - 8.30 pm</li>
                                            <li> <i class="fa fa-map-marker"></i> 25 Newyork City.</li>
                                        </ul>
                                        <ul class="event-date">
                                            <li class="event-day">28</li>
                                            <li class="event-month">Aug</li>
                                        </ul>
                                    </div>
                                    <div class="alternate">
                                        <p class="desc">Lorem ipsum dolor sit amet et siu amet sio audiam si copiosaei mei purto </p>
                                        <a class="theme-btn btn-style-five btn-xs tp-mr10" href="#">Read More</a>
                                        <a class="theme-btn btn-style-two btn-xs tp-mr10" href="#">Join Now</a>
                                    </div>
                                </div>

                                <div class="link-block">
                                    <div class="default inner">
                                        <figure class="image-thumb"><img src="{_theme_url_}images/event/2.jpg" alt=""></figure>
                                        <h4 class="title">Urgent Clothe Needed</h4>
                                        <ul class="event-held">
                                            <li><i class="fa fa-clock-o"></i> at 6.00 pm - 8.30 pm</li>
                                            <li> <i class="fa fa-map-marker"></i> 25 Newyork City.</li>
                                        </ul>
                                        <ul class="event-date">
                                            <li class="event-day">28</li>
                                            <li class="event-month">Aug</li>
                                        </ul>
                                    </div>
                                    <div class="alternate">
                                        <p class="desc">Lorem ipsum dolor sit amet et siu amet sio audiam si copiosaei mei purto </p>
                                        <a class="theme-btn btn-style-five btn-xs tp-mr10" href="#">Read More</a>
                                        <a class="theme-btn btn-style-two btn-xs tp-mr10" href="#">Join Now</a>
                                    </div>
                                </div>

                                <div class="link-block">
                                    <div class="default inner">
                                        <figure class="image-thumb"><img src="{_theme_url_}images/event/1.jpg" alt=""></figure>
                                        <h4 class="title">Charity For Education</h4>
                                        <ul class="event-held">
                                            <li><i class="fa fa-clock-o"></i> at 6.00 pm - 8.30 pm</li>
                                            <li> <i class="fa fa-map-marker"></i> 25 Newyork City.</li>
                                        </ul>
                                        <ul class="event-date">
                                            <li class="event-day">28</li>
                                            <li class="event-month">Aug</li>
                                        </ul>
                                    </div>
                                    <div class="alternate">
                                        <p class="desc">Lorem ipsum dolor sit amet et siu amet sio audiam si copiosaei mei purto </p>
                                        <a class="theme-btn btn-style-five btn-xs tp-mr10" href="#">Read More</a>
                                        <a class="theme-btn btn-style-two btn-xs tp-mr10" href="#">Join Now</a>
                                    </div>
                                </div>

                                <div class="link-block">
                                    <div class="default inner">
                                        <figure class="image-thumb"><img src="{_theme_url_}images/event/2.jpg" alt=""></figure>
                                        <h4 class="title">Urgent Clothe Needed</h4>
                                        <ul class="event-held">
                                            <li><i class="fa fa-clock-o"></i> at 6.00 pm - 8.30 pm</li>
                                            <li> <i class="fa fa-map-marker"></i> 25 Newyork City.</li>
                                        </ul>
                                        <ul class="event-date">
                                            <li class="event-day">28</li>
                                            <li class="event-month">Aug</li>
                                        </ul>
                                    </div>
                                    <div class="alternate">
                                        <p class="desc">Lorem ipsum dolor sit amet et siu amet sio audiam si copiosaei mei purto </p>
                                        <a class="theme-btn btn-style-five btn-xs tp-mr10" href="#">Read More</a>
                                        <a class="theme-btn btn-style-two btn-xs tp-mr10" href="#">Join Now</a>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </article>
                </div>

                <div class="col-lg-8 col-md-12">
                    <div class="row">
                
                        <!--Featured Column-->
                        <div class="column default-featured-column style-three col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <article class="inner-box tp-mb-zx60">
                                <figure class="image-box">
                                    <a href="#"><img src="{_theme_url_}images/resource/causes-u1.jpg" alt=""></a>
                                    <div class="post-tag">Urgent Cause</div>
                                </figure>
                                <div class="content-box">
                                    <h3><a href="#">Charity For Education</a></h3>
                                    <div class="column-info"><span class="raised-amount">Raised: $2570</span> Goal: $3500</div>
                                    <div class="text">Lorem ipsum dolor sit amet, eu qui modo expeten dis reformidans, ex sit appetere sententiae.. </div>
                                    <a href="#" class="theme-btn btn-style-two btn-sm tp-mr10">Donate Now</a>
                                    <a href="#" class="theme-btn btn-style-four btn-sm">Read More</a>
                                </div>
                            </article>
                        </div>
                        
                        <!--Featured Column-->
                        <div class="column default-featured-column style-three col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <article class="inner-box tp-mb-zx60">
                                <figure class="image-box">
                                    <a href="#"><img src="{_theme_url_}images/resource/team-image-b1.jpg" alt=""></a>
                                    <div class="post-tag"><span class="black_color roboto-font">30000+</span> Volunteer</div>
                                </figure>
                                <div class="content-box">
                                    <h3><a href="#">Meet Our Volunteers</a></h3>
                                    <div class="column-info">Join Our Volunteer & Helping Us</div>
                                    <div class="text">Lorem ipsum dolor sit amet, eu qui modo expeten dis reformidans, ex sit appetere sententiae.. </div>
                                    <a href="#" class="theme-btn btn-style-two btn-sm tp-mr10">Join With Us</a>
                                    <a href="#" class="theme-btn btn-style-four btn-sm">Volunteer</a>
                                </div>
                            </article>
                        </div>

                    </div>

                    <div class="row tp-mt40 tp-mt-zx0">
                        <div class="col-xs-12 col-sm-2">
                            <div class="tp-ml10 tp-ml-zx0 tp-mb-zx20">
                               <span class="normal-font theme_color fs-24">Our</span>
                               <h2 class="fw-b fs-30 lh-30">IMPACT</h2>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-10">
                            <div class="two-column-fluid style-two tp-ml20 tp-ml-zx0">
                                <div class="icon-box">
                                    <div class="icon"><span class="flaticon-shapes-1"></span></div>
                                    <div class="lower-box">
                                        <h4>$<span data-speed="1500" data-stop="7845910" class="count-text">7,845,910</span></h4>
                                        <span class="title">Raised</span>
                                    </div>
                                </div>
                                
                                <div class="icon-box">
                                    <div class="icon"><span class="flaticon-tool-4"></span></div>
                                    <div class="lower-box">
                                        <h4>$<span data-speed="1500" data-stop="13360" class="count-text">12,360</span></h4>
                                        <span class="title">Projects</span>
                                    </div>
                                </div>
                                
                                <div class="icon-box">
                                    <div class="icon"><span class="flaticon-favorite"></span></div>
                                    <div class="lower-box">
                                        <h4>$<span data-speed="1500" data-stop="78459" class="count-text">225,580</span></h4>
                                        <span class="title">Donations</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>
    </section>

    <!--Recent Causes Section-->
    <section class="recent-projects">
        <div class="auto-container">
            
            <div class="sec-title clearfix">
                <div class="pull-left">
                    <h2>Recent <span class="normal-font theme_color">Causes</span></h2>
                    <div class="text">Lorem ipsum dolor sit amet, cum at inani interesset, nisl fugit munere ad mel,vix an omnium dolor amet </div>
                </div>
                <div class="pull-right padd-top-30">
                    <a href="#" class="theme-btn btn-style-three">See All Projects</a>
                </div>
            </div>
            <div class="row clearfix">
                
                <!--Default Featured Column-->
                <div class="column default-featured-column style-two col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <article class="inner-box wow fadeInLeft" data-wow-delay="900ms" data-wow-duration="1500ms">
                        <figure class="image-box">
                            <a href="#"><img src="{_theme_url_}images/causes/1.jpg" alt=""></a>
                            <div class="donate-piechart">
                              <div class="piechart-block">
                                <div class="piechart style-one"  data-fg-color="rgba(250,119,68,1)" data-value=".75">
                                  <span>.75</span>
                                </div>
                              </div>
                            </div>
                        </figure>
                        <div class="content-box">
                            <h3><a href="#">Charity For Education</a></h3>
                            <div class="column-info"><span class="raised-amount">Raised: $2570</span> Goal: $3500</div>
                            <div class="text">Lorem ipsum dolor sit amet et siu amet amet audiam copiosaei mei.</div>
                            <a href="#" class="theme-btn btn-style-four btn-sm tp-mr10">Donate Now</a>
                            <a href="#" class="theme-btn btn-style-two btn-sm">Read More</a>
                        </div>
                    </article>
                </div>
                
                <!--Default Featured Column-->
                <div class="column default-featured-column style-two col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <article class="inner-box wow fadeInLeft" data-wow-delay="900ms" data-wow-duration="1500ms">
                        <figure class="image-box">
                            <a href="#"><img src="{_theme_url_}images/causes/2.jpg" alt=""></a>
                            <div class="donate-piechart">
                              <div class="piechart-block">
                                <div class="piechart style-one"  data-fg-color="rgba(250,119,68,1)" data-value=".65">
                                  <span>.65</span>
                                </div>
                              </div>
                            </div>
                        </figure>
                        <div class="content-box">
                            <h3><a href="#">Charity For Education</a></h3>
                            <div class="column-info"><span class="raised-amount">Raised: $2570</span> Goal: $3500</div>
                            <div class="text">Lorem ipsum dolor sit amet et siu amet amet audiam copiosaei mei.</div>
                            <a href="#" class="theme-btn btn-style-four btn-sm tp-mr10">Donate Now</a>
                            <a href="#" class="theme-btn btn-style-two btn-sm">Read More</a>
                        </div>
                    </article>
                </div>
                
                <!--Default Featured Column-->
                <div class="column default-featured-column style-two col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <article class="inner-box wow fadeInLeft" data-wow-delay="900ms" data-wow-duration="1500ms">
                        <figure class="image-box">
                            <a href="#"><img src="{_theme_url_}images/causes/3.jpg" alt=""></a>
                            <div class="donate-piechart">
                              <div class="piechart-block">
                                <div class="piechart style-one"  data-fg-color="rgba(250,119,68,1)" data-value=".85">
                                  <span>.85</span>
                                </div>
                              </div>
                            </div>
                        </figure>
                        <div class="content-box">
                            <h3><a href="#">Charity For Education</a></h3>
                            <div class="column-info"><span class="raised-amount">Raised: $2570</span> Goal: $3500</div>
                            <div class="text">Lorem ipsum dolor sit amet et siu amet amet audiam copiosaei mei.</div>
                            <a href="#" class="theme-btn btn-style-four btn-sm tp-mr10">Donate Now</a>
                            <a href="#" class="theme-btn btn-style-two btn-sm">Read More</a>
                        </div>
                    </article>
                </div>
                
                <!--Default Featured Column-->
                <div class="column default-featured-column style-two col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <article class="inner-box wow fadeInLeft" data-wow-delay="900ms" data-wow-duration="1500ms">
                        <figure class="image-box">
                            <a href="#"><img src="{_theme_url_}images/causes/4.jpg" alt=""></a>
                            <div class="donate-piechart">
                              <div class="piechart-block">
                                <div class="piechart style-one"  data-fg-color="rgba(250,119,68,1)" data-value=".75">
                                  <span>.75</span>
                                </div>
                              </div>
                            </div>
                        </figure>
                        <div class="content-box">
                            <h3><a href="#">Charity For Education</a></h3>
                            <div class="column-info"><span class="raised-amount">Raised: $2570</span> Goal: $3500</div>
                            <div class="text">Lorem ipsum dolor sit amet et siu amet amet audiam copiosaei mei.</div>
                            <a href="#" class="theme-btn btn-style-four btn-sm tp-mr10">Donate Now</a>
                            <a href="#" class="theme-btn btn-style-two btn-sm">Read More</a>
                        </div>
                    </article>
                </div>
                
            </div>
        </div>
    </section>
    
    <!--Main Features-->
    <section class="main-features parallax-section theme-overlay overlay-deep-white" style="background-image:url(images/parallax/image-1.jpg);">
        <div class="auto-container">
            <div class="title-box text-center tp-mb0">
                <h1 class="fs-36 tp-mb15">Charity For Education</h1>
                <h2>Working With US by helping & donation</h2>
                <div class="text">Lorem ipsum dolor sit amet, pro in harum aperiri persecuti, eu mea minim platonem, mea cetero intellegam eu. Mel ferri</div>
                <div class="">
                    <a class="theme-btn btn-style-four" href="#">Join With Us</a>
                    <a class="theme-btn btn-style-two" href="#">Donate Now</a>
                </div>
            </div>
        </div>
    </section>

    <!--Gallery Section-->
    <section class="gallery-section gutterless tp-pb0">
        <div class="container">
            <div class="row">            
                <div class="sec-title text-center">
                    <h2>Our <span class="normal-font theme_color">Gallery</span></h2>
                    <div class="text">Lorem ipsum dolor sit amet, cum at inani interes setnisl omnium dolor amet amet qco modo cum text </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            
            <!--Filter-->
            <div class="filters text-center">
                <ul class="filter-tabs filter-btns clearfix anim-3-all">
                    <li class="active filter" data-role="button" data-filter="all">All</li>
                    <li class="filter" data-role="button" data-filter=".environment">Child</li>
                    <li class="filter" data-role="button" data-filter=".eco">Charity</li>
                    <li class="filter" data-role="button" data-filter=".energy">Volunteering</li>
                    <li class="filter" data-role="button" data-filter=".animals">Sponsorship</li>
                    <li class="filter" data-role="button" data-filter=".plants">Plants</li>
                </ul>
            </div>
            
            <!--Filter List-->
            <div class="row filter-list clearfix">
                
                <!--Column-->
                <div class="column mix mix_all eco plants col-md-3 col-sm-6 col-xs-12">
                    <!--Default Portfolio Item-->
                    <div class="default-portfolio-item">
                        <div class="inner-box text-center">
                            <!--Image Box-->
                            <figure class="image-box"><img src="{_theme_url_}images/gallery/s1.jpg" alt=""></figure>
                            <div class="overlay-box">
                                <div class="inner-content">
                                    <div class="content">
                                        <a class="arrow lightbox-image" href="images/gallery/s1.jpg" title="Image Caption Here"><span class="icon flaticon-cross-4"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Column-->
                <div class="column mix mix_all environment  energy animals col-md-3 col-sm-6 col-xs-12">
                    <!--Default Portfolio Item-->
                    <div class="default-portfolio-item">
                        <div class="inner-box text-center">
                            <!--Image Box-->
                            <figure class="image-box"><img src="{_theme_url_}images/gallery/s2.jpg" alt=""></figure>
                            <div class="overlay-box">
                                <div class="inner-content">
                                    <div class="content">
                                        <a class="arrow lightbox-image" href="images/gallery/s2.jpg" title="Image Caption Here"><span class="icon flaticon-cross-4"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Column-->
                <div class="column mix mix_all environment eco animals col-md-3 col-sm-6 col-xs-12">
                    <!--Default Portfolio Item-->
                    <div class="default-portfolio-item">
                        <div class="inner-box text-center">
                            <!--Image Box-->
                            <figure class="image-box"><img src="{_theme_url_}images/gallery/s3.jpg" alt=""></figure>
                            <div class="overlay-box">
                                <div class="inner-content">
                                    <div class="content">
                                        <a class="arrow lightbox-image" href="images/gallery/s3.jpg" title="Image Caption Here"><span class="icon flaticon-cross-4"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Column-->
                <div class="column mix mix_all environment eco energy animals plants col-md-3 col-sm-6 col-xs-12">
                    <!--Default Portfolio Item-->
                    <div class="default-portfolio-item">
                        <div class="inner-box text-center">
                            <!--Image Box-->
                            <figure class="image-box"><img src="{_theme_url_}images/gallery/s4.jpg" alt=""></figure>
                            <div class="overlay-box">
                                <div class="inner-content">
                                    <div class="content">
                                        <a class="arrow lightbox-image" href="images/gallery/s4.jpg" title="Image Caption Here"><span class="icon flaticon-cross-4"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Column-->
                <div class="column mix mix_all energy animals plants col-md-3 col-sm-6 col-xs-12">
                    <!--Default Portfolio Item-->
                    <div class="default-portfolio-item">
                        <div class="inner-box text-center">
                            <!--Image Box-->
                            <figure class="image-box"><img src="{_theme_url_}images/gallery/s5.jpg" alt=""></figure>
                            <div class="overlay-box">
                                <div class="inner-content">
                                    <div class="content">
                                        <a class="arrow lightbox-image" href="images/gallery/s5.jpg" title="Image Caption Here"><span class="icon flaticon-cross-4"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Column-->
                <div class="column mix mix_all environment eco energy animals plants col-md-3 col-sm-6 col-xs-12">
                    <!--Default Portfolio Item-->
                    <div class="default-portfolio-item">
                        <div class="inner-box text-center">
                            <!--Image Box-->
                            <figure class="image-box"><img src="{_theme_url_}images/gallery/s6.jpg" alt=""></figure>
                            <div class="overlay-box">
                                <div class="inner-content">
                                    <div class="content">
                                        <a class="arrow lightbox-image" href="images/gallery/s6.jpg" title="Image Caption Here"><span class="icon flaticon-cross-4"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Column-->
                <div class="column mix mix_all environment  energy animals col-md-3 col-sm-6 col-xs-12">
                    <!--Default Portfolio Item-->
                    <div class="default-portfolio-item">
                        <div class="inner-box text-center">
                            <!--Image Box-->
                            <figure class="image-box"><img src="{_theme_url_}images/gallery/s7.jpg" alt=""></figure>
                            <div class="overlay-box">
                                <div class="inner-content">
                                    <div class="content">
                                        <a class="arrow lightbox-image" href="images/gallery/s7.jpg" title="Image Caption Here"><span class="icon flaticon-cross-4"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Column-->
                <div class="column mix mix_all environment eco animals col-md-3 col-sm-6 col-xs-12">
                    <!--Default Portfolio Item-->
                    <div class="default-portfolio-item">
                        <div class="inner-box text-center">
                            <!--Image Box-->
                            <figure class="image-box"><img src="{_theme_url_}images/gallery/s8.jpg" alt=""></figure>
                            <div class="overlay-box">
                                <div class="inner-content">
                                    <div class="content">
                                        <a class="arrow lightbox-image" href="images/gallery/s8.jpg" title="Image Caption Here"><span class="icon flaticon-cross-4"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
    </section>

    <!--Intro Section-->
    <section class="subscribe-intro">
        <div class="auto-container">
            <div class="row clearfix">
                <!--Column-->
                <div class="column col-md-9 col-sm-12 col-xs-12">
                    <h2>Subcribe for Newsletter</h2>
                    There are many variations of passages of Lorem Ipsum available but the majority have 
                </div>
                <!--Column-->
                <div class="column col-md-3 col-sm-12 col-xs-12">
                    <div class="text-right padd-top-20">
                        <a href="#" class="theme-btn btn-style-one">Subscribe Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!--Mission Section-->
    <section class="main-features tp-pt60 tp-pb10">
        <div class="auto-container">

            <div class="sec-title text-center">
                <h2>Our <span class="normal-font theme_color">Mission</span></h2>
                <div class="text">Lorem ipsum dolor sit amet, cum at inani interes setnisl omnium dolor amet amet qco modo cum text </div>
            </div>
            
            <div class="row clearfix">
                
                <!--Default Icon Column-->
                <div class="default-icon-column col-lg-3 col-md-6 col-xs-12">
                    <article class="inner-box text-center">
                        <div class="icon-box center">
                            <div class="icon"><span class="flaticon-illumination"></span></div>
                        </div>
                        <h3>Charity For Education</h3>
                        <div class="text">Lorem ipsum dolor sit amet et siu amet amet audiam copiosaei mei purto dolor timeam mea </div>
                    </article>
                </div>
                
                <!--Default Icon Column-->
                <div class="default-icon-column col-lg-3 col-md-6 col-xs-12">
                    <article class="inner-box text-center">
                        <div class="icon-box center">
                            <div class="icon"><span class="flaticon-arrows-3"></span></div>
                        </div>
                        <h3>Feed for hungry child</h3>
                        <div class="text">Lorem ipsum dolor sit amet et siu amet amet audiam copiosaei mei purto dolor timeam mea </div>
                    </article>
                </div>
                
                <!--Default Icon Column-->
                <div class="default-icon-column col-lg-3 col-md-6 col-xs-12">
                    <article class="inner-box text-center">
                        <div class="icon-box center">
                            <div class="icon"><span class="flaticon-nature-1"></span></div>
                        </div>
                        <h3>Home for homeless</h3>
                        <div class="text">Lorem ipsum dolor sit amet et siu amet amet audiam copiosaei mei purto dolor timeam mea </div>
                    </article>
                </div>
                
                <!--Default Icon Column-->
                <div class="default-icon-column col-lg-3 col-md-6 col-xs-12">
                    <article class="inner-box text-center">
                        <div class="icon-box center">
                            <div class="icon"><span class="flaticon-summer-3"></span></div>
                        </div>
                        <h3>Clean water for people</h3>
                        <div class="text">Lorem ipsum dolor sit amet et siu amet amet audiam copiosaei mei purto dolor timeam mea </div>
                    </article>
                </div>
                
                <!--Default Icon Column-->
                <div class="default-icon-column col-lg-3 col-md-6 col-xs-12">
                    <article class="inner-box text-center">
                        <div class="icon-box center">
                            <div class="icon"><span class="flaticon-technology-13"></span></div>
                        </div>
                        <h3>Charity For Education</h3>
                        <div class="text">Lorem ipsum dolor sit amet et siu amet amet audiam copiosaei mei purto dolor timeam mea </div>
                    </article>
                </div>
                
                <!--Default Icon Column-->
                <div class="default-icon-column col-lg-3 col-md-6 col-xs-12">
                    <article class="inner-box text-center">
                        <div class="icon-box center">
                            <div class="icon"><span class="flaticon-summer"></span></div>
                        </div>
                        <h3>Feed for hungry child</h3>
                        <div class="text">Lorem ipsum dolor sit amet et siu amet amet audiam copiosaei mei purto dolor timeam mea </div>
                    </article>
                </div>
                
                <!--Default Icon Column-->
                <div class="default-icon-column col-lg-3 col-md-6 col-xs-12">
                    <article class="inner-box text-center">
                        <div class="icon-box center">
                            <div class="icon"><span class="flaticon-nature-11"></span></div>
                        </div>
                        <h3>Home for homeless</h3>
                        <div class="text">Lorem ipsum dolor sit amet et siu amet amet audiam copiosaei mei purto dolor timeam mea </div>
                    </article>
                </div>
                
                <!--Default Icon Column-->
                <div class="default-icon-column col-lg-3 col-md-6 col-xs-12">
                    <article class="inner-box text-center">
                        <div class="icon-box center">
                            <div class="icon"><span class="flaticon-dog"></span></div>
                        </div>
                        <h3>Clean water for people</h3>
                        <div class="text">Lorem ipsum dolor sit amet et siu amet amet audiam copiosaei mei purto dolor timeam mea </div>
                    </article>
                </div>
                
            </div>
        </div>
    </section>

    <!--Testimonials-->
    <section class="testimonials-section bg-color-f5">
        <div class="auto-container">
            
            <div class="sec-title text-center">
                <h2 class="black_color">Testi<span class="normal-font theme_color">Monials</span></h2>
                <div class="text black_color">Lorem ipsum dolor sit amet, cum at inani interes setnisl omnium dolor amet amet qco modo cum text </div>
            </div>
            
            <!--Slider-->      
            <div class="testimonials-slider testimonials-carousel">
                
                <!--Slide-->
                <article class="slide-item">
                    
                    <div class="info-box">
                        <figure class="image-box"><img src="{_theme_url_}images/resource/testi-image-1.jpg" alt=""></figure>
                        <h3>Mark Pine</h3>
                        <p class="designation">Rome, Italy</p>
                    </div>
                    
                    <div class="slide-text">
                        <p>“But I must explain to you the how all this mistaken idea of thealorem qco denouncing pleasure”</p>
                    </div>
                </article>
                
                <!--Slide-->
                <article class="slide-item">
                    
                    <div class="info-box">
                        <figure class="image-box"><img src="{_theme_url_}images/resource/testi-image-2.jpg" alt=""></figure>
                        <h3>Mark Pine</h3>
                        <p class="designation">Rome, Italy</p>
                    </div>
                    
                    <div class="slide-text">
                        <p>“But I must explain to you the how all this mistaken idea of thealorem qco denouncing pleasure”</p>
                    </div>
                </article>
                
                <!--Slide-->
                <article class="slide-item">
                    
                    <div class="info-box">
                        <figure class="image-box"><img src="{_theme_url_}images/resource/testi-image-3.jpg" alt=""></figure>
                        <h3>Mark Pine</h3>
                        <p class="designation">Rome, Italy</p>
                    </div>
                    
                    <div class="slide-text">
                        <p>“But I must explain to you the how all this mistaken idea of thealorem qco denouncing pleasure”</p>
                    </div>
                </article>
                
                
            </div>
            
        </div>    
    </section>    
    
    <!--Blog News Section-->
    <section class="blog-news-section latest-news">
    	<div class="auto-container">
        	
            <div class="sec-title text-center">
                <h2>Latest <span class="normal-font theme_color">News</span></h2>
                <div class="text">Lorem ipsum dolor sit amet, cum at inani interessetnisl omnium dolor amet amet qco modo cum text </div>
            </div>
        	<div class="row clearfix">
                
                <!--News Column-->
                <div class="column blog-news-column col-lg-4 col-md-6 col-sm-6 col-xs-12">
                	<article class="inner-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                		<figure class="image-box">
                        	<a href="#"><img src="{_theme_url_}images/blog/1.jpg" alt=""></a>
                            <div class="news-date">28<span class="month">OCT</span></div>
                        </figure>
                        <div class="content-box">
                        	<h3><a href="#">Lates blog post with image</a></h3>
                        	<div class="post-info clearfix">
                            	<div class="post-author">Posted by Rashed Kabir</div>
                                <div class="post-options clearfix">
                                	<a href="#" class="comments-count"><span class="icon flaticon-communication-2"></span> 6</a>
                                    <a href="#" class="fav-count"><span class="icon flaticon-favorite-1"></span> 14</a>
                                </div>
                            </div>
                            <div class="text">Lorem ipsum dolor sit amet, consectetur adipi elit sed do eiusmod tempor incididunt ut modo labore et dolore magna aliqua veniam...</div>
                            <a href="#" class="theme-btn read-more">Read More</a>
                        </div>
                    </article>
                </div>
                
                <!--News Column-->
                <div class="column blog-news-column col-lg-4 col-md-6 col-sm-6 col-xs-12">
                	<article class="inner-box wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                		<figure class="image-box">
                        	<a href="#"><img src="{_theme_url_}images/blog/2.jpg" alt=""></a>
                            <div class="news-date">22<span class="month">APR</span></div>
                        </figure>
                        <div class="content-box">
                        	<h3><a href="#">Lates blog post with image</a></h3>
                        	<div class="post-info clearfix">
                            	<div class="post-author">Posted by Rashed Kabir</div>
                                <div class="post-options clearfix">
                                	<a href="#" class="comments-count"><span class="icon flaticon-communication-2"></span> 6</a>
                                    <a href="#" class="fav-count"><span class="icon flaticon-favorite-1"></span> 14</a>
                                </div>
                            </div>
                            <div class="text">Lorem ipsum dolor sit amet, consectetur adipi elit sed do eiusmod tempor incididunt ut modo labore et dolore magna aliqua veniam...</div>
                            <a href="#" class="theme-btn read-more">Read More</a>
                        </div>
                    </article>
                </div>
                
                <!--News Column-->
                <div class="column blog-news-column col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <article class="inner-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <figure class="image-box">
                            <a href="#"><img src="{_theme_url_}images/blog/3.jpg" alt=""></a>
                            <div class="news-date">28<span class="month">OCT</span></div>
                        </figure>
                        <div class="content-box">
                            <h3><a href="#">Lates blog post with image</a></h3>
                            <div class="post-info clearfix">
                                <div class="post-author">Posted by Rashed Kabir</div>
                                <div class="post-options clearfix">
                                    <a href="#" class="comments-count"><span class="icon flaticon-communication-2"></span> 6</a>
                                    <a href="#" class="fav-count"><span class="icon flaticon-favorite-1"></span> 14</a>
                                </div>
                            </div>
                            <div class="text">Lorem ipsum dolor sit amet, consectetur adipi elit sed do eiusmod tempor incididunt ut modo labore et dolore magna aliqua veniam...</div>
                            <a href="#" class="theme-btn read-more">Read More</a>
                        </div>
                    </article>
                </div>
                
                
            </div>
        </div>
    </section>
    
    <!--Sponsors Section-->
    <section class="sponsors-section">
        <div class="auto-container">
            <div class="slider-outer">
                <!--Sponsors Slider-->
                <ul class="sponsors-slider">
                    <li><a href="#"><img src="{_theme_url_}images/clients/logo-1.png" alt=""></a></li>
                    <li><a href="#"><img src="{_theme_url_}images/clients/logo-2.png" alt=""></a></li>
                    <li><a href="#"><img src="{_theme_url_}images/clients/logo-3.png" alt=""></a></li>
                    <li><a href="#"><img src="{_theme_url_}images/clients/logo-4.png" alt=""></a></li>
                    <li><a href="#"><img src="{_theme_url_}images/clients/logo-5.png" alt=""></a></li>
                </ul>
            </div>            
        </div>
    </section>
    
    
    
  */
  ?>                              