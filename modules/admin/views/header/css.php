<div class="card-header bg-danger text-white" style="margin-top:1px;height:auto">
    <strong><i class="fa fa-cog"></i> CSS STYLE</strong>
</div>

<div class="card-body" style="margin:0">
        
    <ul class="tabs-animated-shadow nav-justified tabs-animated nav">

        <li class="nav-item">

            <a role="tab" class="nav-link active show" id="tab-c1-0" data-toggle="tab" href="#tab-animated1-0" aria-selected="true">

                <span class="nav-text"><i class="fa fa-cog"></i> Style</span>

            </a>

        </li>
        
        <li class="nav-item">

            <a role="tab" class="nav-link" id="tab-c1-0" data-toggle="tab" href="#tab-animated1-1" aria-selected="true">

                <span class="nav-text"><i class="fa fa-cog"></i> Border</span>

            </a>

        </li>
        
        <!--<li class="nav-item">-->

        <!--    <a role="tab" class="nav-link" id="tab-c1-0" data-toggle="tab" href="#tab-animated1-2" aria-selected="true">-->

        <!--        <span class="nav-text"><i class="fa fa-cog"></i> Other</span> <span class="badge badge-danger pull-right" style="margin-top: 8px;font-size: 0.4em;">New</span>-->

        <!--    </a>-->

        <!--</li>-->
                                                        

    </ul>

    <div class="tab-content">
                  
        <div class="tab-pane" id="tab-animated1-1" role="tabpanel">
            <div class="col-md-12" style="display:inline-block">


                <div class="row">

                    <div class="col-md-4 form-group">

                        <label>Border-Top Color</label>

                        <input type="color" name="BTcolor" class="form-control" value="<?=$css['BTcolor']?>"/>

                    </div>

                    <div class="col-md-4 form-group">

                        <label>Border-Top Style</label>

                        <select class="form-control" name="BTstyle" >

                            <option value="none" <?=($css['BTstyle']=='none'?"selected":"")?>>None</option>

                            <option value="solid"<?=($css['BTstyle']=='solid'?"selected":"")?>>Solid</option>

                            <option value="double"<?=($css['BTstyle']=='double'?"selected":"")?>>Double</option>

                            <option value="dashed"<?=($css['BTstyle']=='dashed'?"selected":"")?>>Dashed</option>

                            <option value="dotted"<?=($css['BTstyle']=='dotted'?"selected":"")?>>Dotted</option>

                            <option value="groove"<?=($css['BTstyle']=='groove'?"selected":"")?>>Groove</option>

                            <option value="ridge"<?=($css['BTstyle']=='ridge'?"selected":"")?>>Ridge</option>

                            <option value="inset" <?=($css['BTstyle']=='inset'?"selected":"")?>>Inset</option>
                                                                            
                            <option value="outset"<?=($css['BTstyle']=='outset'?"selected":"")?>>Outset</option>
                                                                            
                        </select>

                    </div>
                    
                    <div class="col-md-4 form-group">

                        <label>Border-Top Size</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text curSizeB"><?=$css['BTsize']?>px</span>
                            </div>
                            <input type="range" name="BTsize" class="form-control" onchange="curSizeB(this)" min=0 max=10 value="<?=$css['BTsize']?>">
                            <script>function curSizeB(ip){$(".curSizeB").html(ip.value+"px")}</script>
                                                                       
                        </div>

                    </div>
                                                                        
                </div>
                                                                    
                                                                    
                                                                    
                <div class="row">

                    <div class="col-md-4 form-group">

                        <label>Border-Bottom Color</label>

                        <input type="color" name="BBcolor" class="form-control" value="<?=$css['BBcolor']?>"/>

                    </div>

                    <div class="col-md-4 form-group">

                        <label>Border-Bottom Style</label>

                         <select class="form-control" name="BBstyle" >

                            <option value="none" <?=($css['BBstyle']=='none'?"selected":"")?>>None</option>

                            <option value="solid"<?=($css['BBstyle']=='solid'?"selected":"")?>>Solid</option>

                            <option value="double"<?=($css['BBstyle']=='double'?"selected":"")?>>Double</option>

                            <option value="dashed"<?=($css['BBstyle']=='dashed'?"selected":"")?>>Dashed</option>

                            <option value="dotted"<?=($css['BBstyle']=='dotted'?"selected":"")?>>Dotted</option>

                            <option value="groove"<?=($css['BBstyle']=='groove'?"selected":"")?>>Groove</option>

                            <option value="ridge"<?=($css['BBstyle']=='ridge'?"selected":"")?>>Ridge</option>

                            <option value="inset" <?=($css['BBstyle']=='inset'?"selected":"")?>>Inset</option>
                                                                            
                            <option value="outset"<?=($css['BBstyle']=='outset'?"selected":"")?>>Outset</option>
                                                                            
                        </select>

                    </div>
                    
                    <div class="col-md-4 form-group">

                        <label>Border-Bottom Size</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text curSizeBB"><?=$css['BBsize']?>px</span>
                            </div>
                            
                            <input type="range" name="BBsize" class="form-control" onchange="curSizeBB(this)" min=0 max=10 value="<?=$css['BBsize']?>">
                                
                            <script>function curSizeBB(ip){$(".curSizeBB").html(ip.value+"px")}</script>
                                                                       
                        
                        </div>

                    
                    </div>
                                                                        
                
                </div>
                                                                    
                
                <div class="row">

                    <div class="col-md-4 form-group">

                        <label>Border-Left Color</label>

                        <input type="color" name="BLcolor" class="form-control" value="<?=$css['BLcolor']?>"/>

                    </div>

                    <div class="col-md-4 form-group">

                        <label>Border-Left Style</label>

                        <select class="form-control" name="BLstyle" >

                            <option value="none" <?=($css['BLstyle']=='none'?"selected":"")?>>None</option>

                            <option value="solid"<?=($css['BLstyle']=='solid'?"selected":"")?>>Solid</option>

                            <option value="double"<?=($css['BLstyle']=='double'?"selected":"")?>>Double</option>

                            <option value="dashed"<?=($css['BLstyle']=='dashed'?"selected":"")?>>Dashed</option>

                            <option value="dotted"<?=($css['BLstyle']=='dotted'?"selected":"")?>>Dotted</option>

                            <option value="groove"<?=($css['BLstyle']=='groove'?"selected":"")?>>Groove</option>

                            <option value="ridge"<?=($css['BLstyle']=='ridge'?"selected":"")?>>Ridge</option>

                            <option value="inset" <?=($css['BLstyle']=='inset'?"selected":"")?>>Inset</option>
                                                                            
                            <option value="outset"<?=($css['BLstyle']=='outset'?"selected":"")?>>Outset</option>
                                                                            
                        </select>

                    </div>
                <div class="col-md-4 form-group">

                    <label>Border-Left Size</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text curSizeBL"><?=$css['BLsize']?>px</span>
                        </div>
                        
                        <input type="range" name="BLsize" class="form-control" onchange="curSizeBL(this)" min=0 max=10 value="<?=$css['BLsize']?>">
                        <script>function curSizeBL(ip){$(".curSizeBL").html(ip.value+"px")}</script>
                                                                       
                    </div>

                </div>
                                                                        
            </div>
                                                                    
            <div class="row">

                <div class="col-md-4 form-group">

                    <label>Border-Right Color</label>

                    <input type="color" name="BRcolor" class="form-control" value="<?=$css['BRcolor']?>"/>

                </div>

                <div class="col-md-4 form-group">

                    <label>Border-Right Style</label>

                    <select class="form-control" name="BRstyle" >

                        <option value="none" <?=($css['BRstyle']=='none'?"selected":"")?>>None</option>

                        <option value="solid"<?=($css['BRstyle']=='solid'?"selected":"")?>>Solid</option>

                        <option value="double"<?=($css['BRstyle']=='double'?"selected":"")?>>Double</option>

                        <option value="dashed"<?=($css['BRstyle']=='dashed'?"selected":"")?>>Dashed</option>

                        <option value="dotted"<?=($css['BRstyle']=='dotted'?"selected":"")?>>Dotted</option>

                        <option value="groove"<?=($css['BRstyle']=='groove'?"selected":"")?>>Groove</option>

                        <option value="ridge"<?=($css['BRstyle']=='ridge'?"selected":"")?>>Ridge</option>

                        <option value="inset" <?=($css['BRstyle']=='inset'?"selected":"")?>>Inset</option>
                                                                            
                        <option value="outset"<?=($css['BRstyle']=='outset'?"selected":"")?>>Outset</option>
                                                                            
                    </select>

                </div>
            
                <div class="col-md-4 form-group">

                    <label>Border-Right Size</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text curSizeBR"><?=$css['BRsize']?>px</span>
                        </div>
                        
                        <input type="range" name="BRsize" class="form-control" onchange="curSizeBR(this)" min=0 max=10 value="<?=$css['BRsize']?>">
                        <script>function curSizeBR(ip){$(".curSizeBR").html(ip.value+"px")}</script>
                                                                       
                    </div>

                </div>
                                                                        
            </div>
            </div>
        </div>
    

        <div class="tab-pane active show" id="tab-animated1-0" role="tabpanel">

            <div class="row">

                <div class="col-md-6" style="display:inline-block">

                    <div class="row">   

                        <h4>Background</h4>

                    </div>

                    <div class="row">
                        
                         <div class="col-md-6 form-group">
        <?
        $colType = isset( $css['backgroundType'] ) ? $css['backgroundType'] : 'color';
        ?>
                            <label>Type</label>
                            <select class="form-control" name="backgroundType" >
                                <option value="color">Color</option>
                                <option value="transparent" <?=$colType == 'transparent' ? 'selected' : ''?>>Transparent</option>
                            </select>
                            <!--<input type="color" onchange="" name="backgroundColor" class="form-control" value="<?=$css['backgroundColor']?>"/>-->

                        </div>
                        
                        <div class="col-md-6 form-group">

                            <label>Color</label>

                            <input type="color" onchange="" name="backgroundColor" class="form-control" value="<?=$css['backgroundColor']?>"/>

                        </div>

                    </div>

                </div>

               
                <div class="col-md-12" style="display:inline-block">

                    <div class="row">

                        <h4> Padding</h4>

                    </div>

                    <div class="row">

                        <div class="col-md-3 form-group">

                            <label>Left</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text curPedL"><?=$css['menuPadL']?>px</span>
                                </div>
                                <input type="range" name="menuPadL" class="form-control" onchange="curPeddL(this)" min=0 max=100 value="<?=$css['menuPadL']?>">
                                <script>function curPeddL(ip){$(".curPedL").html(ip.value+"px")}</script>
                                                                           
                            </div>

                        </div>

                        <div class="col-md-3 form-group">

                            <label>Right</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text curPedR"><?=$css['menuPadR']?>px</span>
                                </div>
                                <input type="range" name="menuPadR" class="form-control" onchange="curPeddR(this)" min=0 max=100 value="<?=$css['menuPadR']?>">
                                <script>function curPeddR(ip){$(".curPedR").html(ip.value+"px")}</script>
                                                                       
                            </div>

                        </div>

                        <div class="col-md-3 form-group">

                            <label>Top</label>

                            <div class="input-group">
                                
                                <div class="input-group-prepend">
                                    <span class="input-group-text curPedT"><?=$css['menuPadT']?>px</span>
                                </div>
                                
                                <input type="range" name="menuPadT" class="form-control" onchange="curPeddT(this)" min=0 max=100 value="<?=$css['menuPadT']?>">
                                <script>function curPeddT(ip){$(".curPedT").html(ip.value+"px")}</script>
                                                                       
                            </div>

                        </div>

                        <div class="col-md-3 form-group">

                            <label>Bottom</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text curPedB"><?=$css['menuPadB']?>px</span>
                                </div>
                                <input type="range" name="menuPadB" class="form-control" onchange="curPeddB(this)" min=0 max=100 value="<?=$css['menuPadB']?>">
                                <script>function curPeddB(ip){$(".curPedB").html(ip.value+"px")}</script>
                                                                       
                            </div>

                        </div>
                                                                            

                    </div>

                </div>

            </div>
              

        </div>


    </div>
</div>
