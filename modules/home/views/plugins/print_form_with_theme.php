
<style type="text/css">
	<?
	if(!empty($css) && isJson($css)){
	    $css = OBJTOARRAY(json_decode($css,true));
	    echo '#form-'.$event->id.' .AJ-box{';
	    foreach($css['main'] as $k => $v)
	        echo $k.':'.$v.';';
	    echo '}#form-'.$event->id.' .AJ-box .AJ-header{';
	    foreach($css['header'] as $k => $v)
	        echo $k.':'.$v.';';
	    echo '}#form-'.$event->id.' .AJ-box .AJ-body{';
	    foreach($css['body'] as $k => $v)
	        echo $k.':'.$v.';';
	    echo '}#form-'.$event->id.' .AJ-box .AJ-footer{';
	    foreach($css['footer'] as $k => $v)
	        echo $k.':'.$v.';';
	    echo '}';
	    if(isset($css['input'])){
	        echo '#form-'.$event->id.' .AJ-box .AJ-body input,#form-'.$event->id.' .AJ-box .AJ-body select,	            #form-'.$event->id.' .AJ-box .AJ-body input:hover,#form-'.$event->id.' .AJ-box .AJ-body select:hover,	            #form-'.$event->id.' .AJ-box .AJ-body input:focus,#form-'.$event->id.' .AJ-box .AJ-body select:focus{';
    	    foreach($css['input'] as $k => $v)
    	        echo $k.':'.$v.'!important;';
    	    echo '}';
	    }
	}
	?>
</style>


<div class="col-md-12 " id="form-<?=$event->id?>" align="none">
    <?
    echo '<form action="" class="" data-id="'.AJ_ENCODE($event->id).'" align="left" onsubmit="DataFormSubmit (event,this)">';
    ?>
	<div class="AJ AJ-box">
		<div class="AJ-header">
			<strong class="AJ-title"><?=$event->title?></strong>
		</div>
		<div class="AJ-body">
			<?
			

            $col = (int)12/$event->layout;

            $ck = 0;

            foreach ($fields as $fil)

            {

              if($ck==0)

              echo '<div class="row form-group">';

                      echo'<div class="col-md-'.$col.' mb-3 mb-md-0">'.$fil.'</div>';

                      $ck  +=  $col;

              if($ck==12)

              {

                echo'</div>'; $ck=0;

              }

              

            }

              if($ck>0)

                echo '</div>';

             
        
	
              echo '
              	</div>
              <div class="AJ-footer">
                <div class="form-group">

                      '.$event->btn.'

                    </div>
                </div>';
			?>
	</div>
    </form>

</div>