<?
require_once 'header.php';
?>

<div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
                                        </i>
                                    </div>
                                    <div>Theme Setting
                                        <div class="page-title-subheading">
                                        </div>
                                    </div>
                                </div>  
                            </div>
</div>  
<div class="row">
        <?
        $allThemes = $this->ThemeModel->getAllTheme(array('status'=>1));
        
        foreach($allThemes->result() as $k => $theme){
            ?>
            <div class="card mb-3 main-card  col-md-3 " style="padding:10px">
    		    <div class="card-header">
    		        <h4><?=ucwords($theme->theme_name)?></h4>
    		    </div>
    		    <div class="card-body">
    			      <img src="<?=site_url('public/theme/theme-setting-01.jpg')?>" alt="" style="width:100%">
    		   </div>
    		   <div class="card-footer">
    		       <?
    		       if(THEME_ID==$theme->id)
    		       echo '<button class="btn btn-danger">Enabled</button>';
    		       else
    		       echo '<button class="btn btn-success theme-setting" data-id="'.$theme->id.'">Click to Set</button>';
    		       ?>
    		       
    		   </div>
    		</div>
            <?
        }
        ?>
</div>
<script>
    $('.theme-setting').click(function(){
        $('#load').show();
        $.ajax({
            type:'POST',
            url:base_url+'/Admin/AJAX',
            data:{
                var:'theme_set',theme_id:$(this).data('id')
            },
            dataType:'json',
            success:function(_res){
                $('#load').hide();
                toastr.success('Theme Set Successfully..');
                setTimeout(function(){location.reload();},1000);
            },error:function(a,n,c){
                alert(c);
            }
        });
    });
</script>
<?
require_once 'footer.php';
?>