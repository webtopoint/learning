<?
$CI = get_instance();
?>

<div class="container" style="display:none">
        <div class="clock text-right"> <span id="dg-clock"></span> </div>
</div>

<style>
    .menu-area .main-menu ul li a {
        margin-top:0!important;
    }
</style>

<div class="container">
    <div class="breadcom mt-m-130">
        <ul>
            <li><a href="<?=base_url?>">Home</a></li>
              <li><a href="#">/</a></li>
              <?
              if(defined('event_id')){
                 $cat = $CI->NewsModel->get_category(['id'=>event_id])->row();
                  echo '<li><a href="'.base_url.'/category/'.$cat->slug.'">'.$cat->name.'</a></li>
                        <li><a href="#">/</a></li>';
              }
              ?>
            <li><a href="<?=current_url()?>"><?=$news->title?></a></li>
        </ul> 
    </div>  
</div>
<div class="clearfix"></div>
<section class="slider-area">
  <div class="container">
    <div class="row">      
      <div class="col-lg-8 col-md-12 padding-fix-r category-details no-mt">
        <div class="latest-news-top">
            <div class="news-details-inner">
                
                <h1> <?=$news->title?></h1>
                    <img style="width:100%" src="<?=$CI->NewsModel->PostThumb($news->id)?>" alt="" class="img-fluid">
                    <?
                    
                    /*
                    <div class="author">
                                <div class="author-img">
                                    <img src="../assets/uploads/client_images/1598683495Alka.jpg">
                                </div>
                                
                                <div class="author-text">
                                          <h6>Alka Kumari</h6> 
                                          <p>दिल्ली   28 Sep, 2020 04:38 pm</p>
                                </div> 
            
                            <!-- AddToAny BEGIN -->
                            <a class="a2a_dd" href="https://www.addtoany.com/share"><i class="fa fa-share-alt "></i></a>
                            <script async src="../../static.addtoany.com/menu/page.js"></script>
         
                    </div>
                    */
                    
                    echo $news->content;
                    ?>
            </div>
        <div class='clearfix'></div>
        <?
        /*
        <ul class="Blogs_Tags_Line">
                        
              <li><form action="https://www.thelastbreaking.com/search_url" method="post">
                  <input type="hidden" placeholder="Search.." name="search_url" value="the-last-breaking">
              <input type="hidden" placeholder="Search.." name="search" value="The last breaking">
              <button type="submit">The last breaking</button></form></li>
            
            
                                    
              <li><form action="https://www.thelastbreaking.com/search_url" method="post">
                  <input type="hidden" placeholder="Search.." name="search_url" value="bollywood-top-news">
              <input type="hidden" placeholder="Search.." name="search" value="bollywood top news">
              <button type="submit">bollywood top news</button></form></li>
            
                                    
            <li><form action="https://www.thelastbreaking.com/search_url" method="post">
                <input type="hidden" placeholder="Search.." name="search_url" value="lata-mangeshker">
              <input type="hidden" placeholder="Search.." name="search" value="lata Mangeshker">
              <button type="submit">lata Mangeshker</button></form></li>
              
                                     
            <li><form action="https://www.thelastbreaking.com/search_url" method="post">
                <input type="hidden" placeholder="Search.." name="search_url" value="singer-lata-mangeshkar">
              <input type="hidden" placeholder="Search.." name="search" value="singer lata mangeshkar">
              <button type="submit">singer lata mangeshkar</button></form></li>
              
                                    
            <li><form action="https://www.thelastbreaking.com/search_url" method="post">
                \<input type="hidden" placeholder="Search.." name="search_url" value="91st-birthday">
              <input type="hidden" placeholder="Search.." name="search" value="91st birthday ">
              <button type="submit">91st birthday </button></form></li>
              
                                    
            <li><form action="https://www.thelastbreaking.com/search_url" method="post">
                <input type="hidden" placeholder="Search.." name="search_url" value="asha-bhosle">
              <input type="hidden" placeholder="Search.." name="search" value="asha bhosle">
              <button type="submit">asha bhosle</button></form></li>
              
                                                                        
        </ul>
        */
        ?>
        <div class='clearfix'></div>
			<div class="next-btn">
			    <?
			    if($PrevLink = $CI->NewsModel->getPrevNews($news->id)) //getNextNews
			        echo '<a class="float-left" href="'.$PrevLink.'">Prev</a>';
			    if($NextLink = $CI->NewsModel->getNextNews($news->id))
			        echo '<a class="float-right" href="'.$NextLink.'">Next</a>';
			    ?>
			</div>
			<div class='clearfix'></div>
        </div>
        <div class="clearfix"></div>
                <div class='clearfix'></div>
    <div class="comment-form">
        <div class="sec-title">
            <h5>Leave Your Comment</h5>
        </div>
        <p class="messagevalidate">&nbsp;</p>
            <div class="clearfix"></div>
            <form class="com-form review" method="post">                                            
              <input type="hidden" name="blog_id" value="836">
                <div class="clearfix"></div>
                <div class="">
                    <div class="col-md-6 float-left">
                        <input type="text" name="name" value="" placeholder="Enter Your Name">
                    </div>
                    <div class="col-md-6 float-left">
                        <input type="text" name="email" value="" placeholder="Enter Your Email">
                    </div>
                      <div class="clearfix"></div>
                    <div class="col-md-12 float-left">
                        <textarea name="comment" placeholder="Your Comment Here"></textarea>
                        <button type="button" id="review" name="button">Post Comment</button>
                    </div>
                </div>
            </form>
        </div>
    </div> 
    
    <div class="col-lg-4 col-md-12">
        <?
        $get = $this->NewsModel->getNewsSetting('right_widget_in_news');
        $row = [];
        if($get->num_rows()){
            $row = (array) json_decode( $get->row()->value, true); 
            if($row != null){
                //print_r($row);
                foreach($row['actions'] as $key => $action){
                    $num = $row['numPost'][$key];
                    $cats = $row['catBox'][$key] == null ? []: (array) $row['catBox'][$key];
                    $widgetData = json_encode(['category'=>$cats,'number_of_post'=>$num]);
                    switch($action){
                        case 'title_newsList':
                            echo '<div class="latest-news-top mar-btm-30">
                                    <h3>'.$row['boxTitle'][$key].'</h3>
                                    <ul>';
                                    
                                    foreach( $CI->NewsModel->getNewsViaMultiCategory($cats,$num,TRUE)->result() as $post){
                                        $cat = $CI->NewsModel->get_category(['id'=>$post->cat_id])->row();
                                        echo    '<li> 
                                                    <span>'.$cat->name.'</span> 
                                                    <a href="'.$CI->NewsModel->postLink($post->post_id,$cat->id,$cat->name).'">'.$post->title.'</a>
                                                 </li>';
                                    }
                                        
                           echo '</ul>
                                </div>';
                        break;
                        case 'thumbnail_news':
                            get_thumbnailNewsList($widgetData);
                        break;
                        case 'sliderNews':
                            get_newsSlider($widgetData);
                        break;
                        case 'thumbnail_with_title_grid_view':
                            get_titleNewsGRIDView($widgetData);
                        break;
                        default:
                            
                        break;
                    }
                }
            }
        }
        ?>
        

        <!--<div class="other-news-top mar-btm-30">-->
        <!--    <h3><img src="../images/Career16%2b-logo.png"></h3>-->
        <!--    <div class="clearfix"></div>-->

        <!--    <div class="side-single-post">-->
        <!--        <a href="cbse-class-12-board-exams-postponed-class-10-exams-cancelled.html"><img src="../assets/uploads/blog_images/1618393416cbse_biard_exams2021-nishank.jpg"></a>-->
        <!--        <h4><a href="cbse-class-12-board-exams-postponed-class-10-exams-cancelled.html">CBSE Exams 2021: 10वीं बोर्ड की परीक्षाएं कैंसिल, 12वीं के एग्‍जाम स्‍थगित</a></h4>-->
        <!--        <a class="more-btn" href="cbse-class-12-board-exams-postponed-class-10-exams-cancelled.html">Read More</a> -->
        <!--    </div>-->
        <!--</div>-->
        
        
      </div>
    </div>
  </div>
</section>

<p>&nbsp;</p>
<script type="text/javascript">
   $("#review").click(review);
function review() {
    if (isReview()) {  
        var frm = $(".review").serialize();
        $.ajax({
            url: 'https://www.thelastbreaking.com/Homepage/comment',
            type: 'POST',
            data: frm,
            success: function(result) {
                console.log(result);
                if (result.indexOf("Done") > -1) {
                    $(".messagevalidate").html("You are Successfully commented. Your comment will be shown after verified by admin.");
                    $(".review")[0].reset();

                } else {
                    $(".messagevalidate").html("Something went wrong.");
                    $(".review")[0].reset();


                }
            }
        })
    }
}

function isReview() {
    var valid = !0;
   
    var review = $("textarea[name='comment']").val();
    
    //alert(review);
    $(".message").html("&nbsp;");
    $(".messagevalidate").css("color", "red");
    $(".message").css("font-size", "15px");
    if (review.length == 0 || review=="") {
        valid = !1;
        $(".messagevalidate").html("Please enter your review.")
    } 
    return valid
}
            </script>