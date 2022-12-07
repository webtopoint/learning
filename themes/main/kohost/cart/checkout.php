                <div class="header-lined">
                    <h2 class="font-size-24">Review &amp; Checkout</h2>
                </div>

               

                <div class="row">
                    
                    
                    <?php 
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
                                                 <div class="item">
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
                                                            <a href="/cart.php?a=confdomains" data-toggle="tooltip" data-original-title="Edit" class="btn btn-link btn-xs edit-btn">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                            <button type="button" class="btn btn-link btn-xs btn-remove-from-cart" data-toggle="tooltip" data-original-title="Remove" onclick="removeItem('d','0')">
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

                        <?php
                        
                        ?>
                    </div>
                    
                    
                </div>