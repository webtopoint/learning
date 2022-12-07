<style type="text/css">
    .menu-css:hover{text-decoration:none} 
</style>
<form class="row tab-setting-form">
    <input type="hidden" name="tab_id" value="<?=$id?>">
    <div class="col-md-8">
         <div class="mb-2 mt-2 card">
    
        <div class="card-body" style="overflow-x:hidden">
    
            <ul class="tabs-animated-shadow nav-justified tabs-animated nav">
    
                <li class="nav-item">
    
                    <a role="tab" class="nav-link active show" id="tab-c1-0" data-toggle="tab" href="#tab-animated1-0" aria-selected="true">
    
                        <span class="nav-text"><i class="fa fa-cog"></i> Tab Style</span>
    
                    </a>
    
                </li>
                
                <li class="nav-item">
    
                    <a role="tab" class="nav-link" id="tab-c1-0" data-toggle="tab" href="#tab-animated1-1" aria-selected="true">
    
                        <span class="nav-text"><i class="fa fa-cog"></i> Border</span>
    
                    </a>
    
                </li>
                
                <li class="nav-item">
    
                    <a role="tab" class="nav-link" id="tab-c1-0" data-toggle="tab" href="#tab-animated1-2" aria-selected="true">
    
                        <span class="nav-text"><i class="fa fa-cog"></i> Other</span> <span class="badge badge-danger pull-right" style="margin-top: 8px;font-size: 0.4em;">New</span>
    
                    </a>
    
                </li>

                <li class="nav-item">
    
                    <a role="tab" class="nav-link" id="tab-c1-0" data-toggle="tab" href="#tab-animated1-3" aria-selected="true">
    
                        <span class="nav-text"><i class="fa fa-cog"></i> Header</span> 
    
                    </a>
    
                </li>
                                                                
    
            </ul>
    
            <div class="tab-content">
                
                <div class="tab-pane" id="tab-animated1-2" role="tabpanel">
                    
                    <div class="col-md-12" style="display:inline-block">
                        <div class="row">
                            <h4> Border Radius 
                                <span class="badge badge-danger pull-right" style="margin-top: 8px;font-size: 0.4em;">New</span>
                            </h4>
                        </div>
    
                        <div class="row">
                            
                            <div class="col-md-3 form-group">
    
                                <label>Top-Left </label>
                                
                                <div class="input-group">
    
                                    <div class="input-group-prepend">
                                        <span class="input-group-text curRadBTL"><?=$css['BradiusBTL']?>px</span>
                                    </div>
                                                                                        
                                    <input type="range" name="BradiusBTL" class="form-control" onchange="curRadBTL(this)" min=0 max=30 value="<?=$css['BradiusBTL']?>">
                                    <script>function curRadBTL(ip){$(".curRadBTL").html(ip.value+"px")}</script>
                                                                           
                                </div>
                            </div>
                                                                            
                            <div class="col-md-3 form-group">
    
                                <label>Top-Right</label>
                                
                                <div class="input-group">
                                    
                                    <div class="input-group-prepend">
                                        <span class="input-group-text curRadBTR"><?=$css['BradiusBTR']?>px</span>
                                    </div>
                                                                                        
                                    <input type="range" name="BradiusBTR" class="form-control" onchange="curRadBTR(this)" min=0 max=30 value="<?=$css['BradiusBTR']?>">
                                    <script>function curRadBTR(ip){$(".curRadBTR").html(ip.value+"px")}</script>
                                                                           
                                </div>
                            </div>
                                                                            
                            <div class="col-md-3 form-group">
    
                                <label>Bottom-Left</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text curRadBBL"><?=$css['BradiusBBL']?>px</span>
                                    </div>
                                                                                        
                                    <input type="range" name="BradiusBBL" class="form-control" onchange="curRadBBL(this)" min=0 max=30 value="<?=$css['BradiusBBL']?>">
                                    <script>function curRadBBL(ip){$(".curRadBBL").html(ip.value+"px")}</script>
                                                                           
                                </div>
                            </div>
                                                                            
                            <div class="col-md-3 form-group">
    
                                <label>Bottom-Right</label>
                                <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text curRadBBR"><?=$css['BradiusBBR']?>px</span>
                                        </div>
                                                                                        
                                        <input type="range" name="BradiusBBR" class="form-control" onchange="curRadBBR(this)" min=0 max=30 value="<?=$css['BradiusBBR']?>">
                                        <script>function curRadBBR(ip){$(".curRadBBR").html(ip.value+"px")}</script>
                                                                           
                                </div>
                            </div>
                        </div>
                                                                        
                        <div class="row">
                            <h4>Box Shadow <span class="badge badge-danger pull-right" style="margin-top: 8px;font-size: 0.4em;">New</span>
                            </h4>
                        </div>
                                                                        
                        <div class="row">
                            <div class="col-md-2 form-group">
                                <select class="form-control" name="box_shadow_type">
                                    <option value="" <?=($css['box-shadow']['box_shadow_type']=='' ? 'selected':'')?>>OutSet</option>
                                    <option value=inset <?=($css['box-shadow']['box_shadow_type']=='inset' ? 'selected':'')?>>InSet</option>
                                </select>
                            </div>
                            
                            <div class="col-md-2 form-group">
                                <input type=color name=boxShadowColor class="form-control" value="<?=$css['box-shadow']['boxShadowColor']?>">
                            </div>
                                                                            
                            <div class="col-md-2 form-group">
    
                                <input type="number" name="shad_first" class="form-control" min=-100 max=100  value="<?=$css['box-shadow']['shad_first']?>">
                                                                                      
                            </div>
                                                                            
                            <div class="col-md-2 form-group">
    
                                <input type="number" name="shad_first1" class="form-control" min=-100 max=100 value="<?=$css['box-shadow']['shad_first1']?>">
                                                                                     
                            </div>
                                                                            
                            <div class="col-md-2 form-group">
    
                                                                                   
                                <input type="number" name="shad_first2" class="form-control" min=-100 max=100 value="<?=$css['box-shadow']['shad_first2']?>">
                                                                                        
                            </div>
                                                                            
                            <div class="col-md-2 form-group">
    
                                                                                
                                <input type="number" name="shad_first3" class="form-control"  min=-100 max=100 value="<?=$css['box-shadow']['shad_first3']?>">
                                                                                        
                            </div>
                                                                            
                        </div>
                        <div class="row">
                            <h4>Tab Margin <span class="badge badge-danger pull-right" style="margin-top: 8px;font-size: 0.4em;">New</span></h4>
                                                                            
                        </div>
                                                                        
                        <div class="row">
                            
                            <div class="col-md-2 form-group">
                                <label>Left</label>
                                <input type="number" name="marginLeft" class="form-control" min=-20 max=20  value="<?=$css['marginLeft']?>">
                                                                                      
                            </div>
                                                                            
                            <div class="col-md-2 form-group">
                                <label>Right</label>
                                <input type="number" name="marginRight" class="form-control" min=-20 max=20 value="<?=$css['marginRight']?>">
                                                                                             
                            </div>
                                                                                    
                            <div class="col-md-2 form-group">
    
                                <label>Top</label>          
                                <input type="number" name="marginTop" class="form-control" min=-20 max=20 value="<?=$css['marginTop']?>">
                                                                                        
                            </div>
                                                                                    
                            <div class="col-md-2 form-group">
        
                                <label>Bottom</label>    
                                <input type="number" name="marginBottom" class="form-control"  min=-20 max=20 value="<?=$css['marginBottom']?>">
                                                                                        
                            </div>
                            
                        </div>
                                                                        
                                                                        
                    </div>
                </div>
                 
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
        
                                    <label>Color</label>
        
                                    <input type="color" onchange="" name="backgroundColor" class="form-control" value="<?=$css['backgroundColor']?>"/>
        
                                </div>
        
                                <div class="col-md-6 form-group">
        
                                    <label>Hover Color</label>
        
                                    <input type="color" name="backgroundHover" class="form-control" value="<?=$cssHover['backgroundHover']?>"/>
        
                                </div>
        
                            </div>
        
                        </div>
        
                        <div class="col-md-6" style="display:inline-block">
        
                            <div class="row">
        
                                <h4>Tab Text</h4>
        
                            </div>
        
                            <div class="row">
        
                                <div class="col-md-6 form-group">
        
                                    <label>Color</label>
        
                                    <input type="color" name="textColor" class="form-control" value="<?=$css['textColor']?>"/>
        
                                </div>
        
                                <div class="col-md-6 form-group">
        
                                    <label>Hover Color</label>
        
                                    <input type="color"  name="textHover" class="form-control" value="<?=$cssHover['textHover']?>"/>
        
                                </div>
        
                            </div>
        
                        </div>
                        <div class="col-md-12" style="display:inline-block">
        
                            <div class="row">
        
                                <h4>Tab Padding</h4>
        
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
                                                                        
                                                                         
                    <div class="col-md-12" style="display:inline-block">
        
                        <div class="row">
                            <h4>Typography</h4>
                        </div>
        
                        <div class="row">
        
                            <div class="col-md-4 form-group">
        
                                <label>Font Size</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="Fsize" placeholder="Font Size" value="<?=$css['Fsize']?>" required="">
                                    <div class="input-group-append">
                                        <span class="input-group-text">px</span>
                                    </div>
                                </div>
        
                            </div>
                            
                            <div class="col-md-4 form-group">
        
                                <label>Font Style</label>
                                <select id="font-style-select" class="form-control " data-cur="<?=$css['Fstyle']?>" name="Fstyle">
        
                                </select>
        
                            </div>
                            
                            <div class="col-md-4 form-group">
        
                                <label>Font Family</label>
                                <select id="font-family-select" class="form-control" data-cur="<?=$css['Ffamily']?>" name="Ffamily">
                                                                                       
                                </select>
                            </div>
                        </div>
                    </div>
        
                </div>

                <div class="tab-pane" id="tab-animated1-3" role="tabpanel">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Tab-Header Background</h3>
                                <input type="color" class="form-control" name="head[backgroundColor]" value="<?=$tabCss['backgroundColor']?>">
                            </div>
                        </div>



                            <div class="row">
        
                                <h4>Tab-Header Padding</h4>
        
                            </div>
        
                            <div class="row">
        
                                <div class="col-md-3 form-group">
        
                                    <label>Left</label>
        
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text curPedL_head">0px</span>
                                        </div>
                                        <input type="range" name="head[menuPadL]" class="form-control" onchange="curPeddL_head(this)" min=0 max=100 value="<?=$tabCss['menuPadL']?>">
                                        <script>function curPeddL_head(ip){$(".curPedL_head").html(ip.value+"px")}</script>
                                                                                   
                                    </div>
        
                                </div>
        
                                <div class="col-md-3 form-group">
        
                                    <label>Right</label>
        
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text curPedR_head"><?=$tabCss['menuPadR']?>px</span>
                                        </div>
                                        <input type="range" name="head[menuPadR]" class="form-control" onchange="curPeddR_head(this)" min=0 max=100 value="<?=$tabCss['menuPadR']?>">
                                        <script>function curPeddR_head(ip){$(".curPedR_head").html(ip.value+"px")}</script>
                                                                               
                                    </div>
        
                                </div>
        
                                <div class="col-md-3 form-group">
        
                                    <label>Top</label>
        
                                    <div class="input-group">
                                        
                                        <div class="input-group-prepend">
                                            <span class="input-group-text curPedT_head"><?=$tabCss['menuPadT']?>px</span>
                                        </div>
                                        
                                        <input type="range" name="head[menuPadT]" class="form-control" onchange="curPeddT_head(this)" min=0 max=100 value="<?=$tabCss['menuPadT']?>">
                                        <script>function curPeddT_head(ip){$(".curPedT_head").html(ip.value+"px")}</script>
                                                                               
                                    </div>
        
                                </div>
        
                                <div class="col-md-3 form-group">
        
                                    <label>Bottom</label>
        
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text curPedB_head"><?=$tabCss['menuPadB']?>px</span>
                                        </div>
                                        <input type="range" name="head[menuPadB]" class="form-control" onchange="curPeddB_head(this)" min=0 max=100 value="<?=$tabCss['menuPadB']?>">
                                        <script>function curPeddB_head(ip){$(".curPedB_head").html(ip.value+"px")}</script>
                                                                               
                                    </div>
        
                                </div>
                                                                                    
        
                            </div>

                            <div class="row">
        
                                <h4> Head Bottom Line </h4>
        
                            </div>

                            <div class="row">
        
                                <div class="col-md-6 form-group">
                                    <label>background</label>
                                    <input type="color" name="head[background]" value="<?=$tabCss['background']?>" class="form-control">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Line Height</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text lineHeight"><?=$tabCss['height']?>px</span>
                                        </div>
                                        <input type="range" name="head[height]" class="form-control" onchange="lineHeight(this)" min="0" max="100" value="<?=$tabCss['height']?>">
                                        <script>function lineHeight(ip){$(".lineHeight").html(ip.value+"px")}</script>
                                                                               
                                    </div>
                                </div>
        
                            </div>



                    </div>
                </div>

            </div>
    
                                                                
                                                               
    
    </div>
    
    </div>
    
              
    </div>
    
    <div class="col-md-4" style="height:320px">
    
                                                <div class="card">
    
                                                    <div class="card-header">
    
                                                       Tab Preview
    
                                                    </div>
    
                                                    <div class="card-body md" style="overflow-x:hidden;background: rgba(0,0,0,0.8);">
    
                                                       <ul class="menu-ul-css">
    
                                                            <li style="list-style:none">
    
                                                                <a class="menu-css" href="#">Tab 1</a>
                                                            </li>
    
                                                       </ul>
    
                                                    </div>
                                                    
                                                    <div class="card-footer">
                                                            <!--<button class="btn btn-info" onclick="resetToDefault()">Reset to Default</button>-->
                                                            <button class="btn btn-success" type="submit"> <i class="pe-7s-plus"></i> Save</button>
                                                    </div>
    
                                                </div>
    
                                  </div>
    
    
