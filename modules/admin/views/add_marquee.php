<?php
require_once('header.php');
?>

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-browser icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Marquee
                <div class="page-title-subheading">Modify This section.
                </div>
            </div>
        </div>
        <div class="page-title-actions">
	        <!--button class="btn btn-success manage-images">Manage Images</button-->
                                   
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <form action="" method="post">
         
            <div class="mb-3 card text-primary bg-white">
                <div class="card-header">Marquee </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Marquee Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Marquee Data</label>
                        <textarea id="aryaeditor" class="form-control" name="data"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label> Direction</label><br>
                                <select class="form-control" name="direction">
                                    <option value="right">Right</option>
                                    <option value="left">Left</option>
                                    <option value="up">Up</option>
                                    <option value="down">Down</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label> Behavior</label><br>
                                <select class="form-control" name="behavior">
                                    <option value="scroll">Scroll</option>
                                    <option value="slide">Slide</option>
                                    <option value="alternate">Alternate</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label> Loop</label>
                                <input type="number" class="form-control" name="loop" placeholder="Default is Infinite">
                            </div>
                        </div>
                        <div class="col-lg-2">
                             <div class="form-group">
                                <label> Scrollamount</label><br>
                                <input type="number" class="form-control" name="scrollamount" value="10" required>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>OnHover Stop</label><br>
                                <input type="radio" name="hoverstop" value="yes" checked> &nbsp; Yes <br>
                                <input type="radio" name="hoverstop" value="no" checked> &nbsp; No
                            </div>
                        </div>
                        
                        
                        
                        
                        <!--div class="col-lg-12">
                            <div class="form-group">
                                <label>Make A Title. <small></small></label>
                                <br>
                                <label><input type="checkbox" class="make_a_title" name="is_title" >  Click Me!</label>
                                
                            </div>
                        </div-->
                    </div>
                    <div class="row make_title" style="display:none">
                        <div class="form-group col-lg-6">
                            <label>Enter Title</label>
                            <textarea name="title_text" id="title_text" class="required_field"></textarea>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Select Position</label>
                            <select name="title_postion" class="form-control required_field">
                                <option value="">Choose a option</option>
                                <option value="left">Left</option>
                                <option value="right">Right</option>
                                <!--<option value="top">Top</option>-->
                                <!--<option value="bottom">Bottom</option>-->
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success" type="submit">Add Marquee</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Available Marquee</div>
            <div class="card-body">
                <table class="table table-striped table-bordered table-hover">
                    <tr><th>#</th><th>Name</th><th>Data</th><th>Options</th></tr>
                    <?php $i=1;
                    $list = $this->SiteModel->getMarquee();
                    foreach ($list->result() as $res)
                     {
                        echo'<tr><td>'.$i++.'</td><td>'.$res->name.'</td><td>'.$res->data.'</td><td><label class="badge badge-danger" style="cursor:pointer"  onclick="del(this)" data-id="'.AJ_ENCODE($res->id).'"><i class="fa fa-trash"></i> Delete</label></td></tr>';
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    //CKEDITOR.replace('aryaeditor');

    function del(e)
    {   
        /*
        if(confirm("Are you sure to Delete?"))
        {   var id= $(e).data('id')
            location.href="<?=site_url('Admin/delete-marquee/')?>"+id;
        }
        */
        var id= $(e).data('id')
        $.confirm({
            type :  'red',
            theme : 'bootstrap',
            title : 'Confirmation!',
            content : 'Are you sure for delete it.',
            icon : 'fa fa-bell',
            buttons : {
                ok : {
                    text : '<i class="fa fa-trash"></i> Delete',
                    btnClass:'btn-danger',
                    action:function(){
                            location.href="<?=site_url('Admin/delete-marquee/')?>"+id;
                    }
                },
                cancel:function(){}
            }
        });
    }
    
    $('.make_a_title').change(function(){
         $('.make_title').toggle(600);
    });
    
   var  editor_title = CKEDITOR.replace( 'title_text', {
        toolbar: [
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline'] },
            { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
            { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] }
        ]
    });
</script>

<script type="text/javascript" src="<?=base_url?>/public/custom/ckeditor.js"> </script>
<?php
require_once('footer.php');
?>
