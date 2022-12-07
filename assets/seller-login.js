$(function(){
    'use strict'
    // toastr.success('a');
    // window.href
    $(document).on('submit','form',function(e){
        e.preventDefault();
        var loginBtn = $(this).find('.login-btn'),
            that = this,
            url = $('#uri').val();
            $(loginBtn).html(`
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
          Please Wait...`).prop('disabled',true);
        $.ajax({
            type : 'POST',
            url : $(this).attr('action'),
            data : $(this).serialize(),
            dataType : 'json',
            success:function(res){
              console.log(res);
              if(res.status){
                toastr.success(res.message);
                if(url != 'login')
                    location.reload()
                else
                    location.href = res.url;
              }
              else{
                toastr.error(res.message);
              }
             
            },
            complete:function(){
                $(loginBtn).html('Sign In').prop('disabled',false);
            },
            error:function(a,v,c){
              console.log(a.responseText);
            }
        });
    })
  });