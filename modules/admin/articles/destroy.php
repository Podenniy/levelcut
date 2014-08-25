<?php
if (isset($_SESSION['user']) ) {

     $res = q( "
              SELECT *
              FROM articles

              WHERE id = '".(int)$_GET['key2']."'
              LIMIT 1
            ");

     if (!$res->num_rows ) {
          header("location:/errors/404");
          exit();
        }else {
           $row = $res->fetch_assoc();
        }

        if (!empty($row['id'])) {
          q(" DELETE
               FROM `articles`
               WHERE id = '".(int)$_GET['key2']."'
               LIMIT 1

           ");
          if (!empty($row['img_url'])) {
             unlink(".".$row['img_url']);
          }
            $res->close();
            $_SESSION['info'] = "Вы успешно удалили статью";
             header("Location:/admin/articles");
              exit();

        }

}

?>