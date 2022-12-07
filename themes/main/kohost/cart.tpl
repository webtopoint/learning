<section class="page-header-section" >
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7 col-lg-6">
                <div class="page-header-content text-white">
                    <h1 class="text-white mb-2">
                                                Shopping Cart
                                                </h1>
                                    </div>
                <div class="custom-breadcrumb">
                    <ol class="d-inline-block bg-transparent list-inline py-0 pl-0">
                                                    <li class="list-inline-item breadcrumb-item active">
                                                                Shopping Cart
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
                    
            <!-- Container for main page display content -->
            <div class="col-xs-12 main-content">
    


    <div id="order-standard_cart">

        <div class="row">
            <div class="cart-sidebar">

                    <!-- hide Currency change option from sidebar -->
                <div menuitemname="Categories" class="panel card card-sidebar mb-3 panel-sidebar">
                    <div class="panel-heading card-header">
                        <h3 class="panel-title">
                              <i class="fas fa-shopping-cart"></i>&nbsp;
                                
                                    Categories
            
                            
                            <i class="fas fa-chevron-up card-minimise panel-minimise pull-right float-right"></i>
                        </h3>
                    </div>
        
                    
                    <div class="list-group collapsable-card-body">
                                              
                      <a menuitemname="weebly" href="<?=site_url('cart/?a=plan')?>" class="list-group-item list-group-item-action" id="Secondary_Sidebar-Categories-weebly">
                    
                             Plan(s)
    
                      </a>
                    </div>
                    
                </div>
        
                    <!-- hide Currency change option from sidebar -->
                <div menuitemname="Actions" class="panel card card-sidebar mb-3 panel-sidebar">
                    
                    <div class="panel-heading card-header">
                        <h3 class="panel-title">
                                                    <i class="fas fa-plus"></i>&nbsp;
                                
                            Actions
            
                            
                            <i class="fas fa-chevron-up card-minimise panel-minimise pull-right float-right"></i>
                        </h3>
                    </div>
        
                    
                    <div class="list-group collapsable-card-body">
                        <a menuitemname="Domain Registration" href="<?=site_url('cart?a=add&amp;domain=register')?>" class="list-group-item list-group-item-action" id="Secondary_Sidebar-Actions-Domain_Registration">
                                            <i class="fas fa-globe fa-fw"></i>&nbsp;
                                
                                Register a New Domain
        
                        </a>
                        <!-- a menuitemname="Domain Transfer" href="/cart.php?a=add&amp;domain=transfer" class="list-group-item list-group-item-action" id="Secondary_Sidebar-Actions-Domain_Transfer">
                            <i class="fas fa-share fa-fw"></i>&nbsp;
                            Transfer in a Domain
                        </a -->
                        <a menuitemname="View Cart" href="<?=site_url('cart?a=view')?>" class="list-group-item list-group-item-action active" id="Secondary_Sidebar-Actions-View_Cart">
                            <i class="fas fa-shopping-cart fa-fw"></i>&nbsp;
                                        
                                    View Cart
        
                        </a>
                    </div>
                    
                </div>
        
                <!-- hide Currency change option from sidebar -->
    
            </div>
            <div class="cart-body">
                
                <div class="header-lined">
                    <h2 class="font-size-24"><?=set_cart_heading()?></h2>
                </div>

                <div class="sidebar-collapsed">
            <div class="panel card panel-default">
                <div class="m-0 panel-heading card-header">
                    <h3 class="panel-title">
                            <i class="fas fa-shopping-cart"></i>&nbsp;
            
                            Categories

                    </h3>
                </div>

                <div class="panel-body card-body">
                    <form role="form">
                        <select class="form-control custom-select" onchange="selectChangeNavigate(this)">
                                                            
                                                                    <option menuitemname="weebly" value="<?=site_url('cart/?a=plan')?>" class="list-group-item">
                                    Plan(s)
            
                                                        </option>
                                                                                    <option value="" class="list-group-item" selected="">- Choose Another Category -</option>
                                        </select>
                    </form>
                </div>

            </div>
            <div class="panel card panel-default">
                <div class="m-0 panel-heading card-header">
                    <h3 class="panel-title">
                                        <i class="fas fa-plus"></i>&nbsp;
                        
                        Actions

                    </h3>
                </div>

                <div class="panel-body card-body">
                    <form role="form">
                        <select class="form-control custom-select" onchange="selectChangeNavigate(this)">
                                                                <option menuitemname="Domain Registration" value="/cart.php?a=add&amp;domain=register" class="list-group-item">
                                    Register a New Domain
            
                                                        </option>
                                                                    <option menuitemname="Domain Transfer" value="/cart.php?a=add&amp;domain=transfer" class="list-group-item">
                                    Transfer in a Domain
            
                                                        </option>
                                                                    <option menuitemname="View Cart" value="/cart.php?a=view" class="list-group-item" selected="selected">
                                    View Cart
            
                                                        </option>
                                                                                                                        </select>
                    </form>
                </div>

            </div>
            <div class="panel card panel-default">
                <div class="m-0 panel-heading card-header">
                    <h3 class="panel-title">
                            <i class="fas fa-plus"></i>&nbsp;
            
                        Choose Currency

                    </h3>
                </div>

                <div class="panel-body card-body">
        <form role="form">
            <select class="form-control custom-select" onchange="selectChangeNavigate(this)">
                <option value="" class="list-group-item" selected="">- Choose Another Category -</option>
            </select>
        </form>
    </div>

            </div>
    </div>

                <div class="row">
                    
                    
                     <?php
                    $type = (isset($_GET['a'])) ? $_GET['a'] : 'view';
                    $type = isset($page) ? $page : $type;
        
                    
                    if($type == 'add' AND isset($_GET['domain'])){
                        $type = 'register_domain';
                    }
                    
                    switch($type)
                    {
                        case 'checkout':
                            $this->load->view(DIR_THEMS.'/'.$type);
                        break;
                        case 'view':
                            if($this->cart->total_items()){
                                    ?>
                                    <div class="col-md-8">
        
                                
                                        <form method="post" action="/cart.php?a=view">
        
                
                                            <div class="view-cart-items-header">
                                                <div class="row">
                                                    <div class="col-sm-7 col-xs-7 col-7">
                                                        Product/Options
                                                    </div>
                                                    <div class="col-sm-4 col-xs-5 col-5 text-right">
                                                        Price/Cycle
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="view-cart-items">
                
                                                    <?php
                                                    //pre($this->cart->contents());
                                                    foreach($this->cart->contents() as $rowId => $item){
                                                        ?>
                                                         <div class="item" data-id="<?=$rowId?>">
                                                            <div class="row">
                                                                <div class="col-sm-7 col-xs-6">
                                                        <span class="item-title"><?php 
                                                            echo ($item['type'] == 'plan') ? 'Website Plan' : 'Domain Registration'; ?></span>
                                                                <span class="item-domain"> <?=$item['name']?> </span>
                                                                <ul class="addon-item-icon mb-0">
                                                                                                                                                                                                                                            </ul>
                                                            </div>
                                                            <div class="col-sm-3 col-xs-3 item-price">
                                                                                                                            
                                                                <span name="nsproduction1.comPrice"><?=$item['price']?></span>
                                                                <div class="dropdown renewal-item">
                                                                    <button class="btn btn-default btn-xs dropdown-toggle" type="button" id="nsproduction1.comPricing" name="nsproduction1.comPricing" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                        1 Year
                                                                        <span class="caret"></span>
                                                                    </button>
                                                                    <ul class="dropdown-menu" aria-labelledby="nsproduction1.comPricing">
                                                                                                                                            <li>
                                                                                <a href="#" onclick="selectDomainPeriodInCart('nsproduction1.com', '<?=$item['price']?>, 1, 'Year');return false;">
                                                                                    1 Year @ <?=$item['price']?>
                                                                                </a>
                                                                            </li>
                                                                    </ul>
                                                                </div>
                                                                <span class="renewal cycle">
                                                                    Renewal <span class="renewal-price cycle"><?=$item['price']?>/1yr</span>
                                                                </span>
                                                            </div>
                                                            <div class="col-sm-2 col-xs-2 actions-prod">
                                                                <div class="cart-actions-item">
                                                                    
                                                                    <button type="button" class="btn btn-link btn-xs btn-remove-from-cart" data-toggle="tooltip" data-original-title="Remove" >
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                    
                                               
                                                
                                                
                                                
                                            </div>
                                        
                                
                                
                                        <div class="empty-cart">
                                            <button type="button" class="btn btn-xs" id="btnEmptyCart">
                                                <i class="fas fa-trash"></i>
                                                <span>Empty Cart</span>
                                            </button>
                                        </div>
                                        
        
                                    </form>
                                                        
                                    <div class="view-cart-tabs">
                                        <h5>Apply Promo Code</h5>
                                        <div role="tabpanel" class="tab-pane active promo" id="applyPromo">
                                        <form method="post" action="/cart.php?a=view">
                                            <input type="hidden" name="token" value="4f5e36465a55c344d148beef8a5ef8221a4f9e96">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group prepend-icon ">
                                                        <input type="text" name="promocode" id="inputPromotionCode" class="field form-control" placeholder="Enter promo code if you have one" required="required">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="submit" name="validatepromo" class="btn outline-btn btn-block" value="Validate Code">
                                                        Validate Code
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                            <?php
                            }else{
                            ?>
                            <div class="col-md-8">
        
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        
                                       
                                        <div class="message message-no-data">
                                            <div class="message-image">
                                                <span class="fas fa-exclamation-triangle fa-3x"></span>
                                            </div>
                                            <p class="message-text text-center">Your Shopping Cart is Empty</p>
                                                        <div class="message-action mt-20">
                                                <a class="btn primary-solid-btn" href="cart.php">
                                                                        Start Shopping
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <?php
                            }
                            ?>
                            <div class="col-md-4" id="scrollingPanelContainer">
        
                                <div class="order-summary" id="orderSummary" style="margin-top: 0px;">
                                    <div class="loader" id="orderSummaryLoader" style="display: none;">
                                        <i class="fas fa-fw fa-sync fa-spin"></i>
                                    </div>
                                    <h2>Order Summary</h2>
                                    <div class="summary-container">
        
                                        <ul class="order-summary-list">
                                            <li class="summary-list-item">
                                                <span class="pull-left">Subtotal</span>
                                                <span id="subtotal" class="pull-right"><?=$this->cart->total()?> <i class="fa fa-rupee"></i></span>
                                            </li>
                                        </ul>
                                        
                                        <ul id="recurring" class="order-summary-list">
                                            <li class="summary-list-item faded">
                                                <span class="pull-left">Totals</span>
                                            </li>
                                            <span class="summary-list-item" id="recurringMonthly" style="display:none;">
                                                <small class="pull-left">Monthly</small>
                                                <span class="cost pull-right"></span>
                                            </span>
                                            <span class="summary-list-item" id="recurringQuarterly" style="display:none;">
                                                <small>Quarterly</small>
                                                <span class="cost pull-right"></span>
                                            </span>
                                            <span class="summary-list-item" id="recurringSemiAnnually" style="display:none;">
                                                <small class="pull-left">Semi-Annually</small>
                                                <span class="cost pull-right"></span>
                                            </span>
                                            <span class="summary-list-item" id="recurringAnnually" style="display:none;">
                                                <small class="pull-left">Annually</small>
                                                <span class="cost pull-right"></span>
                                            </span>
                                            <span class="summary-list-item" id="recurringBiennially" style="display:none;">
                                                <small class="pull-left">Biennially</small>
                                                <span class="cost pull-right"></span>
                                            </span>
                                            <span class="summary-list-item" id="recurringTriennially" style="display:none;">
                                                <small class="pull-left">Triennially</small>
                                                <span class="cost pull-right"></span>
                                            </span>
                                        </ul>
        
        
                                        <div class="total-due-today total-due-today-padded">
                                            <div class="content">
                                                <span id="totalDueToday" class="amt"><?=$this->cart->total()?> <i class="fa fa-rupee"></i></span>
                                                <span class="total-due-today-text">Total Due Today</span>
                                            </div>
                                        </div>
        
                                        <div class="express-checkout-buttons">
                                                                            </div>
        
                                        <div class="order-summary-actions">
                                            <a href="<?=base_url('checkout')?>" class="btn btn-block btn-checkout <?=($this->cart->total_items()) ? '' : 'disabled'?>" id="checkout">
                                                Checkout
                                                <i class="fas fa-arrow-right"></i>
                                            </a>
                                        </div>
                                        <a href="/cart.php" class="btn btn-link btn-continue-shopping btn-xs" id="continueShopping">
                                            <i class="fas fa-reply"></i> Continue Shopping
                                        </a>
                                    </div>
                                </div>
                            </div>
                        
                        <?php
                        break;
                        
                        default:
                            $this->load->view(DIR_THEMS.'/cart/'.$type);
                            
                        break;
                    }
                    ?>
                </div>
            </div>
        </div>

        <form method="post" action="/cart.php">
            <input type="hidden" name="token" value="9230d275c5c1778139009392724bb773aff03567">
            <input type="hidden" name="a" value="remove">
            <input type="hidden" name="r" value="" id="inputRemoveItemType">
            <input type="hidden" name="i" value="" id="inputRemoveItemRef">
            <div class="modal fade modal-remove-item" id="modalRemoveItem" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">
                                <i class="fas fa-times fa-3x"></i>
                                <span>Remove Item</span>
                            </h4>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to remove this item from your cart?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn outline-btn" data-dismiss="modal">No</button>
                            <button type="submit" class="btn primary-solid-btn">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form method="post" action="/cart.php">
            <input type="hidden" name="token" value="9230d275c5c1778139009392724bb773aff03567">
            <input type="hidden" name="a" value="empty">
            <div class="modal fade modal-remove-item" id="modalEmptyCart" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">
                                <i class="fas fa-trash-alt fa-3x"></i>
                                <span>Empty Cart</span>
                            </h4>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to empty your shopping cart?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn outline-btn" data-dismiss="modal">No</button>
                            <button type="submit" class="btn primary-solid-btn">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

<script>
    $(document).on('click','.btn-remove-from-cart',function(){
        var id = $(this).closest('.item').data('id');
        $.confirm({
            type :'red',
            title :'Confirmation',
            icon : 'fa fa-bell',
            content : 'Are you sure for remove it .',
            buttons :{
                ok :{
                    text : '<i class="fa fa-trash"></i> Remove',
                    btnClass : 'btn-danger',
                    action :function(){
                        location.href = '<?=base_url('domain/remove/')?>'+id;
                    }
                },
                cancel:function(){}
            }
        });
    })
</script>
</div><!-- /.main-content -->
    
<div class="clearfix"></div>
</div>
</div>
</section>


