<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>


<script>
/*
$.confirm({
    title: 'Title',
    theme:'supervan',
    content: function () {
        var self = this;
        return $.ajax({
            url: '',
            dataType: 'json',
            method: 'post'
        }).done(function (response) {
            self.setContent('Description: ' + response.description);
        }).fail(function(){
            self.setContent('Something went wrong.');
        });
    },
    columnClass: 'medium',
});
*/
    $.alert({
        type:'green',
        theme:'supervan',
        icon:'fa fa-check',
        title:'Choose Payment Option.',
        content: 'lele',
        button:{
            ok:{
                text:'Go!',
                btnClass:'btn-success',
                action:function(){
                    
                }
            },
            cancel:function(){
                
            }
        }
        
        
    });
</script>