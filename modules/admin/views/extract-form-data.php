<?

require_once 'header.php';

?>

<div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">

                                        </i>

                                    </div>

                                    <div>Extarct Form Data

                                        <div class="page-title-subheading">

                                        </div>

                                    </div>

                                </div>  

                            </div>

</div> 
<div class="row">
    
        <div class="col-md-3">
            <div class="mb-3 text-center card main-card">
                <div class="card-body" style="overflow-x:hidden;height:400px">
                    <table class="table table-bordered">
                        <?
                       $row = json_decode($struct);
                       $html = '';
                       foreach($row as $k)
                        $html .= $k;
                       //$FinalLabels = $data['finalLabel'];
    		           $labels = C::get_label_AND_input_AND_type_field($html,'file',true);
    		           $row = [];
                       foreach($labels['oldLabel'] as $k)
                        $row[] = trim($k->textContent);
                  
                       $i = 1;
                       foreach($row as $key => $value)
                         echo '<tr><td><input type="checkbox" class="my-form_input" checked id="form_id_'.$i.'" value="'.$i.'"></td><td><label for="form_id_'.$i++.'">'.$value.'</label></td></tr>';
                       ?>
                    </table>
                    
                </div>
                <div class="card-footer">
                    <button class="btn btn-success col-md-12" id="btnExport"><i class="fa fa-file-archive"></i> Extract Now</button>
                    <div class="msg-dl col-md-12"></div>
                </div>
            </div>
        </div>
    
        <div class="col-md-9">
            <div class="mb-3 text-center card main-card">
                <div class="card-body" style="height:400px">
                
               <?     
                   $colspan = (sizeof((array)$row) + 1);
                      
                	echo'
                	    <div class="print-table table-responsive">
                    	<table id="dvData" class="mb-0 table table-striped table-bordered bg-white">
                    		
                    		<thead><tr><th colspan="'.$colspan.'" align="center" class="colspn-tr"><center><h2>'.$form_title.'</h2></center></th></tr><tr>';
                    		
                    		$i = 1;
                    		
                    		foreach ($row as  $value)
                    		    echo '<th class="box-'.$i++.'">'.$value.'</th>';
                    	    echo '</tr></thead><tbody>';
                    	    
                            foreach($data as $d){
                                echo '<tr>';
                                
                                $drow = (array)json_decode($d['data']);
                         
                                $i = 1;
                            	foreach ($row as  $value){
                            	    
                            		echo'<td class="box-'.$i++.'">';
                            		if(isset($drow[$value]))
                            		    echo (isJson($drow[$value])  ?    implode(' , ',(array) json_decode($drow[$value]))  :  $drow[$value]);
                            	    echo '</td>';
                            	}
                            	echo '</tr>';
                            }
                            
                    	echo'</tbody></table>
                	    </div>
                	    ';
                	?>
                </div>
            </div>    
        </div>
        
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>  

<script type="text/JavaScript">

//table2excel.js
(function ( $, window, document, undefined ) {
		var pluginName = "table2excel",
				defaults = {
				exclude: ".noExl",
                name: "Table2Excel"
		};

		// The actual plugin constructor
		function Plugin ( element, options ) {
				this.element = element;
				this.settings = $.extend( {}, defaults, options );
				this._defaults = defaults;
				this._name = pluginName;
				this.init();
		}

		Plugin.prototype = {
			init: function () {
				var e = this;
				e.template = "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\" xmlns=\"http://www.w3.org/TR/REC-html40\"><head><!--[if gte mso 9]><xml>";
				e.template += "<x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions>";
				e.template += "<x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>";
				e.tableRows = "";

				// get contents of table except for exclude
				$(e.element).find("tr").not(this.settings.exclude).each(function (i,o) {
				   
				    $(o).find('td,th').each(function(p,k){
				        if($(this).attr('style') === 'display: none;')
				            $(this).remove();
				    });
					e.tableRows += "<tr>" + $(o).html() + "</tr>";
				
				});
				this.tableToExcel(this.tableRows, this.settings.name);
			},
			tableToExcel: function (table, name) {
				var e = this;
				e.uri = "data:application/vnd.ms-excel;base64,";
				e.base64 = function (s) {
					return window.btoa(unescape(encodeURIComponent(s)));
				};
				e.format = function (s, c) {
					return s.replace(/{(\w+)}/g, function (m, p) {
						return c[p];
					});
				};
				e.ctx = {
					worksheet: name || "Worksheet",
					table: table
				};
				window.location.href = e.uri + e.base64(e.format(e.template, e.ctx));
			}
		};

		$.fn[ pluginName ] = function ( options ) {
				this.each(function() {
						if ( !$.data( this, "plugin_" + pluginName ) ) {
								$.data( this, "plugin_" + pluginName, new Plugin( this, options ) );
						}
				});

			return this;
		};

})( jQuery, window, document );











$(document).ready(function(){
    $("#btnExport").click(function(e) {
        var msg = GetMimeTypes();
        $("#dvData").table2excel({
					exclude: ".noExl",
    				name: "Excel Document Name"
				}); 
        e.preventDefault();
    $('.msg-dl').addClass('text-danger').html('Please Reload Page..');
    });
});

function GetMimeTypes () {
    var message = "";
       
    if (navigator.mimeTypes && navigator.mimeTypes.length > 0) {
        var mimes = navigator.mimeTypes;
        for (var i=0; i < mimes.length; i++) {
            message += "<b>" + mimes[i].type + "</b> : " + mimes[i].description + "<br />";
        }
    }
    else 
        message = "Your browser does not support this ";

    return ( message);
}


    $('.my-form_input').change(function(){
        if(!$(this).is(':checked')){
            $('.box-'+this.value).hide();
            $('.colspn-tr').attr('colspan', parseInt(parseInt($('.colspn-tr').attr('colspan')) - 1) );
        }
        else{
            $('.box-'+this.value).show(); 
            $('.colspn-tr').attr('colspan', parseInt(parseInt($('.colspn-tr').attr('colspan')) + 1) );
        }
    });
</script>
<?

require_once 'footer.php';

?>