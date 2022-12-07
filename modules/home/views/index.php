<div class="container-fluid" style="overflow-x:hidden">
        <!--<img src="<?=base_url('assets/file/product_1.jpg')?>">-->
        	<div class="row" style="margin:0">
        	    <?
        	    if(isset($pageData->heading_image) && $pageData->heading_image!='')
        	    {
        	    ?>
        	    <div class="col-md-12" style="background:url('<?=base_url?>/public/temp/<?=CLIENT_ID?>/<?=$pageData->heading_image?>') no-repeat;background-size:100% 100%;width:100%;height:<?=$pageData->heading_height?>px">
        	    	
        	    </div>
        		<?php
        	    }
        	    
        	    
        				if($leftSide->num_rows())
        				{	echo'<div class="col-sm-'.$lw.'" style="padding: 5px;">';
        					foreach ($leftSide->result() as $le)
        					{
        							echo getWidget($le->widget_id);
        					}
        					echo'</div>';
        				}
        				
        			?>
        
        <div class="col-sm-<?=$cw?> main-cn-main" >
        			<?php	
        			$GLOBALS['page_id'] = $page_id;
        			$GLOBALS['cw'] = $cw;
        			$GLOBALS['page_data'] = $pageData;
        			foreach ($result as $item)
        			{
        				container($item->type , $item->key_id);
        			}
        
        					        
        				function arragePage($type,$key)
        				{
        					$page_id    = $GLOBALS['page_id'];
        					$cw         = $GLOBALS['cw'];
        					$pageData   = $GLOBALS['page_data'];
        					$CI = get_instance();
        					switch($type)
        					{
        					    case 'typing_master':
        					        $CI->load->view('front/plugins/dir/'.$type,['id' => $key , 'cw' => $cw ]);
        					    break;
        					    
        					    case 'main_slider':
        					       echo $CI->load->view('front/plugins/main_slider',['cw' => $cw],true);//.php';
        					    break;
        						case 'slider':
        							echo'<div class="" style="margin-top:0px; padding-top:0; margin-bottom:10px; width:100%;">';
        							    if(function_exists('getCarousel'))
            							    getCarousel($key);
        					
        							echo '</div>';
        						break;
        
        						case 'igallery':
        				            if(function_exists('getGallery'))
        							    getGallery($key,$cw);
        						break;
        
        						case 'pgallery':
        						    if(function_exists('getProductGallery'))
        							    getProductGallery($key,$cw);
        						break;
                                
                                case 'fdgallery':
                                    if(function_exists('getFileDownloadGallery'))
                                        getFileDownloadGallery($key,$cw);
                                break;
                                
        						case 'vgallery':
        						    if(function_exists('getVideoGallery'))
        							getVideoGallery($key,$cw);
        						break;
        
        						case 'content':
        							echo isset($pageData->content)?"<div class='container-fluid'> $pageData->content </div>":"";
        						break;
        
        						case 'form':
            						echo '<div class="container" style="padding:10px;">';
            						if(function_exists('getForm'))
            							getForm($key);
            						echo'</div>';
        						break;
        
        						case 'tform':
            						echo '<div class="container" style="padding:10px;">';
            						if(function_exists('getTransactionForm'))
            						    getTransactionForm($key);
            						echo'</div>';
        						break;
        
        						case 'fbox':
        						    if(function_exists('getFeatureBox'))
        							    getFeatureBox($key);
        						break;
        
        						case 'fservice':
            						if(function_exists('getFileService'))
        							    getFileService($key);
        						break;
        						case 'ads':
            						if(function_exists('getAds'))
            							getAds($key);
        						break;
        
        						case 'marquee':
        						    if(function_exists('getMarquee'))
        							  getMarquee($key);
        						break;
        						
        						case 'rform':
        						    if(function_exists('getSearchResultForm') && get_instance()->crud_model->get_general_setting_by_type('result_section') == 'ok')
        							   getSearchResultForm($key);
        						break;
        						
        						
        						case 'content_category':
        						    require 'includes/content.php';
        						break;
        
        
        						case 'tab':
        							require 'plugins/tab_scheme.php';
        						break;
        						
        						case 'special_category':
        						    $CI = get_instance();
        						    $special_category = $CI->NewsModel->special_category(['id'=>$key]);
        						    if($special_category->num_rows()){
        						        $special_category_row = $special_category->row();
        						       
        						        $widgets  = (array) json_decode($special_category_row->widgets,true);
        						        
        						       $titleActive = $moreBtnActive = $categoryActive = TRUE;
                                        if(isJson($special_category_row->settings)){
                                            $settings = (array) json_decode($special_category_row->settings,true);
                                            
                                            $titleActive      = $settings['title_image']    == 'show' ? TRUE : FALSE;
                                            $categoryActive   = $settings['category']  == 'show' ? TRUE : FALSE;
                                            $moreBtnActive    = $settings['view_more_btn']  == 'show' ? TRUE : FALSE;
                                        }
        						    ?>
        						    
            						    <section class="news-area">
                                            <div class="container">
                                                <div class="row">
                                                <?
                                                if($titleActive || $categoryActive):    
                                                ?>
                                                  <div class="col-md-12">
                                                    <div class="tab-box d-flex justify-content-between">
                                                      <div class="sec-title">
                                                        <?
                                                        if($titleActive):
                                                            echo '<h5><a href="#"><img src="'.base_url('public/temp/'.CLIENT_ID.'/'.$special_category_row->image).'"></a></h5>';
                                                        endif;
                                                        if($categoryActive):
                                                            $css = !$titleActive ? 'style="margin:30px 0 0 0"' : '';
                                                        
                                                            echo '<ul class="sub-cat-menu car-menu" '.$css.'>';
                                                                $YCategory = [];
                                                                foreach($widgets as $widget => $ui){
                                                                    if(isset($ui['category'])){
                                                                        foreach($ui['category'] as $iu){
                                                                            if(in_array($iu,$YCategory))
                                                                                continue;
                                                                            $YCategory[] = $iu;
                                                                        }
                                                                    }
                                                                }
                                                                
                                                                foreach($YCategory as $i){
                                                                    $cat1 = $CI->NewsModel->get_category(['id'=>$i]);
                                                                    $link = '#';
                                                                    $title = '';
                                                                    if($cat1->num_rows()){
                                                                        $link = $CI->NewsModel->getCategorylink($i);
                                                                        $rowCat = $cat1->row();
                                                                        $title = $rowCat->name;
                                                                    }
                                                                    echo '<li><a href="'.$link.'">'.$title.'</a></li>';
                                                                }
                                                                
                                                            echo '</ul>';
                                                        endif;
                                                        ?>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <?
                                                  endif;
                                                  ?>
                                                  <div class="container">
                                                    <div class="latest-news">
                                                      <div class="tab-content">
                                                        <div class="tab-pane fade show active" id="tech" role="tabpanel">
                                                          <div class="row">
                                                              <?
                                                              foreach($widgets as $widget => $ui){
                                                                  
                                                                  $num = $ui['numPost'];
                                                                  $boxClass = $ui['boxClass'];
                                                                  $category = [0];
                                                                  if(isset($ui['category'])){
                                                                      $category = ($ui['category']);
                                                                  }
                                                                  $widgetData = json_encode(['category'=>$category,'number_of_post'=>$num]);
                                                                  /*
                                                                  title_newsList
                                                                    thumbnail_news
                                                                    sliderNews
                                                                    thumbnail_with_title_grid_view
                                                                  */
                                                                  echo '<div class="'.$boxClass.'">';
                                                                  
                                                                  
                                                                  
                                                                  if(function_exists('get_thumbnailNewsList') AND $widget == 'thumbnail_news')
                                                                    get_thumbnailNewsList($widgetData);
                                                                    
                                                                  if(function_exists('get_titleNewsList') AND $widget == 'title_newsList')
                                                                    get_titleNewsList($widgetData);
                                                                    
                                                                  if(function_exists('get_newsSlider') AND $widget == 'sliderNews')
                                                                    get_newsSlider($widgetData);
                                                                    
                                                                  if(function_exists('get_titleNewsGRIDView') AND $widget == 'thumbnail_with_title_grid_view')  
                                                                    get_titleNewsGRIDView($widgetData);
                                                                    
                                                                  
                                                                  
                                                                  echo '</div>';
                                                                  
                                                                  
                                                              }
                                                              
                                                              if($moreBtnActive)
                                                                echo '<div class="vire-more-btn"> <a href="#">View All</a> </div>';
                                                            ?>
                                                            
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                        </section>
        						    <?
        						    }
        						break;
        						case 'newsTicker':
        						    
        						    
        						    if(function_exists('getNewsTicker'))
        						        getNewsTicker($key);
        						    
        						    
        						break;
        						
        					}
        				}
        			?>
        				
        		</div>
        
        		
        			<?php
        				if($rightSide->num_rows()){
        				    
        					echo'<div class="col-sm-'.$rw.'" style="padding: 5px;">';
        					foreach ($rightSide->result() as $re)
        						echo getWidget($re->widget_id);
        					echo'</div>';
        					
        				}
        			?>
        		</div>
        	</div>
        	
        	
        	
        </div>