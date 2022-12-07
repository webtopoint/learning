<style>
    .text-black{
        color:black!important;
    }
    .ui-helper{
      background-color: rgb(0,0,0,.9);
      border:2px dotted red;
      color: white;
      z-index:99999999;
   }
   .drop-li{
      width: 100%;
      border:1px solid black;
      background-color: rgb(0,0,0,.8);
      color:white;
      font-size:1.3em;
      padding: 8px
   }
   .list-group{
       height:400px;
       padding: 1em 0;
   }
   .tab-content .card-body{
       padding: 0 ;
   }
   
</style>

<div class="main-card my-app mb-3 card">
    <div class="card-header"><i class="header-icon fa fa-cog"> </i>All Setting
        <div class="btn-actions-pane-right">
            <div class="nav">
                <a data-toggle="tab" href="#tab-eg2-0" class="btn-pill btn-wide btn btn-outline-alternate  active show"> <i class="fa fa-columns"></i> Set Layout</a>
                <a data-toggle="tab" href="#tab-eg2-1" class="btn-pill btn-wide mr-1 ml-1 btn btn-outline-alternate  show">News Widgets</a>
                <a data-toggle="tab" href="#tab-eg2-2" class="btn-pill btn-wide btn btn-outline-alternate  show">Tab 3</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane active show" id="tab-eg2-0" role="tabpanel">
                <?
                $get = $this->NewsModel->getNewsSetting('layout');
                $row = [];
                if($get->num_rows()){
                    $row = json_decode( $get->row()->value, true); 
                    
                }
                ?>
                <div class="row" >
                    <div class="col-md-8 row">
                        <div class="col-md-6">
                            <div class="card bg-primary text-white">
                                <div class="card-header">
                                    <strong>Full News View</strong>
                                </div>
                                <div class="card-body text-black ">
                                    <ul class="list-group div-full-news-view" >
                                        <?
                                        if(isset($row['full_view'])){
                                            foreach($row['full_view'] as $k){
                                                echo '<li class="drop-li list-group-item" data-action="'.$k.'">'.C::newsEvents($k).'</li>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-primary text-white">
                                <div class="card-header">
                                    <strong>Grid News View</strong>
                                </div>
                                <div class="card-body text-black ">
                                        <ul class="list-group div-grid-news-view" >
                                            <?
                                            if(isset($row['grid_view'])){
                                                foreach($row['grid_view'] as $k){
                                                    echo '<li class="drop-li list-group-item" data-action="'.$k.'">'.C::newsEvents($k).'</li>';
                                                }
                                            }
                                            ?>
                                        </ul>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card bg-success text-white">
                            <div class="card-header">
                                <strong>All Event(s)</strong>
                            </div>
                            <div class="card-body text-black" style="height:500px;overflow-x:hidden;padding:0">
                                <ul class="list-group">
                                    <?
                                    foreach(C::newsEvents() as $k => $event)
                                        echo  '<li class=" list-group-item drag" data-action="'.$k.'" data-id="0">'.$event.'</li>';
                                    
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="tab-pane show" id="tab-eg2-1" role="tabpanel">
                <?
                require 'right_news_widgets.php';
                ?>
            </div>
            <div class="tab-pane show" id="tab-eg2-2" role="tabpanel"><p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a
                type specimen book. It has
                survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p></div>
        </div>
    </div>
</div>










<script>
NProgress.configure({ parent: '.my-app .card-body' });

     $(function() {
            $( ".drag" ).draggable({
              appendTo: ".main-card",
              helper: "clone",
              start  : function(event, ui){
                 
                 $(ui.helper).css('width', `${ $(event.target).width() }px`).addClass("ui-helper");
             }
            });
            $( ".div-full-news-view,.div-grid-news-view" ).droppable({
              activeClass: "ui-state-default",
              hoverClass: "ui-state-hover",
              accept: ":not(.ui-sortable-helper)",
              drop: function( event, ui ) {
                $( this ).find( ".placeholder" ).remove();
       
                $( '<li class="drop-li list-group-item" data-action="'+ui.draggable.data('action')+'"></li>' ).html( ui.draggable.html()  ).appendTo( this );
        
                saveData();
              }
            }).sortable({
                    forcePlaceholderSize: true,
                    tolerance: 'pointer',
                    update: function (event, ui) {
                        saveData();
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
                                            saveData();
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
              let i = 0,
                    full_view = [],
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
              });
          }
          
</script>









