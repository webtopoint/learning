<?
$sms = $form->sms ? 'checked' :'';
$email = $form->email ? 'checked' : '';
$url = $form->url;
$redirect = !empty($url) ? 'checked' : '';
?>

<div class="col-md-6">
    <div class="form-group" align="center">
        <label class="col-md-12">Check To Active or Not </label>
        <label>
            <input type="checkbox" class="form-control" name="sms" <?=$sms?>>
            SMS
        </label>
    </div>
</div>

<input type="hidden" name="satnps" value="!">
<div class="col-md-6">
    <div class="form-group" align="center">
        <label class="col-md-12">Check To Active or Not </label>
        <label>
            <input type="checkbox" class="form-control" name="email" <?=$email?>>
            EMAIL
        </label>
    </div>
</div>


<div class="col-md-12">
    <div class="from-group">
        <label><input type="checkbox" class="redirect" name="redirect" <?=$redirect?>> Redirect</label>
        <input type="url" id="url_link" 
        <?
        if(  $redirect == 'required' )
              echo 'style="display:none" ';
        else
            echo $redirect;
        ?>                         
                        name="redirect_link" class="form-control" value="<?=$url?>" placeholder="Enter Link for Redirect After Fill the Form.">
    </div>
</div>

<script>
    $('.redirect').change(function(){
        if($(this).is(':checked'))
            $('#url_link').attr('required',true).show();
        else
            $('#url_link').attr('required',true).hide();
    });
</script>


