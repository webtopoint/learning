<?php

require_once 'header.php';

?>

<div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="pe-7s-file icon-gradient bg-mean-fruit">

                                        </i>

                                    </div>

                                    <div>List pages

                                        <div class="page-title-subheading">

                                        </div>
<div>List pages

                                        <div class="page-title-subheading">

                                        </div>
                                    </div>

                                </div>   

                            </div>

</div>  

<div class="row">

	<div class="col-md-12">

		<?php

        $pages = $this->SiteModel->list_page();

        if($pages->num_rows()){
 
            ?>

            <table id="list-pages" class="table table-bordered table-striped">

                <thead>

                    <tr>

                        <th>#.</th>

                        <th>Page Name</th>

                        <th>Information</th>

                        <th>Edit</th>

                        <th>Delete</th>
                        
                        <th>Copy URL</th>

                        <th>Default Page</th>
                    </tr>

                </thead>

                <tbody>

                    <?php $i =1;

                    foreach ($pages->result() as $key => $cv) {

                        $content = $cv->link?$cv->link:'<span class="mb-2 mr-2 btn btn-alternate btn-xs btn-sm"><i>Content</i></span>';

                        $chk = $cv->id==$this->SiteModel->getDefaultPage(CLIENT_ID) ? " checked":"";
                        $encodid = AJ_ENCODE($cv->id);
                       echo '<tr>

                                <td>'.$i++.'.</td>

                                <td>'.ucwords($cv->page_name).'</td>

                                <td>'.$content.'</td>
                                <td><a href="add-page-content/'.AJ_ENCODE($cv->id).'" class="mb-2 mr-2 btn btn-dark btn-xs btn-sm"><i class="fa fa-edit"></i></a></td>

                                <td><button class="mb-2 mr-2 btn btn-danger btn-xs btn-sm" data-id="'.AJ_ENCODE($cv->id).'" onclick="del(this)"><i class="fa fa-trash" ></i></button></td>
                                
                                <td><button class="btn btn-xs btn-sm btn-warning copy-url-btn" data-url="'.base_url.'/web/'.AJ_ENCODE($cv->id).'/'.Print_page($cv->page_name).'"><i class="fa fa-copy"></i></button></td>
                                
                                <td align="center"><div class="custom-radio custom-control">
                                		<input type="radio" id="'.$encodid.'" name="defaultPage" class="custom-control-input" '.$chk.' onchange="setDefaultPage(this)">
                                		<label class="custom-control-label" for="'.$encodid.'"></label>
                                	</div>
                                </td>

                             </tr>';

                    }

                    ?>

                </tbody>

            </table>

            <?php

        }

        else

        {

            echo '<center><div class="col-md-4">

                        <div class="card-shadow-secondary border mb-3 card card-body border-secondary" >

                          <h5 class="card-title text-danger">You don\'t have page.</h5>

                             If you can add a new page then click here!

                            <a href="'.site_url('Admin/Add-Page').'" class="btn btn-danger"><i class="fa fa-plus"></i> Create Page</a>

                        </div>

                    </div></center>';

        }

        ?>

	</div>

</div>

<script type="text/javascript">

    $('.page_setting').addClass('mm-active');

    $('.all_pages').addClass('mm-active');

    $('.copy-url-btn').click(function(){
        let data = $(this).data('url');
                  var $temp = $("<input>");
                    $("body").append($temp);
                    $temp.val(data).select();
                    document.execCommand("copy");
                     toastr.success('Link Copy Successfully.');
                    $temp.remove();
    });

    function setDefaultPage(ip)
    {
    	$.ajax({
    		url:'<?=site_url("Admin/set_default_page")?>',
    		type:'POST',
    		data:{page_id:$(ip).attr("id")},
    		beforeSend:function()
    		{
    			$("#load").show();
    		},
    		success:function(q)
    		{	//alert(q);
    			toastr.success("Default Page Updated");
    			$("#load").hide();
    		}
    	});
    }
    function del(e)
    {	var el =e;
        if(confirm("Are you sure to delete Page?"))
        {
            var id = $(e).data('id');
            //alert(id);
            $.ajax({
                url:'<?=site_url('Admin/list_pages')?>',
                type:'post',
                data:{status:'delete',id:id},
                success:function(q)
                {
                	$(el).parent().parent().hide(200);
                    toastr.success('Page Deleted successfully');
                },
                error:function(u,v,w)
                {
                    alert(w);
                }
            })
        }
    }

 </script>

<?php

require_once 'footer.php';

?>