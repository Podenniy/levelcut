<?php
include './modules/articles/main.php';
$_id = 0 ;
 $all_p =  q( "
      SELECT  *
       FROM  `pages`
       WHERE  `static` = 1
    ");




?>