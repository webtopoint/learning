<?php
                   $plans = $this->db->get('plans');
if($plans->num_rows()):
?>

<section class="pricing-section">
    <div class="container">
        <div class="row"> <!-- align-items-center justify-content-between-->
           <?php
           foreach($plans->result() as $plan):
           ?>
            <div class="col-lg-4 col-md-4 col-12">
                <div class="card text-center single-pricing-pack">
                    <div class="pt-5">
                        <h5 class="mb-0"><?=$plan->title?></h5>
                    </div>
                    <div class="card-header py-4 border-0 pricing-header">
                        <div class="price text-center mb-0 yearly-price" style="display: block;"><?=$plan->price?><span>/yr</span></div>
                    </div>
                    <div class="card-body">
                        <?=$plan->description?>
                        <a href="#" class="btn btn-brand-01 mb-3" target="_blank">Purchase now</a>
                    </div>
                </div>
            </div>
            <?php
            endforeach;
            ?>
            
            <div class="col-12">
                <div class="support-cta mt-5">
                    <h5 class="mb-1 d-flex align-items-center justify-content-center"><span class="ti-loop color-primary mr-3 icon-sm"></span>Choose Your <a href="/" class="ml-2">Plans</a></h5>
                </div>
            </div>
        </div>
    </div>
</section>
        
        
    <?php
    endif;
    
    ?>