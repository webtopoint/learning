<?

$ci = get_instance();
$listTab = $ci->HtmlModel->list_tabs($key);

$lsitTabData = [];

if(count($listTab)>0){


	$lsitTabData = OBJTOARRAY( json_decode($listTab[0]['content']) );

	?>
<style type="text/css">

	<?
	$mean = \C :: menuCssArray();
	if($listTab[0]['css']!=''){


	    echo '.tab-content{ padding-bottom:20px } .tab-section-'.$listTab[0]['id'].'  .nav-tabs{min-height:10px;
	    	';


	    	 $tabHeader = (array) OBJTOARRAY( json_decode($listTab[0]['headerCss']) );

	    	 $headerBanner = [];

              foreach($tabHeader as $pro => $val)
              		$headerBanner[$pro] = $val;
              echo 'border-bottom:'.$headerBanner['height'].' solid '.str_replace('px','',$headerBanner['background']);



	    echo '} .tab-section-'.$listTab[0]['id'].' .nav-tabs li a{';
	           $tabCss = (array) OBJTOARRAY( json_decode($listTab[0]['css']) );
	           
	           foreach ($tabCss as $pro => $val)
              {    if($val=='bold')
                      $pro='Fweight';
                      
                      
                    if($pro == 'box-shadow')
        				$val =  $tabCss[$pro]['box_shadow_type'].' '.$tabCss[$pro]['shad_first'].' '.$tabCss[$pro]['shad_first1'].' '.$tabCss[$pro]['shad_first2'].' '.$tabCss[$pro]['shad_first3'].' '.$tabCss[$pro]['boxShadowColor'];
        					
        					          
                        echo $mean[$pro].$val.'!important;';
                  
                    // if($pro == 'Fsize')
                    //     echo $mean[$pro].$val.'!important;';
              }
              echo '} .tab-section-'.$listTab[0]['id'].' .nav-tabs li a:hover, .tab-section-'.$listTab[0]['id'].' .nav-tabs li a.active,.tab-section-'.$listTab[0]['id'].' .nav-tabs li.active a{';
              $tabHover = (array) OBJTOARRAY( json_decode($listTab[0]['hoverCss']) );


              foreach($tabHover as $pro => $val)
              		echo $mean[$pro].$val.'!important;';
              
              
	    echo '}';
	}
	
	?>
</style>

<div class="tab-section-<?=$listTab[0]['id']?>">

		<ul class="nav nav-tabs">
		<?
		$count = 0;
			foreach( $lsitTabData as $Tabkey => $li ){
				$class = $count == 0 ? 'active' : '';
				echo '<li class="'.$class.' " >
							<a data-toggle="tab" href="#tab-'.$count.'" class="tab_a">
								'.$li['title'].'
							</a> 
						</li>';
				$count++;
			}
		?>
		</ul>

		<div class="tab-content">
			<?
			$count = 0;
			foreach( $lsitTabData as $Tabkey => $li ){
				$class = $count == 0 ? 'in active show' : '';
				echo '<div id="tab-'.$count.'" class="tab-pane '.$class.'">
							'. $li['content'].'
					  </div>';
				$count++;
			}
			
			?>			    
		</div>
		<script type="text/javascript">
			$(document).on('click','.tab_a',function(){
				$(this).closest('ul').find('li').removeClass('active');
				$(this).closest('li').addClass('active');
			})
		</script>
		</div>
	<?

}

unset($listTab,$lsitTabData);
?>
