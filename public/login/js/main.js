

(function ($) {

    "use strict";





    /*==================================================================

    [ Focus input ]*/

    $('.input100').each(function(){

        $(this).on('blur', function(){

            if($(this).val().trim() != "") 

                $(this).addClass('has-val');

            else 

                $(this).removeClass('has-val');

        })    

    })

  

  

    /*==================================================================

    [ Validate ]*/

    var input = $('.validate-input .input100');



    $('.validate-form').on('submit',function(evenrt){

        var check = true;



        for(var i=0; i<input.length; i++) {

            if(validate(input[i]) == false){

                showValidate(input[i]);

                check=false;

            }

        }

        if(check){

            evenrt.preventDefault();

            var msg = $(this).parent().find('.message');

            $(msg).html('<div class="alert alert-primary"><strong class="fa fa-spin fa-refresh"></strong> Please Wait....</div>');

            $.ajax({

                type:'POST',

                url:$(this).attr('action'),

                data:$(this).serialize(),

                dataType:'json', 

                success:function(_res){

                    
                    console.log(_res);
                    if(_res.status==1){     

                         $(msg).html('<div class="alert alert-success"><strong class="fa fa-check"></strong> Login successfully....</div>');      

                        setTimeout(function(){location.href='https://'+_res.url;},500);

                    }

                    else if(_res.status==2)

                        $(msg).html('<div class="alert alert-primary"><strong class="fa fa-exclamation"></strong> This Email is not exists.</div>');

                    else if(_res.status==3){

                         $(msg).html('<div class="alert alert-primary"><strong class="fa fa-check"></strong> Choose Any One.</div>');

                         $.dialog({

                             type:'green',

                             columnClass: 'col-md-12',

                             title:'Click Any One',

                             content:_res.html

                         });

                        

                    }

                    else

                        $(msg).html('<div class="alert alert-primary"><strong class="fa fa-exclamation"></strong> Wrong Username Password...</div>');


                     

                },error:function(s,v,c){

                    console.log(s.responseText);
                    console.log(v);
                    console.log(c);

                }

            });

        }

        else

          return check;

    });





    $('.validate-form .input100').each(function(){

        $(this).focus(function(){

           hideValidate(this);

        });

    });



    function validate (input) {

        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {

            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {

                return false;

            }

        }

        else {

            if($(input).val().trim() == ''){

                return false;

            }

        }

    }



    function showValidate(input) {

        var thisAlert = $(input).parent();



        $(thisAlert).addClass('alert-validate');

    }



    function hideValidate(input) {

        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');

    }

    

    /*==================================================================

    [ Show pass ]*/

    var showPass = 0;

    $('.btn-show-pass').on('click', function(){

        if(showPass == 0) {

            $(this).next('input').attr('type','text');

            $(this).addClass('active');

            showPass = 1;

        }

        else {

            $(this).next('input').attr('type','password');

            $(this).removeClass('active');

            showPass = 0;

        }

        

    });





})(jQuery);