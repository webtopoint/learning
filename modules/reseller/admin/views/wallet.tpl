<div class="row row-sm">
    <div class="col-md-12">
    <?=print_session_message()?>
    </div>
</div>

<div class="row row-sm">
    <div class="col-md-6">
        <div class="card" data-box="main">
            <div class="card-header">
                Main wallet
            </div>
            <div class="card-body">
            <small class="fa fa-rupee"></small>
                <h3>
                <?php
                $get = $this->AM->get_account(['id' => RID]);
                if($get->num_rows()){
                    echo $get->row()->wallet;
                }
                ?>
                
                </h3> 
            </div>
            <div class="card-footer">
                <button class="btn btn-primary load-wallet"> Load Wallet</button>
                <a href="<?=base_url()?>payment/all-transactions" class="btn btn-warning"> All Transactions</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
    </div>    
</div>

<div class="row row-sm mt-5">
    <div class="col-md-6">
        <div class="card" data-box="main">
            <div class="card-header bg-primary text-white">
                Main wallet Transactions
            </div>
            <div class="card-body">
            <?php
            $get = $this->WM->get_wallet_transaction();
            echo $get->num_rows();

            ?>
            </div>
        </div>
    </div>
</div>

<script>
    $('.load-wallet').click(function(){
        var that = this;
        var old_html = $(this).html();
        $(this).html(loader_btn_html).prop('disabled',true);
        var box = $(this).closest('.card').data('box');
        var surl = base_url + '/admin/wallet_payment_status';
        var furl = surl,
            udf2 = box == 'main' ? 'wallet' : 'domain_wallet';
        var message = ( box == 'main' ? 'Main ' : 'Domain ' ) + ' Wallet Load Money.';
        $.confirm({
            type : 'green',
            theme : 'bootstrap',
            icon : 'fa fa-money',
            title : 'Enter Amount',
            content : `<input autofocus class="form-control get-amount" placeholder="Enter Amount" type="number">`,
            buttons : {
                ok : {
                    text : 'GO',
                    btnClass : 'btn-primary',
                    keys : ['enter','y'],
                    action : function(){
                        var amount = this.$content.find('.get-amount').val();
                        if( !amount || amount <= 0 ){
                            $.alert('Provide a valid amount.');
                            this.$content.find('.get-amount').focus();
                        }
                        else{
                            this.$$ok.prop('disabled', true);
                            this.buttons.ok.setText('wait..');
                            $.ajax({
                                type : 'POST',
                                data : { udf2: udf2,box : box, amount : amount, surl:surl, furl:furl,message:message},
                                url : base_url+ '/payment/create_transaction',
                                dataType :'json',
                                success:function(res){
                                    if(res.form.status){
                                        console.log(res.form.html);
                                        var form = $(res.form.html);
                                            $('body').append(form); 
                                            form.submit();
                                    }
                                    else{
                                        $.confirm({
                                            title :'Notification!',
                                            icon :'fa fa-bell',
                                            content : res.form.html,
                                        })
                                    }
                                },
                                error:function(r,v,c){
                                    console.warn(r.responseText);
                                }
                            });
                        }

                        return false;

                    }
                },
                cancel:function(){
                    $(that).html(old_html).prop('disabled',false);
                }
            }
        });
        
    });
    
</script>