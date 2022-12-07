   
    
    
    <script type="text/javascript" src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
   
<form class="create-header" novalidate method="POST" enctype="multipart/form-data">
    <input type="hidden" name="status" value="header">
	<div class="card card-border border-focus">
        
		<div class="card-header bg-danger text-white all-widget-card">
			<div><i class="fa fa-cog"></i>  Header</div>
			<div class="btn-actions-pane-right">
			    <div role="group" class="btn-group-sm btn-group">
                    <button class="btn-outline-9x text-white submit-btn btn-success btn btn-outline-focus" ><i class="fa fa-plus"></i> Publish</button>
                </div>
            </div>
		</div>

		<div class="card-body md row " style="    margin: 0;    padding: 1px;   ">
            
            <div class="wrapper widget-area-body row">
                <?
                
                  $i = 0;
                $allEvents = $this->SiteModel->getHeader();
                $css = \C::defaultMenuCss();
                if($allEvents->num_rows()){
                     
                     $data = $allEvents->row();
                     
                    $css = !isJson( $data->css ) ? $css : json_decode( $data->css , true );
                     
                     
                    echo '<input type="hidden" name="id" value="'.$data->id.'">';
                   
                    $events = (array) json_decode($data->events,true);
                  
                    foreach($events as $d){
                        $div = (array) $d;
                        
                        $class = $div['size'];
                        $id = $div['id'];
                        $action = $div['action'];
                        
                        echo '<div class="drop-li '.$class.' ">
                                    <input type="hidden" name="key[]" class="key" value="'.$i.'">
                                    <input type="hidden" name="box['.$i.'][size]" class="box-size" value="'.$class.'">
                                    <input type="hidden" name="box['.$i.'][id]" value="'.$id.'">
                                    <input type="hidden" name="box['.$i.'][action]" value="'.$action.'">';
                                    switch($action){
                                        case 'menu':
                                           echo $this->MenuModel->get_menu_groups(['id'=>$id])->row()->name;
                                        break;
                                        case 'widget':
                                            echo $this->WidgetModel->getAllWidget($id)->row()->widget_title;
                                        break;
                                        //case 'logo':
                                        default:
                                            echo ucwords( $action );
                                        break;
                                    }  
                        echo '    <label class="pull-right badge badge-success">'.$action.'</label>
                              </div>';
                              $i++;
                    }
                }
                ?>
            </div>
            <div class="col-md-12 drop-delete" >
                <center><i class="fa fa-trash"></i> Drop here for delete it.</center>
            </div>
            
        </div>
        <div class="card-header bg-danger text-white" style="margin-top:1px;height:auto">
            <strong><i class="fa fa-list"></i> List All Event(s)</strong>
        </div>
        <div class="row card-body" style="margin:0"> 
            <?
            echo '<div class=" col-md-3 drag" data-action="box" data-id="0" draggable="true" >Empty <span class="badge badge-success pull-right">Box</label></div>';
            echo '<div class=" col-md-3 drag" data-action="logo" data-id="0" draggable="true" >Logo<span class="badge badge-success pull-right">Logo</label></div>';
            foreach($this->MenuModel->get_menu_groups()->result() as $menuGroup)
                echo '<div class=" col-md-3 drag" data-action="menu" data-id="'.$menuGroup->id.'" draggable="true" >'.ucwords($menuGroup->name).' <span class="badge badge-success pull-right">Menu</label></div>';
            foreach($this->WidgetModel->getAllWidget()->result() as $gt)
                echo '<div class=" col-md-3 drag" data-action="widget" data-id="'.$gt->id.'" draggable="true">'.ucwords($gt->widget_title).' <span class="badge badge-success pull-right">Widget</label></div>';
            ?>
        </div>
        <?
        require 'css.php';
        ?>
    </div>
