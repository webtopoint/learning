$("#createWidget").on("click",function(){
	$("#load").show();
	
	$.ajax({
			url:base_url+'Admin/add_widget',
			type:'POST',
			data:{status:'printType'},
			success:function(q)
			{
			    $("#load").hide();
				$(".formBox").html(q);
			},
			error:function(u,v,w)
			{
				alert(w);
			}
	}); 
	//alert(base_url+'/Admin/add-widget');
});
function print_form(x){
    $("#load").show();
    if(x.value.trim()===''){
        $("#load").hide();
        $('.widget-form-area').html('');
        return false;
    }
    
    $.ajax({
        type:'POST',
        url:base_url+'/Admin/add_widget',
        data:{status:'printFormFields',type:x.value},
        success:function(q){
            $("#load").hide();
            $('.widget-form-area').html(q);
        },error:function(a,c,v){
            alert(v);
        }
    });
    
}

