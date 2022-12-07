<?
include 'header.php';
?>
<style>
    .form-control:focus {
    box-shadow: none;
    border-color: #BA68C8
}

.profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #682773
}

.profile-button:focus {
    background: #682773;
    box-shadow: none
}

.profile-button:active {
    background: #682773;
    box-shadow: none
}

.back:hover {
    color: #682773;
    cursor: pointer
}

.labels {
    font-size: 11px
}

.add-experience:hover {
    background: #BA68C8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #BA68C8
}
</style>
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-user icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Profile
                <div class="page-title-subheading">Update Your Profile.
                </div>
            </div>
        </div>
    </div>
</div>  
<style>
    .camera-tg{
        position: absolute;
        bottom: 10px;
        border-radius: 50%;
        padding: 10px;
        right: -1px;
        background: rgb(0,0,0,.7);
        color: white;
        border: 1px solid white;
    }
    .file-input{
        position:absolute;
        z-index:-1;
        display:none;
    }
</style>
 <?
            $admin = $this->db->get_where('websites',['id'=>CLIENT_ID])->row();
?>
<div class="row">
    <div class="col-md-3 border-right">
        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
            <label style="position:relative;">
                <img class="rounded-circle mt-5 admin-profile" style="width:200px;height:200px" src="<?=AdminProfile?>">
                <span class="camera-tg"><i class="fa fa-camera"></i></span>
                <input type="file" class="file-input">
            </label>
            
            <span class="font-weight-bold"><?=AdminNAME?></span>
            <span class="text-black-50"><?=SYSTEM_EMAIL?></span>
            <span> <?=$admin->phone?></span>
        </div>
    </div>
    <div class="col-md-5 border-right">
        <form class="p-3 py-5" method="POST">
            <input type="hidden" name="status" value="update_details">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-right">Profile Settings</h4>
            </div>
           
            <div class="row mt-2">
                <div class="col-md-6"><label class="labels">Name</label><input type="text" class="form-control" name="name" placeholder="first name" value="<?=$admin->name?>"></div>
                <div class="col-md-6"><label class="labels">Surname</label><input type="text" class="form-control" name="last_name" value="<?=$admin->last_name?>" placeholder="surname"></div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text" value="<?=$admin->phone?>" name="phone" class="form-control" placeholder="enter phone number"></div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12"><label class="labels">Email</label><input type="text" value="<?=$admin->_email?>" disabled  class="form-control" ></div>
            </div>
            <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
        </form>
    </div>
    <div class="col-md-4">
        <!--<div class="p-3 py-5">-->
        <!--    <div class="d-flex justify-content-between align-items-center experience"><span>Edit Experience</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Experience</span></div><br>-->
        <!--    <div class="col-md-12"><label class="labels">Experience in Designing</label><input type="text" class="form-control" placeholder="experience" value=""></div> <br>-->
        <!--    <div class="col-md-12"><label class="labels">Additional Details</label><input type="text" class="form-control" placeholder="additional details" value=""></div>-->
        <!--</div>-->
    </div>
</div>
<script>
    $('.file-input').change(function(){
        
        var fd = new FormData();
        var files = $('.file-input')[0].files;
        console.log(files[0]);
        // Check file selected or not
        if(files.length > 0 ){
           fd.append('file',files[0]);
           fd.append('status','profile_update');
            $('#load').show();
           $.ajax({
              url: '<?=current_url()?>',
              type: 'post',
              data: fd,
              contentType: false,
              processData: false,
              success: function(response){
                 if(response != 0){
                    $(".admin-profile").attr("src",response); 
                    $('#load').hide();
                 }else{
                    alert('file not uploaded');
                 }
              },
              error:function(a,v,c){
                  console.log(a.responseText);
              }
           });
        }else{
           alert("Please select a file.");
        }
    });
</script>
<?
include 'footer.php';
?>