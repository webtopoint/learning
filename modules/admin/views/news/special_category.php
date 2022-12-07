<style>
    .widget-set-area{
        border:2px dashed #ddd;
        min-height:400px;
        position:relative;
    }
    .widget-set-area span{
        font-size: 4.5em;
        color: #ddd;
        transform: rotate(27deg );
        position: absolute;
        top: 143px;
        font-weight: 700;
        font-family: cursive;
        z-index: 0; 
    }
    .all-widget-card{
        position: -webkit-sticky!important;
          position: sticky!important;
          bottom: 0;
    }
    .drop-li.proccess {
        height: 412px;
        border: 1px solid black;
        background-image: linear-gradient(
    -155deg
    , #d5244e, #060606);
        border-radius: 5px;
        box-shadow: 0 0 10px 0 grey;
    }
    .drop-li.proccess strong {
    font-size: 3.2em;
    font-family: cursive;
    color: white;
    transform: rotate(
37deg
);
    position: absolute;
    left: 15%;
    top:29px;
}
</style>
<form class="create-special-category" novalidate method="POST" enctype="multipart/form-data">
	<div class="card">

		<div class="card-header bg-primary text-white all-widget-card">
			<div><i class="fa fa-plus"></i> Add Special Category</div>
			<div class="btn-actions-pane-right">
                <div role="group" class="btn-group-sm btn-group">
                    <button class="btn-outline-9x text-white submit-btn btn-success btn btn-outline-focus" ><i class="fa fa-plus"></i> Publish</button>
                </div>
            </div>
		</div>

		<div class="card-body md row" style="    margin: 0;  ">
			<div class="col-md-9 row" style="margin:0">
				
				<div class="col-md-12 widget-set-area" >
				    <span>Drop Widget Here..</span>
				    <div class="widget-area-body row">
				        
				    </div>
				</div>
				
				
			</div>
			<div class="col-md-3">
				
				<div class="card all-widget-card">

					<div class="card-header bg-primary text-white">
						<strong>News Widget(s)</strong>
					</div>
					<div class="card-body">
					    <div class="list-group">
					        <li class="list-group-item drag" data-action="title_newsList" draggable="true" >
					            <strong>Title News List</strong>
					        </li>
					        
					        <li class="list-group-item drag" data-action="thumbnail_news" draggable="true">
    						    <strong>Thumbnail News List</strong>
        					</li>
        					
        					<li class=" list-group-item drag" data-action="sliderNews" draggable="true">
        						<strong>News Slider List</strong>
        					</li>
        					
        					<li class="list-group-item drag" data-action="thumbnail_with_title_grid_view" draggable="true">
        						<strong>Thumbnail With Title News List [ Grid News ]</strong>
        					</li>
					    </div>
						
    					
    					<hr>
    					<div class="form-group">
        				    <label>Enter Title</label>
        					<input type="text" id="title"  placeholder="Enter Title.." class="form-control">
        				</div>
    					<div class="form-group media-div image-div">
        				    <label>Select Title Image</label>
        					<div id="coba" class="row row-sm"></div>
        				</div>
        				<?/*
        				<div class="form-group">
        				    <label>Select Top Category</label>
        				    <select required class="form-control cats" name="cats[]" multiple>
        				        <option>Select</option>
        				        <?
        				        foreach($this->NewsModel->get_category()->result() as $cat)
        				            echo '<option value="'.$cat->id.'">'.$cat->name.'</option>';
        				        ?>
        				    </select>
        				</div>
    					*/
    					?>
					</div>

				</div>



			</div>
		</div>


	</div>

</form>

<hr>
<div class="card text-white">
    <div class="card-header bg-info">
        <strong><i class="fa fa-list"></i> List Special Category</strong>
    </div>
    <div class="card-body print-all">
        
    </div>
</div>
<style>
    .spartan_remove_row{
        width:18px!important;
        height:18px!important;
    }
    .widget-area-body{
        width:100%;
        position:absolute;
        height:100%;
        left:0;
        padding:10px;
        overflow-x:hidden;
    }
    .widget-area-box .card-body{
        background: rgb(255 255 255 / 15%)!important;
        border: 1px solid #3f6ad8!important;
    }
    .required{
        border:1px solid red!important;
    }
</style>
<script type="text/javascript" src="<?=base_url?>/public/spartan-multi-image-picker.js"></script>
<script>

 $(".sortable_cancel").disableSelection();
  getAll();
  $(document).on('click','.set-in-page',function(){
      let id = $(this).data('widgetid');
     // alert(id);
      $.dialog({
          type : 'green',
          icon : 'fa fa-list',
          title : 'List Page (s)',
          content : function(){
              let self = this;
              return $.ajax({
                  type : 'POST',
                  url : base_url+'/Admin/news_ajax',
                  data : { status : 'list-page-with-special-category', widgetId : id},
                  dataType :'json',
                  success :function(res){
                      self.setContent(res.html);
                  }
              });
          }
      });
  });
  $(document).on('change','.set-in-page-input',function(){
      let key = $(this).data('widgetid'),
          page_id = this.value;
            $.ajax({
                  type : 'POST',
                  url : base_url+'/Admin/news_ajax',
                  data : { status : 'use-special-category-in-page', key_id : key, page_id : page_id, type : 'special_category'},
                  dataType :'json',
                  success :function(res){
                      console.log(res);
                      toastr.success( ' Process Compelete Successfully.. ' );
                  },
                  error : function(f,v,g){
                      
                      console.log(v);
                      console.log(g);
                      console.log(f.responseText);
                  }
              });
  })
  function getAll(){
      $.ajax({
          type : 'POST',
          url : base_url+'/Admin/news_ajax',
          data : {status : 'list-special-category'},
          dataType : 'json',
          success : function(res){
              $('.print-all').html(res.html);
          }
      });
  }
  toastr.options = {
                        "closeButton": true,
                        "debug": true,
                        "positionClass": "toast-bottom-right",
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
    $(document).on('submit','.create-special-category',(event)=>{
        event.preventDefault();
        
        let on = true;
        
        $('.create-special-category').find('.form-control').each((kk,vv)=>{
            $(vv).removeClass('required');

        });
        
        
        var form_data = new FormData(),
            title = $('#title').val();
            
            if(!title){
                $('#title').addClass('required').focus();
                on = false;
            }
            form_data.append('title',title);
            
        var files = $('#files')[0].files;

        // Check file selected or not
        if(files.length > 0 ){
           form_data.append('file',files[0]);
        }
        else{
            toastr.error('Please Select Image..');
            on = false;
        }

       let actions = [],numPost = [],boxClasses = [],catBox = [];
       $('.drop-li').each((i,n)=>{
           
           let x = $(n).find('#number_of_post');
            if(!$(x).val()){
                $(x).addClass('required').focus();
                toastr.error('Please, Enter Title..');
                on = false;
            }
            let catX = $(n).find('#category_list');
            if(!$(catX).val() || $(catX).val() == null){
                $(catX).addClass('required').focus();
                
                toastr.error('Please, Select '+(i+1)+' Widget`s Category..');
                on = false;
            }
            
            
            catBox[i]  = $(catX).val().toString().replaceAll(',','|||');
            actions[i] = $(n).data('action');
            numPost[i] = $(n).find('#number_of_post').val();
            boxClasses[i] = $(n).find('#size').val();
            
        });


        if(!actions.length){
            toastr.error('Please, Drop atleast one widget..');
            on = false;
        }
        form_data.append("action", actions );
        form_data.append("numPost", numPost );
        form_data.append("boxClass", boxClasses );
        form_data.append("category", catBox );
        
        if(on === true ){
            let btn = $('.submit-btn').html();
            $('.submit-btn').html('<i class="fa fa-spin fa-spinner"></i> loading...').prop('disabled',true);
            $.ajax({
                url : window.location.href,
                data : form_data,
                type : 'POST',
                dataType : 'json',
                contentType: false,
                processData: false,
                success  : function(res){
                    console.log(res);
                    if(res.status){
                        toastr.success(res.message);
                        $('.create-special-category')[0].reset();
                        $('.spartan_remove_row').click();
                        $('.widget-area-body').html('');
                        getAll();
                    }
                    else
                        toastr.error(res.message);
                        
                    $('.submit-btn').html(btn).prop('disabled',false);
                }
            });
        }
        else
             toastr.error('Please, Fill all fields..');
             
        
    });
    
  
    
    $('.media-select').click(function(){
        	$('.media-div').slideUp(500);
        	$('.'+this.value+'-div').slideDown(500);
    });

		$(function(){

			$("#coba").spartanMultiImagePicker({
				fieldName:        'imgs[]" id="files"',
				maxCount:         1,
				rowHeight:        '150px',
				groupClassName:   'col-md-12',
				maxFileSize   :      '',
				placeholderImage: {
				    image: '<?=base_url?>/public/placeholder.png',
                	width : '100%'
				},
				dropFileLabel : "Drop Here",
				onAddRow:       function(index){
					console.log(index);
					console.log('add new row');
				},
				onRenderedPreview : function(index){
					console.log(index);
					console.log('preview rendered');
				},
				onRemoveRow : function(index){
					console.log(index);
				},
				onExtensionErr : function(index, file){
					console.log(index, file,  'extension err');
					alert('Please only input png or jpg type file')
				},
				onSizeErr : function(index, file){
					console.log(index, file,  'file size too big');
					alert('File size too big');
				}
			});
		});
		
NProgress.configure({ parent: '.widget-set-area' });

    
    
    
    function changeBOxSize(event){
        let box = $(event).closest('.drop-li');
        $(box).removeClass('col-md-3 col-md-4 col-md-6 col-md-8 col-md-9 col-md-12').addClass(event.value); 
    }
            
            

            
     $(function() {
            $( ".drag" ).draggable({
              appendTo: ".create-special-category",
              helper: "clone",
              start  : function(event, ui){
                 $(ui.helper).css('width', `${ $(event.target).width() }px`).addClass("ui-helper");
             }
            });
            
            $( ".widget-area-body" ).droppable({
              activeClass: "ui-state-default",
              hoverClass: "ui-state-hover",
              accept: ":not(.ui-sortable-helper)",
              drop: function( event, ui ) {
                  let that = this;
                $( this ).find( ".placeholder" ).remove();
                NProgress.start();
                $('<div class="drop-li proccess col-md-3 sortable_cancel ui-state-disabled"></div>').html('<strong><i class="fa fa-spin fa-spinner fa-3x"></i> Loading...</strong>').appendTo( this );
                $.ajax({
                    url : base_url + '/Admin/news_ajax',
                    data : { action : ui.draggable.data('action'), status : 'get_news_widget' },
                    dataType : 'json',
                    type : 'POST',
                    success:function(res){
                        NProgress.done();
                        console.log(res);
                        $( '<div  class="drop-li col-md-3" data-action="'+ui.draggable.data('action')+'"></div>' ).html('<div class="card"><div class="card-header bg-danger text-white">'+ui.draggable.html()+'</div>'+res.html+'</div>').appendTo(that);
                    },
                    complete:function(){
                        NProgress.remove();
                        $(that).find('.proccess').remove();
                    },
                    error : function(r,b,v){
                        console.log(r.responseText);
                        console.log(b);
                        console.log(v);
                    }
                });
                
                // $( '<div  class="drop-li col-md-3" data-action="'+ui.draggable.data('action')+'"></div>' ).html( '<div class="card"><div class="card-header bg-danger text-white">'+ui.draggable.html()+'</div>'+CardBody+'</div>'  ).appendTo( this );
                
                //saveData();
              }
            }).sortable({
                    forcePlaceholderSize: true,
                    tolerance: 'pointer',
                    animation: 150,
                    items: ".drop-li:not(.unsortable)",
                    update: function (event, ui) {
                       
                    },
                    cursor: 'pointer',
                    over: function () {
                        removeIntent = false;
                    },
                    out: function () {
                        removeIntent = true;
                    },
                    beforeStop: function (event, ui) {
                        if(removeIntent === true) {
                            ui.item.hide();
                            $.confirm({
                                type:'red',
                                title:'Confirmation',
                                icon:'fa fa-bell',
                                content:'Are you sure want to remove this item',
                                buttons:{
                                    ok:{
                                        text:'Yes',
                                        btnClass:'btn-danger',
                                        action:function(){
                                            ui.item.remove();
                                        }
                                    },
                                    cancel:function(){
                                        ui.item.show();
                                    }
                                }
                            });
                        }
                    }
            });
          });
          
          function saveData(){
              let i = 0,full_view = [],
                    grid_view = [];
              $('.div-full-news-view').find('li').each(function(i,v){
                  full_view[i++] = $(v).data('action');
              })
              i = 0;
              $('.div-grid-news-view').find('li').each(function(i,v){
                  grid_view[i++] = $(v).data('action');
              });
              NProgress.start();
              //console.log({full_view,grid_view});
              /*
              $.ajax({
                  url : base_url+'Admin/news_ajax',
                  data : {status : 'news_setting_layout', layout : {full_view,grid_view} },
                  dataType : 'json',
                  type :'post',
                  success: function(res){
                      NProgress.done();
                  },
                  complete:function(){
                    NProgress.remove();  
                  },
                  error : function(a,b,c){
                      console.log(a.responseText);
                  }
              });*/
          }
          
</script>