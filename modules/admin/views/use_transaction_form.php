<?php
require_once 'header.php';

$allPage= $this->SiteModel->list_page();
$forms = $this->FormModel->getTransactionForm();
?>


<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-browser icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Use Form
                <div class="page-title-subheading">Modify Form using this section.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="main-card mb-3 card">
        <div class="card-body"><h5 class="card-title">Use Form on Pages</h5>

            <ul class="list-group">
                <?php
                foreach($forms->result() as $f)
                {
                    echo'<li class="list-group-item">
                        <h5 class="list-group-item-heading"><strong>'.$f->tform_name.'</strong> </h5>
                        <p class="list-group-item-text">';
                        foreach ($allPage->result() as $page)
                        {
                            $chk = $this->FormModel->checkTransactionFormUse(array('form_id'=>$f->id,'page_id'=>$page->id))?" checked":"";
                           echo'<div class="custom-checkbox custom-control"><input type="checkbox" id="'.$f->id.'_'.$page->id.'" class="custom-control-input" onclick="useTransactionForm('.$f->id.','.$page->id.')" '.$chk.'>
                            <label class="custom-control-label" for="'.$f->id.'_'.$page->id.'">'.$page->page_name.'</label>
                            </div>';
                        }
                            

                        echo'</p>
                      </li>';
                }
                ?>

            </ul>
        </div>
    </div>
</div>


<script type="text/javascript">
    function useTransactionForm(formid,pageid)
    {  
        var DATA = 'formid='+formid+'&pageid='+pageid+'&status=usetransactionform';
        $("#load").show();
        $.ajax({
            url:'<?site_url('Admin/use_transaction_form')?>',
            type:'POST',
            data:DATA,
            success:function(q)
            {
                //alert(q);
                toastr.success("Saved successfully");
                $("#load").hide();
            },
            error:function(a,b,c) 
            {
                alert(c);
            }
        });
    }
</script>

<!-- 
  <div class="d-inline-block dropdown">
                                        <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-shadow dropdown-toggle btn btn-info">
                                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                                <i class="fa fa-cog fa-w-20"></i>
                                            </span>
                                        </button>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(109px, 34px, 0px);">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <div class="nav-link form-group">
                                                        <label>View Gallary</label>
                                                        <select class="form-control" onchange="useGallery(this.value)">
                                                        <option value="0">Disabled</option>
                                                       </select>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div> -->
<?php
//  ';
                                                              
//                                                         foreach ($allPage->result() as $page)
//                                                         {
//                                                             echo'<option value="'.$page->id.'">'.$page->page_name.'</option>';
//                                                         }
//                                                         echo'
require_once 'footer.php';
?>
