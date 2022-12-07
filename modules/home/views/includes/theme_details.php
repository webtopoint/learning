<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<style>
*{
    background:black!important;
    border:1px dotted white!important;
    color:white!important;
}
    #___container{
        width:100%;
        padding:30px;
    }
    #___container .div{
        width:100%;
        border:2px solid black;
        padding:20px;
    }
    #___container .div table tr th,  #___container .div table tr td{
        
        font-size:4em;
    }
</style>
<div id="___container">
    <div class="div" align=center>
        <table border=1 class="" style="width:100%" align="center">
            <tr>
                
                <th>Theme Name </th> <td><?php echo  FileDirecory; ?> </td>
            </tr>
            <tr>
                
                <th>Admin Id </th> <td><?php echo time() .'-'. CLIENT_ID; ?> </td>
            </tr>
            <tr>
                <th>Elapsed Time</th> <td><?php echo $elpTime; ?> Seconds</td>
                
                <?php echo  (ENVIRONMENT === 'development') ?  '<tr><th>Website Version</th> <td>'. CI_VERSION.' </td></tr>' : ''; ?>
            </tr>
        </table>
    </div>
</div>


