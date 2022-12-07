<?php
$get = $this->db->get_where('pages',['uri' => $page]);
if($get->num_rows()){

    $row = $get->row();
    $title = ucwords($row->title);
?>

<section class="page-header-section" >
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7 col-lg-6">
                <div class="page-header-content text-white">
                    <h1 class="text-white mb-2">
                                                <?=$title?>
                                                </h1>
                                    </div>
                <div class="custom-breadcrumb">
                    <ol class="d-inline-block bg-transparent list-inline py-0 pl-0">
                                                    <li class="list-inline-item breadcrumb-item active">
                                                                <?=$title?>
                                                            </li>
                                            </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="main-body">
    <div class="container">
        <div class="">
             <?php
            $page_id = $row->id;
            echo Modules :: run('page/schema',$page_id);
            /*
            foreach($webschema as $type => $data){
                
                    echo '<div class="col-xs-12 main-content">
                            '.$data.'
                        </div>';
            
            }*/
            ?>   
            <!-- Container for main page display content -->
            
        </div>
    </div>
</section>

<?php
}
else{
$title = 'Page Not Found.';
?>
<section class="page-header-section" >
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7 col-lg-6">
                <div class="page-header-content text-white">
                    <h1 class="text-white mb-2">
                                                <?=$title?>
                                                </h1>
                                    </div>
                <div class="custom-breadcrumb">
                    <ol class="d-inline-block bg-transparent list-inline py-0 pl-0">
                                                    <li class="list-inline-item breadcrumb-item active">
                                                                <?=$title?>
                                                            </li>
                                            </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="main-body">
    <div class="container">
        <div class="">
    <?php
        $this->load->view(DIR_THEMS.'/errors/main_site_404');
    ?>
 </div>
        </div>
    </div>
</section>
<?php
}

?>

