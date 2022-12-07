<section class="page-header-section" >
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7 col-lg-6">
                <div class="page-header-content text-white">
                    <h1 class="text-white mb-2">
                        <i class="fa fa-sign-in"></i> Client Login
                    </h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="main-body">
    

    <div class="container">
    <div class="row">
        <div class="auth-content-wrap col-sm-12">
           
            <div class="logincontainer with-social">
                
                <div class="auth-body">
                    <div class="header-lined auth-header text-center">
                       
                        <h1>Client Login</h1>
                        
                    </div>
    
                        
                    <div class="providerLinkingFeedback"></div>
    
                    <div class="row">
                        <div class="col-md-12">
    
                            <form method="post" action="<?=site_url('login')?>" class="login-form" role="form" autocomplete="off">

                                <div class="form-group">
                                    <label for="inputEmail">Email Address</label>
                                    <input type="email" name="username"  class="form-control" id="inputEmail" placeholder="Enter email" autofocus="" autocomplete="off">
                                </div>
    
                                <div class="form-group">
                                    <label for="inputPassword">Password</label>
                                    <a href="/password/reset" class="forgot-link text-right">Forgot Password?</a>
                                    <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password" autocomplete="off">
                                </div>
    
                                <!-- div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="rememberme"> Remember Me
                                    </label>
                                </div -->
                                <div align="center">
                                    <button id="login" type="submit" class="btn btn-block primary-solid-btn submit-btn" >Login</button>
                                </div>
                                <br><br>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="auth-footer">
                    <p class="text-center register-link mb-0">
                        Don't have an account yet? <a href="/register">Register</a>
                    </p>
                </div>
            </div>
                           
        </div>
    </div>
</div>

</section>

<script>
    $('.login-form').submit(function(r){
        r.preventDefault();
        console.log($(this).serialize());
        var form = this;
           //console.log($(this).serialize());
            var url = $(this).attr('action'),
               method = $(this).attr('method'),
               data = $(this).serialize();
               
            var btn_html =  $('.submit-btn').html();
            $('.submit-btn').html('<i class="fa fa-spin fa-spinner"></i> Loading...').prop('disabled',true);

            $.ajax({
                type : url,
                method : method,
                data : data,
                dataType : 'json',
                success : function(res){
                    console.log(res);
                    if(!res.status){
                        $.each(res.errors, function(index, value){
                            toastr.error(value );//+ '<br>');
                        });
                    }
                    else{
                        toastr.success('Login Successfully...');//+ '<br>');

                         location.href = res.href;
                    }
                    
                    $('.submit-btn').html(btn_html).prop('disabled',false);
                },
                error:function(r,b,v){
                    console.log(r.responseText);
                }
            });
    });
</script>