</form>
    
    <script>
    
    
    $(document).on('submit','.create-header',function(ee){
        ee.preventDefault();
        // console.log($(this).serialize());
        $('.submit-btn').prop('disabled',true).html('<i class="fa fa-spin fa-spinner"></i> Please Wait....');
        $.ajax({
            type : 'POST',
            url : '<?=current_url()?>',
            data : $(this).serialize(),
            dataType : 'json',
            success : function(res){
                // console.log(res);
                $('.submit-btn').prop('disabled',false).html('<i class="fa fa-plus"></i> Publish');
                toastr.success('Header Data is Updated Successfully..');
            },
            error:function(a,b,c){
                // console.log(a.responseText);
                alert(a);
                toastr.error(c);
            }
        });
    })
    
    
    let key = <?=$i?>;
     $(function() {
            $( ".drag" ).draggable({
              appendTo: ".create-top-bar",
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
                $('<div class="drop-li proccess sortable_cancel ui-state-disabled"></div>').html('<strong><i class="fa fa-spin fa-spinner fa-3x"></i> Loading...</strong>').appendTo( this );
                
                NProgress.done();
                     
                $( '<div  class="drop-li col-sm-4" ></div>' ).html(`
                
                                <input type="hidden" name="key[]" class="key" value="`+key+`">
                                <input type="hidden" name="box[`+key+`][size]" class="box-size" value="col-sm-4">
                                <input type="hidden" name="box[`+key+`][id]" value="`+ui.draggable.data('id')+`">
                                <input type="hidden" name="box[`+key+`][action]" value="`+ui.draggable.data('action')+`">
                                `+ui.draggable.html()   ).appendTo(that);
                    
                NProgress.remove();
                $(that).find('.proccess').remove();
                // $( '<div  class="drop-li col-md-3" data-action="'+ui.draggable.data('action')+'"></div>' ).html( '<div class="card"><div class="card-header bg-danger text-white">'+ui.draggable.html()+'</div>'+CardBody+'</div>'  ).appendTo( this );
                key++;
                //saveData();
                wrapper();
              }
            }).sortable({
                
                    forcePlaceholderSize: true,
                    tolerance: 'pointer',
                    cursor: 'pointer',
                    over: function () {
                        removeIntent = false;
                        $('.drop-delete').slideDown(600);
                    },
                    out: function () {
                        $('.drop-delete').mouseover(function() {
                                  removeIntent = true;
                                  $(this).css({'background':'black'});
                              })
                              .mouseleave(function() {
                                  removeIntent = false;
                                  $(this).css({'background':'red'});
                              });
                    },
                    beforeStop: function (event, ui) {
                        
                        // alert(removeIntent);
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
                                            $('.drop-delete').slideUp(600);
                                        }
                                    },
                                    cancel:function(){
                                        ui.item.show();
                                        $('.drop-delete').slideUp(600);
                                    }
                                }
                            });
                        }
                        else
                            $('.drop-delete').slideUp(600);
                    }
                    
            });
          });
 
 
 
var gridsystem = [
    /*{
          grid: 8.33333333,
          col: 1,
          title : ''
        }, {
          grid: 16.66666667,
          col: 2,
          title : ''
        }, */{
          grid: 25,
          col: 3,
          title : 'One-Forth'
        }, {
          grid: 33.33333333,
          col: 4,
          title : 'One-Third'
        }, /*{
          grid: 41.66666667,
          col: 5,
          title : ''
        }, */{
          grid: 50,
          col: 6,
          title : 'Half'
        }, /*{
          grid: 58.33333333,
          col: 7,
          title : ''
        }, */{
          grid: 66.66666667,
          col: 8,
          title : 'Two-Third'
        }, {
          grid: 75,
          col: 9,
          title : 'Three-Forth'
        }, /*{
          grid: 83.33333333,
          col: 10,
          title : ''
        }, {
          grid: 100,
          col: 11,
          title : ''
        }, */{
          grid: 91.66666667,
          col: 12,
          title : 'Full'
        }, {
          grid: 10000,
          col: 10000,
          title : ''
        }
];

function getClosest(arr, value) {
  var closest, mindiff = null;

  for (var i = 0; i < arr.length; ++i ) {
    var diff = Math.abs(arr[i].grid - value);

    if (mindiff === null || diff < mindiff) {
      closest = i;
      mindiff = diff;
    }
    else 
      return { col : arr[closest]['col'] , title : arr[closest]['title'] }; 
  }
  return null;
}
   var bsClass = "col-sm-1 col-sm-2 col-sm-3 col-sm-4 col-sm-5 col-sm-6 col-sm-7 col-sm-8 col-sm-9 col-sm-10 col-sm-11 col-sm-12";
   wrapper();
       function wrapper() {

            ////GC
            //alert( $(".wrapper").width());
            
            var wrapperW = $(".wrapper").width();
            var allGridClass = 'col-md-1 col-md-2 col-md-3 col-md-4 col-md-5 col-md-6 col-md-7 col-md-8 col-md-9 col-md-10 col-md-11 col-md-11 col-md-12';
            wrapperW = wrapperW/12 ;
            
            /**/
                
                var container = $(".wrapper");
                var numberOfCol = 3;
                //$(".wrapper .drop-li").css('width', 100/numberOfCol +'%');
               
                var sibTotalWidth;
                $(".wrapper .drop-li").resizable({
                    handles: 'e',
                    grid: wrapperW,
                    resize: function(e, ui) { // pas besoin pour l'instant
      
                        var thiscol = $(this);
                        var container = thiscol.parent();
                        thiscol.removeClass(bsClass);
                        var cellPercentWidth = (100 * ui.originalElement.outerWidth()) / container.innerWidth();
                        
                        ui.originalElement.css('width', cellPercentWidth + '%');
                
                        var box = getClosest(gridsystem, cellPercentWidth);
                
                        thiscol.addClass('col-sm-' + box.col).css("width", '');
                        thiscol.find('.box-size').val('col-sm-'+box.col);
                      }
                }); 
            }
            
            
    </script>