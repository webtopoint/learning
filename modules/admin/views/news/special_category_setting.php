<?
$CI = get_instance();

$catSetting = $CI->NewsModel->special_category(['id'=>AJ_DECODE($id)]);
if($catSetting->num_rows()){
    $row = $catSetting->row();
    $title = $moreBtn = $category = 'show';
    if(isJson($row->settings)){
        $settings = (array) json_decode($row->settings,true);
        
        $title      = $settings['title_image'];          // == 'show' ? TRUE : FALSE;
        $category   = $settings['category'];          // == 'show' ? TRUE : FALSE;
        $moreBtn    = $settings['view_more_btn'];          // == 'show' ? TRUE : FALSE;
    }
?>

    <form class="card submit-setting">
        <div class="card-header bg-info text-white">
            <strong><i class="fa fa-cog"></i> Special Category (s)</strong>
        </div>
        <div class="card-body text-black row" style="margin:0">
            <input type="hidden" name="id" value="<?=$id?>">
            <div class="form-group col-md-4">
                <label>Title Image</label>
                <select type="checkbox" class="form-control" name="title_image">
                    <option <?=$title == 'show' ? 'selected' : ''?> value="show">Show</option>
                    <option <?=$title == 'hide' ? 'selected' : ''?> value="hide">Hide</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label>View More Button</label>
                <select type="checkbox" class="form-control" name="view_more_btn">
                    <option <?=$moreBtn == 'show' ? 'selected' : ''?> value="show">Show</option>
                    <option <?=$moreBtn == 'hide' ? 'selected' : ''?> value="hide">Hide</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label>Category</label>
                <select type="checkbox" class="form-control" name="category">
                    <option <?=$category == 'show' ? 'selected' : ''?> value="show">Show</option>
                    <option <?=$category == 'hide' ? 'selected' : ''?> value="hide">Hide</option>
                </select>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-success" >Save</button>
        </div>
    </form>
    <script>
    NProgress.configure({ parent: '.submit-setting .card-body' });
    $('.submit-setting').submit(function(e){
        e.preventDefault();
        let data = $(this).serialize()+'&status=save_special_category_setting';
        NProgress.start();
        
                    $('.submit-setting').find('select,button').prop('disabled',true);
         $.ajax({
                type : 'POST',
                url : base_url + '/Admin/news_ajax',
                data : data,
                dataType: 'json',
                success:function(res){
                    console.log(res);
                    $('.submit-setting').find('select,button').prop('disabled',false);
                    NProgress.done();
                    toastr.success('Proccess Complete Successfully..');
                },
                complete:function(){
                    NProgress.remove();
                }
            });
    });
    /*
        $('.form-control').on('change',function()  {
            let val = this.value,
                check = this.checked,
                id = $(this).closest('table').data('id');
            $.ajax({
                type : 'POST',
                url : base_url + '/Admin/news_ajax',
                data : { status : 'save_special_category_setting' , check : check, val : val , id : id},
                dataType: 'json',
                success:function(res){
                    console.log(res);
                }
            });
        })*/
    </script>
<?
}
?>