<style>
    .wizard {
        background-color: transparent;
    }
    .loading-wizard{
          position: absolute;
          top: 0;
          width: 100%;
          background: #250735d4;
          left: 0;
          height: 100%;
          z-index: 99;
          display:none;
      }
      .loading-wizard i{
          color: white;
          font-size: 4em;
          left: 50%;
          position: absolute;
          top: 50%;
      }
</style>      

	    <link rel="stylesheet" href="<?=base_url()?>/public/company/assets/css/azia.css">
            <form class="create-website" style="position:relative;display: none">
            <div id="wizard2">
                <div class="loading-wizard"><i class="fa fa-spin fa-refresh"></i></div>
                <h3>Personal Info.</h3>
                
                <section>
                  <p class="mg-b-20">Try the keyboard navigation by clicking arrow left or right!</p>
                    <?php
                        // print_r($this->session->userdata());
                        echo 
                              form_hidden(['account_manager_id'=>0,'parent_id'=>$this->session->userdata('role'),'addedBy' => 'admin']);
                    ?>
                    
                    <div class="row row-sm">
                    <div class="col-md-3 col-lg-3">
                      <label class="form-control-label">Firstname: <span class="tx-danger">*</span></label>
                      <input id="firstname" class="form-control" name="firstname" placeholder="Enter firstname" type="text" required>
                    </div><!-- col -->
                    
                    
                    <div class="col-md-3 col-lg-3 mg-t-20 mg-md-t-0"> 
                      <label class="form-control-label">Lastname: <span class="tx-danger">*</span></label>
                      <input id="lastname" class="form-control" name="lastname" placeholder="Enter lastname" type="text" required>
                    </div><!-- col -->
                    
                    <div class="col-md-3 col-lg-3 mg-t-20 mg-md-t-0">
                      <label class="form-control-label">Mobile: <span class="tx-danger">*</span></label>
                      <input id="mobile" class="form-control" name="mobile" placeholder="Enter Mobile" type="text" required>
                    </div><!-- col -->
                    
                    <div class="col-md-3 col-lg-3 mg-t-20 mg-md-t-0">
                      <label class="form-control-label">Comapny Name: </label>
                      <input id="company_name" class="form-control" name="company_name" placeholder="Enter lastname" type="text">
                    </div><!-- col -->
                    
                    
                    
                  </div><!-- row -->
                </section>
                
                <h3>Domain Info.</h3>
                
                <section>
                  <p class="mg-b-20">Domain Info.</p>
    
                  <div class="row row-sm">
                    <div class="col-md-5 col-lg-4">
                      <label class="form-control-label">Domain Name: <span class="tx-danger">*</span></label>
                      <input id="domain_name" class="form-control "  name="domain_name" placeholder="Enter Domain Name" type="url" required>
                    </div><!-- col -->
                    <div class="col-md-5 col-lg-4 mg-t-20 mg-md-t-0">
                      <label class="form-control-label">Plan : <span class="tx-danger">*</span></label>
                      <select id="plan" class="form-control" name="plan_id" required>
                          <option label="Select Plan"></option>
                          <?php
                          foreach($this->db->get('plans')->result() as $k){
                               
                                      echo '<option value="'.$k->id.'">'.$k->title.'</option>'; 
                          }
                           
                          ?>
                      </select>
                    </div>
                    <div class="col-md-5 col-lg-4 mg-t-20 mg-md-t-0 plan-details">
                        
                    </div>
                    <div class="theme_view col-md-12"></div>
                  </div><!-- row -->
                </section>
                
                <h3>Billing Info.</h3>
                
                <section>
                  <p>Wonderful transition effects.</p>
                  
                  <div class="row row-sm">
                      
                      <div class="col-md-6 col-lg-6 form-group">
                            <label class="form-contorl-label">Email [ <span class="tx-success">Username</span> ] : <span class="tx-danger">*</span></label>
                            <input id="email" class="form-control" name="email" placeholder="Enter email address" type="email" required>
                      </div>
                      
                      <div class="col-md-6 col-lg-6 form-group">
                            <label class="form-contorl-label">Password : <span class="tx-danger">*</span></label>
                            <input id="password" class="form-control" name="password" placeholder="Enter Password" type="text" required>
                      </div>
                      
                      <div class="col-md-12 col-lg-12 form-group">
                            <label class="form-contorl-label">Address : </label>
                            <textarea class="form-control" name="address" cols="5" placeholder="Enter Address Here.."></textarea>
                      </div>
                      
                      <div class="col-md-3 col-lg-3 form-group">
                            <label class="form-contorl-label">City : <span class="tx-danger">*</span></label>
                            <input id="city" class="form-control" name="city" placeholder="Enter City" type="text" required>
                      </div>
                      <div class="col-md-3 col-lg-3 form-group">
                            <label class="form-contorl-label">State : <span class="tx-danger">*</span></label>
                            <input id="state" class="form-control" name="state" placeholder="Enter State" type="text" required>
                      </div>
                      
                      <div class="col-md-3 col-lg-3 form-group">
                            <label class="form-contorl-label">Pincode </label>
                            <input id="pincode" class="form-control" name="pincode" placeholder="Enter Pincode" type="text" >
                      </div>
                      
                      <div class="col-md-3 col-lg-3 form-group">
                            <label class="form-contorl-label">GST No. : </label>
                            <input id="gst" class="form-control" name="gst_no" placeholder="Enter GST No." type="text" >
                      </div>
                      
                  </div>
                  
                  
                  
                </section>
                
                <h3>Payment Details</h3>
                <section>
                  
                  <p>The next and previous buttons help you to navigate through your content.</p>
                 
                  <div class="row">
                      <div class="col-md-3  form-group ">
                        <label class="control-label  " for="payment_status">Payment Status<span class="tx-danger">*</span>
                        </label>
                        <div class=" ">
                            <select id="payment_status" class="form-control "  name="payment_status" required="required" >
                                <option label="Select payment Status"></option>
                                <option value="panding">Panding</option>
                                <option value="success">Success</option>
                            </select>
                        </div>
                     </div>
                     
                     <div class="col-md-3 form-group  ">
                        <label class="control-label  " for="payment_mode">Payment Mode<span class="tx-danger">*</span>
                        </label>
                        <div class="">
                            <select id="payment_mode" class="form-control "  name="payment_mode" required="required" >
                                <option label="Select payment Mode"></option>
                                <option value="cash">Cash</option>
                                <option value="Paytm">Paytm</option>
                                <option value="Phonepe">Phonepe</option>
                                <option value="Google Pay">Google Pay</option>
                                <option value="Other Online Mode">Other Online Mode</option>
                                <option value="IMPS/RTGS/NEFT Or Bank Transfer">IMPS/RTGS/NEFT Or Bank Transfer</option>
                                <option value="Direct Deposit/By Cheque">Direct Deposit/By Cheque</option>
                            </select>
                        </div>
                     </div>
                     
                     <div class="col-md-3  form-group ">
                        <label class="control-label " for="total_payment">Total Payment<span class="tx-danger">*</span>
                        </label>
                        <div class="">
                            <input type="number" id="total_payment" class="form-control  cal-amount"  name="total_payment" placeholder="Enter Total Payment" required="required" >
                        </div>
                     </div>
                     
                     <div class="col-md-3  form-group ">
                        <label class="control-label " for="payment_receive">Payment Received<span class="tx-danger">*</span>
                        </label>
                        <div class=" ">
                            <input type="number" id="payment_receive" value="0" class="form-control  cal-amount"  name="payment_receive" placeholder="Enter Payment Received" required="required" >
                        </div>
                     </div>
                     <div class=" form-group col-md-4">
                         <label class="control-label " for="payment_dis">Payment Discount <span class="tx-danger">*</span> </label>
                         <div class=" ">
                            <div class="dropdown input-group">
                                <input type="number" class="form-control dis_value" name="dis_value" value="0" required>
                                <div class="input-group-btn">
                                    <select class="form-control dis_type"  required name="dis_type">
                                        <option value="rupee" > &#8377;</option>
                                        <option value="percentage"> %</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                     </div>
                     <div class="col-md-3  form-group  col-md-4">
                         <label class="control-label " for="">Arrearages : 
                        </label>
                        <div class="form-control "> <label id="arr_amnt"> 0 <i class="fa fa-rupee"></i></label> </div>
                    </div>
                    <!-- dis-amount-print -->
                    <div class="col-md-3  form-group col-md-4">
                         <label class="control-label " for="">Discount : 
                        </label>
                        <div class=" form-control"> <label class="dis-amount-print"> 0 <i class="fa fa-rupee"></i></label> </div>
                    </div>
                    <div class="col-md-3  form-group col-md-12">
                         <label class="control-label " for="payment_innfo">payment Info : </label>
                        <div class=" "> 
                            <textarea class="form-control" rows="4" name="payment_info" placeholder="Enter Payment Info"></textarea>
                        </div>
                    </div>
                  </div>
                </section>
                
                
          </div>
          
          <?
          ?>
            </form>
          <hr class="mg-y-30 mg-lg-y-50 bd-transparent">
          
          <script>
          

          $(document).on('keyup keydown blur','.cal-amount,.dis_value,.dis_type',function(){
                         
                        var ttl_amount = $('#total_payment').val(),
                             rec_amnt = $('#payment_receive').val(),arr_amount = 0;
                        var dis_type = $('.dis_type').val(),
                            dis_value = ($('.dis_value').val()),
                            iconDis = ' <i class="fa fa-rupee"></i>';
                            dis_value = dis_value == '' ? 0 : dis_value;
                            if( dis_type == 'rupee' ){
                                ttl_amount -= dis_value;
                            }
                            else{
                                
                                let disc = ttl_amount * ( dis_value * 0.01 ); 
                                    ttl_amount -= disc;
                                iconDis = ' %'; 
                            }
                            $('.dis-amount-print').html(dis_value + ' '+iconDis);    
                            arr_amount = ttl_amount - rec_amnt;
                            let class1 = arr_amount >= -1 
                                                  ? '<label class="label label-success">Success</label>' 
                                                  : '<label class="label label-danger">Something Went Wrong, Check Your calculation.</label>';
                            $('#arr_amnt').html(arr_amount.toFixed(2)+' <i class="fa fa-rupee"></i> '+class1);
                     });
                     
                     
                $(document).on('change','#plan',function(){
                     $('.loading-wizard').show(600);
                          $.ajax({
                              type : 'POST',
                              url : '<?=base_url()?>ajax/plan_details',
                              data : { theme_id: $('#plan').val() },
                              dataType : 'json',
                              success : function(res){
                                  $('.loading-wizard').hide(600);
                                  $('.plan-details').html(res.html);
                                  $('#total_payment').val(res.price);
                                //   alert(res.price);
                              },
                              error : function(a,v,c){
                                  $('.loading-wizard').hide(600);
                                    $('.plan-details').html(a.responseText);
                              }
                          });
                            
                });



               $('#wizard2').steps({
                  headerTag: 'h3',
                  bodyTag: 'section',
                  autoFocus: true,
                  titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
                  onStepChanging: function (event, currentIndex, newIndex) {
                     
                    if(currentIndex < newIndex) {
                    
                      if(currentIndex === 0) {
                        var fname = $('#firstname').parsley();
                        var lname = $('#lastname').parsley();
                        var mobile = $('#mobile').parsley();
                        
        
                        if(fname.isValid() && lname.isValid() && mobile.isValid() ) {
                          return true;
                        } else {
                          fname.validate();
                          lname.validate();
                          mobile.validate();
                        }
                      }
        
                      if(currentIndex === 2) {
                        var email = $('#email').parsley(),
                            password = $('#password').parsley(),
                            city = $('#city').parsley(),
                            state = $('#state').parsley();
                            
                        if( email.isValid() && password.isValid() && city.isValid() && state.isValid() ) {
                           
                           
                          return true;
                        } else { 
                            email.validate(); 
                            password.validate();
                            city.validate();
                            state.validate();
                        }
                      }
                      
                      if(currentIndex === 1){
                        var domain_name = $('#domain_name').parsley(),
                            plan = $('#plan').parsley();
                        
                        if(domain_name.isValid() && plan.isValid() )
                             return true;
                        else{
                            domain_name.validate();
                            plan.validate();
                        }
                      }
                      
                      
                      
                    // Always allow step back to the previous step even if the current step is not valid.
                    } else { 
                        return true; 
                    }
                    
                  },
                  onFinishing: function (event, currentIndex)
                  {
                       if(currentIndex === 3){
                           var payment_status = $('#payment_status').parsley(),
                               payment_mode   = $('#payment_mode').parsley(),
                               total_payment  = $('#total_payment').parsley(),
                               payment_receive= $('#payment_receive').parsley();
                            
                            if( payment_status.isValid() && payment_mode.isValid() && total_payment.isValid() && payment_receive.isValid()  )
                                return true;
                            else{
                                payment_status.validate();
                                payment_mode.validate();
                                total_payment.validate();
                                payment_receive.validate();
                            }
                      }
                  },
                    onFinished: function (event, currentIndex)
                    {
                        // alert('yes');
                        var form = $(this);
                        $('.create-website').on('submit',function(a){
                            
                            var f = $(this);
                            f.parsley().validate();
                            
                            if (f.parsley().isValid()) {
                                $('.loading-wizard').show(600);
                                $.ajax({
                                    type : 'POST',
                                    url : '<?=base_url('website/create')?>',
                                    data : f.serialize(),
                                    dataType : 'json',
                                    success : function(res){
                                        console.log(res);
                                        $.alert({
                                            type : 'green',
                                            title : 'Website Data',
                                            theme : '<?=confirm_js_theme()?>',
                                            content : res.html,
                                            columnClass : 'col-md-10 col-md-offset-1'
                                            
                                        });
                                        if(res.status){
                                          $('.create-website')[0].reset();
                                          location.reload();
                                        }
                                        $('.loading-wizard').hide(600);
                                    },
                                    error : function(a,v,c){
                                        console.log(a);
                                        $.alert({
                                            type : 'red',
                                            theme : '<?=confirm_js_theme()?>',
                                            title : 'Error',
                                            content : a.responseText,
                                            columnClass : 'col-md-10 col-md-offset-1'
                                            
                                        });
                                        $('.loading-wizard').hide();
                                    }
                                });
                                console.log(f.serialize());
                            }
                            
                            a.preventDefault();
                        }).trigger('submit');
                    }
                });
               



                $('.create-website').slideDown(600);

          </script>