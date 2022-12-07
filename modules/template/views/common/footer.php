<?php
echo $fixed_content."\n".$footer_data;

    require_once FCPATH.'demo.php';
    
?>
<script>

    $('.div-method > label').click(function(){
        // alert(2);
        // console.log(this);
        var form = $(this).closest('form');
        $(form).find('.div-method').find('label').removeClass('checked');
        $(this).addClass('checked');
    })
</script>
    </body>
</html>