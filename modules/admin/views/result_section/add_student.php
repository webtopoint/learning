<div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">

                                        </i>

                                    </div>

                                    <div>Add a New Student

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
            <div class="card-header">Add Student</div>
            <div class="card-body row">
               
                <div class="form-group has-success col-md-4">
                    <label for="success" class="control-label">Full Name</label>
                	<div class="">
                		<input type="text" name="full_name" class="form-control" required="required" placeholder="Eg- Harsh Jadaun etc" id="success">
                		<div class="invalid-feedback">Provide a valid Student name</div>
                	</div>
                </div>
                
                <div class="form-group has-success col-md-4">
                    <label for="success" class="control-label">Roll No</label>
                    <div class="">
                        <input type="text" name="rool_id" placeholder="Roll No." required="required" class="form-control" id="success">
                        <div class="invalid-feedback">Provide a valid Rool id</div>
                    </div>
                </div>
                                                    
                 <div class="form-group has-success col-md-4">
                    <label for="success" class="control-label">Gender</label>
                    <div class="">
                        <select type="text" name="gender" class="form-control"  required="required" >
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                        <div class="invalid-feedback">Provide a valid Gender</div>
                    </div>
                </div>
                
                <div class="form-group has-success col-md-4">
                    <label for="success" class="control-label">Father Name</label>
                	<div class="">
                		<input type="text" name="father_name" class="form-control" required="required" placeholder="Father name" id="success">
                		<div class="invalid-feedback">Provide a valid Father name</div>
                	</div>
                </div>
                
                <div class="form-group has-success col-md-4">
                    <label for="success" class="control-label">Mother Name</label>
                    <div class="">
                        <input type="text" name="mother_name" placeholder="Mother Name" required="required" class="form-control" id="success">
                        <div class="invalid-feedback">Provide a valid Mother Name</div>
                    </div>
                </div>  
                
                <div class="form-group has-success col-md-4">
                    <label for="success" class="control-label">DOB</label>
                    <div class="">
                        <input type="date" name="dob" required="required" class="form-control" id="success">
                        <div class="invalid-feedback">Provide a valid Date of Brith</div>
                    </div>
                </div>  
                <div class="form-group has-success col-md-4">
                    <label for="success" class="control-label">Class</label>
                    <div class="">
                        <select name="class_id" required="required" class="form-control" id="success">
                            <option value="">Select A Class</option>
                            <?
                            foreach($classes as $class)
                              echo '<option value="'.$class['id'].'">'.ucwords($class['class_name']).' Section-'.$class['section_name'].'</option>';
                            ?>
                        </select>
                        <div class="invalid-feedback">Provide a valid Class</div>
                    </div>
                </div>  
                                                
            </div>
            <div class="card-footer">
                <div class="form-group has-success">

                    <div class="">
                        <button type="submit" class="btn btn-success btn-labeled">Submit<span class="btn-label btn-label-right" ><i class="fa fa-check"></i></span></button>
                    </div>
                    
                </div>
            </div>
        </div>
        </form>
    </div>
</div>