$(document).ready(function(){
   
   $('.parent-input').click(function(){
       var id = $(this).val();
       
    //   var checked = $(this).is(':checked');
        
        $('.input-check-'+id).prop('disabled',!$(this).is(':checked'));
           
       
       
   });
   
   
   
   
    
    
});

$(document).on('click','.get-web-details',function(){
    //   console.log(this);
       var box  = $(this).closest('.box'),
           website_id =box.data('id');
        $.dialog({
            title : 'Website Details',
            theme:'supervan',
            icon  : 'fa fa-globe fa-3x text-white',
            columnClass :'row',
            content : 'url:'+hostUrl+'website/details/'+website_id
        });
   })