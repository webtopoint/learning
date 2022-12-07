<?php
$isAjax = isset($isAjax);// ? true : false;
$this->load->helper('tool/custom');
?>
<style>
.row{position: relative;}
.post-list{ 
    margin-bottom:20px;
}
div.list-item {
    border-left: 4px solid #7ad03a;
    margin: 5px 15px 2px;
    padding: 1px 12px;
    background-color:#F1F1F1;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    height: 60px;
}
div.list-item p {
    margin: .5em 0;
    padding: 2px;
    font-size: 13px;
    line-height: 1.5;
}
.list-item a {
    text-decoration: none;
    padding-bottom: 2px;
    color: #0074a2;
    -webkit-transition-property: border,background,color;
    transition-property: border,background,color;-webkit-transition-duration: .05s;
    transition-duration: .05s;
    -webkit-transition-timing-function: ease-in-out;
    transition-timing-function: ease-in-out;
}
.list-item a:hover{text-decoration:underline;}
.list-item h2{font-size:25px; font-weight:bold;text-align: left;}


/* loading */
.loading{position: absolute;left: 0; top: 0; right: 0; bottom: 0;z-index: 2;background: rgba(255,255,255,0.7);}
.loading .content {
    position: absolute;
    transform: translateY(-50%);
     -webkit-transform: translateY(-50%);
     -ms-transform: translateY(-50%);
    top: 50%;
    left: 0;
    right: 0;
    text-align: center;
    color: #555;
}
.page-link i {
    line-height: 1!important;
}
.table td:first-child, .table th:first-child, .table tr:first-child {
    padding-left: 11px!important;

    
}
.list_website .card .card-body{
    padding:0!important;
}
.dark .card-body{
    background:transparent!important;
}
.dark h6{
    color:white!important;
}
.list_website .card .card-header{
    min-height: 127px!important;
}
.pagination {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-end;
    margin: 0;
    flex-direction: row;
    /* width: 217px; */
    float: right;
}
.box > .card{
    box-shadow:inset 0 0 10px 0 black;
    transition:.3s;
    border:1px solid black;
}
.box > .card:hover{
    box-shadow:0 0 10px 0 black;
    transition:.3s;
    border:1px solid black;
}
.dark > .card{
    box-shadow:inset 0 0 10px 0 white;transition-timing-function: linear;
    border:1px solid white;
}
.dark > .card:hover{
    box-shadow:0 0 10px 0 white;transition-timing-function: linear;
    border:1px solid white;
}
.view-img:hover{

    border:3px double white;
    box-shadow: 0 0 10px 0 black;
}
</style>
<?php if(!$isAjax): ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
    // toastr.success('ss');
    $(document).on('change','.change-website',function(){
        var status  = ($(this).is(':checked') ? 1 : 0),
            that = this,
            box = $(this).closest('.box'),
            id = $(box).data('id'),
            boxId = $(box).find('.card').attr('id');
        NProgress.configure({parent : '#'+boxId});
        NProgress.start();
        $.confirm({
            type : 'green',
            title : 'Confirmation',
            theme : 'bootstrap',
            content : 'Are you sure for changes.',
            icon : 'fa fa-toggle-on',
            buttons : {
                ok:{
                    text : 'OK',
                    btnClass : 'btn-primary',
                    action : function(){
                        $.ajax({
                            type : 'POST',
                            url : '<?=base_url('website/update_status')?>',
                            data : {id,status},
                            dataType : 'json',
                            success : function(res){
                                console.log(res);
                                NProgress.done();
                                toastr.success(res.message);
                            },
                            error: function(r,v,c){
                                console.log(r.responseText);
                                NProgress.done();
                            }
                        });
                    }
                },
                cancel:function(){
                    $(that).prop('checked',!status);
                    NProgress.done();
                }
            }
        });
        
        
    });
