<!DOCTYPE html>
<html lang="en">
  <head>
     <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Azia">
    <meta name="twitter:description" content="Bizknow india reseller panel">
    <meta name="twitter:image" content="http://themepixels.me/azia/img/azia-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="<?=base_url()?>">
    <meta property="og:title" content="Azia">
    <meta property="og:description" content="Bizknow india reseller panel">

    <meta property="og:image" content="http://themepixels.me/azia/img/azia-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/azia/img/azia-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Bizknow india reseller panel">
    <meta name="author" content="Seller Panel">

    <title>Reseller Login</title>

    <!-- vendor css -->
    <link href="<?=base_url()?>public/company/assets/lib/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="<?=base_url()?>public/company/assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="<?=base_url()?>public/company/assets/lib/typicons.font/typicons.css" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="<?=base_url()?>public/company/assets/css/azia.css">

  </head>
  <body class="az-body">

    <div class="az-signin-wrapper">
      <div class="az-card-signin">
        <h1 class="az-logo">Rese<span>ll</span>er Login</h1>
        <div class="az-signin-header">
          <h2>Welcome back!</h2>
          <h4>Please sign in to continue</h4>

          <form action="<?=base_url('login')?>" method="POST">
            <input type="hidden" id="uri" value="<?=$this->uri->segment(1,0)?>">
            <div class="form-group">
              <label>Email</label>
              <input type="text" name="email" class="form-control" placeholder="Enter your email" >
            </div><!-- form-group -->
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" class="form-control" placeholder="Enter your password">
            </div><!-- form-group -->
            <button class="btn btn-az-primary login-btn btn-block">Sign In</button>
          </form>
        </div><!-- az-signin-header -->
        <div class="az-signin-footer">
          <p><a href="">Forgot password?</a></p>
        </div><!-- az-signin-footer -->
      </div><!-- az-card-signin -->
    </div><!-- az-signin-wrapper -->

    <script src="<?=base_url()?>public/company/assets/lib/jquery/jquery.min.js"></script>
    <script src="<?=base_url()?>public/company/assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url()?>public/company/assets/lib/ionicons/ionicons.js"></script>

    <script src="<?=base_url()?>public/company/assets/js/azia.js"></script>
    <script src="<?=base_url()?>assets/easyNotify.js"></script>
    <script src="<?=base_url()?>assets/seller-login.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
// var myImg = "https://unsplash.it/600/600?image=777";
// var options = {
//     title: 'Notification',
//     options: {
//       body: 'Hello Ajay Arya.',
//       icon: myImg,
//       lang: 'en-US'
//     }
//   };
//   console.log(options);
//   $("#easyNotify").easyNotify(options);

      
    </script>
  </body>
</html>
