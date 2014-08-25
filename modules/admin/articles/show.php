<?php
$ar = q( "
             SELECT *
             FROM  `articles`
             WHERE  id =  '".$_GET['key2']."'
             LIMIT 1
          ");
if (!$ar->num_rows) {
          header("location:/404");
          exit();
      }else {
          $_all = $ar->fetch_assoc();
       }

$p =  q( "
      SELECT  module
       FROM  `pages`
       WHERE  `id` = '".$_all['page_id']."'
    ");
  $pgs = $p->fetch_assoc();

?>