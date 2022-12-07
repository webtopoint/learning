<div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">

                                        </i>

                                    </div>

                                    <div>Add Subject Combination

                                        <div class="page-title-subheading">

                                        </div>

                                    </div>

                                </div>  

                            </div>

</div> 
<div class="">
    <div class="row">
         <form class="needs-validation container add_subject_combination" method="post"  novalidate >
        <div class="mb-3 card main-card">
            <div class="card-header">Add Subject Combination</div>
            <div class="card-body row">
               
                <div class="form-group has-success col-md-4">
                    <label for="success" class="control-label">Select Class</label>
                	<div class="">
                		<select name="class_id" class="form-control class_id" required="required" >
                		    <option value="">Select A Class</option>
                		    <?
                		    foreach($classes as $cl)
                		       echo '<option value="'.$cl['id'].'">'.ucwords($cl['class_name']).' Section-'.ucwords($cl['section_name']).'</option>';
                		    ?>
                		</select>
                		<div class="invalid-feedback">Select a valid Class</div>
                	</div>
                </div>
                <div class="form-group data-html col-md-12 ">
                    
                </div>
                                                    
                                                    
            </div>
            <div class="card-footer">
                
            </div>
        </div>
        </form>
    </div>
</div>
<script>

let btn = '<div class="form-group has-success">\
                    <div class="">\
                        <button type="submit" name="submit" class="btn btn-success btn-labeled">Submit<span class="btn-label btn-label-right" ><i class="fa fa-check"></i></span></button>\
                    </div>\
                </div>';
    $('.class_id').change(function(){
        if(this.value == ''){
            $('.data-html').html('');
            $('.card-footer').html('');
        }
        else{
            let id = this.value;
            $('#load').show();
            $.post(base_url+'admin/result-section-ajax',{status:'get_subjects',id:id},function(data){
                console.log(data);
                var data = JSON.parse(data);
                $('.data-html').html(data.html);
                if(data.status)
                    $('.card-footer').html(btn);               
                else
                    $('.card-footer').html('');
                $('#load').hide();
            });
        }
    });
    $('.add_subject_combination').submit(function(event){
        event.preventDefault();
        let data = $(this).serialize();
        $.post(base_url+'Admin/result-section-ajax',data+'&status=add_subject_in_class',function(d){
            var d = JSON.parse(d);
            if(d.status)
                toastr.success('Subject Combination Successfully done.');
        });
        
    });
</script>