<div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">

                                        </i>

                                    </div>

                                    <div> Add Result

                                        <div class="page-title-subheading">

                                        </div>

                                    </div>

                                </div>  

                            </div>

</div> 
<div class="">
    <div class="row">
         <form class="needs-validation container" method="post"  novalidate >
        <div class="mb-3 card main-card">
            <div class="card-header">Add Result</div>
            <div class="card-body">
               
                <div class="form-group has-success col-md-12">
                    <label for="success" class="control-label">Class</label>
                    <div class="">
                        <select name="class_id" required="required" class="form-control class_id" id="success">
                            <option value="">Select A Class</option>
                            <?
                            foreach($classes as $class)
                              echo '<option value="'.$class['id'].'">'.ucwords($class['class_name']).' Section-'.$class['section_name'].'</option>';
                            ?>
                        </select>
                        <div class="invalid-feedback">Provide a valid Class</div>
                    </div>
                </div>  
                
                <div class="data-list col-md-12">
                    
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
                        <button type="submit" class="btn btn-success btn-labeled">Submit<span class="btn-label btn-label-right" ><i class="fa fa-check"></i></span></button>\
                    </div>\
                </div>';
                
    $('.class_id').change(function(){
        let class_id = this.value;
        if(this.value==''){
            $('.data-list').html('');
            $('.card-footer').html('');
        }
        else{
            $('#load').show();
            $.post(base_url+'Admin/result-section-ajax',{class_id:class_id,status:'get_students_and_subjects'},function(s){
                s = JSON.parse(s);
                //console.log(s);
                $('.data-list').html(s.html);
                $('.card-footer').html(btn);
                $('#load').hide();
            });
        }
    });

     
</script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>