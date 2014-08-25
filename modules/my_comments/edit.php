<?php if( isset($_SESSION['user'])) {
CORE::$META['title']="Редактирование коментария";

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
           if (isset($_POST['comment_text'])) {
              if (empty($_POST['comment_text'])) {
              $errors["comment_text"] = "<div class='alert alert-danger'>Это поле не может быть пустым</div>";
             }
             securetext($_POST['comment_text']);
               if (!count($errors)){
                  q( "
                     UPDATE  `comments` SET
                    `comment_text`        = '".es($_POST['comment_text'])."'
                     WHERE     `id`          = '".(int)$row['id']."'

                    ");
                       header("location:/my_comments/");
                       exit();
              }
           }
        }
}




?>