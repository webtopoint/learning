<div class="form-group">
    <?php
    $checkType = start_with($value,'http') ? 'link' : 'page';
    ?>
    <lable><input type="radio" class="link_type" name="link_type" <?=$checkType == 'page' ? 'checked' : ''?> value="page"> Page</label>
    <lable><input type="radio" class="link_type" name="link_type" <?=$checkType == 'link' ? 'checked' : ''?> value="link"> Link</label>
</div>

<div class="form-group">
    <textarea name="link" placeholder="Slug" <?=$checkType == 'page' ? 'readonly' : ''?> class="form-control link"><?=$value?></textarea>
</div>



<script>
    $(document).on('change keyup','#field-page_name,.link_type',function(){
        var type = ($('.link_type:checked').val());
        var str = $('#field-page_name').val();

        if(type == 'page'){
            $('.link').prop('readonly',true);
            $('.link').val( str.replace(/\W+/g, '-').toLowerCase() );
        }
        else
            $('.link').prop('readonly',false);
        // alert(1);
    })
   
</script>