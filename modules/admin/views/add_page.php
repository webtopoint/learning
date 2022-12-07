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
                                    <div>Add a New Page
                                        <div class="page-title-subheading">
                                        	<?
                                        	if($this->session->flashdata('error')){
                                        		echo $this->session->flashdata('error');
                                        		?>
                                        		<script type="text/javascript">
                                        			toastr.success('<?=$this->session->flashdata('error')?>');
                                        		</script>
                                        		<?
                                        	}
                                        	if($this->session->flashdata('success')){
                                        		?>
                                        		<script type="text/javascript">
                                        			toastr.success('<?=$this->session->flashdata('success')?>');
                                        		</script>
                                        		<?
                                        	}
                                        	?>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>  
                        
                        <form class="row add_page_form" method="post">
                        	<div class="col-md-8">
                        		<div class="card mb-3 main-card " style="padding:10px">
                        			<div class="form-group">
                        				<input type="text" name="page_name" required class="form-control" placeholder="Enter Page Name">
                        			</div>
                        			<div class="form-group all-div">
                        
                        			</div>
                        		</div>
                        	</div>
                        	<div class="col-md-4">
                        		<div class="mb-3 text-center card main-card">
                        			<div class="card-header">
                        				<button class="btn btn-outline-focus"  style="width: 100%">
                        					<i class="pe-7s-paper-plane"></i> Publish
                        				</button>
                        			</div>
                                    <div class="card-body">
                                         <label>
                                            <input type="radio" name="type" class="page_type" value="content" checked> Content
                                        </label>
                                        <label>
                                            <input type="radio" name="type" class="page_type" value="link"> Custom Link
                                        </label>
                                        
                                        <label>
                                            <input type="checkbox" name="redirection"> Redirect A New Page
                                        </label>
                                    </div>
                                </div>
                        	</div>
                        </form>

                <script type="text/javascript">
                	$('.page_setting').addClass('mm-active');
                	$('.add_page').addClass('mm-active');
                    $('.page_type').change(function(){
                       if(this.value=='link'){
                            $('.all-div').html('<input type="text" name="link" placeholder="Enter Link" class="form-control">');
                            $('.all-div input').focus();
                       }else{
                        $('.all-div').html('');
                       }
                    });
                </script>
<?
require_once 'footer.php';
?>