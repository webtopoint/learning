</div>
<?php
if(isset($js_files)){
    foreach($js_files as $file): ?>
        <script src="<?php echo $file; ?>"></script>
    <?php endforeach;
}
?>

<script type="text/javascript" src="<?=site_url('public/custom/custom.js')?>"></script>

  <script type="text/javascript" src="<?=site_url('public/custom/ckeditor/config.js')?>"></script> 



<div class="app-wrapper-footer">

                        <div class="app-footer">

                            <div class="app-footer__inner">

                                <div class="app-footer-left">

                                    <ul class="nav">

                                        <li class="nav-item">

                                            <a href="javascript:void(0);" class="nav-link">

                                                Version : <strong><?=CI_VERSION?></strong>

                                            </a>

                                        </li>

                                        <li class="nav-item">

                                            <a href="javascript:void(0);" class="nav-link">

                                                Page rendered in <strong> {elapsed_time} </strong> seconds.

                                            </a>

                                        </li>

                                    </ul>

                                </div>

                                <div class="app-footer-right">

                                    <ul class="nav">

                                        <li class="nav-item">

                                            <a href="javascript:void(0);" class="nav-link">

                                                Memory Usage : <strong> {memory_usage} </strong>

                                            </a>

                                        </li>

                                        <li class="nav-item">

                                            <a href="javascript:void(0);" class="nav-link">

                                                <div class="badge badge-success mr-1 ml-0">

                                                    <small>NEW</small>

                                                </div>

                                                Footer Link 

                                            </a>

                                        </li>

                                    </ul>

                                </div>

                            </div>

                        </div>

                    </div>    

                </div>

                

        </div>

    </div>



</html>



<script type="text/javascript">
/*

document.addEventListener('DOMContentLoaded', function ()
{

    if (Notification.permission !== "granted")
    {
        Notification.requestPermission();
    }
});
function sendNotificationToBrowser(setTitle,setDescription,setUrl)
{
    if (!Notification) {
        console.log('Desktop notification is currently not available in your browser.');
        return;
    }
    if (Notification.permission !== "granted")
    {
        Notification.requestPermission();
    }
    else {
        var notification = new Notification(setTitle, {
            icon:'http://discussdesk.com//view/assets/images/logo.png',
            body: setDescription,
        });
        
        notification.onclick = function () {
            window.open(setUrl);
        };
        
        notification.onclose = function () {
            console.log('Notification closed');
        };
    
    }
}
var articles = [
["10 JQuery Plugins for Creating Dynamic Layouts","http://discussdesk.com//10-jquery-plugins-for-creating-dynamic-layouts.htm","10 JQuery Plugins for Creating Dynamic Layouts",],
["Multiple image upload and resize using AJAX","http://discussdesk.com//multiple-image-upload-and-resize-using-ajax.htm","Multiple image upload and resize using AJAX"],
["Server Side Filtering using jQuery Ajax PHP and MySQL","http://discussdesk.com//server-side-filtering-using-jquery-ajax-php-and-mysql.htm","Server Side Filtering using jQuery Ajax PHP and MySQL"],
["Autocomplete Places Search Box using Google Maps JavaScript API","http://discussdesk.com//autocomplete-places-search-box-using-google-maps-javaScript-api.htm","Autocomplete Places Search Box using Google Maps JavaScript API"],
["ReactJS And AngularJS Comparison - Which One Is The Best","http://discussdesk.com//comparison-between-reactjs-and-angularjs.htm","ReactJS And AngularJS Comparison - Which One Is The Best"],
["Submit a Form without Refreshing page with jQuery and Ajax","http://discussdesk.com//submit-form-without-refreshing-page-with-jquery-and-ajax.htm","Submit a Form without Refreshing page with jQuery and Ajax"],
["How to Create Custom Social Share Links","http://discussdesk.com//how-to-create-custom-social-share-links.htm","How to Create Custom Social Share Links"],
["Adding Google Map on Your Website within 5 Minutes","http://discussdesk.com//adding-google-map-on-your-website-within-five-minutes.htm","Adding Google Map on Your Website within 5 Minutes"],
["How to Create the Best AdWords Expanded Text Ads to Boost Your Sales","http://discussdesk.com//create-best-adwords-expanded-text-ads-to-boost-your-sales.htm","How to Create the Best AdWords Expanded Text Ads to Boost Your Sales"],
["Send Beautiful HTML Email using PHP","http://discussdesk.com//send-beautiful-html-email-using-php.htm","Send Beautiful HTML Email using PHP"]
];

document.querySelector("#sendNotifyMessage").addEventListener("click", function(e)
{
    var outputParameter = Math.floor((Math.random() * 10) + 1);
    var setTitle= "10 JQuery Plugins for Creating Dynamic Layouts";//articles[outputParameter][0];
    var setDescription="10 JQuery Plugins for Creating Dynamic Layouts";//articles[outputParameter][2];
    var setUrl="http://discussdesk.com//10-jquery-plugins-for-creating-dynamic-layouts.htm";//articles[outputParameter][1];
    sendNotificationToBrowser(setTitle,setDescription,setUrl);
    e.preventDefault();
});
*/

font_select();

/* font_select_subMenu();*/

function font_select()
{

    var family  = ['Arial','Tangerine','Comic Neue','Bangers','Inconsolata','Lobster','Indie Flower','Dancing Script','Pacifico','Bebas Neue','Righteous','Cinzel','Courgette'];
  
    var fstyle = ['normal','italic','bold'];
    var i =0;
    var fam  = document.getElementById('font-family-select');
    var st   = document.getElementById('font-style-select');
/*
    var fam1  = document.getElementById('font-family-select1');
    var st1   = document.getElementById('font-style-select1');
*/

    if($('#font-family-select').length){
        for(i=0;i<family.length;i++)
        {   
            var  s = fam.dataset.cur.toLowerCase()==family[i].toLowerCase()?" selected":"";
            fam.innerHTML+="<option value='"+family[i]+"' style='font-family:"+family[i]+";' "+s+">"+family[i]+"</option>";
    /*
            s = fam1.dataset.cur.toLowerCase()==family[i].toLowerCase()?" selected":"";
            fam1.innerHTML+="<option value='"+family[i]+"' style='font-family:"+family[i]+";' "+s+">"+family[i]+"</option>";*/
        }
    }
    
    if($('#font-style-select').length){
        for(i=0;i<fstyle.length;i++)
        {   
            var  s = st.dataset.cur.toLowerCase()==fstyle[i].toLowerCase()?" selected":"";
            
            var  t = (fstyle[i]=='bold') ? 'font-weight:' : 'font-style:';
            st.innerHTML+="<option value='"+fstyle[i]+"' style='"+t+fstyle[i]+"' "+s+">"+fstyle[i]+"</option>";
    /*
            s = st1.dataset.cur.toLowerCase()==fstyle[i].toLowerCase()?" selected":"";
            
            t = (fstyle[i]=='bold') ? 'font-weight:' : 'font-style:';
    
            st1.innerHTML+="<option value='"+fstyle[i]+"' style='"+t+fstyle[i]+"' "+s+">"+fstyle[i]+"</option>";*/
        }
    }
}
</script>