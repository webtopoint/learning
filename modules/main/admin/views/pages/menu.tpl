<div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-info">
            <div class="card-header">
                <strong>Menu Section</strong>
            </div>
            <div class="card-body print-menu-div">
                
            </div>
            <div class="card-footer">
                <button class="btn btn-success save"><i class="fa fa-save"></i></button>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>

<script>

$('.save').on('click',function(){
     var dataString = { 

              data : $("#nestable-output").val(),

            };
        $('.loader-pre').show();
        $.ajax({

            type: "POST",

            url: hostUrl+'admin/pages/save_menu',

            data: dataString,

            cache : false,

            success: function(data){
                    //$("#load").hide();
                toastr.success('Menu Update Successfully..');
                $('.loader-pre').hide();
            } ,error: function(xhr, status, error) {
                $('.loader-pre').hide();

            },

        });
})
    
     NProgress.configure({ parent: '.print-menu-div' });
    print_menu(1);
    NProgress.start();
    
    
    function print_menu(group_id ){
        //alert(1);
        NProgress.start();
        $('.first-footer').removeClass('card-footer').html('');
        
        $('.footer-menu').hide();
        $('.print-menu-div').html('');
        $.ajax({
            type : 'POST',
            url :hostUrl+'admin/pages/menu_section',
            dataType : 'json',
            data : {group_id : group_id, status : 'print-menu'},
            success : function(res){
                console.log(res);
                NProgress.done();
                $('.print-menu-div').html(res.html);
            },
            complete:function(){
                NProgress.remove();
                $('.footer-menu').show();
                
                
                $(document).ready(function()

                    {
                    
                    
                    
                        var updateOutput = function(e)
                    
                        {
                    
                            var list   = e.length ? e : $(e.target),
                    
                                output = list.data('output');
                    
                            if (window.JSON) {
                    
                                output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
                        
                            } else {
                    
                                output.val('JSON browser support required for this demo.');
                    
                            }
                    
                        };
                    
                    
                    
                        $('#nestable').nestable({
                    
                            group: 1
                    
                        })
                    
                        .on('change', updateOutput);
                    
                        updateOutput($('#nestable').data('output', $('#nestable-output')));
                    
                    
                    
                        $('#nestable-menu').on('click', function(e)
                    
                        {
                    
                            var target = $(e.target),
                    
                                action = target.data('action');
                    
                            if (action === 'expand-all') {
                    
                                $('.dd').nestable('expandAll');
                    
                            }
                    
                            if (action === 'collapse-all') {
                    
                                $('.dd').nestable('collapseAll');
                    
                            }
                    
                        });
                    
                    
                    
                    
                    
                    });
                
                
            },
            error:function(re,v,c){
                console.log(re);
                $('.print-menu-div').html(re.responseText);
                NProgress.done();
                NProgress.remove();
            }
        });
    }
</script>