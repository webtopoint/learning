<?

require_once 'header.php';

$fe = $this->SiteModel->getFeatureBox(array('id'=>$id));

if(!$fe->num_rows())
{
    echo'<div class="alert alert-danger">No Data Available</div>'; exit();
}  

$res = $fe->row();

?>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css.map">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css">
<script type="text/javascript" src="<?=base_url.'/public/icons.js'?>"></script>
<div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">

                                        </i>

                                    </div>

                                    <div>Edit Feature Box

                                        <div class="page-title-subheading">

                                            <?

                                            if($this->session->flashdata('error')){

                                                echo $this->session->flashdata('error');

                                            }

                                            ?>

                                        </div>

                                    </div>

                                </div>  

                            </div>

</div>  



<div class="row">

    <div class="col-md-12">
        <form action="" method="post" >

        <div class="mb-3 text-center card main-card">



            <div class="card-header">

                <h5>edit Feature Box</h5>

            </div>

            <div class="card-body"  align="left">
                <div class="form-group">
                    <label>Enter Feature Box Name</label>
                    <input type="text" name="name" class="form-control" value="<?=$res->name?>" required>
                </div>

                <div class="form-group">
                    <label>No of Features</label>
                    <select class="form-control" name="no" onchange="makeBox()" required>
                        <option <?=$res->no=='1'?'selected':''?>>1</option>
                        <option <?=$res->no=='2'?'selected':''?>>2</option>
                        <option <?=$res->no=='3'?'selected':''?>>3</option>
                        <option <?=$res->no=='4'?'selected':''?>>4</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Icon Color</label>
                    <input type="color" name="iconcolor" class="form-control" value="<?=$res->icolor?>" required>
                </div>

                <div class="form-group">
                    <label>Icon Background color</label>
                    <input type="color" name="boxcolor" class="form-control" value="<?=$res->boxcolor?>" required>
                </div>

                <div class="form-group">
                    <label>Icon Size (In Pixel)</label>
                    <input type="number" name="size" class="form-control" min="1" max="100" value="<?=$res->size?>" required value="20">
                </div>

                <div class="form-group">
                    <label>Type</label><br>
                    <input type="radio" name="type" value="circle" required <?=$res->type=='circle'?'checked':''?>> Circle
                    <input type="radio" name="type" value="square" required <?=$res->type=='square'?'checked':''?>> Square
                    
                </div>

                <div id="boxList" class="row">
                    <?php
                        $i=0;
                        $num = 12/$res->no;
                        foreach (json_decode($res->boxes) as $val)
                        {
                            echo'<div class="col-sm-'.$num.'" style="border:1px solid #f0f0f0; padding-top:5px;"><div class="form-group"><input type="text" value="'.$val->icon.'" class="form-control" name="icon_'.$i.'" placeholder="Enter Icon Here" onclick="chooseIcon(this)" readonly><input type="text" value="'.$val->title.'" class="form-control" name="title_'.$i.'" placeholder="Enter Title"><textarea id="aryaeditor'.$i.'" name="data_'.$i.'">'.$val->data.'</textarea></div></div>';
                            $i++;
                        }

                    ?>
                </div>

            </div>

            <div class="card-footer ">
                <button class="btn btn-success">Save</button>
            </div>

        </div></form>
    </div>


</div>

<style type="text/css">
    .ilist{
        position: fixed;
        height: 100%;
        width: 100%;
        top:0;
        padding-top: 5%;
        padding: 20px;
        z-index: 999999;
        background:rgba(0,0,0,0.4);
        overflow: auto;
        display: none;
    }

</style>
<?

require_once 'footer.php';

?>
<div class="ilist">
    <center><span class="badge" onclick="$('.ilist').hide()" style="background: white;"> <font size="4"><i class="fa fa-times"></i> Close</font></span></center>
    <div class="container" style="padding: 20px; background: white;"></div>
