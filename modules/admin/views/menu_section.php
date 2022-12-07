<? // 7088364123

require_once 'header.php';

$menu_group = $this->MenuModel->get_menu_groups([],1); //$this->db->order_by('id','ASC')->limit(1)->get_where('menu_groups',['admin_id'=>CLIENT_ID]);


    $groupData = (!$menu_group->num_rows()) 
                            ? $this->MenuModel->install_menu_group()
                            : $menu_group->row();

?>



<style type="text/css">
    .card-body{
        overflow-x: hidden!important;
    }
    .card-header{
        padding:0.6em!important;
    }
    select{
		font-family: fontAwesome
	}
</style>

                    <link rel="stylesheet" href="<?=base_url?>/public/custom/icon-picker/dist/fontawesome-5.11.2/css/all.min.css">
                    <link rel="stylesheet" href="<?=base_url?>/public/custom/icon-picker/dist/iconpicker-1.5.0.css">
                    <script src="<?=base_url?>/public/custom/icon-picker/dist/iconpicker-1.5.0.js"></script>
                        
                        <div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="pe-7s-car icon-gradient bg-mean-fruit">

                                        </i>

                                    </div>

                                    <div>Menu Section

                                        <div class="page-title-subheading">This is an example dashboard created using build-in elements and components.
                               
                                        </div>

                                    </div>

                                </div>

                                <div class="page-title-actions">
                                   
                                    <!--<button type="button" data-toggle="tooltip" title="Menu Setting" data-placement="bottom" class="btn-shadow menu-setting mr-3 btn btn-dark">-->

                                    <!--    <i class="fa fa-cog"></i>-->

                                    <!--</button>-->

                                    <div class="d-inline-block dropdown">

                                        <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-shadow dropdown-toggle btn btn-info">

                                            <span class="btn-icon-wrapper pr-2 opacity-7">

                                                <i class="fa fa-business-time fa-w-20"></i>

                                            </span>

                                            Buttons

                                        </button>

                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">

                                            <ul class="nav flex-column">

                                                <li class="nav-item">

                                                    <a href="javascript:void(0);" class="nav-link">

                                                        <i class="nav-link-icon lnr-inbox"></i>

                                                        <span>

                                                            Inbox

                                                        </span>

                                                        <div class="ml-auto badge badge-pill badge-secondary">86</div>

                                                    </a>

                                                </li>

                                                <li class="nav-item">

                                                    <a href="javascript:void(0);" class="nav-link">

                                                        <i class="nav-link-icon lnr-book"></i>

                                                        <span>

                                                            Book

                                                        </span>

                                                        <div class="ml-auto badge badge-pill badge-danger">5</div>

                                                    </a>

                                                </li>

                                                <li class="nav-item">

                                                    <a href="javascript:void(0);" class="nav-link">

                                                        <i class="nav-link-icon lnr-picture"></i>

                                                        <span>

                                                            Picture

                                                        </span>

                                                    </a>

                                                </li>

                                                <li class="nav-item">

                                                    <a disabled href="javascript:void(0);" class="nav-link disabled">

                                                        <i class="nav-link-icon lnr-file-empty"></i>

                                                        <span>

                                                            File Disabled

                                                        </span>

                                                    </a>

                                                </li>

                                            </ul>

                                        </div>

                                    </div>

                                </div>    
                            </div>

                        </div>  
                            
                        <div class="row">
                            
                            <div class="col-md-12">
                                
                                <div class="" id="IconPreview">
                                    
                                </div>
                            </div>
                            <div class="col-md-4">
                            
                            
                            
                            	<div id="accordion" class="accordion-wrapper mb-3">

                                        <div class="card text-white bg-primary " style="border-radius: 0">

                                            <div id="headingOne" class="card-header">

                                                <button type="button" data-toggle="collapse" data-target="#collapseOne1" aria-expanded="true" aria-controls="collapseOne" class="text-left m-0 p-0 btn btn-link btn-block text-white">

                                                    <h5 class="m-0 p-0">Pages</h5>

                                                </button>

                                            </div>

                                            <div data-parent="#accordion" id="collapseOne1" aria-labelledby="headingOne" class="collapse show" style="">

                                                <div class="card-body">

                                                	<form action="" method="post" class="add-pages-to-menu">

                                                		<?

                                                        $pages = $this->SiteModel->list_page();

                                                        if($pages->num_rows()){

                                                		echo '

                                                		<table class="table table-bordered">';

                                                            foreach ($pages->result() as $key => $page) {             

                                                                echo '

                                                        			<tr>

                                                        				<td width=5%>

                                                                        <input type="hidden" name="page_'.$page->id.'" value="'.$page->page_name.'">

                                                                        <input type="checkbox" id="add_'.$page->id.'" class="add__in" name="page_id[]" value="'.$page->id.'">

                                                                        </td><td><label class="text-white"  for="add_'.$page->id.'">'.ucwords($page->page_name).'</label></td>

                                                        			</tr>';

                                                             }

                                                            echo '

                                                		</table>

                                                        <a href="javascript:void(0)" class="checkBox text-white col-md-6">select all</a>

                                                		<button class="btn btn-success pull-right">Add to Menu</button>';

                                                        }

                                                        ?>

                                                	</form>

                                                </div>

                                                <script type="text/javascript">

                                                    $('.checkBox').click(function(){

                                                            $(".add__in").prop("checked", true);    

                                                    });

                                                </script>

                                            </div>

                                        </div>
                                        <?
                                    if(defined('newsportal')):
                                        ?>
                                        <div class="card bg-danger text-white" style="border-radius: 0">

                                            <div id="headingThree" class="card-header">

                                                <button type="button" data-toggle="collapse" data-target="#collapseOne3" aria-expanded="false" aria-controls="collapseThree" class="text-left m-0 p-0 btn btn-link btn-block text-white"><h5 class="m-0 p-0">
                                                    Category
                                                </h5></button>

                                            </div>

                                            <div data-parent="#accordion" id="collapseOne3" class="collapse">

                                                <div class="card-body">
                                                    <form action="" method="post" class="add-category-to-menu">
                                                    <?
                                                    $get  = $this->NewsModel->get_category();
                                                    if($get->num_rows()){
                                                        echo '

                                                            <table class="table table-bordered">';

                                                                foreach ($get->result() as $key => $cat) {             

                                                                    echo '

                                                                        <tr>

                                                                            <td width=5%>

                                                                            <input type="hidden" name="cat_'.$cat->id.'" value="'.$cat->name.'">

                                                                            <input type="checkbox" id="add_cat_'.$cat->id.'" class="add_cats__in" name="cat_id[]" value="'.$cat->id.'">

                                                                            </td><td><label class="text-white"  for="add_cat_'.$cat->id.'">'.($cat->name).'</label></td>

                                                                        </tr>';

                                                                 }

                                                                echo '

                                                            </table>';
                                                            ?>

                                                            <a href="javascript:void(0)" class="col-md-6 text-white"  onclick="$('.add_cats__in').prop('checked',true)">select all</a>

                                                            <button class="btn btn-success pull-right">Add to Menu</button>
                                                    <?
                                                    }
                                                    ?>
                                                    </form>
                                                </div>

                                            </div>

                                        </div>
                                        <?
                                    endif; //check is newportal
                                        ?>

                                        
                                       <div class="card">

                                            <div id="headingTwo" class="b-radius-0 card-header">

                                                <button type="button" data-toggle="collapse" data-target="#collapseOne2" aria-expanded="false" aria-controls="collapseTwo" class="text-left m-0 p-0 btn btn-link btn-block"><h5 class="m-0 p-0">Link</h5></button>

                                            </div>

                                            <div data-parent="#accordion" id="collapseOne2" class="collapse">

                                                <div class="card-body" style="padding: 0">

                                                    <div class="mb-3 card text-white card-body">

                                                        <div>

                                                            <form class="needs-validation create-menu" autocomplete="off" novalidate>

                                                                <div class="form-row">

                                                                    <div class="col-md-12 mb-3">

                                                                        <input type="text" class="form-control" placeholder="Enter Menu Name.." required name="label">

                                                                        <div class="invalid-feedback">

                                                                            Please provide a valid Menu name.

                                                                        </div>

                                                                    </div>

                                                                    <div class="col-md-12 mb-3">

                                                                        <input type="text" class="form-control" id="validationTooltip01" placeholder="Enter Link" value="#" name="link" >

                                                                    </div>

                                                                    <div class="col-md-12 ">

                                                                        <button class="btn btn-success"><i class="fa fa-plus"></i></button>

                                                                    </div>

                                                                </div>

                                                            </form>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>





		

	</div>

	<div class="col-md-8">

		<div class="card-shadow-alternate border mb-3 card  border-alternate " style="">
            
            <div class="card-header card-header-tab">
                <div class="card-header-title">
                    <i class="header-icon pe-7s-paint-bucket"> </i>
                    Menu structure
                </div>
                <ul class="nav groups-nav">
                    <?
                    $i = 0;
                    foreach($this->MenuModel->get_menu_groups()->result() as $group){
                        $active = $i++ ? '' : 'show active'; 
                        echo '<li class="nav-item"><a data-toggle="tab" href="#print-menu-'.$i.'" onclick="print_menu('.$group->id.')" class="nav-link print-menu-'.$group->id.' '.$active.'">'.$group->name.'</a></li>';
                    }
                    ?>
                    <li class="nav-item"><a data-toggle="tab" href="#add-new-0" onclick="print_menu('add')" class="btn-xs btn-sm btn btn-primary text-white "><i class="fa fa-plus"></i> New Menu</a></li>
                </ul>
            </div>
            
            
			<div class="form-inline menu-header">
                
			    <!--<menu id="nestable-menu" style="margin:0">-->

			    <!--    <button type="button" class="btn btn-primary" data-action="expand-all">Expand All</button>-->

			    <!--    <button type="button" class="btn btn-primary" data-action="collapse-all">Collapse All</button>-->

			    <!--</menu>-->

			</div>

			<div class="card-body print-menu-div">
			    
			    <?
			    /*
                <input type="hidden" name="group_id" value="<?=$groupData->id?>">
				<div class="cf nestable-lists">



			        <div class="dd" id="nestable" style="width:100%">



			<?php

			$query = $this->MenuModel->get_menus();

			 

			$ref   = [];

			$items = [];



			foreach($query->result() as $k => $data) {



			    $thisRef = &$ref[$data->id];



			    $thisRef['parent'] = $data->parent;

                $thisRef['type']   = $data->type;

			    $thisRef['label'] = $data->label;

			    $thisRef['link'] = $data->link;

			    $thisRef['id'] = $data->id;



			   if($data->parent == 0) {

			        $items[$data->id] = &$thisRef;

			   } else {

			        $ref[$data->parent]['child'][$data->id] = &$thisRef;

			   }



			}

			 

			 

			function get_menu($items,$class = 'dd-list') {



			    $html = "<ol class=\"".$class."\" id=\"menu-id\">";



			    foreach($items as $key=>$value) {

			        $html.= '<li class="dd-item dd3-item" data-id="'.$value['id'].'" >

			                    <div class="dd-handle dd3-handle"></div>

			                    <div class="dd3-content"><span id="label_show'.$value['id'].'">'.$value['label'].'</span> 

			                        <span class="span-right"><span id="link_show'.$value['id'].'">'.ucwords($value['type']).'</span> &nbsp;&nbsp; 

			                        <a class="SingleMenuSetting" onclick="SingleMenuSetting('.$value['id'].')"><i class="fa fa-cog"></i></a>     

			                       <a class="del-button" id="'.$value['id'].'"><i class="fa fa-trash"></i></a></span> 

			                    </div>';

			        if(array_key_exists('child',$value)) 
			            $html .= get_menu($value['child'],'child');
                    $html .= "</li>";

			    }

			    $html .= "</ol>";



			    return $html;



			}

			 

			print get_menu($items);



			?>





			        </div>







			    </div>
			    
			    <input type="hidden" id="nestable-output">
                */
                ?>
			</div>
			<div class="first-footer">
			    
			</div>
			<div class="card-footer footer-menu" style="display:none">
                <button type="button" id="save" class="btn btn-success">Save</button>
			</div>

		</div>

	</div>

