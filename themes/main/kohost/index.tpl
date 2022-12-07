        
        <?php
        
        echo Modules :: run('addons/get_header',1,'static');
        
        ?>

        <!--domain search promo start-->
        <section class="position-relative zindex-2">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-9 col-lg-8 col-12">
                        <div class="domain-search-wrap border gray-light-bg">
                            <h4 class="text-center">Looking For Domain Name?</h4>
                            <form action="/domain-checker" method="GET" class="domain-search-form my-4">
                                <input type="text" name="domain" id="domain" class="form-control" placeholder="yourdomainname.com" />
                                <div class="select-group">
                                    <!--select name="domainType" class="form-control">
                                        <option value="com" selected>.com</option>
                                        <option value="net">.net</option>
                                        <option value="io">.io</option>
                                        <option value="info">.info</option>
                                        <option value="store">.store</option>
                                        <option value="store">.org</option>
                                    </select -->
                                    <button type="submit" class="btn btn-brand-01"><i class="fas fa-search pr-1"></i> Search</button>
                                </div>
                            </form>
                            <div class="domain-list-wrap text-center">
                                <?php
                                echo Modules :: run('domain/domain_list_wrap');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--domain search promo end-->
        <?php
           echo Modules :: run('page/schema',1,'static');
        
        //echo $page_content;
        ?>



