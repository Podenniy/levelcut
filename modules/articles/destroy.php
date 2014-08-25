<?php
if (isset($_SESSION['user']) ) {

     $res = q( "
              SELECT articles.id, articles.user_id, comments.article_id
              FROM articles
              LEFT JOIN comments ON comments.article_id = articles.id
              WHERE articles.user_id = '".(int)$_SESSION['user']['id']."' AND articles.id = '".(int)$_GET['key1']."'
              LIMIT 1
            ");

     if (!$res->num_rows ) {
          header("location:/errors/404");
          exit();
        }else {
           $row = $res->fetch_assoc();
        }

        if (!empty($row['article_id'])) {
            q(" DELETE articles, comments
              FROM articles, comments
              WHERE articles.id = '".(int)$_GET['key1']."' AND comments.article_id = '".(int)$_GET['key1']."'
           ");
            $res->close();
             header("Location:/articles/main/author_id/".(int)$_SESSION['user']['id']);
              exit();

        }else {
          q(" DELETE articles
               FROM articles
               WHERE articles.id = '".(int)$_GET['key1']."'

           ");
            $res->close();
           header("Location:/articles/main/author_id/".(int)$_SESSION['user']['id']);
            exit();
        }

}

?>