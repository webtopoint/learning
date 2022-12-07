<?php

require_once 'header.php';

?>

<div class="row">
    <?php
    if(CLIENT_ID == 1730){
        ?>
        <style>
            .main-body {
                background: black;
                color:white;
                text-align:center;
                font-family:Helvetica;
                box-sizing: border-box;
                margin: 0;
            }
            
            .main-body main {
                margin: 4rem auto 6rem;
                max-width: 650px;
                width: 90vw;
            }
            
            .lamps {
               display: flex;
               flex-direction: row;
               justify-content: center;
            }
             
            .main-body div{
                margin:0 auto;
                text-align:center;
            }
                
            .base{
                background-color:#d2691e;
                width:120px;
                height:70px;
                border-bottom-right-radius:250px;
                border-bottom-left-radius:250px;
            }
                
            .fire{
                height:30px;
                width:18px;
                background-color:yellow;
                border-radius:50%;
                border: 1px solid red
            }
            
            .actions {
                margin: 15px;
            }
            
            .actions .icon  {
                cursor: pointer;
            }
            
            .glow {
                font-size: 80px;
                color: #fff;
                text-align: center;
            }
            
            .main-body a {
                color: #61dafb;
            }
        </style>
        <div class="main-div">
            <main>
                <h1 class="glow" id="banner">Happy Diwali 2020</h1>
                <div class="lamps">
                    <div>
                        <div class="fire" id="light-1"></div>
                        <div class="base"></div>
                    </div>
        
                    <div>
                        <div class="fire" id="light-2"></div>
                        <div class="base"></div>
                    </div>
                </div>
            </main>
        </div>
        <script>
            feather.replace();

let element = document.getElementById('light-1');

let swing = [
    { transform: 'rotate(30deg)' },
    { transform: 'rotate(-30deg)'},
    { transform: 'rotate(30deg)' }
];
const animateX = element.animate(
  swing
  , {
    duration: 2000,
    iterations: Infinity,
    easing: 'ease-in-out'
  }
);

const animateY = document.getElementById('light-2').animate(
  [
    { transform: 'translateY(0)' },
    { transform: 'translateY(-80%)' },
    { transform: 'translateX(-80%)' },   
    { transform: 'translateX(80%)' },
    { transform: 'translateY(0)' }
  ], 
  {
    fill: 'forwards',
    easing: 'steps(4, end)',
    iterations: Infinity,
    duration: 2000
  }
);

const glow = document.getElementById('banner').animate(
  [
    { 'textShadow': '0 0 10px #fff, 0 0 20px #fff, 0 0 30px #EAB72F, 0 0 40px #e60073, 0 0 50px #e60073, 0 0 60px #EAB72F, 0 0 70px #EA5C2F'},
    { 'textShadow': '0 0 10px #fff, 0 0 20px #fff, 0 0 30px #36EA2F, 0 0 40px #36EA2F, 0 0 50px #36EA2F, 0 0 60px #36EA2F, 0 0 70px #36EA2F'},
    { 'textShadow': '0 0 10px #fff, 0 0 20px #fff, 0 0 30px #e60073, 0 0 40px #e60073, 0 0 50px #362FEA, 0 0 60px #e60073, 0 0 70px #362FEA'},
    { 'textShadow': '0 0 10px #fff, 0 0 20px #ff4da6, 0 0 30px #362FEA, 0 0 40px #EA5C2F, 0 0 50px #EAB72F, 0 0 60px #ff4da6, 0 0 70px #ff4da6'},
  ], 
  { 
    easing: 'ease-in-out',
    iterations: Infinity,
    duration: 1000,
    direction: 'alternate'
  }
);

const pause = () => {
  animateX.pause();
  animateY.pause();
  glow.pause();
}

const play = () => {
  animateX.play();
  animateY.play();
  glow.play();
}
        </script>
        <?php
    }
    ?>
</div>


<!--<center><h1>Do Customization and Build your Site</h1></center>-->
<div class="row">
    
    <div class="col-md-6 col-xl-4">
        <a href="javascript:void(0);" id="sendNotifyMessage">
            <div class="card mb-3 widget-content bg-midnight-bloom">
                <div class="widget-content-wrapper text-white" id="lblGreetings">
                    
                </div>
            </div>
        </a>
    </div>
    <script>
        var myDate = new Date();
        var hrs = myDate.getHours();
    
        var greet;
    
        if (hrs < 12)
            greet = 'Good Morning';
        else if (hrs >= 12 && hrs <= 17)
            greet = 'Good Afternoon';
        else if (hrs >= 17 && hrs <= 24)
            greet = 'Good Evening';
    
        document.getElementById('lblGreetings').innerHTML =
            '<b>' + greet + ', <?=AdminNAME?></b> ';
    </script> 
    
    
        <!--<div class="col-md-6 card">-->
        <!--    <h2 class="text-danger">Maintenance Time</h2>-->
        <!--    <label><i class="fa fa-clock-o"></i> 05:00 PM TO <i class="fa fa-clock-o"></i> 07:00 PM</label>-->
        <!--</div>-->
        <!--img src="<?=base_url?>/public/gandhi.jpg" style="width:100%;height:100%"-->
    
</div>
<?php

require_once 'footer.php';

?>