<div style="display:none">
        <!--application hosting promo start-->
        <section class="appliction-hosting ptb-100 ">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-9 col-lg-8">
                        <div class="section-heading text-center mb-5">
                            <h2>Application Hosting Optimised for WordPress & more</h2>
                            <p class="lead">Our web hosting platform has been fully optimised to offer outstanding performance for your web applications, delivering speeds of up to16x faster.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="application-hosting-wrap">
                            <ul class="app-list">
                                <li><a href="#" class="bg-white shadow text-dark"><img src="<?=theme_base()?>assets/img/icons/wordpress-icon-color.svg" alt="icon"> <span>WordPress</span></a></li>
                                <li><a href="#" class="bg-white shadow text-dark"><img src="<?=theme_base()?>assets/img/icons/joomla-icon-color.svg" alt="icon"> <span>Joomla</span></a></li>
                                <li><a href="#" class="bg-white shadow text-dark"><img src="<?=theme_base()?>assets/img/icons/magento-icon-color.svg" alt="icon"> <span>Megento</span></a></li>
                                <li><a href="#" class="bg-white shadow text-dark"><img src="<?=theme_base()?>assets/img/icons/opencart-icon-color.svg" alt="icon"> <span>OpenCart</span></a></li>
                                <li><a href="#" class="bg-white shadow text-dark"><img src="<?=theme_base()?>assets/img/icons/prestashop-icon-color.svg" alt="icon"> <span>Prestashop</span></a></li>
                                <li><a href="#" class="bg-white shadow text-dark"><img src="<?=theme_base()?>assets/img/icons/drupal-icon-color.svg" alt="icon"> <span>Drupal</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--application hosting promo end-->

        <!--call to action start-->
        <section class="ptb-60 primary-bg">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-7 col-lg-6">
                        <div class="cta-content-wrap text-white">
                            <h2 class="text-white">Best Cloud Hosting <br> With Trusted Service</h2>
                            <p>Objectively innovate high standards in methodologies vis-a-vis sustainable compellingly maintain multidisciplinary process proactively streamline mission-critical information via quality imperatives. </p>
                        </div>
                        <div class="action-btns mt-4">
                            <a href="#" class="btn btn-brand-03"> Get Start Now </a>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-4">
                        <div class="cta-img-wrap text-center">
                            <img src="<?=theme_base()?>assets/img/cta-new.svg" class="img-fluid" alt="server room">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--call to action end-->

        <!--services section start-->
        <section class="ptb-100 service-section-wrap">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-7">
                        <div class="section-heading text-center">
                            <h2>Our Tools And Services For Optimize Website Building</h2>
                            <p>Uniquely repurpose strategic core competencies with progressive content. Assertively transition ethical imperatives and collaborative manufactured products. </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="single-service p-5 rounded border gray-light-bg">
                            <div class="service-header d-flex align-items-center justify-content-between">
                                <h4><span class="h5 text-uppercase">Easy & First</span> <br>Website Building</h4>
                                <span class="fas fa-shield-alt fa-3x color-primary"></span>
                            </div>
                            <p>Globally fashion client-focused synergy for accurate synergy. Quickly network cost effective ideas rather than standardized leadership. Interactively syndicate alternative opportunities via ubiquitous systems. </p>
                            <a href="#" class="btn btn-outline-brand-02 mt-3">Learn More</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="single-service p-5 rounded border gray-light-bg">
                            <div class="service-header d-flex align-items-center justify-content-between">
                                <h4><span class="h5 text-uppercase">Suitable For All Users</span> <br>Managed WordPress</h4>
                                <span class="fab fa-wordpress fa-3x color-primary"></span>
                            </div>
                            <p>Globally fashion client-focused synergy for accurate synergy. Quickly network cost effective ideas rather than standardized leadership. Interactively syndicate alternative opportunities via ubiquitous systems. </p>
                            <a href="#" class="btn btn-outline-brand-02 mt-3">Learn More</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="single-service p-5 rounded border gray-light-bg">
                            <div class="service-header d-flex align-items-center justify-content-between">
                                <h4><span class="h5 text-uppercase">Commitment To</span> <br>Dedicated Support</h4>
                                <span class="fas fa-headset fa-3x color-primary"></span>
                            </div>
                            <p>Globally fashion client-focused synergy for accurate synergy. Quickly network cost effective ideas rather than standardized leadership. Interactively syndicate alternative opportunities via ubiquitous systems. </p>
                            <a href="#" class="btn btn-outline-brand-02 mt-3">Learn More</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="single-service p-5 rounded border gray-light-bg">
                            <div class="service-header d-flex align-items-center justify-content-between">
                                <h4><span class="h5 text-uppercase">Easy & Smooth</span> <br>Website Transfer</h4>
                                <span class="fas fa-dolly-flatbed fa-3x color-primary"></span>
                            </div>
                            <p>Globally fashion client-focused synergy for accurate synergy. Quickly network cost effective ideas rather than standardized leadership. Interactively syndicate alternative opportunities via ubiquitous systems. </p>
                            <a href="#" class="btn btn-outline-brand-02 mt-3">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--services section end-->

        <!--pricing section start-->
        <section class="pricing-section ptb-100 gray-light-bg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-9 col-lg-8">
                        <div class="section-heading text-center mb-4">
                            <h2>Our Flexible Pricing Plan</h2>
                            <p>
                                Professional hosting at an affordable price. Distinctively recaptiualize principle-centered
                                core competencies through client-centered
                                core competencies.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-md-center justify-content-center">
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="text-center bg-white single-pricing-pack-2 mt-4 rounded border">
                            <div class="pricing-icon">
                                <img src="<?=theme_base()?>assets/img/dadicate-web-hosting.svg" width="60" alt="hosing">
                            </div>
                            <h4 class="package-title">Web Hosting</h4>
                            <p class="mb-4">For small business</p>
                            <div class="pricing-price pt-4">
                                <small>Starting at</small>
                                <div class="h2">$8.99 <span class="price-cycle h4">/mo</span></div>
                            </div>
                            <a href="#" class="btn btn-brand-01">Get Started Now</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="popular-price text-center bg-white single-pricing-pack-2 mt-4 rounded border">
                            <div class="pricing-icon">
                                <img src="<?=theme_base()?>assets/img/vps-hosting.svg" width="60" alt="hosing">
                            </div>
                            <h4 class="package-title">VPS Hosting</h4>
                            <p class="mb-4">For medium business</p>
                            <div class="pricing-price pt-4">
                                <small>Starting at</small>
                                <div class="h2">$8.99 <span class="price-cycle h4">/mo</span></div>
                            </div>
                            <a href="#" class="btn btn-brand-01">Get Started Now</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="text-center bg-white single-pricing-pack-2 mt-4 rounded border">
                            <div class="pricing-icon">
                                <img src="<?=theme_base()?>assets/img/cloud-hosting.svg" width="60" alt="hosing">
                            </div>
                            <h4 class="package-title">Cloud Hosting</h4>
                            <p class="mb-4">Large and enterprise business</p>
                            <div class="pricing-price pt-4">
                                <small>Starting at</small>
                                <div class="h2">$8.99 <span class="price-cycle h4">/mo</span></div>
                            </div>
                            <a href="#" class="btn btn-brand-01">Get Started Now</a>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="support-cta text-center mt-5">
                            <h5 class="mb-1"><span class="ti-headphone-alt color-primary mr-3"></span>We're Here to Help You
                            </h5>
                            <p>Have some questions? <a href="#">Chat with us now</a>, or <a href="#">send us an email</a> to
                                get in touch.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--pricing section end-->

        <!--features section start-->
        <div class="feature-section ptb-100 ">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-7 col-lg-6">
                        <div class="feature-content-wrap">
                            <h2>99% Cloud Hosing High-speed Cutting-edge Platform</h2>
                            <p>Authoritatively transform functionalized information without cross-platform convergence. Quickly reconceptualize cross-unit e-markets without superior products. Appropriately foster timely collaboration and idea-sharing rather than magnetic potentialities. Authoritatively restore high standards in outsourcing whereas vertical meta-services. Compellingly reconceptualize out-of-the-box outsourcing through plug-and-play synergy.</p>
                            <a href="#" class="btn btn-outline-brand-01 mt-3" target="_blank">Learn More</a>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-6 d-none d-md-block d-lg-block">
                        <div class="feature-img-wrap text-center">
                            <img src="<?=theme_base()?>assets/img/services.svg" class="img-fluid" alt="server room">
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-between mt-5">
                    <div class="col-md-5 col-lg-6 d-none d-md-block d-lg-block">
                        <div class="feature-img-wrap text-center">
                            <img src="<?=theme_base()?>assets/img/create-website.svg" class="img-fluid" alt="server room">
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-6">
                        <div class="feature-content-wrap">
                            <h2>Our Own Interfaces for All Management Processes</h2>
                            <p>Authoritatively transform functionalized information without cross-platform convergence. Quickly reconceptualize cross-unit e-markets without superior products. Appropriately foster timely collaboration and idea-sharing rather than magnetic potentialities. Authoritatively restore high standards in outsourcing whereas vertical meta-services. Compellingly reconceptualize out-of-the-box outsourcing through plug-and-play synergy.</p>
                            <a href="#" class="btn btn-outline-brand-01 mt-3" target="_blank">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--features section end-->

        <!--call to action start-->
        <section class="ptb-60 primary-bg">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-12 col-lg-6">
                        <div class="cta-content-wrap text-white">
                            <h2 class="text-white">24/7 Expert Hosting Support Our Customers Love</h2>
                            <p>Objectively innovate high compellingly maintain progressively pursue mission-critical information quality imperatives. </p>
                        </div>
                        <div class="support-action d-inline-flex flex-wrap">
                            <a href="mailto:support@yourdomain.com" class="mr-3"><i class="fas fa-comment mr-1 color-accent"></i> <span>support@yourdomain.com</span></a>
                            <a href="tel:+00123456789" class="mb-0"><i class="fas fa-phone-alt mr-1 color-accent"></i> <span>+00123456789</span></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 d-none d-lg-block">
                        <div class="cta-img-wrap text-center">
                            <img src="<?=theme_base()?>assets/img/call-center-support.svg" width="250" class="img-fluid" alt="server room">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--call to action end-->


        <!--testimonial section start-->
        <section class="review-section ptb-100 ">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-7">
                        <div class="section-heading text-center">
                            <h2>Our Lovely Client Say About Us</h2>
                            <p>Uniquely repurpose strategic core competencies with progressive content. Assertively transition ethical imperatives and collaborative manufactured products. </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="owl-carousel owl-theme client-testimonial-1 dot-bottom-center custom-dot">
                        <div class="item">
                            <div class="border single-review-wrap bg-white p-4 m-3">
                                <div class="review-body">
                                    <h5>Amazing template</h5>
                                    <p>Distinctively foster maintainable metrics whereas multidisciplinary process improvements. Distinctively foster maintainable metrics whereas multidisciplinary process improvements. Objectively implement strategic niches through.</p>
                                </div>
                                <div class="review-author d-flex align-items-center">
                                    <div class="author-avatar">
                                        <img src="<?=theme_base()?>assets/img/client-2.jpg" width="64" alt="author" class="rounded-circle shadow-sm img-fluid mr-3" />
                                        <span>“</span>
                                    </div>
                                    <div class="review-info">
                                        <h6 class="mb-0">Ana Joly</h6>
                                        <span>BizBite</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="border single-review-wrap bg-white p-4 m-3">
                                <div class="review-body">
                                    <h5>Best template for app</h5>
                                    <p>Efficiently innovate customized growth strategies whereas error-free paradigms. Monotonectally enhance stand-alone data with prospective innovation.</p>
                                </div>
                                <div class="review-author d-flex align-items-center">
                                    <div class="author-avatar">
                                        <img src="<?=theme_base()?>assets/img/client-1.jpg" width="64" alt="author" class="rounded-circle shadow-sm img-fluid mr-3" />
                                        <span>“</span>
                                    </div>
                                    <div class="review-info">
                                        <h6 class="mb-0">Tony Roy</h6>
                                        <span>BizBite</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="border single-review-wrap bg-white p-4 m-3">
                                <div class="review-body">
                                    <h5>Efficiently innovate app</h5>
                                    <p>Continually redefine sticky channels whereas extensive "outside the box" thinking. Rapidiously supply focused schemas vis-a-vis optimal users.</p>
                                </div>
                                <div class="review-author d-flex align-items-center">
                                    <div class="author-avatar">
                                        <img src="<?=theme_base()?>assets/img/client-3.jpg" width="64" alt="author" class="rounded-circle shadow-sm img-fluid mr-3" />
                                        <span>“</span>
                                    </div>
                                    <div class="review-info">
                                        <h6 class="mb-0">Ana Joly</h6>
                                        <span>BizBite</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="border single-review-wrap bg-white p-4 m-3">
                                <div class="review-body">
                                    <h5>Uniquely mesh flexible</h5>
                                    <p>Phosfluorescently optimize intermandated platforms without integrated infrastructures. Proactively redefine granular thinking before.</p>
                                </div>
                                <div class="review-author d-flex align-items-center">
                                    <div class="author-avatar">
                                        <img src="<?=theme_base()?>assets/img/client-4.jpg" width="64" alt="author" class="rounded-circle shadow-sm img-fluid mr-3" />
                                        <span>“</span>
                                    </div>
                                    <div class="review-info">
                                        <h6 class="mb-0">Ana Joly</h6>
                                        <span>BizBite</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="border single-review-wrap bg-white p-4 m-3">
                                <div class="review-body">
                                    <h5>Compellingly empower app</h5>
                                    <p>Proactively grow focused niche markets with virtual e-services. Rapidiously pursue effective ROI via holistic information completely reintermediate.</p>
                                </div>
                                <div class="review-author d-flex align-items-center">
                                    <div class="author-avatar">
                                        <img src="<?=theme_base()?>assets/img/client-2.jpg" width="64" alt="author" class="rounded-circle shadow-sm img-fluid mr-3" />
                                        <span>“</span>
                                    </div>
                                    <div class="review-info">
                                        <h6 class="mb-0">Ana Joly</h6>
                                        <span>BizBite</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="border single-review-wrap bg-white p-4 m-3">
                                <div class="review-body">
                                    <h5>Holisticly reintermediate</h5>
                                    <p>Collaboratively reintermediate out-of-the-box e-business via economically sound supply chains. Dynamically target client-based holistic information.</p>
                                </div>
                                <div class="review-author d-flex align-items-center">
                                    <div class="author-avatar">
                                        <img src="<?=theme_base()?>assets/img/client-1.jpg" width="64" alt="author" class="rounded-circle shadow-sm img-fluid mr-3" />
                                        <span>“</span>
                                    </div>
                                    <div class="review-info">
                                        <h6 class="mb-0">Ana Joly</h6>
                                        <span>BizBite</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="border single-review-wrap bg-white p-4 m-3">
                                <div class="review-body">
                                    <h5>Uniquely mesh flexible</h5>
                                    <p>Phosfluorescently optimize intermandated platforms without integrated infrastructures. Proactively redefine granular thinking before.</p>
                                </div>
                                <div class="review-author d-flex align-items-center">
                                    <div class="author-avatar">
                                        <img src="<?=theme_base()?>assets/img/client-3.jpg" width="64" alt="author" class="rounded-circle shadow-sm img-fluid mr-3" />
                                        <span>“</span>
                                    </div>
                                    <div class="review-info">
                                        <h6 class="mb-0">Ana Joly</h6>
                                        <span>BizBite</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="border single-review-wrap bg-white p-4 m-3">
                                <div class="review-body">
                                    <h5>Compellingly empower app</h5>
                                    <p>Proactively grow focused niche markets with virtual e-services. Rapidiously pursue effective ROI via holistic information completely reintermediate.</p>
                                </div>
                                <div class="review-author d-flex align-items-center">
                                    <div class="author-avatar">
                                        <img src="<?=theme_base()?>assets/img/client-1.jpg" width="64" alt="author" class="rounded-circle shadow-sm img-fluid mr-3" />
                                        <span>“</span>
                                    </div>
                                    <div class="review-info">
                                        <h6 class="mb-0">Ana Joly</h6>
                                        <span>BizBite</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="border single-review-wrap bg-white p-4 m-3">
                                <div class="review-body">
                                    <h5>Holisticly reintermediate</h5>
                                    <p>Collaboratively reintermediate out-of-the-box e-business via economically sound supply chains. Dynamically target client-based holistic information.</p>
                                </div>
                                <div class="review-author d-flex align-items-center">
                                    <div class="author-avatar">
                                        <img src="<?=theme_base()?>assets/img/client-2.jpg" width="64" alt="author" class="rounded-circle shadow-sm img-fluid mr-3" />
                                        <span>“</span>
                                    </div>
                                    <div class="review-info">
                                        <h6 class="mb-0">Ana Joly</h6>
                                        <span>BizBite</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--testimonial section end-->

        <!--our blog section start-->
        <section class="our-blog-section ptb-100 gray-light-bg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-9 col-lg-8">
                        <div class="section-heading text-center">
                            <h2>Recent News and Events</h2>
                            <p>
                                Efficiently matrix robust total linkage after market positioning bandwidth. Holisticly restore B2B materials rather than brand flexible paradigms vis-a-vis mission-critical e-commerce.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <a class="single-blog-article border rounded bg-white d-block p-4 mt-4" href="#">
                            <div class="article-heading">
                                <h3 class="h5 mb-0">Professionally cultivate testing</h3>
                                <span> On 20 Mar, 2020</span>
                            </div>
                            <span class="border-shape my-3"></span>
                            <p>Enthusiastically pursue tactical architectures vis-a-vis goal-oriented resources.</p>
                            <div class="article-footer d-flex align-items-center justify-content-between">
                                <div class="article-comments">
                                    <span><i class="fas fa-comment mr-1"></i> 34 Comments</span>
                                </div>
                                <div class="article-user">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a class="single-blog-article border rounded bg-white d-block p-4 mt-4" href="#">
                            <div class="article-heading">
                                <h3 class="h5 mb-0">Monotonectally promote market</h3>
                                <span> On 20 May, 2020</span>
                            </div>
                            <span class="border-shape my-3"></span>
                            <p>Enthusiastically pursue tactical architectures vis-a-vis goal-oriented resources.</p>
                            <div class="article-footer d-flex align-items-center justify-content-between">
                                <div class="article-comments">
                                    <span><i class="fas fa-comment mr-1"></i> 24 Comments</span>
                                </div>
                                <div class="article-user">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a class="single-blog-article border rounded bg-white d-block p-4 mt-4" href="#">
                            <div class="article-heading">
                                <h3 class="h5 mb-0">Seamlessly evolve interactive </h3>
                                <span> On 10 Mar, 2020</span>
                            </div>
                            <span class="border-shape my-3"></span>
                            <p>Enthusiastically pursue tactical architectures vis-a-vis goal-oriented resources.</p>
                            <div class="article-footer d-flex align-items-center justify-content-between">
                                <div class="article-comments">
                                    <span><i class="fas fa-comment mr-1"></i> 20 Comments</span>
                                </div>
                                <div class="article-user">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!--our blog section end-->

        <!--our team section start-->
        <section class="client-section  ptb-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="section-heading text-center mb-5">
                            <h2>Lots of Customer Love Us</h2>
                            <p>
                                Rapidiously morph transparent internal or sources whereas resource sucking e-business. Conveniently innovate formulate clicks-and-mortar manufactured products compelling internal.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme clients-carousel dot-indicator">
                            <div class="item single-customer">
                                <img src="<?=theme_base()?>assets/img/customers/clients-logo-01.png" alt="client logo" class="customer-logo">
                            </div>
                            <div class="item single-customer">
                                <img src="<?=theme_base()?>assets/img/customers/clients-logo-02.png" alt="client logo" class="customer-logo">
                            </div>
                            <div class="item single-customer">
                                <img src="<?=theme_base()?>assets/img/customers/clients-logo-03.png" alt="client logo" class="customer-logo">
                            </div>
                            <div class="item single-customer">
                                <img src="<?=theme_base()?>assets/img/customers/clients-logo-04.png" alt="client logo" class="customer-logo">
                            </div>
                            <div class="item single-customer">
                                <img src="<?=theme_base()?>assets/img/customers/clients-logo-05.png" alt="client logo" class="customer-logo">
                            </div>
                            <div class="item single-customer">
                                <img src="<?=theme_base()?>assets/img/customers/clients-logo-06.png" alt="client logo" class="customer-logo">
                            </div>
                            <div class="item single-customer">
                                <img src="<?=theme_base()?>assets/img/customers/clients-logo-07.png" alt="client logo" class="customer-logo">
                            </div>
                            <div class="item single-customer">
                                <img src="<?=theme_base()?>assets/img/customers/clients-logo-08.png" alt="client logo" class="customer-logo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--our team section end-->
</div>

<script>
    $('.tooltip').removeClass('show');
</script>