</div>
<script>

$(document).on('change','.iconCss',function(){
   var event = $(this).data('event'),
       value = this.value,
       MENU_ID = $('#MENU_ID').val(),
       msg = event;
    if(event == 'position')
        value = $(this).is(':checked') ? 'right' : 'left';
        
    if(event == 'icon_hide' || event == 'title_hide'){
        value = $(this).is(':checked') ? 'true' : 'false';
        msg = 'Visibility ';
    }
   
   $('.icon-proccess').html('<div class="alert alert-info"><i class="fa fa-spin fa-spinner"></i> Please Wait....</div>');
   $.ajax({
       type : 'POST',
       url : base_url+'/admin/AJAX',
       data : {var : 'saveSingleMenuSetting' , type : event, value : value,MenuId:MENU_ID},
       dataType : 'json',
       success:function(res){
           console.log(res);
           toastr.success(msg +' update Successfully..');
           $('.icon-proccess').html('<div class="alert alert-success">'+msg +' update Successfully..</div>').css('textTransform', 'capitalize');;
       },
       error:function(r,v,c){
           console.log(r.responseText);
       }
   });
});






(function($){
    $.fn.focusTextToEnd = function(){
        this.focus();
        var $thisVal = this.val();
        this.val('').val($thisVal);
        return this;
    }
}(jQuery));


