<?php
$CI = & get_instance();

$website=$CI->SiteModel->getWebsiteData()->row();
$page = $CI->SiteModel->list_page($page_id)->row();


echo web_plugin('google_adsense');

require_once 'includes/'.FileDirecory.'/header.php';


        
        //=============================================//
        
        
        $rw=$lw=0;
        $x=12;
        if($leftSide->num_rows())
        	$lw=2;
        if($rightSide->num_rows())
        	$rw=2;
        $cw=$x-$lw-$rw;
        
        ?>
        
        <?/*
        
        $faceBookPixels = $this->SiteModel->facebook_pixel();
        if(count($faceBookPixels) > 0){
            
            ?>
                <!-- Facebook Pixel Code -->
            	<script>
            	  !function(f,b,e,v,n,t,s)
            	  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            	  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            	  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            	  n.queue=[];t=b.createElement(e);t.async=!0;
            	  t.src=v;s=b.getElementsByTagName(e)[0];
            	  s.parentNode.insertBefore(t,s)}(window, document,'script',
            	  'https://connect.facebook.net/en_US/fbevents.js');
            	  <?
            	  $faceBookPixelsImage = '';
            	  foreach($faceBookPixels as $pixel_id){
            	      $iddd = (int) $pixel_id;
            	    echo 'fbq("init", '.$iddd.');';
            	    $faceBookPixelsImage .= '<img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id='.$iddd.'&ev=PageView&noscript=1"/>';
            	  }
            	  ?>
            	  fbq('track', 'PageView');
            	</script>
            	
            	<noscript>
            	  <?=$faceBookPixelsImage?>
            	</noscript>
            	
            <?
            
        }
        $Google_Analytics = $this->SiteModel->Google_Analytics();
        if(count($Google_Analytics) > 0){
            ?>
            <!-- Google Analytics -->
            <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
            <?
            foreach($Google_Analytics as $pixel_id)
            	    echo 'ga("create", "'.$pixel_id.'", "auto");';
            ?>
            ga('send', 'pageview');
            </script>
            <!-- End Google Analytics -->
            <?
        }
        */
        if($website->other)
        {
        	$d = json_decode($website->other);
        	echo isset($d->headerCode) ? $d->headerCode : '';
        }
        ?>
        <div class="container-fluid" style="overflow-x:hidden">
        <?php
        
        
        
        $schema = $this->SiteModel->getPageSchema(array('page_id'=>$page_id,'admin_id'=>CLIENT_ID));
        $result;
        if($schema->num_rows())
        {
        	$result = $schema->result();
        
        	if($result[0]->type=='slider')
        	{
        			echo'<div class="" style="margin-top:0px; padding-top:0px;">';
        		 getCarousel($result[0]->key_id);
        			echo '</div>';
        		unset($result[0]);
        	}
        }
        else
        {
        	$result=array();
        }
        
        if(isCustom){
            require __DIR__. '/process.php';
        }
        else
            require __DIR__. '/index.php';  
        // require view_page();
        
        ?>
        
        
        
        	
        	
        </div>
        
         
        
        <div id="overlay" style=" padding: 26px; ">
        	<button class="btn btn-danger " style="    position: absolute;    right: 21px; "><i class="fa fa-times"></i> Close</button>
        	<br>
        	<center></center>
        
        </div>
        
        <div id="fileView">
        	<a class="downloadButton" href="" download=""><button class="btn btn-success"><i class="fa fa-download"></i> Download</button></a>
        	<button class="btn btn-danger " onclick="$(this).parent().hide()"><i class="fa fa-times"></i> Close</button>
        	<br>
        	<embed  width="100%" height="100%" style="z-index: 99999999" />
        
        </div>
        
        
        
        <script type="text/javascript">
        
            $(document).ready(function() {
                $(document).bind("keydown", function(event) {
                    console.log(event);
                    //alert(event.keyCode);
                    if(event.altKey && event.ctrlKey && event.which == 84) {
                        $.alert({
                            title : 'Theme Details',
                            theme : 'green',
                            closeIcon : true,
                            content : function(){
                                var self = this;
                                return $.ajax({
                                    type : 'POST',
                                    url : '<?=site_url('home/theme-details')?>',
                                    dataType : 'json',
                                    success : function(res){
                                        self.setContent(res.html);
                                    },
                                    error:function(a,vb,c){
                                        self.setContent(a.responseText);
                                    }
                                });
                            }
                        });
                    }
                });
            });
            
        	$(".GalleryBox img").on("click",function(){
        			$("#overlay").show(400);
        			$("#overlay center").html("<img src='"+this.src+"' style='max-height:600px; max-width:100%;' >");
        	});
        	$("#overlay button").on("click",function(){
        		$(this).parent().hide(400);
        		$(this).parent().find('img,iframe').remove();
        	});
        
        	$(".VideoBox ").on("click",function(){
        	        
        			var l = $(this).find('.img-fluid').data('link');
        			console.log(this);
        			$("#overlay").show(400);
        			$("#overlay center").html('<iframe style="width:100%" height="315" src="'+l+'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
        	});
        
        
        	// ============ Form Submit
        
        
        	
        
        </script>
        
        <?php
        $f =  $CI->ThemeModel->getCustomCss(array('element'=>'footer'));
        if($f->num_rows())
        {
        	$css = json_decode($f->row()->css); 
        	if(isset($css->wno) && strlen($css->wno))
        	{	/*
        		$al= 0;
        		if($css->walign=='right')
        			$al=90;
                 */   	
                echo'<a href="https://wa.me/'.$css->wno.'" target="_blank" style="'.$css->walign.':10px"  class="wplogo">
                    		<img src="'.base_url.'/public/temp/whatsapplogo.png" ></a>';
                
        	}
        	if(isset($css->callBackNo) && strlen($css->callBackNo))
        	{	
        	    $align = isset($css->callBackAlign) ? $css->callBackAlign : 'right';
                echo'<a href="tel:'.$css->callBackNo.'" style="'.$align.':10px"  class="wplogo">
                    		<img src="'.base_url.'/public/images/phone/'.$css->CallBackImg.'"></a>';
                
        	}
        	
        }
        
        if($website->other)
        {
        	$d = json_decode($website->other);
        	echo $d->chatCode;
        }
        
        $utilitySocial  = $this->db->where(array('type'=>'social','admin_id'=>CLIENT_ID,'status'=>1))->get('utilities');
        
        if($utilitySocial->num_rows())
        {	$srow  = json_decode($utilitySocial->row()->data);
        
        	echo'<div class="icon-bar social_links" style="'.$srow->position.':0;">';
        	if($srow->facebook)
        		echo'<a target="_blank" class="facebook" href="'.$srow->facebook.'"><i class="fa fa-facebook"></i></a>';
        	
        	if($srow->twitter)
        		echo'<a target="_blank" class="twitter" href="'.$srow->twitter.'"><i class="fa fa-twitter"></i></a>';
        	
        	if($srow->instagram)
        		echo'<a target="_blank" class="instagram" href="'.$srow->instagram.'"><i class="fa fa-instagram"></i></a>';
        	
        	if($srow->linkedin)
        		echo'<a target="_blank" class="linkedin" href="'.$srow->linkedin.'"><i class="fa fa-linkedin"></i></a>';
        	
        	if($srow->pinterest)
        		echo'<a target="_blank" class="pintrest" href="'.$srow->pinterest.'"><i class="fa fa-pinterest"></i></a>';
        	
        	if($srow->youtube)
        		echo'<a target="_blank" class="youtube" href="'.$srow->youtube.'"><i class="fa fa-youtube"></i></a> ';                           
        	echo'</div>';
        }
        
        
        require_once 'includes/'.FileDirecory.'/footer.php';
        
        $pop  = $CI->SiteModel->getPopup("(page_id = 'all' or page_id = ".$page_id.")");
        
        if($pop->num_rows())
        {
        	
        	$popup = $pop->row();
        	$de = json_decode($popup->details);
        	$act = 1;
        	if($de->frq=='0')
        	{
        		if(!isset($_COOKIE['popup_'.CLIENT_ID.'_'.$popup->id]))
        			setcookie('popup_'.CLIENT_ID.'_'.$popup->id, 'true', time() + (86400), "/");
        		else
        			$act=0;
        		
        	}
        
        
        	if($act)
        	{
        		$con = 	$popup->type=='data'?$popup->content:getPopupForm($popup->form_id);
        
        		echo'<div id="popup" align="center" style="overflow:auto;">
        			<span class="" style="margin:10px; font-size:38px; position:fixed; right:0; color:red; z-index:99999999; background: white;padding: 6px 10px;border-radius: 50%;border: 2px solid black;" onclick="$(\'#popup\').hide()"><i class="fa fa-times"></i></span>
        			<div class="container" style="background: white; width: '.$de->width.'px; max-width:100%; min-height: '.$de->height.'px; margin-top: 20px; padding:10px; border:2px solid black; border-radius:4px; box-shadow:4px 10px 13px -5px black">
        					'.$con.' 
        			</div>  
        		</div>';	
        	}
        	
        	
        }
        
        
        if(time() < 1611685800){ 
            echo'<div id="popup" align="center" style="overflow:auto;">
        			<span class="" style="margin:10px; font-size:38px; position:fixed; right:0; color:red; z-index:99999999; background: white;padding: 6px 10px;border-radius: 50%;border: 2px solid black;" onclick="$(\'#popup\').hide()"><i class="fa fa-times"></i></span>
        			<div class="container" style="background: white; width: 530px; max-width:100%; height: 400px; margin-top: 20px; padding:10px; border:2px solid black; border-radius:4px; box-shadow:4px 10px 13px -5px black">
        					<img src="https://images.inkhabar.com/wp-content/uploads/2019/01/Happy-Republic-Day-GIFs-2019.webp" style="width:100%;height:100%">
        					<h3 style="color: red;    margin-top: -28px;    font-weight: 700;    font-family: cursive;    text-shadow: 2px 1px 2px black;">'.@$title.'</h3>
        			</div>
        		</div>';
        }
        
        
        
        ?>
        
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script src="<?=base_url?>/public/custom/print.js"></script>
        <script type="text/javascript">
        
        
        // document.addEventListener('contextmenu', event => event.preventDefault());
        $('.fixed-header').css({'position':'static'});
        /*
        document.onkeydown = function(e) {
        if (e.ctrlKey && (e.keyCode === 65 || e.keyCode === 97 || e.keyCode === 67 || e.keyCode === 86 || e.keyCode === 85 || e.keyCode === 117)) {return false;}};*/
        
        
        
        
        
        	$("form.quick_form").on("submit",function(ev){
        		ev.preventDefault();
        
        
        		var ip = $(this).find("input");
        		var flag=1;
        		var i;
        		for(i=0; i<ip.length;i++)
        		{
        			if(ip[i].value=='')
        			{
        				$(ip[i]).attr("style","border:1px solid red");
        				flag=0;
        			}
        			else
        			{
        				$(ip[i]).removeAttr("style");
        			}
        		}
        
        		if(flag)
        		{	
        			var ele = $(this).parent();
        			$(ele).find('div.formCover').show(600);
        			var x = $(this).serialize();
        			$.ajax({
        				url:'<?=site_url('home/send-query')?>',
        				type:'POST',
        				data:x,
        				beforeSend:function()
        				{	
        					$(ele).find('div.formCover').show(300);
        					
        				},
        				success:function(q)
        				{
        					
        					$(".quick_form input").val("");
        					$(".quick_form button").html("Done");
        					$(".quick_form input,button").attr("disabled","disabled");
        
        					$(ele).prepend('<div class="alert alert-success">Query Sent</div>');
        				},
        				complete:function()
        				{
        					$(ele).find('div.formCover').hide(300);
        				}
        			});
        		}
        	});
        
        
        $(".productQuery").on("click",function(){
        	var pro = $(this).data('proid');
        	$.ajax({
        				url         :   '<?=site_url('home/product-query')?>',
        				type        :   'POST',
        				data        :   { proid:pro , status:'viewForm' },
        				beforeSend  :   function()
        				{	
        					$("#overlay").show(100);
        					$("#overlay center").html("<font color='white' size='40'><i class='fa fa-spinner fa-spin'></i></font>");
        					
        				},
        				success:function(q)
        				{	
        					$("#overlay center").html(q);
        				}
        			});
        });
        
        
        
        function bookProduct(ev,ele)
        {
        		ev.preventDefault();
        		
        		var ip = $(ele).find("input,textarea");
        		var flag=1;
        		var i;
        		for(i=0; i<ip.length;i++)
        		{
        			if(ip[i].value=='')
        			{
        				$(ip[i]).attr("style","border:1px solid red");
        				flag=0;
        			}
        			else
        			{
        				$(ip[i]).removeAttr("style");
        			}
        		}
        
        		if(flag)
        		{
        			$.ajax({
        				url:'<?=site_url('home/book-product')?>',
        				type:'POST',
        				data:$(ele).serialize(),
        				beforeSend:function()
        				{	
        					$(ele).find("input,textarea,button").attr("disabled","disabled");
        					$(ele).find("button").html("<i class='fa fa-spinner fa-spin'></i> Please Wait..");
        					
        				},
        				success:function(q)
        				{	
        					$(ele).find("input,textarea,button").removeAttr("disabled",);
        					$(ele).find("input,textarea").val("");
        				},
        				complete:function()
        				{
        					$(ele).find("button").hide();
        					$(ele).append("<div class='alert alert-success'><strong><i class='fa fa-check-square-o'></i></strong> Your Booking Query has been send.</div>");
        				}
        			});
        		}
        		
        }
        
        function findResultBySomeFields(ev,ele){
            ev.preventDefault();
            var formid = $(ele).data("id");
            var fdata =new FormData(ele);
            fdata.append("fid",formid);
            
            
            $.ajax({
                    url:"<?=site_url("home/getResultView")?>",
                    type:"POST",
                    data:fdata,
                    processData: false,
                    contentType: false,
                    dataType:'json',
                    beforeSend:function()
                    {
                      $(ele).find("button").html("<i class='fa fa-spinner fa-spin'></i> Please Wait...").attr("disabled","disabled");
        
                    },
                    success:function(q)
                    { 
                        console.log(q);
                        let x= $.confirm({
                            content:q.html,
                            title:'Result View',
                            icon:'fa fa-view',
                            boxHeight:'400px',
                            type:'green',
                            columnClass:'col-md-12 col-xs-12',
                            buttons:{
                                print:{
                                    text:'Print',
                                    className:'btn-primary',
                                    action:function(){
                                        //alert('Working Area..');
                                       var contents =  this.$content.find('.print-result-table > div').html();
                                       
                                       /*  $('<iframe>', {
                                            name: 'myiframe',
                                            class: 'printFrame'
                                          })
                                          .appendTo('body')
                                          .contents().find('body')
                                          .append(`<html><head><title>Pritn Result</title>
                                                    </head><body>
                                                    <style>#result-frame *{overflow:hidden;}</style>
                                                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
                                                    `+contents+`
                                                    </body></html>
                                                    `);
                                        
                                          window.frames['myiframe'].focus();
                                          window.frames['myiframe'].print();
                                        
                                          setTimeout(() => { $(".printFrame").remove(); }, 1000);            
                                       //console.log(contents);*/
                                      
                                       var frame1 = $('<iframe />');
                                                frame1[0].name = "frame1";
                                                frame1[0].id = 'result-frame';
                                                frame1.css({ "position": "absolute", "top": "-1000000px" });
                                                $("body").append(frame1);
                                                var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
                                                frameDoc.document.open();
                                                frameDoc.document.write('<html><head><title>Pritn Result</title>');
                                                frameDoc.document.write('</head><body>');
                                                frameDoc.document.write('<style>#result-frame *{overflow:hidden;}</style>');
                                                frameDoc.document.write('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">');
                                                frameDoc.document.write(contents);
                                                frameDoc.document.write('</body></html>');
                                                frameDoc.document.close();
                                                setTimeout(function () { 
                                                    window.frames["frame1"].focus();
                                                    window.frames["frame1"].print();
                                                    frame1.remove();
                                                }, 500);
                                                
                                           return false; 
                                    }
                                },
                                close:function(){}
                            }
                        });
                        //$('.jconfirm-content').css({'height':'400px','overflow-x':'hidden'});
                        $(ele).find("button").html("<i class='fa fa-check-square-o'></i> Done").attr("disabled",false);
                    	//alert(q);
                     //  alert(s);
                     /*
                      if(q=="done")
                      {
                         $(".resultSearchForm-Button-"+).html("<i class='fa fa-check-square-o'></i> Done");
                         //$(ele).append("<center><font color='green'><strong>Form Submitted Successfully.</strong></font></center>");
                      }*/
                    },
                    error:function(a,b,c)
                    {
                      alert(c);
                    }
                  });
        }
        
        
        function DataFormSubmit(ev,ele)
        {
              ev.preventDefault();
        
              var vex = ["jpg","jpeg","png","gif","docx","doc","docm","pdf"];
              var validimg = $(ele).find("input[type=file]");
              var i;
              var err=0;
              for(i=0;i<validimg.length;i++)
              { 
              	var f;
              	if(f=validimg[i].files[0])
              	{
        	        if(!vex.includes(f.name.split(".").pop().toLowerCase()))
        	        { alert("This file type is not Allowed"); err=1; }
        	        if(f.size>300000)
        	        { alert("File Size is too Big ="+f.size); err=1; }
        	        if(f.error)
        	        {  alert("Error in File. Please Try Another"); err=1; }
        	        if(err==1)
        	        {
        	          $(validimg[i]).css("border","1px solid red"); break;
        	        }
        	        else
        	          $(validimg[i]).css("border","1px solid green");
        	    }
              }
            
              if(!err)
              {
                var formid = $(ele).data("id");
                var fdata =new FormData(ele);
                fdata.append("fid",formid);
                //alert("dome");
               // return ;
                $.ajax({
                    url:"<?=site_url("home/submit_form")?>",
                    type:"POST",
                    data:fdata,
                    processData: false,
                    contentType: false,
                    dataType:'json',
                    beforeSend:function()
                    {
                      $(ele).find("input,select,button,textarea").attr("disabled","disabled");
                      $(ele).find(".submitBtn button").html("<i class='fa fa-spinner fa-spin'></i> Please Wait...");
        
                    },
                    success:function(q,s)
                    { 
                    	//alert('Please Wait  Updating server.. , This record is not saved.');
                    	console.log(q);
                     //  alert(s);
                     
                      if(q.status)
                      {
                         $(ele).find("button").html("<i class='fa fa-check-square-o'></i> Done");
                         $(ele).append("<center><font color='green'><strong>Form Submitted Successfully.</strong></font></center>");
                         
                         if(q.redirect)
                             location.href = q.url;
                             
                      }
                    },
                    error:function(a,b,c)
                    {
                      alert(c);
                      console.log(a.responseText);
                    }
                  });
        
              }
              
            }
            
        function FileService(e,t)
        {
        	e.preventDefault();
        	ele = t;
        	var btn = $(t).find('button').text();
        
        	$.ajax({
        				url:'<?=site_url('home/file-service/')?>'+$(t).data('service-id'),
        				type:'POST',
        				data:$(t).serialize(),
        				beforeSend:function()
        				{	
        					$(ele).find("input,textarea,button").attr("disabled","disabled");
        					$(ele).find("button").html("<i class='fa fa-spinner fa-spin'></i> Please Wait..");
        					
        				},
        				success:function(q)
        				{	
        
        					if(q=='0')
        					{
        						alert("No Result Found.");
        					}
        					else
        					{
        						var d = JSON.parse(q);
        						
        						if(d.download=='1')
        						{	
        							$("#fileView > .downloadButton").attr("href",d.link);
        							$("#fileView > .downloadButton").show();
        						}
        						else
        						{
        							$("#fileView > .downloadButton").hide();
        						}
        
        						$("#fileView > embed").attr("src",d.link+'#toolbar='+d.download+'&navpanes=0&scrollbar=0');
        						$("#fileView").show();
        						
        					}
        					$(ele).find("input,textarea,button").removeAttr("disabled",);
        					$(ele).find("input,textarea").val("");
        				},
        				complete:function()
        				{
        					$(ele).find("button").text(btn);
        				}
        			});
        }
            $(document).hover(
                 function(e){ e.preventDefault();  }, 
                 function(e){ e.preventDefault(); });
          </script>
        <?

?>