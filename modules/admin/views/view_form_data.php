<?

require_once 'header.php';

if(!$data->num_rows())
{
	echo'<div class="alert alert-danger">No Data to show</div>';
}
else
{
	$CI= &get_instance();
	$data = $data->row();
	$form = $CI->FormModel->getFormModel(array('id'=>$data->form_id,'admin_id'=>CLIENT_ID));
	$f = $form->row();


	$row = json_decode($data->data);

	echo'
	<div class="">
	    <button class="btn btn-primary pull-right" id="btnPrint"><i class="fa fa-print"></i> Print</button>
	    <br>
	    <div class="print-table">
    	<table class="mb-0 table table-striped table-bordered bg-white" border="1">
    	    <thead>
    		    <tr><th colspan="2" align="center"><center><h2>'.($f->title).'</h2></center></th></tr>
    		</thead>
    		<tbody>
    	';
    
    	foreach ($row as $key => $value)
    	{	//echo $value;
    		echo'<tr class="tr"><th width=40%>'.utf8_decode($key).'</th><td>';
    		                    
    		                    if(isJson($value) )
    		                    {
    		                            $fd = '';
    		                            foreach( (array)json_decode($value,true) as $f){
    		                               $fd .= print_ddd($f) ."  ";     
    		                            }
    		                            echo trim($fd,',');
    		                            
    		                    }
    		                    else
    		                      echo ($value);
    		echo '</td></tr>';
    	}
    	echo'</tbody></table>
	    </div>
	</div>';
}




?>



<script>

 $('tbody').sortable();
$( ".imgClass" ).draggable();
$( ".imgClass" ).resizable();


    $("#btnPrint").on("click", function () {
            var contents = $(".print-table").html();
            var frame1 = $('<iframe />');
                                        frame1[0].name = "frame1";
                                        frame1[0].id = 'result-frame';
                                        frame1.css({ "position": "absolute", "top": "-1000000px" });
                                        $("body").append(frame1);
                                        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
                                        frameDoc.document.open();
                                        frameDoc.document.write('<html><head><title>Pritn Result</title>');
                                        frameDoc.document.write('</head><body>');
                                        frameDoc.document.write('<style>#result-frame *{overflow:hidden;}td a{display:none}</style>');
                                        frameDoc.document.write('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">');
                                        frameDoc.document.write(contents);
                                        frameDoc.document.write('</body></html>');
                                        frameDoc.document.close();
                                        setTimeout(function () {
                                            window.frames["frame1"].focus();
                                            window.frames["frame1"].print();
                                            frame1.remove();
                                        }, 500);
        });
</script>
<?

require_once 'footer.php';

?>