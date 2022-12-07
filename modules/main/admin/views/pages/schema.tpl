<?php
$page = $this->db->get('pages',['id' => $id]);
if($page->num_rows()){
    ?>
    <style>
        li.list-group-item{
            position:relative;
            color:black;
            font-weight:700;
        }
        li.list-group-item .type-box{
            position: absolute;
            top: -1px;
            left: 45%;
            background: #1e1e2d;
            padding: 3px 20px;
            border-radius: 0 0 30px 30px;
            color:white;
        }
        .pull-right{
            float:right;
        }
        .delete-schema{
            color:red;
        }
        .edit-schema:hover .edit-schema i{
            color:blue;
        }
    </style>
    <div class="content-wrapper">
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Page Schema Section</h3>
                </div>
                <div class="card-body">
                    <?php
                    $schema = $this->db->get_where('page_schema',['page_id' => $id,'section' => $type]);
                    if($schema->num_rows()){
                    ?>
                        <ul class="list-group  mein-group">
                            <?php
                            foreach($schema->result() as $item){
                                echo '<li class="list-group-item">
                                            <span>Title</span>
                                            <strong class="type-box">
                                                '.ucwords(str_replace('_',' ',$item->type)).'
                                            </strong>';
                                        if($item->type == 'content'){   
                                            echo '<div class="action pull-right">
                                                        <a href="'.site_url('admin/pages/content/'.$item->id.'/'.$type).'" class="edit-schema"><i class="fa fa-edit"></i></a>
                                                        <a href="javscript:;" class="delete-schema"><i class="fa fa-trash"></i></a>
                                                    </div>';
                                        }
                                 echo '      </li>';
                            }
                            ?>
                            
                        </ul>
                    
                    <?php
                    }
                    ?>
                </div>
              </div>
            </div>
          </div>
        </section>
    </div>
    <?php
}
?>
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
      <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
      

<script>
    $('.mein-group').sortable();
</script>