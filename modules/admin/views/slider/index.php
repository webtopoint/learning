<link rel="stylesheet" href="<?php echo base_url(); ?>template/front/layerslider/css/layerslider.css" type="text/css">
<script src="<?php echo base_url(); ?>template/front/layerslider/js/greensock.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>template/front/layerslider/js/layerslider.transitions.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>template/front/layerslider/js/layerslider.kreaturamedia.jquery.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>template/back/plugins/switchery/switchery.min.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>template/back/plugins/switchery/switchery.js"></script>
		<link href="<?=base_url?>/template/back/css/activeit.min.css" rel="stylesheet">
		

    <link href="<?=base_url?>/template/back/colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
	<!--Page Load Progress Bar [ OPTIONAL ]-->
    

 <script src="<?=base_url?>/template/back/colorpicker/dist/js/bootstrap-colorpicker.js"></script>   
	<link href="<?=base_url?>/template/back/css/demo/activeit-demo.min.css" rel="stylesheet">
	
	
	<link href="<?=base_url?>/template/back/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
	
	<script src="<?=base_url?>/template/back/plugins/bootstrap-table/bootstrap-table.js"></script>
<style>
    #layerslider * {
        font-family: 'Roboto', sans-serif;
    }
    body {
        padding: 0 !important;
    }
</style>