</div>

    <script type="text/javascript">
       // makeBox();
        function makeBox()
        {
            var no = $("select[name=no]").val();
            $("#boxList").html('');
            var i;
            var x = 12/parseInt(no);
            for(i = 0; i<no;i++)
            {
                $("#boxList").append('<div class="col-sm-'+x+'" style="border:1px solid #f0f0f0; padding-top:5px;"><div class="form-group"><input type="text" class="form-control" name="icon_'+i+'" placeholder="Enter Icon Here" onclick="chooseIcon(this)" readonly><input type="text" class="form-control" name="title_'+i+'" placeholder="Enter Title"><textarea id="aryaeditor'+i+'" name="data_'+i+'"></textarea></div></div>');   
            }
            makeeditor();
        }

    </script>

<script type="text/javascript">


makeeditor();
function makeeditor()
{
    var  editor0 =  CKEDITOR.replace('aryaeditor0', {
          height: 400,contentsCss : 'body{background:url(/path/to/image.gif);}',
          baseFloatZIndex: 10005,
        });
    editor0.ui.addButton('SuperButton', { 
        label: "Manage Files",
        command: 'mySimpleCommand',
        toolbar: 'insert',
        icon: 'https://avatars1.githubusercontent.com/u/200?v=10&s=40'
    });
    editor0.addCommand("mySimpleCommand", { 
        exec: function(edt) {
            manage_gallery();
        }
    });
    
    var  editor1 =  CKEDITOR.replace('aryaeditor1', {
          height: 400,contentsCss : 'body{background:url(/path/to/image.gif);}',
          baseFloatZIndex: 10005,
        });
    editor1.ui.addButton('SuperButton', { 
        label: "Manage Files",
        command: 'mySimpleCommand',
        toolbar: 'insert',
        icon: 'https://avatars1.githubusercontent.com/u/200?v=10&s=40'
    });
    editor1.addCommand("mySimpleCommand", { 
        exec: function(edt) {
            manage_gallery();
        }
    });
    var  editor2 =  CKEDITOR.replace('aryaeditor2', {
          height: 400,contentsCss : 'body{background:url(/path/to/image.gif);}',
          baseFloatZIndex: 10005,
        });
    editor2.ui.addButton('SuperButton', { 
        label: "Manage Files",
        command: 'mySimpleCommand',
        toolbar: 'insert',
        icon: 'https://avatars1.githubusercontent.com/u/200?v=10&s=40'
    });
    editor2.addCommand("mySimpleCommand", { 
        exec: function(edt) {
            manage_gallery();
        }
    });
    var  editor3 =  CKEDITOR.replace('aryaeditor3', {
          height: 400,contentsCss : 'body{background:url(/path/to/image.gif);}',
          baseFloatZIndex: 10005,
        });
    
    editor3.ui.addButton('SuperButton', { 
        label: "Manage Files",
        command: 'mySimpleCommand',
        toolbar: 'insert',
        icon: 'https://avatars1.githubusercontent.com/u/200?v=10&s=40'
    });
    editor3.addCommand("mySimpleCommand", { 
        exec: function(edt) {
            manage_gallery();
        }
    });
    
}

var i=0;
for(i=0;i<iconList.length;i++)
{
    $(".ilist .container").append('<div style="height:50px; width:50px; display:inline-block; color:black; font-size:22px; text-align:center; line-height:50px; border:1px solid white;" onclick="choose(this)" data-class="'+iconList[i]+'"><i class="fa '+iconList[i]+'"></i></div>');
}

var IPbox;
function chooseIcon(e)
{// alert("HK");
    IPbox=e;
    $(".ilist").show();
}
function choose(e)
{
    $(".ilist").hide();

    $(IPbox).val($(e).data('class'));
}

function deleteBox(e)
{
    if(confirm("Are you sure to delete?"))
    {
       location.href="<?=site_url('Admin/delete-feature-box/')?>"+$(e).data('id');
    }
}
 </script>

