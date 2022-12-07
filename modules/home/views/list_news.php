<?
$CI = & get_instance();

$title='';
$title .='<title>';
$title .= $mainTitle;
$title.='</title>';

if($type == 'newPost'){
	echo '<meta name="description" content="'.strip_tags($news->content).'">
  		  <meta name="keywords" content="'.$news->title.'">';
}

$adsense = $this->db->where('admin_id',CLIENT_ID)->get('google_adsense');
if($adsense->num_rows())
{
	$code = $adsense->row()->code;
	echo is_html($code) ? $code : '';
}

require_once 'includes/'.FileDirecory.'/header.php';
$newsSetting = $this->NewsModel->getNewsSetting('layout');
?>

<style type="text/css">
	.news-text {
	    overflow: hidden;
	    text-overflow: ellipsis;
	    display: -webkit-box;
	    -webkit-line-clamp: 2;
	    -webkit-box-orient: vertical;
	}
	.ytp-impression-link{
		display: none!important
	}
	.pagination{
		display: inline-block;
		margin:1.4em!important;
	}
	.pagination li{
		    margin-right: .6em!important;
	}
</style>

<div class="container-fluid">
<div class="">
<?

$layout = 1;
$col = 12/$layout;
$height = 74*$col;




switch($type){
	case 'newPost':
	    /*
		?>
		<div class="col-md-<?=$col?>">
			<article class="card">
				<div class="view overlay">
			        <iframe src="<?=$CI->NewsModel->PostThumb($news->id,true)?>" style=" height: <?=$height?>;   border: 0;" class="card-img-top"
			                alt=""></iframe>
			        <a href="#"><div class="mask rgba-white-slight"></div></a>
			    </div>
			    <div class="card-body">

			    	<?
			    	echo '<h4>'.$news->title.'<h4>';

			    	?>
			    	<span class="fa fa-clock-o"> <?=_ago($news->create_time)?></span>
			    	<div style="padding: 10px">
			    		<?
			    		echo $this->NewsModel->share();
			    		echo $news->content;
			    		?>
			    	</div>


			    </div>

			</article>
		</div>
		<?
		*/
		$FILE = VIEWPATH.'front/plugins/news/full_view_'.FileDirecory.'.php';
		if(file_exists($FILE))
		  require $FILE;
		else
		  echo 'News is not available..';
	break;
	case 'category':
  
		if($total){
		    if(true){
		        require 'plugins/category_news/list_'.FileDirecory.'.php';
		    }
		    else{
		              echo '<div class="row" style="padding:10px">';
            ?>
                <style>
                    .post-entry  .pd-lr-4{
                        padding: 0.5em;
                    }
                </style>
                <?
    			foreach($news as $n){
                        $grid = ['thumbnail','title','time_and_author','description','share'];
                     
                        if($newsSetting->num_rows()){
                            $row = json_decode( $newsSetting->row()->value, true); 
                            if( isset($row['grid_view']) ){
                                $grid = $row['grid_view'];
                            }
                        }
    					 ?>
    					 
    					<div class="col-md-3">
    						<div class="post-entry bg-white">
    						    <?
    						    foreach($grid as $gr):
    						        switch($gr){
    						            
    						            case 'thumbnail':
    						                ?>
    						                <div class="image">
                    			                 <a href="<?=$this->NewsModel->postLink($n['id'],$id,$n['title'])?>"><img src="<?=$CI->NewsModel->PostThumb($n['id'])?>" alt="Image" class="img-fluid"></a>
                    			            </div>
    						                <?
    						            break;
    						            case 'title':
    						                ?>
    						                <div class=" pd-lr-4">
                    			                <h2 class="h5 text-black" style="margin:0"><a href="<?=$this->NewsModel->postLink($n['id'],$id,$n['title'])?>"><?=$n['title']?></a></h2>
                    			            </div>
    						                <?
    						            break;
    						            case 'time_and_author':
    						                ?>
    						                <div class=" pd-lr-4">
                			                  <span class="text-uppercase date d-block mb-3"><small>By Admin • <span class="fa fa-clock-o"> <?=_ago($n['create_time'])?></span></small></span>
                			                
                			                </div>
    						                <?
    						            break;
    						            case 'description':
    						                ?>
    						                 <div class="text">
                    			                <p class="card-text news-text mb-0"><?=strip_tags($n['content'])?></p>
                    			                 	
                    			             </div>
    						                <?
    						            break;
    						            case 'share':
    						                echo '<div class=" pd-lr-4">'.$this->NewsModel->share().'</div>';
    						            break;
    						            
    						        }
        			             endforeach;
        			             ?>
    			           </div>
    
    	      			</div>
    					 <?
    
    			}
    			    echo '<div class="col-md-12 site-block-27 text-center">'.$pagination.'</div>';
    			 echo '</div>';
		    }

		}
		else
			echo '<b style="font-size:2em">News are not availabel.</b>';
		echo '</div>';
	break;
}

echo '</div></div>';

require_once 'includes/'.FileDirecory.'/footer.php';
?>