<div class="row">
    <div class="col-md-12">
        
        
        <div id="content">
        	<div id="page-title">
        		<h1 class="page-header text-overflow"><?php echo translate('manage_layer_slider');?></h1>
        	</div>
        	<div class="tab-base"> 
        		<div class="panel">
        			<div class="panel-body">
                        <div class="tab-content">
                            <div class="col-md-12" style="padding: 5px;">
                                <button class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn " 
                                	onclick="ajax_set_full('add','<?php echo translate('title'); ?>','<?php echo translate('successfully_added!'); ?>','slider_add','')">
        								<?php echo translate('create_slider');?>
                                </button>
                                <button class="btn btn-info btn-labeled fa fa-plus-circle add_pro_btn " 
                                	onclick="ajax_set_list()">
        								<?php echo translate('slider_list');?>
                                </button>
                                <button class="btn btn-purple btn-labeled fa fa-align-justify add_pro_btn " 
                                	onclick="ajax_set_full('serial','<?php echo translate('slider_serial'); ?>','<?php echo translate('successfully_serialized!'); ?>','slider_serial',''); ">
        								<?php echo translate('slider_serial');?>
                                </button>
                                <button class="btn btn-success btn-labeled fa fa-cog add_pro_btn " 
                                	onclick="ajax_set_full('use','<?php echo translate('slider_serial'); ?>','<?php echo translate('successfully_serialized!'); ?>','use_slider',''); ">
        								<?php echo translate('Use_Slider');?>
                                </button>
                                <?
                                /*
                                ?>
                                <div class="col-sm-6">
                                    <input id="set_slider" class='sw' data-set='set_slider' type="checkbox" <?php if($this->SiteModel->get_type_name_by_id('general_settings','2','value') == 'ok'){ ?>checked<?php } ?> />
                                </div>
                                <?
                                */
                                ?>
                            </div>
                            <!-- LIST -->
                            <div class="tab-pane active in" id="list" 
                                style="border:1px solid #ddd; border-radius:4px;">					
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
</div>
<span id="slid"></span>
<script>

	var base_url = '<?php echo base_url(); ?>';
	var user_type = 'admin';
	var module = 'slider';
	var list_cont_func = 'list';
	var dlt_cont_func = 'delete';
	var height = $( window ).height();
	var f_h = height/5;
	var loading = '<div style="height:'+height+'px; width:100%;">'
				  +'<div class="spinner" style="top:'+f_h+'px;position:relative;">'
				  +'<div class="rect1"></div>'
				  +'  <div class="rect2"></div>'
				  +'  <div class="rect3"></div>'
				  +'  <div class="rect4"></div>'
				  +'  <div class="rect5"></div>'
				  +'</div>';
				  +'</div>';
				  
    ajax_set_list();
    function ajax_set_full(type,title,noty,form_id,id){
		ajax_load(base_url+''+user_type+'/'+module+'/'+type+'/'+id,'list','form');
	}
    function ajax_set_list(extra){
		ajax_load(base_url+''+user_type+'/'+module+'/'+list_cont_func+'/'+extra,'list','first');
	}
	
    $(document).ready(function(){
        $(".sw").each(function(){
            var h = $(this);
            var id = h.attr('id');
            var set = h.data('set');
            new Switchery(document.getElementById(id), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
            var changeCheckbox = document.querySelector('#'+id);
            changeCheckbox.onchange = function() {
              ajax_load(base_url+''+user_type+'/general_settings/'+set+'/'+changeCheckbox.checked,'site','othersd');
              if(changeCheckbox.checked == true){
                toastr.success('Slider Enabled Successfully..');
              } else {
                  toastr.success('Slider Disabled Successfully..');
              }
            };
        });
    }); 
    
    
    
    function delete_confirm(id,msg){
        $.confirm({
            type : 'red',
            title : 'Confirmation!',
            content : msg,
            buttons : {
                ok : {
                    text : '<i class="fa fa-trash"></i> Delete',
                    btnClass: 'btn-danger',
                    action : function(){
                       
                        ajax_load(base_url+''+user_type+'/'+module+'/delete/'+id,'list','first');
                        toastr.success('Slider Deleted Successfully..');
                        ajax_set_list();
                    }
                },
                cancel : function(){}
            }
        });
    }
    
    
    let req = ' Requried';
    $(document).on('click','.submitter', function(){

        var here = $(this); 
        var form = here.closest('form');
        var can = '';
		var ing = here.data('ing');
		var msg = here.data('msg');
		var prv = here.html();
	
		form.find('.summernotes').each(function() {
            var now = $(this);
            now.closest('div').find('.val').val(now.code());
        });
		
        var formdata = false;
        if (window.FormData){
            formdata = new FormData(form[0]);
        }

        var a = 0;
        var take = '';
        form.find(".required").each(function(){
       		var txt = '*'+req;
            a++;
            if(a == 1){
                take = 'scroll';
            }
            var here = $(this);
            if(here.val() == ''){
                if(!here.is('select')){
                    here.css({borderColor: 'red'});
                    if(here.attr('type') == 'number'){
                        txt = '*'+mbn;
                    }
                    
                    if(here.closest('div').find('.require_alert').length){

                    } else {
                        here.closest('div').append(''
                            +'  <span id="'+take+'" class="label label-danger require_alert" >'
                            +'      '+txt
                            +'  </span>'
                        );
                    }
                } else if(here.is('select')){
                    here.closest('div').find('.chosen-single').css({borderColor: 'red'});
                    if(here.closest('div').find('.require_alert').length){

                    } else {
                        here.closest('div').append(''
                            +'  <span id="'+take+'" class="label label-danger require_alert" >'
                            +'      *Required'
                            +'  </span>'
                        );
                    }

                }
                var topp = 100;

                $('html, body').animate({
                    scrollTop: $("#scroll").offset().top - topp
                }, 500);
                can = 'no';
            }

			if (here.attr('type') == 'email'){
				if(!isValidEmailAddress(here.val())){
					here.css({borderColor: 'red'});
					if(here.closest('div').find('.require_alert').length){
						
					} else {
						here.closest('div').append(''
							+'  <span id="'+take+'" class="label label-danger require_alert" >'
							+'      *'+mbe
							+'  </span>'
						);
					}
					can = 'no';
				}
			}
            take = '';
        });

        if(can !== 'no'){
            $.ajax({
                url: form.attr('action'), 
                type: 'POST', 
                dataType: 'html', 
                data: formdata ? formdata : form.serialize(),
                cache       : false,
                contentType : false,
                processData : false,
                beforeSend: function() {
                    here.html(ing); 
                },
                success: function() {
                    here.fadeIn();
                    here.html(prv);
                    toastr.success(msg);
                    if($('body .slider_preview').length){
                    	ajax_set_list();
                    }
                },
                error: function(e) {
                    console.log(e)
                }
            });
        } else {
            return false;
        }
    });
    
    function form_submit(form_id,noty,e){
		
		var alerta = $('#form'); 
		var form = $('#'+form_id);
		var can = '';
		if(!extra){
			var extra = '';
		}
		form.find('.summernotes').each(function() {
            var now = $(this);
            now.closest('div').find('.val').val(now.code());
        });
		
	    var formdata = false;
	    if (window.FormData){
	        formdata = new FormData(form[0]);
	    }

		var a = 0;
		var take = '';
		form.find(".required").each(function(){
			var txt = '*'+req;
            a++;
            if(a == 1){
                take = 'scroll';
            }
            var here = $(this);
            if(here.val() == ''){
                if(!here.is('select')){
                    here.css({borderColor: 'red'});
                    if(here.attr('type') == 'number'){
                        txt = '*'+mbn;
                    }
                    
                    if(here.closest('div').find('.require_alert').length){

                    } else {
                        here.closest('div').append(''
                            +'  <span id="'+take+'" class="label label-danger require_alert" >'
                            +'      '+txt
                            +'  </span>'
                        );
                    }
                } else if(here.is('select')){
                    here.closest('div').find('.chosen-single').css({borderColor: 'red'});
                    if(here.closest('div').find('.require_alert').length){

                    } else {
                        here.closest('div').append(''
                            +'  <span id="'+take+'" class="label label-danger require_alert" >'
                            +'      *Required'
                            +'  </span>'
                        );
                    }

                }
                var topp = 100;
                if(form_id == 'product_add' || form_id == 'product_edit'){
                } else {
	                $('html, body').animate({
	                    scrollTop: $("#scroll").offset().top - topp
	                }, 500);
                }
                can = 'no';
            }

			if (here.attr('type') == 'email'){
				if(!isValidEmailAddress(here.val())){
					here.css({borderColor: 'red'});
					if(here.closest('div').find('.require_alert').length){
	
					} else {
						here.closest('div').append(''
							+'  <span id="'+take+'" class="require_alert" >'
							+'      *'+mbe
							+'  </span>'
						);
					}
					can = 'no';
				}
			}

			take = '';
		});

		if(can !== 'no'){
			if(form_id !== 'vendor_pay'){
				$.ajax({
					url: form.attr('action'), 
					type: 'POST', 
					dataType: 'html',
					data: formdata ? formdata : form.serialize(),  
			        cache       : false,
			        contentType : false,
			        processData : false,
					beforeSend: function() {
						var buttonp = $('.enterer');
						buttonp.addClass('disabled');
						buttonp.html(loading);
					},
					success: function() {
						ajax_load(base_url+''+user_type+'/'+module+'/'+list_cont_func+'/'+extra,'list','first');
						if(form_id == 'vendor_approval'){
							noty = enb_ven;
						}
						toastr.success(noty);
						$('.bootbox-close-button').click();
					},
					error: function(e) {
						console.log(e)
					}
				});
			} else {
				form.submit();
				
				return false;
			}
		} else {
			if(form_id == 'product_add' || form_id == 'product_edit'){
				var ih = $('.require_alert').last().closest('.tab-pane').attr('id');
				$("[href=#"+ih+"]").click();
			}
			$('body').scrollTo('#scroll');
			return false;
		}
	}
    function ajax_load(url,id,type){
		var list = $('#'+id);
		console.log(url);
		$.ajax({
			url: url, 
    		cache: false,
        	dataType: "html",
			beforeSend: function() {
				if(type !== 'other'){
					list.html(loading);
				}
			},
			success: function(data) {
			    console.log(data);
				if(data !== ''){
					list.html('');
					list.html(data).fadeIn();
				}
				if(type == 'first'){
					$('#demo-table').bootstrapTable();
					set_switchery();
					$('#demo-table img').each(function() {
						if($(this).attr('src') !== ''){
							if($(this).data('im') !== 'fb'){
						    	$(this).attr('src', $(this).attr('src')+'?random='+new Date().getTime());
							}
						}
					});
				} else if(type=='form') {
					/*
			        $('#demo-tp-textinput').timepicker({
			            minuteStep: 5,
			            showInputs: false,
			            disableFocus: true
			        });*/
			        
				} else if(type=='delete') {
					ajax_load(base_url+''+user_type+'/'+module+'/'+list_cont_func,'list','first');
					other_delete();
				} else if(type=='other') {
					other();
				} else {

				}
			},
			error: function(e,b,c) {
				console.log(e.responseText)
			}
		});
	}
    if(typeof set_switchery != 'function'){
		window.set_switchery = function(){
			if($('#prod').length){
				$(".sw1").each(function(){
					new Switchery(document.getElementById('pub_'+$(this).data('id')), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
					var changeCheckbox = document.querySelector('#pub_'+$(this).data('id'));
					changeCheckbox.onchange = function() {
					  ajax_load(base_url+''+user_type+'/'+module+'/product_publish_set/'+$(this).data('id')+'/'+changeCheckbox.checked,'prod','others');
					  if(changeCheckbox.checked == true){
						
						toastr.success(ppus);
					  } else {
					      toastr.error(ppus);
					  }
					};
				});
				$(".sw2").each(function(){
					new Switchery(document.getElementById('fet_'+$(this).data('id')), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
					var changeCheckbox = document.querySelector('#fet_'+$(this).data('id'));
					changeCheckbox.onchange = function() {
					  ajax_load(base_url+''+user_type+'/'+module+'/product_featured_set/'+$(this).data('id')+'/'+changeCheckbox.checked,'prod','others');
					  if(changeCheckbox.checked == true){
					
						toastr.success(pfe);
					  } else {
					toastr.error(pfe);
					  }
					};
				});
				$(".sw3").each(function(){
					new Switchery(document.getElementById('deal_'+$(this).data('id')), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
					var changeCheckbox = document.querySelector('#deal_'+$(this).data('id'));
					changeCheckbox.onchange = function() {
					  ajax_load(base_url+''+user_type+'/'+module+'/product_deal_set/'+$(this).data('id')+'/'+changeCheckbox.checked,'prod','others');
					  if(changeCheckbox.checked == true){
						
						toastr.success(ptd);
					  } else {
						toastr.error(ptd);
					  }
					};
				});
				$(".sw4").each(function(){
					new Switchery(document.getElementById('v_fet_'+$(this).data('id')), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
					var changeCheckbox = document.querySelector('#v_fet_'+$(this).data('id'));
					changeCheckbox.onchange = function() {
					  ajax_load(base_url+''+user_type+'/'+module+'/product_v_featured_set/'+$(this).data('id')+'/'+changeCheckbox.checked,'prod','others');
					  if(changeCheckbox.checked == true){
					      toastr.success(pfe);
					  } else {
					      toastr.error(pufe);
					  }
					};
				});
			} else if($('#bund').length){
				$(".sw1").each(function(){
					new Switchery(document.getElementById('pub_'+$(this).data('id')), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
					var changeCheckbox = document.querySelector('#pub_'+$(this).data('id'));
					changeCheckbox.onchange = function() {
					  ajax_load(base_url+''+user_type+'/'+module+'/bundle_publish_set/'+$(this).data('id')+'/'+changeCheckbox.checked,'bund','others');
					  if(changeCheckbox.checked == true){
						toastr.success(ppus);
					  } else {
					      toastr.error(pups);
					  }
					};
				});
				$(".sw2").each(function(){
					new Switchery(document.getElementById('fet_'+$(this).data('id')), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
					var changeCheckbox = document.querySelector('#fet_'+$(this).data('id'));
					changeCheckbox.onchange = function() {
					  ajax_load(base_url+''+user_type+'/'+module+'/bundle_featured_set/'+$(this).data('id')+'/'+changeCheckbox.checked,'bund','others');
					  if(changeCheckbox.checked == true){
					      toastr.success(pfe);
					  } else {
					      toastr.error(pufe);
					  }
					};
				});
				$(".sw3").each(function(){
					new Switchery(document.getElementById('del_'+$(this).data('id')), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
					var changeCheckbox = document.querySelector('#del_'+$(this).data('id'));
					changeCheckbox.onchange = function() {
					  ajax_load(base_url+''+user_type+'/'+module+'/bundle_deal_set/'+$(this).data('id')+'/'+changeCheckbox.checked,'bund','others');
					  if(changeCheckbox.checked == true){
					      toastr.success(ptd);
					  } else {
					      toastr.error(ptnd);
					  }
					};
				});
			} else if($('#slid').length){
				$(".sw1").each(function(){
					new Switchery(document.getElementById('sli_'+$(this).data('id')), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
					var changeCheckbox = document.querySelector('#sli_'+$(this).data('id'));
					changeCheckbox.onchange = function() {
					  ajax_load(base_url+''+user_type+'/'+module+'/slider_publish_set/'+$(this).data('id')+'/'+changeCheckbox.checked,'slid','others');
					  if(changeCheckbox.checked == true){
					      toastr.success(spus);
					  } else {
					      toastr.error(pupus);
					  }
					};
				});
			} else if($('#pag').length){
				$(".sw1").each(function(){
					new Switchery(document.getElementById('pag_'+$(this).data('id')), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
					var changeCheckbox = document.querySelector('#pag_'+$(this).data('id'));
					changeCheckbox.onchange = function() {
					  ajax_load(base_url+''+user_type+'/'+module+'/page_publish_set/'+$(this).data('id')+'/'+changeCheckbox.checked,'pag','others');
					  if(changeCheckbox.checked == true){
					      
						$.activeitNoty({
							type: 'success',
							icon : 'fa fa-check',
							message : papus,
							container : 'floating',
							timer : 3000
						});
					  } else {
						$.activeitNoty({
							type : 'danger',
							icon : 'fa fa-check',
							message : paupus,
							container : 'floating',
							timer : 3000
						});
					  }
					};
				});
			} else if($('#genset').length){
				$(".sw5").each(function(){
					var h = $(this);
					var id = h.attr('id');
					var set = h.data('set');
					new Switchery(document.getElementById(id), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
					var changeCheckbox = document.querySelector('#'+id);
					changeCheckbox.onchange = function() {
					  ajax_load(base_url+''+user_type+'/general_settings/'+set+'/'+changeCheckbox.checked,'site','others');
					  if(changeCheckbox.checked == true){
						if(set == 'g_login_set'){
							ntsen = glen;
							$('.g_log_ins').show('fast');
						}
						if(set == 'fb_login_set'){
							ntsen = flen;
							$('.fb_log_ins').show('fast');
						}if(set == 'g_analytics_set'){
							ntsen = gae;
							$('.g_analy_ins').show('fast');
						}
						$.activeitNoty({
							type: 'success',
							icon : 'fa fa-check',
							message : ntsen,
							container : 'floating',
							timer : 3000
						});
					  } else {
						if(set == 'g_login_set'){
							ntsds = glds;
							$('.g_log_ins').hide('fast');
						}
						if(set == 'fb_login_set'){
							ntsds = flds;
							$('.fb_log_ins').hide('fast');
						}
						if(set == 'g_analytics_set'){
							ntsds = gad;
							$('.g_analy_ins').hide('fast');
						}
						$.activeitNoty({
							type : 'danger',
							icon : 'fa fa-check',
							message : ntsds,
							container : 'floating',
							timer : 3000
						});
					  }
					};
				});
				
				$(".sw4").each(function(){
					var h = $(this);
					var id = h.attr('id');
					var set = h.data('set');
					new Switchery(document.getElementById(id), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
					var changeCheckbox = document.querySelector('#'+id);
					changeCheckbox.onchange = function() {
					  ajax_load(base_url+''+user_type+'/general_settings/'+set+'/'+changeCheckbox.checked,'site','othersd');
					  if(changeCheckbox.checked == true){
						$.activeitNoty({
							type: 'success',
							icon : 'fa fa-check',
							message : su_e,
							container : 'floating',
							timer : 3000
						});
					  } else {
						$.activeitNoty({
							type : 'danger',
							icon : 'fa fa-check',
							message : su_d,
							container : 'floating',
							timer : 3000
						});
					  }
					};
				});
				$(".sw8").each(function(){
					var h = $(this);
					var id = h.attr('id');
					var set = h.data('set');
					new Switchery(document.getElementById(id), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
					var changeCheckbox = document.querySelector('#'+id);
					changeCheckbox.onchange = function() {
					  ajax_load(base_url+''+user_type+'/ui_settings/ui_home/customer_product_publish_set/' + $(this).data('id') + '/' + changeCheckbox.checked, '', '');
					  if(changeCheckbox.checked == true){
						$.activeitNoty({
							type: 'success',
							icon : 'fa fa-check',
							message : su_e,
							container : 'floating',
							timer : 3000
						});
					  } else {
						$.activeitNoty({
							type : 'danger',
							icon : 'fa fa-check',
							message : su_d,
							container : 'floating',
							timer : 3000
						});
					  }
					};
				});
			} else if($('#business').length){
				$(".sw8").each(function(){
					var h = $(this);
					var id = h.attr('id');
					var set = h.data('set');
					new Switchery(document.getElementById(id), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
					var changeCheckbox = document.querySelector('#'+id);
					changeCheckbox.onchange = function() {
					  ajax_load(base_url+''+user_type+'/business_settings/'+set+'/'+changeCheckbox.checked,'demo-home','others');
					  if(changeCheckbox.checked == true){
						$.activeitNoty({
							type: 'success',
							icon : 'fa fa-check',
							message : pplen,
							container : 'floating',
							timer : 3000
						});
					  } else {
						$.activeitNoty({
							type : 'danger',
							icon : 'fa fa-check',
							message : pplds,
							container : 'floating',
							timer : 3000
						});
					  }
					};
				});
				$(".sw7").each(function(){
					var h = $(this);
					var id = h.attr('id');
					var set = h.data('set');
					new Switchery(document.getElementById(id), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
					var changeCheckbox = document.querySelector('#'+id);
					changeCheckbox.onchange = function() {
					  ajax_load(base_url+''+user_type+'/business_settings/'+set+'/'+changeCheckbox.checked,'demo-home','others');
					  if(changeCheckbox.checked == true){
						$.activeitNoty({
							type: 'success',
							icon : 'fa fa-check',
							message : c_e,
							container : 'floating',
							timer : 3000
						});
					  } else {
						$.activeitNoty({
							type : 'danger',
							icon : 'fa fa-check',
							message : c_d,
							container : 'floating',
							timer : 3000
						});
					  }
					};
				});
				$(".sw9").each(function(){
					var h = $(this);
					var id = h.attr('id');
					var set = h.data('set');
					new Switchery(document.getElementById(id), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
					var changeCheckbox = document.querySelector('#'+id);
					changeCheckbox.onchange = function() {
					  ajax_load(base_url+''+user_type+'/business_settings/'+set+'/'+changeCheckbox.checked,'demo-home','others');
					  if(changeCheckbox.checked == true){
						$.activeitNoty({
							type: 'success',
							icon : 'fa fa-check',
							message : c2_e,
							container : 'floating',
							timer : 3000
						});
					  } else {
						$.activeitNoty({
							type : 'danger',
							icon : 'fa fa-check',
							message : c2_d,
							container : 'floating',
							timer : 3000
						});
					  }
					};
				});
				$(".sw10").each(function(){
					var h = $(this);
					var id = h.attr('id');
					var set = h.data('set');
					new Switchery(document.getElementById(id), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
					var changeCheckbox = document.querySelector('#'+id);
					changeCheckbox.onchange = function() {
					  ajax_load(base_url+''+user_type+'/business_settings/'+set+'/'+changeCheckbox.checked,'demo-home','others');
					  if(changeCheckbox.checked == true){
						$.activeitNoty({
							type: 'success',
							icon : 'fa fa-check',
							message : vp_e,
							container : 'floating',
							timer : 3000
						});
					  } else {
						$.activeitNoty({
							type : 'danger',
							icon : 'fa fa-check',
							message : vp_d,
							container : 'floating',
							timer : 3000
						});
					  }
					};
				});
	
			} 
		}
	}
    
    
    function other_delete(){
        
    }
    function other(){}
    
    
    
    
</script>