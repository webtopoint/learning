<?php
require_once 'header.php';
?>
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-browser icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Widget Section
                <div class="page-title-subheading">You can manage Widget and add using this section.
                </div>
            </div>
        </div>
        <div class="page-title-actions">
            <div class="d-inline-block dropdown">
                <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-shadow dropdown-toggle btn btn-info">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-business-time fa-w-20"></i>
                    </span>
                    Actions
                </button>
                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a id="createWidget" class="nav-link">
                                <i class="nav-link-icon lnr-inbox"></i>
                                <span>
                                    Create Widget
                                </span>
                              
                            </a>
                        </li>
                      
                    </ul>
                </div>
            </div>
        </div>   
    </div>
</div>



<div class="">
    <form action="" method="post" class="submit-widget-form row">
        <div class="col-md-3">
    		<div id="accordion" class="accordion-wrapper mb-3">
    		    <div class="formBox"></div>
    		</div>
    	</div>
    	<div class="col-md-9">
    		<div id="accordion" class="accordion-wrapper mb-3">
    		    <div class="widget-form-area"></div>
    		</div>
    	</div>
    </form>
</div>
<div class="row">
    
    <?php 
        foreach ($allWidget->result() as $widget)
        {
            echo'<div class="col-md-3">
                    <div class="card-shadow-primary border mb-3 card card-body border-primary">
                        <h5 class="card-title" style="height:35px;" align="center">'.$widget->widget_title.'</h5>
                        <label class="mb-2 mr-2 badge badge-pill badge-success" style="text-transform:uppercase">'.$widget->widget_type.'</label>
                       <center> 
                       <a href="'.base_url.'/Admin/modify-widget/'.AJ_ENCODE($widget->id).'">
                            <button class="mb-2 mr-2 btn-transition btn btn-outline-primary"><i class="fa fa-cog"></i></button></a>
                        <a data-id="'.AJ_ENCODE($widget->id).'" onclick="del(this)">
                            <button class="mb-2 mr-2 btn-transition btn btn-outline-danger"><i class="fa fa-trash"></i></button></a>
                        </center>
                    </div>';
            echo '</div>';
        }
    ?>
    
</div>
<script type="text/javascript">
    function del(e)
    {
        var id = $(e).data('id');
        if(confirm("Are you sure to delete"))
        {
            location.href="<?=base_url.'/Admin/delete-widget/'?>"+id;
        }
    }
</script>
<script type="text/javascript" src="<?=base_url.'/public/custom/add-widget.js'?>"></script>
<?php
require_once 'footer.php';
?>