</form>
<div class="cssBox"></div>

<script>
    setMENUcss();
    font_select();
    $(document).on("change",".tab-content select,.tab-content input",function(event) { 
        setMENUcss();   
    });
    function setMENUcss(){
        let css = {
            backColor               :           $("input[name=backgroundColor]").val(),
            textColor               :           $("input[name=textColor]").val(),
            backHover               :           $("input[name=backgroundHover]").val(),
            textHover               :           $("input[name=textHover]").val(),
            menuPadL                :           $("input[name=menuPadL]").val(),
            menuPadR                :           $("input[name=menuPadR]").val(),
            menuPadT                :           $("input[name=menuPadT]").val(),
            menuPadB                :           $("input[name=menuPadB]").val(),
            BTcolor                 :           $("input[name=BTcolor]").val(),
            BTstyle                 :           $("select[name=BTstyle]").val(),
            BTsize                  :           $("input[name=BTsize]").val(),
            BBcolor                 :           $("input[name=BBcolor]").val(),
            BBstyle                 :           $("select[name=BBstyle]").val(),
            BBsize                  :           $("input[name=BBsize]").val(),
            BRcolor                 :           $("input[name=BRcolor]").val(),
            BRstyle                 :           $("select[name=BRstyle]").val(),
            BRsize                  :           $("input[name=BRsize]").val(),
            BLcolor                 :           $("input[name=BLcolor]").val(),
            BLstyle                 :           $("select[name=BLstyle]").val(),
            BLsize                  :           $("input[name=BLsize]").val(),
            box_shadow_type         :           $("select[name=box_shadow_type]").val(),
            boxShadowColor          :           $("input[name=boxShadowColor]").val(),
            shad_first              :           $("input[name=shad_first]").val(),
            shad_first1             :           $("input[name=shad_first1]").val(),
            shad_first2             :           $("input[name=shad_first2]").val(),
            shad_first3             :           $("input[name=shad_first3]").val(),
            BradiusBTL              :           $("input[name=BradiusBTL]").val(),
            BradiusBTR              :           $("input[name=BradiusBTR]").val(),
            BradiusBBL              :           $("input[name=BradiusBBL]").val(),
            BradiusBBR              :           $("input[name=BradiusBBR]").val(),
            Fstyle                  :           $("select[name=Fstyle]").val(),
            Ffamily                 :           $("select[name=Ffamily]").val(),
            Fsize                   :           $("input[name=Fsize]").val(),
            marginBottom            :           $("input[name=marginBottom]").val(),
            marginTop               :           $("input[name=marginTop]").val(), 
            marginRight             :           $("input[name=marginRight]").val(),
            marginLeft              :           $("input[name=marginLeft]").val(),
            backHead                :           $('input[name="head[backgroundColor]"]').val(),
            tabHeadPadL             :           $('input[name="head[menuPadL]"]').val(),
            tabHeadPadR             :           $('input[name="head[menuPadR]"]').val(),
            tabHeadPadT             :           $('input[name="head[menuPadT]"]').val(),
            tabHeadPadB             :           $('input[name="head[menuPadB]"]').val(),
            background              :           $('input[name="head[background]"]').val(),
            height                  :           $('input[name="head[height]"]').val(),

        };
        
        console.log(css);

        let shadow = css.box_shadow_type + " " + css.shad_first + "px "+ css.shad_first1 + "px "+css.shad_first2+"px "+css.shad_first3+"px "+css.boxShadowColor;   
             
        var t       =  ( css.Fstyle     ==  "bold" ) ?  "font-weight:bold" : "font-style:"+css.Fstyle;  
        
        $(".cssBox").html("<style>.menu-css{margin-left:"+css.marginLeft+"px; margin-right:"+css.marginRight+"px;margin-top:"+css.marginTop+"px;margin-bottom:"+css.marginBottom+"px;box-shadow:"+shadow+"!important;background-color:"+css.backColor+"!important; color:"+css.textColor+"!important; padding-left:"+css.menuPadL+"px!important;padding-right:"+css.menuPadR+"px!important;padding-top:"+css.menuPadT+"px!important;padding-bottom:"+css.menuPadB+"px!important;border-top:"+css.BTsize+"px "+css.BTstyle+" "+css.BTcolor+"; border-bottom:"+css.BBsize+"px "+css.BBstyle+" "+css.BBcolor+"; border-left:"+css.BLsize+"px "+css.BLstyle+" "+css.BLcolor+"; border-right:"+css.BRsize+"px "+css.BRstyle+" "+css.BRcolor+"; border-radius:"+css.BradiusBTL+"px "+css.BradiusBTR+"px "+css.BradiusBBR+"px "+css.BradiusBBL+"px; font-size:"+css.Fsize+"px!important; font-family:"+css.Ffamily+"!important; "+t+"!important;} .menu-css:hover{background-color:"+css.backHover+"!important; color:"+css.textHover+"!important;}   </style>").append(`
                <style>
                    .menu-ul-css{
                        background : `+css.backHead+`; 
                        padding-left: `+css.tabHeadPadL+`px;
                        padding-right: `+css.tabHeadPadR+`px;
                        padding-top : `+css.tabHeadPadT+`px;
                        padding-bottom:`+css.tabHeadPadB+`px;
                        border-bottom : `+css.height+`px solid `+css.background+`
                    }
                </style>
            `);
    }

    $(document).on('submit','.tab-setting-form',function(){
        $('#load').show();
          event.preventDefault();
        $.ajax({
            url:"<?=base_url?>/Admin/AJAX",
            data:$(this).serialize()+'&var=save_tab_css',
            type:"post",
            dataType:"json",
            beforeSend : function()
            {
                $(".tab-setting-form input,.tab-setting-form select,.tab-setting-form button").attr("disabled","disabled");
            },
            success : function(q)
            {
                toastr.success("Tab Style Upload Successfully");
                $('#load').hide();
                $(".jconfirm-closeIcon").click();
            },
            error : function(u,v,r){
                alert(r);
            }

        });
                      
    })
</script>