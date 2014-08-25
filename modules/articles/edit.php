<?php

if (isset($_SESSION['user'])) {

    if( isset($_GET['page'] ) && $_GET['page'] == "edit"){
    ///  $res = q("
    ///    SELECT  *
    ///    FROM `articles`
    ///    WHERE articles.id =  ".$_GET['key2']." LIMIT 1
    ///  ");
    ///    $res2 = q( "
    ///          SELECT *
    ///          FROM `category`
    ///        ");
///
    ///  if (!$res->num_rows) {
    ///      header("location:/404");
    ///      exit();
    ///  }else {
    ///      $row = $res->fetch_assoc();
    ///  }
///
///
///
      if (isset($_POST['title'],$_POST['text'], $_POST['cat'], $_POST['desc'])) {
         $errors = array();  ////// ERRORS
          foreach ($_POST as $k => $v) {
             if ($k != 'cat') {
                   ta($v);
             }
           }

             if (mb_strlen($_POST['desc']) > 255) {

                $errors["desc"] = "<div class='alert alert-danger'>ВЫ ввели больше 255 символов</div>";
             }elseif (empty($_POST['desc'])) {
               $errors["desc"] = "<div class='alert alert-danger'>Это поле не может быть пустым</div>";
             }

             if (empty($_POST['text'])) {
              $errors["text"] = "<div class='alert alert-danger'>Это поле не может быть пустым</div>";
             }

              if (empty($_POST['title'])){
              $errors["title"] = "<div class='alert alert-danger'>Это поле не может быть пустым</div>";
             }

              securetext($_POST['text']);
              securetext($_POST['desc']);
              securetext($_POST['title']);
             if (!count($errors)){
                q( "
                     UPDATE  `articles` SET
                    `title`        = '".es($_POST['title'])."',
                    `description`       = '".es($_POST['desc'])."',
                    `text`       =  '".es($_POST['text'])."',
                    `cat_id`       =  '".(int)$_POST['cat']."'
                     WHERE     `id` = '".(int)$row['id']."'
                     LIMIT 1
                   ");
                     header("location:/articles/show/id/".$row['id']);
                     exit();
              }

          }
     }
}else{
    header("location:/404");
    exit();
}

?>
