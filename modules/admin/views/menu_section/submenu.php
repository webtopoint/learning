
 <div class="mb-3 card">
    <!-- <div class="alert alert-danger"><h3>Now, This Section is not working, so please don't use it.</h3></div> -->
    <div class="card-body" style="overflow-x:hidden">

        <ul class="tabs-animated-shadow nav-justified tabs-animated nav">

            <li class="nav-item">

                <a role="tab" class="nav-link active show" id="tab-c1-0" data-toggle="tab" href="#tab-animated2-0" aria-selected="true">

                    <span class="nav-text"><i class="fa fa-cog"></i> Sub Menu Style</span>

                </a>

            </li>
            
            <li class="nav-item">

                <a role="tab" class="nav-link" id="tab-c1-0" data-toggle="tab" href="#tab-animated2-1" aria-selected="true">

                    <span class="nav-text"><i class="fa fa-cog"></i> Border</span>

                </a>

            </li>
            
            <li class="nav-item">

                <a role="tab" class="nav-link" id="tab-c1-0" data-toggle="tab" href="#tab-animated2-2" aria-selected="true">

                    <span class="nav-text"><i class="fa fa-cog"></i> Other</span> <span class="badge badge-danger pull-right" style="margin-top: 8px;font-size: 0.4em;">New</span>

                </a>

            </li>
                                                            

        </ul>

        <div class="tab-content">
            
            <div class="tab-pane" id="tab-animated2-2" role="tabpanel">
                
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
                                    <span class="input-group-text curRadBTL_Submenu"><?=$css['BradiusBTL']?>px</span>
                                </div>
                                                                                    
                                <input type="range" name="submenu[BradiusBTL]" class="form-control" onchange="curRadBTL_Submenu(this)" min=0 max=30 value="<?=$css['BradiusBTL']?>">
                                <script>function curRadBTL_Submenu(ip){$(".curRadBTL_Submenu").html(ip.value+"px")}</script>
                                                                       
                            </div>
                        </div>
                                                                        
                        <div class="col-md-3 form-group">

                            <label>Top-Right</label>
                            
                            <div class="input-group">
                                
                                <div class="input-group-prepend">
                                    <span class="input-group-text curRadBTR_Submenu"><?=$css['BradiusBTR']?>px</span>
                                </div>
                                                                                    
                                <input type="range" name="submenu[BradiusBTR]" class="form-control" onchange="curRadBTR_Submenu(this)" min=0 max=30 value="<?=$css['BradiusBTR']?>">
                                <script>function curRadBTR_Submenu(ip){$(".curRadBTR_Submenu").html(ip.value+"px")}</script>
                                                                       
                            </div>
                        </div>
                                                                        
                        <div class="col-md-3 form-group">

                            <label>Bottom-Left</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text curRadBBL_Submenu"><?=$css['BradiusBBL']?>px</span>
                                </div>
                                                                                    
                                <input type="range" name="submenu[BradiusBBL]" class="form-control" onchange="curRadBBL_Submenu(this)" min=0 max=30 value="<?=$css['BradiusBBL']?>">
                                <script>function curRadBBL_Submenu(ip){$(".curRadBBL_Submenu").html(ip.value+"px")}</script>
                                                                       
                            </div>
                        </div>
                                                                        
                        <div class="col-md-3 form-group">

                            <label>Bottom-Right</label>
                            <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text curRadBBR_Submenu"><?=$css['BradiusBBR']?>px</span>
                                    </div>
                                                                                    
                                    <input type="range" name="submenu[BradiusBBR]" class="form-control" onchange="curRadBBR_Submenu(this)" min=0 max=30 value="<?=$css['BradiusBBR']?>">
                                    <script>function curRadBBR_Submenu(ip){$(".curRadBBR_Submenu").html(ip.value+"px")}</script>
                                                                       
                            </div>
                        </div>
                    </div>
                                                                    
                    <div class="row">
                        <h4>Box Shadow <span class="badge badge-danger pull-right" style="margin-top: 8px;font-size: 0.4em;">New</span>
                        </h4>
                    </div>
                                                                    
                    <div class="row">
                        <div class="col-md-2 form-group">
                            <select class="form-control" id="box_shadow_type" name="submenu[box_shadow_type]">
                                <option value="" <?=($css['box-shadow']['box_shadow_type']=='' ? 'selected':'')?>>OutSet</option>
                                <option value=inset <?=($css['box-shadow']['box_shadow_type']=='inset' ? 'selected':'')?>>InSet</option>
                            </select>
                        </div>
                        
                        <div class="col-md-2 form-group">
                            <input type=color name=submenu[boxShadowColor] class="form-control" value="<?=$css['box-shadow']['boxShadowColor']?>">
                        </div>
                                                                        
                        <div class="col-md-2 form-group">

                            <input type="number" name="submenu[shad_first]" class="form-control" min=-100 max=100  value="<?=$css['box-shadow']['shad_first']?>">
                                                                                  
                        </div>
                                                                        
                        <div class="col-md-2 form-group">

                            <input type="number" name="submenu[shad_first1]" class="form-control" min=-100 max=100 value="<?=$css['box-shadow']['shad_first1']?>">
                                                                                 
                        </div>
                                                                        
                        <div class="col-md-2 form-group">

                                                                               
                            <input type="number" name="submenu[shad_first2]" class="form-control" min=-100 max=100 value="<?=$css['box-shadow']['shad_first2']?>">
                                                                                    
                        </div>
                                                                        
                        <div class="col-md-2 form-group">

                                                                            
                            <input type="number" name="submenu[shad_first3]" class="form-control"  min=-100 max=100 value="<?=$css['box-shadow']['shad_first3']?>">
                                                                                    
                        </div>
                                                                        
                    </div>
                    <div class="row">
                        <h4>Menu Margin <span class="badge badge-danger pull-right" style="margin-top: 8px;font-size: 0.4em;">New</span></h4>
                                                                        
                    </div>
                                                                    
                    <div class="row">
                        
                        <div class="col-md-2 form-group">
                            <label>Left</label>
                            <input type="number" name="submenu[marginLeft]" class="form-control" min=-20 max=20  value="<?=$css['marginLeft']?>">
                                                                                  
                        </div>
                                                                        
                        <div class="col-md-2 form-group">
                            <label>Right</label>
                            <input type="number" name="submenu[marginRight]" class="form-control" min=-20 max=20 value="<?=$css['marginRight']?>">
                                                                                         
                        </div>
                                                                                
                        <div class="col-md-2 form-group">

                            <label>Top</label>          
                            <input type="number" name="submenu[marginTop]" class="form-control" min=-20 max=20 value="<?=$css['marginTop']?>">
                                                                                    
                        </div>
                                                                                
                        <div class="col-md-2 form-group">
    
                            <label>Bottom</label>    
                            <input type="number" name="submenu[marginBottom]" class="form-control"  min=-20 max=20 value="<?=$css['marginBottom']?>">
                                                                                    
                        </div>
                        
                    </div>
                                                                    
                                                                    
                </div>
            </div>
             
            <div class="tab-pane" id="tab-animated2-1" role="tabpanel">
                <div class="col-md-12" style="display:inline-block">


                    <div class="row">

                        <div class="col-md-4 form-group">

                            <label>Border-Top Color</label>

                            <input type="color" name="submenu[BTcolor]" class="form-control" value="<?=$css['BTcolor']?>"/>

                        </div>

                        <div class="col-md-4 form-group">

                            <label>Border-Top Style</label>

                            <select class="form-control" name="submenu[BTstyle]" >

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
                                    <span class="input-group-text curSizeB_Submenu"><?=$css['BTsize']?>px</span>
                                </div>
                                <input type="range" name="submenu[BTsize]" class="form-control" onchange="curSizeB_Submenu(this)" min=0 max=10 value="<?=$css['BTsize']?>">
                                <script>function curSizeB_Submenu(ip){$(".curSizeB_Submenu").html(ip.value+"px")}</script>
                                                                           
                            </div>

                        </div>
                                                                            
                    </div>
                                                                        
                                                                        
                                                                        
                    <div class="row">

                        <div class="col-md-4 form-group">

                            <label>Border-Bottom Color</label>

                            <input type="color" name="submenu[BBcolor]" class="form-control" value="<?=$css['BBcolor']?>"/>

                        </div>

                        <div class="col-md-4 form-group">

                            <label>Border-Bottom Style</label>

                             <select class="form-control" name="submenu[BBstyle]" >

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
                                    <span class="input-group-text curSizeBB_Submenu"><?=$css['BBsize']?>px</span>
                                </div>
                                
                                <input type="range" name="submenu[BBsize]" class="form-control" onchange="curSizeBB_Submenu(this)" min=0 max=10 value="<?=$css['BBsize']?>">
                                    
                                <script>function curSizeBB_Submenu(ip){$(".curSizeBB_Submenu").html(ip.value+"px")}</script>
                                                                           
                            
                            </div>

                        
                        </div>
                                                                            
                    
                    </div>
                                                                        
                    
                    <div class="row">

                        <div class="col-md-4 form-group">

                            <label>Border-Left Color</label>

                            <input type="color" name="submenu[BLcolor]" class="form-control" value="<?=$css['BLcolor']?>"/>

                        </div>

                        <div class="col-md-4 form-group">

                            <label>Border-Left Style</label>

                            <select class="form-control" name="submenu[BLstyle]" >

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
                                <span class="input-group-text curSizeBL_Submenu"><?=$css['BLsize']?>px</span>
                            </div>
                            
                            <input type="range" name="submenu[BLsize]" class="form-control" onchange="curSizeBL_Submenu(this)" min=0 max=10 value="<?=$css['BLsize']?>">
                            <script>function curSizeBL_Submenu(ip){$(".curSizeBL_Submenu").html(ip.value+"px")}</script>
                                                                           
                        </div>

                    </div>
                                                                            
                </div>
                                                                        
                <div class="row">

                    <div class="col-md-4 form-group">

                        <label>Border-Right Color</label>

                        <input type="color" name="submenu[BRcolor]" class="form-control" value="<?=$css['BRcolor']?>"/>

                    </div>

                    <div class="col-md-4 form-group">

                        <label>Border-Right Style</label>

                        <select class="form-control" name="submenu[BRstyle]" >

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
                                <span class="input-group-text curSizeBR_Submenu"><?=$css['BRsize']?>px</span>
                            </div>
                            
                            <input type="range" name="submenu[BRsize]" class="form-control" onchange="curSizeBR_Submenu(this)" min=0 max=10 value="<?=$css['BRsize']?>">
                            <script>function curSizeBR_Submenu(ip){$(".curSizeBR_Submenu").html(ip.value+"px")}</script>
                                                                           
                        </div>

                    </div>
                                                                            
                </div>
            </div>
        </div>
        

        <div class="tab-pane active show" id="tab-animated2-0" role="tabpanel">

            <div class="row">

                <div class="col-md-6" style="display:inline-block">

                    <div class="row">   

                        <h4>Background</h4>

                    </div>

                    <div class="row">

                        <div class="col-md-6 form-group">

                            <label>Color</label>

                            <input type="color" onchange="" name="submenu[backgroundColor]" class="form-control" value="<?=$css['backgroundColor']?>"/>

                        </div>

                        <div class="col-md-6 form-group">

                            <label>Hover Color</label>

                            <input type="color" name="submenu[backgroundHover]" class="form-control" value="<?=$cssHover['backgroundHover']?>"/>

                        </div>

                    </div>

                </div>

                <div class="col-md-6" style="display:inline-block">

                    <div class="row">

                        <h4>Menu Text</h4>

                    </div>

                    <div class="row">

                        <div class="col-md-6 form-group">

                            <label>Color</label>

                            <input type="color" name="submenu[textColor]" class="form-control" value="<?=$css['textColor']?>"/>

                        </div> 

                        <div class="col-md-6 form-group">

                            <label>Hover Color</label>

                            <input type="color"  name="submenu[textHover]" class="form-control" value="<?=$cssHover['textHover']?>"/>

                        </div>

                    </div>

                </div>
                <div class="col-md-12" style="display:inline-block">

                    <div class="row">

                        <h4>Menu Padding</h4>

                    </div>

                    <div class="row">

                        <div class="col-md-3 form-group">

                            <label>Left</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text curPedL_Submenu"><?=$css['menuPadL']?>px</span>
                                </div>
                                <input type="range" name="submenu[menuPadL]" class="form-control" onchange="curPeddL_Submenu(this)" min=0 max=100 value="<?=$css['menuPadL']?>">
                                <script>function curPeddL_Submenu(ip){$(".curPedL_Submenu").html(ip.value+"px")}</script>
                                                                           
                            </div>

                        </div>

                        <div class="col-md-3 form-group">

                            <label>Right</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text curPedR_Submenu"><?=$css['menuPadR']?>px</span>
                                </div>
                                <input type="range" name="submenu[menuPadR]" class="form-control" onchange="curPeddR_Submenu(this)" min=0 max=100 value="<?=$css['menuPadR']?>">
                                <script>function curPeddR_Submenu(ip){$(".curPedR_Submenu").html(ip.value+"px")}</script>
                                                                       
                            </div>

                        </div>

                        <div class="col-md-3 form-group">

                            <label>Top</label>

                            <div class="input-group">
                                
                                <div class="input-group-prepend">
                                    <span class="input-group-text curPedT_Submenu"><?=$css['menuPadT']?>px</span>
                                </div>
                                
                                <input type="range" name="submenu[menuPadT]" class="form-control" onchange="curPeddT_Submenu(this)" min=0 max=100 value="<?=$css['menuPadT']?>">
                                <script>function curPeddT_Submenu(ip){$(".curPedT_Submenu").html(ip.value+"px")}</script>
                                                                       
                            </div>

                        </div>

                        <div class="col-md-3 form-group">

                            <label>Bottom</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text curPedB_Submenu"><?=$css['menuPadB']?>px</span>
                                </div>
                                <input type="range" name="submenu[menuPadB]" class="form-control" onchange="curPeddB_Submenu(this)" min=0 max=100 value="<?=$css['menuPadB']?>">
                                <script>function curPeddB_Submenu(ip){$(".curPedB_Submenu").html(ip.value+"px")}</script>
                                                                       
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
                            <input type="number" class="form-control" name="submenu[Fsize]" placeholder="Font Size" value="<?=$css['Fsize']?>" required="">
                            <div class="input-group-append">
                                <span class="input-group-text">px</span>
                            </div>
                        </div>

                    </div>
                    
                    <div class="col-md-4 form-group">

                        <label>Font Style</label>
                        <select  class="form-control font-style-select" id="font-style-select1" data-cur="<?=$css['Fstyle']?>" name="submenu[Fstyle]">
 
                        </select>

                    </div>
                     
                    <div class="col-md-4 form-group">

                        <label>Font Family</label>
                        <select  class="form-control font-family-select" id="font-family-select1" data-cur="<?=$css['Ffamily']?>" name="submenu[Ffamily]">
                                                                               
                        </select>
                    </div>
                </div>
            </div>

        </div>
    </div>

                                                            
                                                           

</div>

</div>

                                                    
                                                
<script>
       
font_select();
</script>