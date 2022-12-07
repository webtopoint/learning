 <style>
    .category-box,.News-box{
        min-height: 300px;
    }
    .active-body{
        border:1px dotted red;
        background:rgba(0,0,0,0.5)!important;
    }
    #widget_title{
        background:transparent;
        border:none;    
        color: white;
        font-size: 26px;
        font-weight: 700;
        width:85%;
    }
    #widget_title:focus{
        outline:0;
    }
</style>
<div class="row right-widgets" >
    <div class="col-md-4">
        <div class="card card-primary">
            <div class="card-header">
                <strong>In Category</strong>
            </div>
            <div class="card-body category-box">
                <?
                $get = $this->NewsModel->getNewsSetting('right_widget_in_category');
                $row = [];
                if($get->num_rows()){
                    $row = (array) json_decode( $get->row()->value, true); 
                    //print_r($row);
                    if($row != null){
                        foreach($row['actions'] as $key => $action){
                            $rand = rand(1111,0000);
                                echo '
                                    <div class="drop-item" data-action="">
                                        <div class="card">
                                            <div class="card-header bg-success text-white" id="headingOne">
                                             
                                                <input type="text" id="widget_title" value="'.trim(strip_tags($row['boxTitle'][$key])).'">
                                                
                                                <button type="button" style="    position: absolute;    right: 10px;" data-toggle="collapse" href="#collapseExample'.$rand.'" class="btn btn-primary" aria-expanded="false">
                                                    <i class="fa fa-cog"></i>
                                                </button>
                                              
                                            </div>
                                            <div class="collapse" id="collapseExample'.$rand.'" style="padding:10px">
                                                <div class="form-group">
                                                    <label>Number Of Post(s)</label>
                                                    <input type="number" class="form-control " placeholder="No. of POST" id="number_of_post" value="'.$row['numPost'][$key].'">
                                                </div>
                                                <div class="form-group">
                                                    <label>Select Category(s)</label>
                                                    <select class="form-control" id="category_list" multiple>';
                                                    foreach($this->NewsModel->get_category()->result() as $cat){
                                                        $cats = $row['catBox'][$key] == null ? []: (array) $row['catBox'][$key];
                                                        $selected = in_array($cat->id,$cats) ? 'selected' : '';
                                                         echo '<option value="'.$cat->id.'" '.$selected.'>'.$cat->name.'</option>';   
                                                    }
                                                echo '</select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-primary">
            <div class="card-header">
                <strong>In News</strong>
            </div>
            <div class="card-body News-box">
                <?
                $get = $this->NewsModel->getNewsSetting('right_widget_in_news');
                $row = [];
                if($get->num_rows()){
                    $row = (array) json_decode( $get->row()->value, true); 
                    if($row != null){
                        foreach($row['actions'] as $key => $action){
                            $rand = rand(1111,0000);
                                echo '
                                    <div class="drop-item" data-action="'.$action.'">
                                        <div class="card">
                                            <div class="card-header bg-success text-white" id="headingOne">
                                             
                                                <input type="text" id="widget_title" value="'.trim(strip_tags($row['boxTitle'][$key])).'">
                                                
                                                <button type="button" style="    position: absolute;    right: 10px;" data-toggle="collapse" href="#collapseExample'.$rand.'" class="btn btn-primary" aria-expanded="false">
                                                    <i class="fa fa-cog"></i>
                                                </button>
                                              
                                            </div>
                                            <div class="collapse" id="collapseExample'.$rand.'" style="padding:10px">
                                                <div class="form-group">
                                                    <label>Number Of Post(s)</label>
                                                    <input type="number" class="form-control " placeholder="No. of POST" id="number_of_post" value="'.$row['numPost'][$key].'">
                                                </div>
                                                <div class="form-group">
                                                    <label>Select Category(s)</label>
                                                    <select class="form-control" id="category_list" multiple>';
                                                    foreach($this->NewsModel->get_category()->result() as $cat){
                                                        $cats = $row['catBox'][$key] == null ? []: (array) $row['catBox'][$key];
                                                        $selected = in_array($cat->id,$cats) ? 'selected' : '';
                                                         echo '<option value="'.$cat->id.'" '.$selected.'>'.$cat->name.'</option>';   
                                                    }
                                                echo '</select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-primary">
            <div class="card-header">
                <strong>All Widgets</strong>
            </div>
            <div class="card-body" style="height:300px;overflow-x:hidden">
                <div class="list-group" style="height:200px;min-height:300px">
			        <li class="list-group-item drag-in-widget" data-action="title_newsList" draggable="true" >
			            <strong>Title News List</strong>
			        </li>
			        
			        <li class="list-group-item drag-in-widget" data-action="thumbnail_news" draggable="true">
					    <strong>Thumbnail News List</strong>
					</li>
					
					<li class=" list-group-item drag-in-widget" data-action="sliderNews" draggable="true">
						<strong>News Slider List</strong>
					</li>
					
					<li class="list-group-item drag-in-widget" data-action="thumbnail_with_title_grid_view" draggable="true">
						<strong>Thumbnail With Title News List [ Grid News ]</strong>
					</li>
			    </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success save-data-right-widget">Save </button>
            </div>
        </div>
    </div>
</div>

<script>
$('.save-data-right-widget').click(function(){
    //alert('You don\'t have permission to do this task..');
    let category = [],
        news = [],
        actions = [],
        numPost = [],
        catBox = [],
        boxTitle = [];
        
        
    $('.News-box .drop-item').each(function(i,n){
        let catX = $(n).find('#category_list');
        actions[i] = $(n).data('action');
        numPost[i] = $(n).find('#number_of_post').val();
        catBox[i]  = $(catX).val();
        boxTitle[i] = $(n).find('#widget_title').val();
    });
    news = {actions,numPost,catBox,boxTitle};
    console.log('Category');
    $('.category-box .drop-item').each(function(i,n){
        let catX = $(n).find('#category_list');
        actions[i] = $(n).data('action');
        numPost[i] = $(n).find('#number_of_post').val();
        catBox[i]  = $(catX).val();
        boxTitle[i] = $(n).find('#widget_title').val();
    });
    category = {actions,numPost,catBox,boxTitle};
    console.log(news);
    console.log(category);
    NProgress.start();
    $.ajax({
        type : 'POST',
        url : base_url+'/Admin/news_ajax',
        data : {data : {news,category} , status : 'right_widgets'},
        dataType : 'json',
        success : function(e){
            console.log(e);
            NProgress.done();
        },
        complete:function(){
            NProgress.remove();
        }
    });
});
     $(function() {
            $( ".drag-in-widget" ).draggable({
              appendTo: ".right-widgets",
              helper: "clone",
              start  : function(event, ui){
                 $(ui.helper).css('width', `${ $(event.target).width() }px`).addClass("ui-helper");
             }
            });
            
            $( ".category-box,.News-box" ).droppable({
              activeClass: "ui-state-default",
              hoverClass: "ui-state-hover active-body",
              accept: ":not(.ui-sortable-helper)",
              drop: function( event, ui ) {
                  let that = this;
                $( this ).find( ".placeholder" ).remove();
                NProgress.start();
                $('<div class="drop-item proccess sortable_cancel ui-state-disabled"></div>').html('<strong><i class="fa fa-spin fa-spinner fa-3x"></i> Loading...</strong>').appendTo( this );
                $.ajax({
                    url : base_url + '/Admin/news_ajax',
                    data : { action : ui.draggable.data('action'), status : 'get_news_right_widget' , html : ui.draggable.html()},
                    dataType : 'json',
                    type : 'POST',
                    success:function(res){
                        NProgress.done();
                        console.log(res);
                        $( '<div  class="drop-item" data-action="'+ui.draggable.data('action')+'"></div>' ).html(res.html).appendTo(that);
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
</script>