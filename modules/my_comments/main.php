<?php
    if (isset($_SESSION['user'], $_GET['module']) && $_GET['module'] == 'my_comments') {
      unset($_SESSION["info"]);
      CORE::$META['title']="Мои коментарии";
      $res = q("
               SELECT comments.date, comment_text, `title`, article_id, comments.id
         FROM `comments`
         LEFT JOIN articles ON articles.id = comments.article_id
         WHERE  comments.user_id = '".$_SESSION['user']['id']."'
  ");
      if (!$res->num_rows) {
        if ($_GET['module'] == 'my_comments'){
            $_SESSION["info"]  = "У вас пока нет ни одного  коментария";
            $_SESSION["inf_class"] = $alerts["info"];

        }else {
          header("location:/404");
          exit();
        }
      }
      $in = "in";
    }
?>