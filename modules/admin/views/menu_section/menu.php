 <div class="mb-3 card">

    <div class="card-body" style="overflow-x:hidden">

        <ul class="tabs-animated-shadow nav-justified tabs-animated nav">

            <li class="nav-item">

                <a role="tab" class="nav-link active show" id="tab-c1-0" data-toggle="tab" href="#tab-animated1-0" aria-selected="true">

                    <span class="nav-text"><i class="fa fa-cog"></i> Menu Style</span>

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
                        <h4>Menu Margin <span class="badge badge-danger pull-right" style="margin-top: 8px;font-size: 0.4em;">New</span></h4>
                                                                        
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

                        <h4>Menu Text</h4>

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

                        <h4>Menu Padding</h4>

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
    </div>

                                                            
                                                           

</div>

</div>

                                                    
                                                
<script>
                                                 
    setMENUcss();
    subFont();
    function subFont(){
        var family  = ['Arial','Tangerine','Comic Neue','Bangers','Inconsolata','Lobster','Indie Flower','Dancing Script','Pacifico','Bebas Neue','Righteous','Cinzel','Courgette'];
      
        var fstyle = ['normal','italic','bold'];
        var i =0;
        var fam1  = document.getElementById('font-family-select1');
        var st1   = document.getElementById('font-style-select1');
        for(i=0;i<family.length;i++)
        {   
           
            var  s = fam1.dataset.cur.toLowerCase()==family[i].toLowerCase()?" selected":"";
            fam1.innerHTML+="<option value='"+family[i]+"' style='font-family:"+family[i]+";' "+s+">"+family[i]+"</option>";
        }
    
        for(i=0;i<fstyle.length;i++)
        {   
            var   s = st1.dataset.cur.toLowerCase()==fstyle[i].toLowerCase()?" selected":"";
            
            t = (fstyle[i]=='bold') ? 'font-weight:' : 'font-style:';
    
            st1.innerHTML+="<option value='"+fstyle[i]+"' style='"+t+fstyle[i]+"' "+s+">"+fstyle[i]+"</option>";
        }
    }
    $(document).on("change",".tab-content select,input",function(event) { 
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
            marginLeft              :           $("input[name=marginLeft]").val()
        };
        var subCss = [];

        $('input[name^="submenu"],select[name^="submenu"]').map(function(key){
            
            subCss[ $(this).attr('name').replace('submenu[','').replace(']','') ] = $(this).val();
            
        });
                            
        let shadow = css.box_shadow_type + " " + css.shad_first + "px "+ css.shad_first1 + "px "+css.shad_first2+"px "+css.shad_first3+"px "+css.boxShadowColor;   
                               
        let SubMenushadow = subCss.box_shadow_type + " " + subCss.shad_first + "px "+ subCss.shad_first1 + "px "+subCss.shad_first2+"px "+subCss.shad_first3+"px "+subCss.boxShadowColor;  

        var t       =  ( css.Fstyle     ==  "bold" ) ?  "font-weight:bold" : "font-style:"+css.Fstyle;  
        var subT    =  ( subCss.Fstyle  ==  "bold" ) ?  "font-weight:bold" : "font-style:"+subCss.Fstyle;

        $(".cssBox").html("<style>.menu-css{margin-left:"+css.marginLeft+"px; margin-right:"+css.marginRight+"px;margin-top:"+css.marginTop+"px;margin-bottom:"+css.marginBottom+"px;box-shadow:"+shadow+"!important;background-color:"+css.backColor+"!important; color:"+css.textColor+"!important; padding-left:"+css.menuPadL+"px!important;padding-right:"+css.menuPadR+"px!important;padding-top:"+css.menuPadT+"px!important;padding-bottom:"+css.menuPadB+"px!important;border-top:"+css.BTsize+"px "+css.BTstyle+" "+css.BTcolor+"; border-bottom:"+css.BBsize+"px "+css.BBstyle+" "+css.BBcolor+"; border-left:"+css.BLsize+"px "+css.BLstyle+" "+css.BLcolor+"; border-right:"+css.BRsize+"px "+css.BRstyle+" "+css.BRcolor+"; border-radius:"+css.BradiusBTL+"px "+css.BradiusBTR+"px "+css.BradiusBBR+"px "+css.BradiusBBL+"px; font-size:"+css.Fsize+"px!important; font-family:"+css.Ffamily+"!important; "+t+"!important;} .menu-css:hover{background-color:"+css.backHover+"!important; color:"+css.textHover+"!important;}   .sub-menu-css{margin-left:"+subCss.marginLeft+"px; margin-right:"+subCss.marginRight+"px;margin-top:"+subCss.marginTop+"px;margin-bottom:"+subCss.marginBottom+"px;box-shadow:"+SubMenushadow+"!important;background-color:"+subCss.backgroundColor+"!important; color:"+subCss.textColor+"!important; padding-left:"+subCss.menuPadL+"px!important;padding-right:"+subCss.menuPadR+"px!important;padding-top:"+subCss.menuPadT+"px!important;padding-bottom:"+subCss.menuPadB+"px!important;border-top:"+subCss.BTsize+"px "+subCss.BTstyle+" "+subCss.BTcolor+"; border-bottom:"+subCss.BBsize+"px "+subCss.BBstyle+" "+subCss.BBcolor+"; border-left:"+subCss.BLsize+"px "+subCss.BLstyle+" "+subCss.BLcolor+"; border-right:"+subCss.BRsize+"px "+subCss.BRstyle+" "+subCss.BRcolor+"; border-radius:"+subCss.BradiusBTL+"px "+subCss.BradiusBTR+"px "+subCss.BradiusBBR+"px "+subCss.BradiusBBL+"px; font-size:"+subCss.Fsize+"px!important; font-family:"+subCss.Ffamily+"!important; "+subT+"!important;} .sub-menu-css:hover{background-color:"+subCss.backgroundHover+"!important; color:"+subCss.textHover+"!important;</style>");
    }
                                              
    
    $("#menuStyle").on("submit",function(event){
        event.preventDefault();
        $.ajax({
            url:"<?=base_url?>/admin/AJAX",
            data:$(this).serialize(),
            type:"post",
            dataType:"json",
            beforeSend:function()
            {
                $("#menuStyle input,#menuStyle select,#menuStyle button").attr("disabled","disabled");
            },
            success:function(q)
            {
                toastr.success("Menu Style Upload Successfully");
                $(".jconfirm-closeIcon").click();
            },
            error:function(u,v,r){
                alert(r);
            }

        });
                                                            
                                                        
    });

    function resetToDefault()
    {
        if(confirm("Are you sure to reset to  Default Menu Design?")){
            let group_id = $('#group_id').val();
            alert(group_id);

            $.ajax({
                url:"<?=base_url?>/admin/AJAX",
                data:{var:"resetToDefault",group_id:group_id},
                type:"post",
                dataType:"json",
                beforeSend:function()
                {
                    $("#menuStyle input,#menuStyle select,#menuStyle button").attr("disabled","disabled");
                },
                success:function(q)
                {
                    toastr.success("Menu Style Rest Successfully");
                    $(".jconfirm-closeIcon").click();
                },
                error:function(u,v,r)
                {
                    alert(r);
                }

            }); 
        }
    }
    font_select();
</script>