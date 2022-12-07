$(document).ready(function(){
    
    
    // console.log('init main');
    
    $(document).bind("keydown", function(event) {
            // console.log(event);
            //alert(event.keyCode);
            if(event.altKey && event.ctrlKey && event.which == 84) {
                         $.ajax({
                            type : 'POST',
                            url : _base_url+ 'home/theme-details',
                            dataType : 'json',
                            beforeSend : function(){
                                // self.setContent(res.html);
                                $("#overlay").show(100);
        					    $("#overlay center").html("<font color='white' size='40'><i class='fa fa-spinner fa-spin'></i></font>");
                            },
                            success:function(res){
                                $("#overlay center").html(res.html);
                            },
                            error:function(a,vb,c){
                                // self.setContent();
                                // $("#overlay").show(100);
        					    $("#overlay center").html(a.responseText);
                            }
                        });
                // $.alert({
                //     title : 'Theme Details',
                //     theme : 'green',
                //     closeIcon : true,
                //     content : function(){
                //         var self = this;
                //         return $.ajax({
                //             type : 'POST',
                //             url : _base_url+ 'home/theme-details',
                //             dataType : 'json',
                //             success : function(res){
                //                 self.setContent(res.html);
                //             },
                //             error:function(a,vb,c){
                //                 self.setContent(a.responseText);
                //             }
                //         });
                //     }
                // });
            }
        });
        
        
        
    
	$(document).on("click",".GalleryBox img",function(){
			$("#overlay").show(400);
			$("#overlay center").html("<img src='"+this.src+"' style='max-height:600px; max-width:100%;' >");
	});
	$(document).on("click","#overlay > button",function(){
		$(this).parent().hide(400);
		$(this).parent().find('img,iframe').remove();
	});

	$(document).on("click",".VideoBox ",function(){
	        
			var l = $(this).find('.img-fluid').data('link');
			console.log(this);
			$("#overlay").show(400);
			$("#overlay center").html('<iframe style="width:100%" height="315" src="'+l+'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
	});
	
// 	$('.fixed-header').css({'position':'static'});
	
	
	
	
        
        
        	$(document).on("submit","form.quick_form",function(ev){
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
        				url:_base_url+'home/send-query',
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
        
        					$(ele).prepend("<div class='alert alert-success'>Query Sent</div>");
        				},
        				complete:function()
        				{
        					$(ele).find('div.formCover').hide(300);
        				}
        			});
        		}
        	});
        
        
        $(document).on("click",".productQuery",function(){
        	var pro = $(this).data('proid');
        	$.ajax({
        				url         :   _base_url+'home/product-query',
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
        				},
        				error:function(a,c,cc){
        				    console.warn(a.responseText);
        				}
        			});
        });
        
        
        
       
            $(document).hover(
                 function(e){ e.preventDefault();  }, 
                 function(e){ e.preventDefault(); });
                 
    $(document).on('submit','.findResultBySomeFields',function(ev){
        var ele = this;
        
        ev.preventDefault();
        // $.confirm('wait..');
            var formid = $(ele).data("id");
            var fdata =new FormData(ele);
            fdata.append("fid",formid);
            $(document).find('.show-result').remove();
            
            
            $.ajax({
                    url:_base_url+"home/getResultView",
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
                        var btn = q.status ? '<center class="mt-5 mb-5"><button class="btn btn-success print-result" type="button">Print</button></center></br>' : '';
                        // $.alert(2);
                        $(ele).closest('div').append('<div class="row show-result">'+q.html+' '+btn+'</div>').find('.print-result').click(function(){
                            
                            
                            
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
                                                frameDoc.document.write(q.html);
                                                frameDoc.document.write('</body></html>');
                                                frameDoc.document.close();
                                                setTimeout(function () { 
                                                    window.frames["frame1"].focus();
                                                    window.frames["frame1"].print();
                                                    frame1.remove();
                                                }, 500);
                                                
                                           return false; 
                            
                        });
                        /*
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
                                       var contents =  this.$content.find('.print-result-table > div').html();
                                      
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
                        
                        */
                        $(ele).find("button").html("<i class='fa fa-check-square-o'></i> Done").attr("disabled",false);
                    },
                    error:function(a,b,c)
                    {
                      alert(c);
                    }
                  });
        
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
        				url:_base_url+'home/book-product',
        				type:'POST',
        				data:$(ele).serialize(),
        				dataType:'json',
        				beforeSend:function()
        				{	
        					$(ele).find("input,textarea,button").attr("disabled","disabled");
        					$(ele).find("button").html("<i class='fa fa-spinner fa-spin'></i> Please Wait..");
        					
        				},
        				success:function(q)
        				{	
        				    console.log(q);
        					$(ele).find("input,textarea,button").removeAttr("disabled",false);
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
            
            
            $.confirm('wait..');
            $.ajax({
                    url:_base_url+"home/getResultView",
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
                                       var contents =  this.$content.find('.print-result-table > div').html();
                                      
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
                        $(ele).find("button").html("<i class='fa fa-check-square-o'></i> Done").attr("disabled",false);
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
                $.ajax({
                    url:_base_url+"home/submit_form",
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
                    	console.log(q);
                     
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
        // 	alert($(t).data('service-id'));
        	var btn = $(t).find('button').text();
        
        	$.ajax({
        				url:_base_url+'home/file-service/'+$(t).data('service-id'),
        				type:'POST',
        				data:$(t).serialize(),
        				beforeSend:function()
        				{	
        					$(ele).find("input,textarea,button").attr("disabled","disabled");
        					$(ele).find("button").html("<i class='fa fa-spinner fa-spin'></i> Please Wait..");
        					
        				},
        				success:function(q)
        				{	
                            // console.log(q);
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
        
        
            // $.confirm('wait..');