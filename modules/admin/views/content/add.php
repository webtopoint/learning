
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
   
                                        </i>

                                    </div>

                                    <div>Add a New Content Category

                                        <div class="page-title-subheading">

                                        </div>

                                    </div>

                                </div>  

                            </div>

</div> 

<style>
    .heading input {
    font-weight: bold;
    font-size: 22px;
    padding: 5px;
    width: 100%;
    border: 0px;
    outline: 0px;
}
.card .row{
    padding:0;
    margin:0;
}
.box-design{
    border:1px dotted red;
    min-height:100px
}
.box-design .card-body{
    overflow-x:hidden;
    padding-top:10px;
}
.list-group-item{
    background-color: #000!important;
    border: 1px solid rgb(68 68 68)!important;
    padding: .5rem 1.25rem!important;
}


</style>



<form class="container" method="post">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger">
                Right now the work of update is going on in this section, do not use it right now
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    
                    <h4>Add Custom Content</h4>
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm nav btn-group">
                            <button  class="btn btn-outline-focus"><i class="pe-7s-paper-plane"></i> Publish</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="heading"><input type="text" name="content_title"  required placeholder="Enter Form Title" value="Content-<?=rand(9999999,273648723423)?>"> </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card box-design">
                                <input type="hidden" name="index[]" class="index-val" value="0">
                                <input type="hidden" name="class[0]" value="col-md-6"> 
                                <input type="hidden" name="setting[0]" value="">  
                                
                                <div class="card-header"> 
                                    <h4>Box</h4>   
                                </div>
                                <div class="card-body div-0 row">
                                    
                                </div>
                                <div class="card-footer">
                                    <button type="button" data-page="0" class="btn btn-primary select-event">
                                        <i class="fa fa-plus"></i> Add Event (s)
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card box-design">
                                <input type="hidden" name="index[]" class="index-val" value="1">
                                <input type="hidden" name="class[1]" value="col-md-6"> 
                                <input type="hidden" name="setting[1]" value=""> 
                                
                                <div class="card-header">
                                    <h4>Box</h4>
                                </div>
                                <div class="card-body div-1 row">
                                    
                                </div>
                                <div class="card-footer">
                                    <button type="button" data-page="1" class="btn btn-primary select-event">
                                        <i class="fa fa-plus"></i> Add Event (s)
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
    
</form>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <i class="fa fa-list"></i> List Content Category
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#.</th>
                                <th>Title</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?
                            foreach( $this->db->get_where('content',['admin_id' => CLIENT_ID])->result() as $res){
                                static $x = 1;
                                echo '<tr>
                                        
                                        <td>'.$x++.'</td>
                                        <td>'.$res->content_title.'</td>
                                        <td><a href="'.base_url.'/Admin/content/edit/'.AJ_ENCODE($res->id).'" class="btn btn-primary btn-xs btn-sm "><i class="fa fa-edit"></i></a></td>
                                        <td><a href="javascript:void(0)" class="btn btn-danger btn-xs btn-sm delete-content-area" data-id="'.$res->id.'"><i class="fa fa-trash"></i></a></td>
                                
                                      </tr>';
                            }
                            
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
   $k = 0;
    <?
    require 'instance.js';
    ?>

</script>

