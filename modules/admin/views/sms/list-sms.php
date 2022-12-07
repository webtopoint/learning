<div class="col-md-12">

    <div class="card">
        <div class="card-header">
            <h3><i class="fa fa-list"></i> List SMS Message(s)</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#.</th>
                        <th>Active</th>
                        <th>Form Name</th>
                        <th>Fields</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?
                    foreach($this->SmsModel->listMessage() as $s){
                        static $x = 1;
                        $chk = $s['status'] ? 'checked' : '';
                        $form = $this->FormModel->getFormModel(array('id'=>$s['form_id'],'admin_id'=>CLIENT_ID));
                        if(!$form->num_rows()){
                            $this->db->where('id',$s['id'])->delete('message');
                            continue;
                        }
                        $form = $form->row();
                        echo '<tr data-id="'.$s['id'].'">
                                <td>'.$x++.'.</td>
                                <td><input type="checkbox" '.$chk.' class="activeOrNot" value="'.$s['id'].'"></td>
                                <td>'.$form->title.'</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>