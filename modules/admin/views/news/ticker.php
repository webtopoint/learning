<form class="col-md-12" method="POST">
    <div class="card">
        <div class="card-header bg-info">
            <strong><i class="fa fa-plus<"></i> Add News Ticker </strong>
        </div>
        <div class="card-body row">
            
            <div class="form-group col-md-4">
                <label>Title</label>
                <input type="text" class="form-control" placeholder="Enter Title.." name="title">
            </div>
            
            <div class="form-group col-md-2">
                <label>Hide Title</label>
                <select class="form-control" name="hide_title">
                    <option value="show">Show</option>
                    <option value="hide">Hide</option>
                </select>
            </div>
            
            <div class="form-group col-md-2">
                <label>Background</label>
                <input type="color" name="title_background" class="form-control">
            </div>
            <div class="form-group col-md-2">
                <label>Text Color</label>
                <input type="color" name="title_color" class="form-control" value="#FFFFFF">
            </div>
            <div class="form-group col-md-2">
                <label>Font Size</label>
                <input type="number" name="title_fontSize" class="form-control" value="21">
            </div>
            
            <div class="form-group col-md-4">
                <label>Select category</label>
                <select class="form-control" name="cats[]" multiple>
                    <?
                    foreach($this->NewsModel->get_category()->result()as $cat)
                        echo '<option value="'.$cat->id.'">'.$cat->name.'</option>';
                    ?>
                </select>
            </div>
            
            <div class="form-group col-md-2">
                <label>Thumbnail</label>
                <select class="form-control" name="thumbanail">
                    <option value="show">Show</option>
                    <option value="hide">Hide</option>
                </select>
            </div>
            
            <div class="form-group col-md-2">
                <label>Background</label>
                <input type="color" name="cat_background" class="form-control" value="#FFFFFF">
            </div>
            <div class="form-group col-md-2">
                <label>Text Color</label>
                <input type="color" name="cat_color" class="form-control" >
            </div>
            <div class="form-group col-md-2">
                <label>Font Size</label>
                <input type="number" name="cat_fontSize" class="form-control" value="21">
            </div>
            
            <div class="col-md-3 form-group">
                <label>Select Position  </label>
                <select class="form-control" name="position">
                    <!--<option value="with_content">With Content</option>-->
                    <option value="top">Fixed On Top</option>
                    <option value="bottom">Fixed on Bottom</option>
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label>Number of Post to View  </label>
                <input type="number" class="form-control" required name="numPost" value="5" min=1>
            </div>
            <div class="col-md-3 form-group">
                <label>Animation Duration  </label>
                <input type="number" class="form-control" required name="anim_duration" value="200" min=1>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-success"><i class="fa fa-plus"></i> Add Ticker</button> 
        </div>
    </div>
</form>

<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-info">
            <strong><i class="fa fa-list<"></i> List News Ticker </strong>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#.</th>
                        <th>Title</th>
                        <th>Enable / Disable</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                                    <!--<button class="btn btn-info set-in-page"><i class="fa fa-cog fa-spin"></i> Set in Page</button>-->
                    <?
                    $i = 1;
                    foreach($this->NewsModel->getTicker()->result() as $ticker){
                        
                        
                        $chk = $ticker->status ? 'checked' : '';
                        echo '<tr data-id="'.$ticker->id.'">
                                
                                <td>'.$i++.'.</td>
                                <td>'.$ticker->title.'</td>
                                <td> 
                                    <label> <input type="checkbox" '.$chk.' class="click-to-enable" value="'.$ticker->id.'"> Enable / Disable </label>
                                </td>
                                <td></td>
                        
                        
                        </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
$('.click-to-enable').click(function(){
    let id = $(this).val();//('tr').data('id');
    $.ajax({
                    url : base_url + '/Admin/AJAX',
                    data  : {var : 'enable_ticker', id : id},
                    
                    dataType : 'json',
                    type : 'POST',
                    success : function(res){
                        toastr.success('Process Complete..');
                    },
                    error:function(a,b,x){
                        toastr.error('Error');
                    }
                });
});
    $('.set-in-page').click(function(){
        let id = $(this).closest('tr').data('id');
        $.dialog({
            title : 'Ticker use in Pages!',
            icon : 'fa fa-cog',
            content: function(){
                let self= this;
                return $.ajax({
                    url : base_url + '/Admin/AJAX',
                    data  : {var : 'event_allPages_webSchema','type' : 'newsTicker', id : id},
                    
                    dataType : 'json',
                    type : 'POST',
                    success : function(res){
                        self.setContent(res.html);
                    },
                    error:function(a,b,x){
                        self.setContent(a.responseText);
                    }
                });
            }
        });
    });
    
    $(document).on('change','.event-set-in-page',function(){
        let event_id = $(this).data('event_id')
            type = $(this).data('type'),
            id = this.value;
         
            $('.loadder-'+id).show();
            $.ajax({
                type : 'POST',
                data : {var:'set_event_in_schema' ,type:type, key_id : event_id , page_id : id},
                url : base_url + '/Admin/AJAX',
                dataType : 'json',
                success : function(res){
                     $('.loadder-'+id).hide();
                }
            });
    })
</script>