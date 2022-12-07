<section class="news-area int-lif mt-m-95">
  <div class="container">
    <div class="row">
      <div class=" col-md-9 padding-fix-r ">
        <div class="latest-news-top story-1 mt-5">
          <h3><?=$CatTitle?></h3>
            <ul>
                
                
                <?
                $i = 1;
                foreach($news as $n){
                    $class = $i == 1 ? 'col-lg-3 float-left pl-0' : 'col-lg-2 col-3 float-left pl-0';
                    $title = '<a href="'.$this->NewsModel->postLink($n['id'],$id,$n['title']).'">'.$n['title'].'</a>';
                    $title  = $i == 1 ? '<h4>'.$title.'</h4>' : $title;
                    echo '
                        <li> 
                            <div class="'.$class.'">
                                <a href="'.$this->NewsModel->postLink($n['id'],$id,$n['title']).'">
                				    <img src="'.$CI->NewsModel->PostThumb($n['id']).'" alt="'.$n['title'].'" class="img-fluid">
                				</a> 
                            </div>
                            <div class="col-lg-9 float-left">
                                <span>'._ago($n['create_time']).'</span> 
                                '.$title.'
                            </div>
                        </li>
                    ';
                    $i++;
                }
                ?>
             
                         
          </ul>
        </div>
        <?
        echo $pagination;
        ?>
        <!--<div class="pagination">-->
        <!--    <ul>-->
        <!--        <li><strong>1</strong><a href="television/10.html" data-ci-pagination-page="2">2</a><a href="television/20.html" data-ci-pagination-page="3">3</a><a href="television/10.html" data-ci-pagination-page="2" rel="next">&gt;</a><a href="television/1910.html" data-ci-pagination-page="192">Last &rsaquo;</a></li></ul></div>-->
      </div>


      <div class="col-md-3">
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
      </div>
    </div>
  </div>
</section>