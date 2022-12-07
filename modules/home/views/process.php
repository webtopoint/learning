<?php


$GLOBALS['page_id'] = $page_id;
$GLOBALS['cw'] = $cw;
$GLOBALS['page_data'] = $pageData;
echo '<div style="padding:10px">';
foreach ($result as $item)
    container($item->type , $item->key_id);
echo '</div>';

        $home = 'includes' . DIRECTORY_SEPARATOR .FileDirecory . DIRECTORY_SEPARATOR .'home.php';
        if(file_exists($home))
            require $home;
?>