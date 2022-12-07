<html>
<head>
	<title>Transaction Response</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="container-fluid">

<?php

	echo'<div id="box">';
	if(isset($response["STATUS"]))
	{
    	if ($response["STATUS"] == "TXN_SUCCESS") 
    	{
    		echo "<center><h2 class='text-success'><b><i class='fa fa-check-circle'></i> Transaction successful</b></h2></center>" . "<br/>";
    		$response['STATUS'] = "<b class='text-success'>".ucwords($response['STATUS'])."</b>";
    
    	}
    	else if($response["STATUS"] == "PENDING")
    	{
    		echo "<center><h2 class='text-warning'><b><i class='fa fa-warning'></i> Transaction Pending</b></h2></center>" . "<br/>";
    		$response['STATUS'] = "<b class='text-warning'>".ucwords($response['STATUS'])."</b>";
    	
    	}
    	else 
    	{
    		echo "<center><h2 class='text-danger'><b><i class='fa fa-times-circle'></i> Transaction Failed</b></h2></center>" . "<br/>";
    		$response['STATUS'] = "<b class='text-danger'>".ucwords($response['STATUS'])."</b>";
    
    	}
	}
	if(isset($response["status"])){
	    if ($response["status"] == "success" || $response["status"] == "complete") 
    	{
    		echo "<center><h2 class='text-success'><b><i class='fa fa-check-circle'></i> Transaction successful</b></h2></center>" . "<br/>";
    		$response['status'] = "<b class='text-success'>".ucwords($response['status'])."</b>";
    
    	}
    	else if($response["status"] == "pending")
    	{
    		echo "<center><h2 class='text-warning'><b><i class='fa fa-warning'></i> Transaction Pending</b></h2></center>" . "<br/>";
    		$response['status'] = "<b class='text-warning'>".ucwords($response['status'])."</b>";
    	
    	}
    	else 
    	{
    		echo "<center><h2 class='text-danger'><b><i class='fa fa-times-circle'></i> Transaction Failed</b></h2></center>" . "<br/>";
    		$response['status'] = "<b class='text-danger'>".ucwords($response['status'])."</b>";
    
    	}
	}
	echo'<div class="container" >
			<table class="table table-striped table-bordered">';

	if (isset($response) && count($response)>0 )
	{ 
		foreach($response as $paramName => $paramValue) {
				echo "<tr><th>" . humanize($paramName) . "</th><td>" . $paramValue."</td></tr>";
		}
	}
	echo'</table>
	</div><br><center>';
?>	
</div>
<center><button class="btn btn-success" onclick="window.print()"><i class="fa fa-print"></i> Print</button> &nbsp;<button class="btn btn-primary" onclick="location.href='<?=site_url()?>'"><i class="fa fa-home"></i> Home</button></center>
</body>
</html>