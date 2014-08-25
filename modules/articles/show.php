<?php
if( (isset($_GET['key1'] ) && $_GET['key1'] == "id") && $_GET['page'] == 'show'){
//wtf($_GET,1);

  $res = q("
    SELECT  `login`, `avatar`, `name`, `title`, articles.text, `description`, articles.date, articles.id , `cat_id`, articles.user_id ,text,
         COUNT( votes.vote_like) AS `count_like`,
        COUNT( votes.vote_unlike) AS `count_unlike`
    FROM `articles`
    LEFT JOIN users ON users.id = articles.user_id
    LEFT JOIN category ON category.id = articles.cat_id
    LEFT JOIN votes ON votes.article_vid = articles.id
    WHERE articles.id =  ".(int)$_GET['key2']."
    LIMIT 1

  ");


      $res_com = q("
          SELECT  *
          FROM comments
          LEFT  JOIN users ON users.id = comments.user_id
          WHERE  comments.article_id = ".(int)$_GET['key2']."
          ORDER BY `date` DESC LIMIT 8
        ");

       if (!$res->num_rows ) {
          header("location:/404");
          exit();
        }else {
           $row = $res->fetch_assoc();

       }
     if (isset($_POST['comment'])){
        $errors = array();  ////// ERRORS
        if (empty($_POST['comment']) ) {
            $_SESSION['info'] = "Вы не можете оставлять пустые комментарии";
            $_SESSION["inf_class"] = $alerts["warning"];
          $errors["comment"] = "<div class='alert alert-danger'>Это поле не может быть пустым</div>";
        }

        if (isset($_POST['like'])) {
                 $res_v = q("
                        SELECT  *
                        FROM votes
                        WHERE  article_vid = ".(int)$row['id']." AND user_uid = ".$_SESSION['user']['id']."
                        LIMIT 1
                     ");

                 if ($res_v->num_rows ) {
                    $_SESSION['info'] = "Вы не можете голосовать несколько раз за одну и туже статью ";
                    $_SESSION["inf_class"] = $alerts["warning"];
                    $errors['dubl_vote'] = "Вы не можете несколько раз за одну и туже статью";
                    header("location:/articles/show/id/".$_GET['key2']);
                  exit();
                }


        }

        if (!count($errors)) {
          $vote = "`vote_like`";
          if (isset($_POST['like']) && $_POST['like'] == "unlike") {
              $vote  = "`vote_unlike`";
          }
          if (!$res_v->num_rows ) {
            q(" INSERT INTO `votes` SET
                  `article_vid`       = '".(int)$row['id']."',
                   `user_uid`       = '".(int)$_SESSION['user']['id']."',
                    ".$vote."       = 1
                  ");

            $res_s =  q("   SELECT SUM(`vote_like`), SUM(`vote_unlike`)
                        FROM votes WHERE article_vid = ".(int)$row['id']."
                     ");
              $row_sum = $res_s->fetch_assoc();
              $likes = $row_sum["SUM(`vote_like`)"];
              $dislikes = $row_sum["SUM(`vote_unlike`)"];

             $rating = (($likes + 1.9208) / ($likes + $dislikes) - 1.96 * sqrt(($likes * $dislikes) / ($likes + $dislikes) + 0.9604) / ($likes + $dislikes)) / (1 + 3.8416 / ($likes + $dislikes));
              q( "
                     UPDATE `articles` SET
                    `rating`       = ".fla($rating)."
                     WHERE  `id` =  ".(int)$row['id']."
                   ");

             }



          q(" INSERT INTO `comments` SET
                   `comment_text` = '".es($_POST['comment'])."',
                  `article_id`       = '".(int)$row['id']."',
                   `user_id`       = '".(int)$_SESSION['user']['id']."',
                   `date`       = NOW()
                  ");
                   $_SESSION["info"]  = "Вы успешно добавили коментарий";
                   $_SESSION["inf_class"] = $alerts["info"];
                  header("location:/articles/show/id/".$_GET['key2']);
                  exit();
        }

      }

     if (!isset($_SESSION['user'])) {

        $errors['com_class'] = "panel panel-danger";
     } else {
        $errors['com_class'] = "panel panel-info";

     }
         $res_s =  q("   SELECT SUM(`vote_like`), SUM(`vote_unlike`)
                        FROM votes WHERE article_vid = ".(int)$row['id']."
                     ");
            $row_sum = $res_s->fetch_assoc();

 }
?>