function setIcon(){
    $('.menu-icon').each(function(i,b){
        var id = $(b).closest('.dd-item').data('id');
        var icon = $(b).val() == '' ? '<i class="fas fa-ban" style="color:red"></i>' : ' <i class="'+ $(b).val()+'" ></i>';
        $('.icon-'+id).html( icon );
    });
}
// $( "ul.groups-nav li:nth-last-child(2)" ).append( '<li>asdasdasd</li>' )

     NProgress.configure({ parent: '.print-menu-div' });
    print_menu(<?=$groupData->id?>);
    
    
    
    function print_menu(group_id ){
        NProgress.start();
        $('.menu-header').removeClass('card-header').html('');
        $('.first-footer').removeClass('card-footer').html('');
        
        $('.footer-menu').hide();
        $('.print-menu-div').html(`                <center><img style="width:60%" src="https://thumbs.gfycat.com/HugeDeliciousArchaeocete-max-1mb.gif"></center>        `);
        $.ajax({
            type : 'POST',
            url :base_url+'admin/Menu-section',
            dataType : 'json',
            data : {group_id : group_id, status : 'print-menu'},
            success : function(res){
                NProgress.done();
                $('.print-menu-div').html(res.html);
                $('.menu-header').html(res.header).addClass('card-header ').find('input').focusTextToEnd();
                $('.first-footer').html(res.footer).addClass('card-footer');
            },
            complete:function(){
                NProgress.remove();
                $('.footer-menu').show();
                
                
                IconPicker.Init({
                              jsonUrl: '<?=base_url?>/public/custom/icon-picker/dist/iconpicker-1.5.0.json',  
                              searchPlaceholder: 'Search Icon',
                              showAllButton: 'Show All',
                              cancelButton: 'Cancel',
                              noResultsFound: 'No results found.', 
                              borderRadius: '20px'
                        });
                
                
                IconPicker.Run('#GetIconPicker',function(){
                    setIcon();
                });
                
                $(document).ready(function()

                    {
                    
                    
                    
                        var updateOutput = function(e)
                    
                        {
                    
                            var list   = e.length ? e : $(e.target),
                    
                                output = list.data('output');
                    
                            if (window.JSON) {
                    
                                output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
                        
                            } else {
                    
                                output.val('JSON browser support required for this demo.');
                    
                            }
                    
                        };
                    
                    
                    
                        $('#nestable').nestable({
                    
                            group: 1
                    
                        })
                    
                        .on('change', updateOutput);
                    
                        updateOutput($('#nestable').data('output', $('#nestable-output')));
                    
                    
                    
                        $('#nestable-menu').on('click', function(e)
                    
                        {
                    
                            var target = $(e.target),
                    
                                action = target.data('action');
                    
                            if (action === 'expand-all') {
                    
                                $('.dd').nestable('expandAll');
                    
                            }
                    
                            if (action === 'collapse-all') {
                    
                                $('.dd').nestable('collapseAll');
                    
                            }
                    
                        });
                    
                    
                    
                    
                    
                    });
                
                
            },
            error:function(re,v,c){
                console.log(re);
                $('.print-menu-div').html(re.responseText);
                NProgress.done();
                NProgress.remove();
            }
        });
    }
</script>
<script src="<?=base_url.'/public/custom/menu-setting.js'?>"></script>
<?

require_once 'footer.php';

?>