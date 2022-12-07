  <?
$form_id =	AJ_DECODE($form_id);

$form = $this->db->get_where('form_model',['id'=>$form_id])->row();

?>.  
<style type="text/css">

	.loader{
		position: absolute;
	    font-size: 5em;
	    background: rgba(0,0,0,.8);
	    width: 100%;
	    height: 100%;
	    color: white;
	    padding: 39px;
	    padding-top: 261px;
	    display: none
	}
	.jconfirm-holder{
		padding-top:0!important;
	}
	.jconfirm-holder .card-body{
		height:590px;
		overflow-x: hidden;
		padding:0!important;
	}
	.jconfirm-content{
		overflow-x: hidden!important;
	}
	.panel-scroll::-webkit-scrollbar {
	  width: 10px;
	}

	/* Track */
	.panel-scroll::-webkit-scrollbar-track {
	  box-shadow: inset 0 0 5px grey; 
	}
	 
	/* Handle */
	.panel-scroll::-webkit-scrollbar-thumb {
	  background: black; 
	}

	/* Handle on hover */
	.panel-scroll::-webkit-scrollbar-thumb:hover {
	  background: red; 
	}
	.custom-control-label::before,.custom-control-label::after{
		content:none!important;
	}
	.item button {
        width: 100%;
        padding: 10px;
        border-radius: 0;
        background: rgba(0,0,0,0.8);
        text-decoration: none;
        font-size: 1.8em;
        color: white;
        text-align: left;
        border: 1px solid white;
        transition:1s;
        padding-left: 14px!important;
    }
    .item{
        border:1px solid rgba(0,0,0,0.8);
    }
    .item button:hover,.item button:active{
        color:white;
        text-align:center;
        transition:1s;
        text-decoration:none;
    }
    .widget-content-left{
        position:relative;
    }
    output { 
  position: absolute;
  background-image: linear-gradient(#444444, #999999);
  width: 40px; 
  height: 30px; 
  text-align: center; 
  color: white; 
  border-radius: 10px; 
  display: inline-block; 
  font: bold 15px/30px Georgia;
  bottom: 175%;
  left: 0;
}
output:after { 
  content: "";
  position: absolute; 
  width: 0;
  height: 0;
  border-top: 10px solid #999999;
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  margin-top: -1px;
}
</style>
<?
	$get = $this->db
					->where(['type'=>'form','key_id'=>$form_id])
					->order_by('id','DESC')
					->limit(1)
					->get('web_schema');
					
	$url = 0;
	
	if($get->num_rows()){
			$wo = $get->row();
			$url = base_url.'/web/'.AJ_ENCODE($wo->page_id).'/design/';
	}
	$f = $this->FormModel->getFormModel(array('id'=>$form_id))->row();
	if($f->theme_id){
	    $url = base_url.'/Admin/getFormCss/'.$form_id;
	}
?>
<div class="row">
	<input type="hidden" id="form_id" value="<?=$form_id?>">
	<div class="col-md-4">
		<div class="card ">
			<div class="card-header bg-primary text-white">
				<strong>Style Sheet</strong>
			</div>
			<form enctype="multipart/form-data" class="card-body panel-scroll">
			    <?
			    if($url)
			      echo '<a href="'.$url.'" target="_blank" style="border-radius:0" class="badge badge-primary pull-right"><i class="fa fa-eye"></i> Go To Page</a>';
			    ?>
                    
					<div id="exampleAccordion" data-children=".item">
                        <div class="item" data-type="form_theme">
                            <button type="button" aria-expanded="true" aria-controls="exampleAccordion1" data-toggle="collapse" href="#collapseExample" class="m-0 p-0 btn btn-link collapsed">
	                            Form Themes
	                        </button>
                            
                            <div data-parent="#exampleAccordion" id="collapseExample" class="collapse show" style="">
                            	<ul class="todo-list-wrapper list-group list-group-flush">

                                    <li class="list-group-item">
                                        <div class="todo-indicator bg-warning"></div>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-2">
                                                    <div class="">
                                                        <input type="radio" id="input-2" <?=$form->theme_id == 0 ? 'checked' : ''?> class="inputClass" name="input" value="0">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">
                                                    	<label class="custom-control-label" for="input-2">&nbsp;Default Theme</label>
                                                        <div class="badge badge-danger ml-2"><i>Default</i></div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                            <?
                            $getFormsTheme = $this->db->get_where('form_themes',['status'=>1]);
                            foreach ($getFormsTheme->result() as $key => $value) {
                            	$checked = $form->theme_id == $value->id ? 'checked' : '';
                               echo '<li class="list-group-item">
                                        <div class="todo-indicator bg-warning"></div>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-2">
                                                    <div class="">
                                                        <input type="radio" id="input-'.$value->id.'" '.$checked.' class="inputClass
                                                        " value="'.$value->id.'" name="input">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">
                                                    	<label class="custom-control-label" for="input-'.$value->id.'">&nbsp;'.ucwords($value->theme_name).'</label>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </li>';
                            }
                            ?>


                                </ul>
                                
                                
                            </div>
                        </div>
                        <div class="item" data-type="main_design">
                            <button type="button" aria-expanded="false" aria-controls="exampleAccordion2" data-toggle="collapse" href="#collapseExample0" class="m-0 p-0 btn btn-link">
	                            Main Design
	                        </button>
                            <div data-parent="#exampleAccordion" id="collapseExample0" class="collapse " style="">
                                <ul class="todo-list-wrapper list-group list-group-flush">

                                    <?
                                    echo \C::eventOptionFields();
                                    ?>
                                    
                                </ul>
                            </div>
                        </div>
                        <div class="item" data-type="header_design">
                            <button type="button" aria-expanded="false" aria-controls="exampleAccordion2" data-toggle="collapse" href="#collapseExample2" class="m-0 p-0 btn btn-link">
	                            Header Design
	                        </button>
                            <div data-parent="#exampleAccordion" id="collapseExample2" class="collapse " style="">
                                <ul class="todo-list-wrapper list-group list-group-flush">

                                    <?
                                    echo \C::eventOptionFields();
                                    ?>
                                    
                                </ul>
                            </div>
                        </div>
                        <div class="item" data-type="body_design">
                            <button type="button" aria-expanded="false" aria-controls="exampleAccordion2" data-toggle="collapse" href="#collapseExample3" class="m-0 p-0 btn btn-link">
	                            Body Design
	                        </button>
                            <div data-parent="#exampleAccordion" id="collapseExample3" class="collapse " style="">
                                <ul class="todo-list-wrapper list-group list-group-flush">

                                    <?
                                    echo \C::eventOptionFields();
                                    ?>
                                    
                                </ul>
                            </div>
                        </div>
                        <div class="item" data-type="footer_design">
                            <button type="button" aria-expanded="false" aria-controls="exampleAccordion2" data-toggle="collapse" href="#collapseExample4" class="m-0 p-0 btn btn-link">
	                            Footer Design
	                        </button>
                            <div data-parent="#exampleAccordion" id="collapseExample4" class="collapse " style="">
                                <ul class="todo-list-wrapper list-group list-group-flush">

                                    <?
                                    echo \C::eventOptionFields();
                                    ?>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="item" data-type="input_design">
                            <button type="button" aria-expanded="false" aria-controls="exampleAccordion2" data-toggle="collapse" href="#collapseExample10" class="m-0 p-0 btn btn-link">
	                            Input Box Design
	                        </button>
                            <div data-parent="#exampleAccordion" id="collapseExample10" class="collapse " style="">
                                <ul class="todo-list-wrapper list-group list-group-flush">

                                    <?
                                    echo \C::eventOptionFields();
                                    ?>
                                    
                                </ul>
                            </div>
                        </div>
                        
                        
                        
                        
                    </div>
			</form>
		</div>
	</div>

	<div class="col-md-8" style="position: relative;">
		<div class="break-loader" style="font-size: 2em;
    font-family: cursive;
    position: absolute;
    bottom: 80px;
    background: green;
    color: white;
    display: none;
    width: 100%;
    text-align: center;">
			<i class="fa fa-spin fa-spinner"></i> Please Wait..			
		</div>
		<?
		
		
	


		if($url){
			echo '<iframe id="iframe" src="'.$url.'" style="width:100%;height:100%;border:0">';
		}
		else{
			echo '<b class="text-red">Form is not set in any page.</b>';
		}

		?>
	</div>


</div>

