<?php
if (isset($_SESSION['user']) ) {
   $res = q( "
      SELECT *
      FROM comments
      WHERE comments.user_id = '".(int)$_SESSION['user']['id']."' AND comments.id = '".(int)$_GET['key1']."'
      LIMIT 1
    ");
   if (!$res->num_rows ) {
          header("location:/errors/404");
          exit();
        }else {
           $row = $res->fetch_assoc();
           q(" DELETE comments
               FROM comments
               WHERE comments.id = '".(int)$_GET['key1']."'

           ");
           header("Location:/my_comments");
            exit();
            $res->close();
        }

}
?>