function searchFilter(page_num) {
	page_num = page_num?page_num:0;
	var keywords = $('#keywords').val();
	    keywords = keywords.replace(/^\/\/|^.*?:(\/\/)?/, '')
	    keywords = keywords.replace(/(^\w+:|^)\/\//, '').replace('/','');
	    $('#keywords').val(keywords);
	var sortBy = $('#sortBy').val();
	var limit = $('#limit').val();
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url(); ?>website/ajaxPaginationwebsiteData/'+page_num,
		data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&limit='+limit,
		beforeSend: function () {
			$('.loading').show();
		},
		success: function (html) {
			$('#list_website').html(html);
			$('.loading').fadeOut("slow");
		},
		error : function(a,vb,c){
		    $('#list_website').html(a.responseText);
		}
	});
}
</script>
<div class="row row-sm">

	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary tx-white">
				<strong class="card-title"><i class="fa fa-list"></i> List Website(s)</strong>
			</div>
			<div class="card-body">
			    <div class="row">
			        <div class="col-md-6">
			            <div class="form-group">
			                <lablel>Enter Domain</lablel>
			                <input type="text" id="keywords" class='form-control' placeholder="Enter domain name" onkeyup="searchFilter()"/>
			            </div>
			        </div>
        			<div class="col-md-3">
        			    <div class="form-group">
        			        <lablel>Sort By</lablel>
        			        <select id="sortBy" class="form-control" onchange="searchFilter()">
            				    <option value="">Sort By</option>
                				<option value="asc">Ascending</option>
                				<option value="desc">Descending</option>
                			</select>
        			    </div>
            			
            		</div>
            		<div class="col-md-3">
            		    <div class="form-group">
            		        <lablel>Limit</lablel>
            		        <select id="limit" class="form-control" onchange="searchFilter()">
                				<option value="10">10</option>
                				<option value="100">100</option>
                				<option value="500">500</option>
                				<option value="1000">1000</option>
                			</select>
            		    </div>
            			
            		</div>
        		</div>
        		<div class="loading" style="display: none;"><div class="content"><img src="<?php echo base_url().'assets/images/loading.gif'; ?>"/></div></div>
			</div>
			<div class="" id="list_website">
			    
                <?php 
                endif;
                // $this->load->module('file');
                if(!empty($websites)): echo '<div class="card-body row ">'; foreach($websites as $website):
                     
                    $file = base_url.'/public/web/assets/images/avatars/9.jpg';
                    if($yes = $this->WebsiteModel->getWebsiteData($website['id'])){
                        if(file_exists('public/temp/'.$website['id'].'/'.$yes->logo) AND !empty($yes->logo)){
                            $file = base_url.'/public/temp/'.$website['id'].'/'.$yes->logo;
                        }
                    }
                    else if(!empty($website['photo'])){
                        $file       = base_url.'/public/temp/'.$website['id'].'/'.$website['photo'];
                    }

                    // echo $this->file->get($website['id']);

                    
                    /*
                     <div class="col-lg-6 mg-t-20 mg-lg-t-0 mg-b-20 fade {theme_skin}">
                          <div class="card card-minimal-four " style="border:1px solid gray;border-radius:63px 0 0 0;border-top: 5px solid #f31891;">
                            <div class="card-header">
                              <div class="media">
                                
                                <div class="image-grouped">
                                    
                                        
                                        echo '<img class="img-xs rounded-circle" style="width: 102px;height: 102px;border: 4px solid #250735;" src="'.$file.'" alt="Logo">';
                                    
                                    ?>
                                </div>
                                
                                <div class="media-body">
                                  <h6><?=$website['name']?></h6>
                                  <p><?=$website['domain_name']?></p>
                                </div><!-- media-body -->
                              </div><!-- media -->
                            </div><!-- card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Username</th><td><?=$website['_email']?></td>
                                    </tr>
                                    <tr>
                                        <th>Password</th><td><?=$website['_pass']?></td>
                                    </tr>
                                    <tr>
                                        <th>Create</th><td><?=date('d M Y h:i A',$website['start_time'])?></td>
                                    </tr>
                                    <tr>
                                        <th>Expired</th><td><?
                                        
                                                $date = $website['expire_time'];
                                        if(empty($website['expire_time']))
                                            $date = strtotime( date( 'Y-m-d H:i:s', $website['start_time'] )  . ('+1 year'));
                                        echo date('d M Y h:i A',$date);
                                        ?></td>
                                    </tr>
                                </table>
                            </div><!-- card-body -->
                            <div class="card-footer" style="padding:10px">
                              <div class="btn-group">
                                  <!--<a href="<?=site_url('Admin/expire-websites').'/renew/'.$website['id'].'/'.$website['domain_name']?>"  class="btn btn-success btn-xs btn-sm " ><i class="fa fa-refresh"></i> Renew & Pyament</a>-->
                                  <!--<a href="<?=site_url('Admin/websites').'/invoices/'.$website['id'].'/'.$website['domain_name']?>"  class="btn btn-primary btn-xs btn-sm " ><i class="fa fa-file-o"></i> Invoice</a>-->
                                </div>
                            </div><!-- card-footer -->
                          </div><!-- card -->
                        </div>
                      */  
                    ?>
                     <div class="col-md-6 <?=config_item('theme_skin')?> box"  data-id="<?=$website['id']?>">
						<!--begin::Card-->
						<div class="card mb-3" id="box-<?=$website['id']?>">
							<!--begin::Card body-->
							<div class="card-body d-flex flex-center flex-column pt-12 p-9">
                                <label class="form-check form-switch form-check-custom form-check-solid" style="position: absolute;top: 14px;left: 10px;">
									<input class="form-check-input change-website" type="checkbox" value="1" <?=$website['active'] ? 'checked="checked"' : ''?> >
                                </label>
								<!--begin::Avatar-->
								<!--<a href="<?=$file?>"  data-fslightbox="lightbox-hot-sales">-->
								<div class="symbol symbol-65px symbol-circle mb-5 get-web-details">
									<img src="<?=$file?>" class="view-img" alt="image">
									<div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>
								</div>
								<!--end::Avatar-->
								<!--begin::Name-->
								<a href="javascript:void(0)" class="fs-4 text-gray-800 text-hover-primary get-web-details fw-bold mb-0"><?=$website['name']?></a>
								<!--end::Name-->
								<!--begin::Position-->
								<a href="https://<?=$website['domain_name']?>" target="_blank" class="fw-semibold text-gray-400"><?=$website['domain_name']?></a>
								<a target="_blank" href="https://<?=$website['domain_name'].'/admin?back_url='.base_url.'/customer-login&_token='.AJ_ENCODE($website['id'])?>&via=<?=time()?>" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">
								    <span class="svg-icon svg-icon-6 svg-icon-sign-in me-1">
								        <svg fill="#2c6eed" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M416 448h-84c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h84c17.7 0 32-14.3 32-32V160c0-17.7-14.3-32-32-32h-84c-6.6 0-12-5.4-12-12V76c0-6.6 5.4-12 12-12h84c53 0 96 43 96 96v192c0 53-43 96-96 96zm-47-201L201 79c-15-15-41-4.5-41 17v96H24c-13.3 0-24 10.7-24 24v96c0 13.3 10.7 24 24 24h136v96c0 21.5 26 32 41 17l168-168c9.3-9.4 9.3-24.6 0-34z"/></svg>
	                                </span> 
	                                Login
								</a>
								<!--end::Position-->
							</div>
							<!--end::Card body-->
						</div>
						<!--end::Card-->
					</div>
                     
                    <?php endforeach; 
                    
                    
                
                ?>
                    </div>
            <div class="card-footer">
                <div class="pd-20  mg-t-10 text-white"><?php echo $this->ajax_pagination->create_links(); ?></div>
            </div>
                
            
            <? else: ?>
                <div class="col-md-12"><div class="alert alert-danger">Website(s) not available.</div></div>
            <?php endif; 
                
                
        if(!$isAjax):?>
            
    		</div>
	    </div>
	</div>
</div>

<?php
endif;
?>
