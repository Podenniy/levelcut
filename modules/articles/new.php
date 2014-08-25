<?php
    $errors = array();  ////// ERRORS
if (isset($_SESSION['user'])){
   unset($_SESSION['info']);
}
    if (isset($_SESSION['user'])) {


      if (isset($_POST['title'],$_POST['text'], $_POST['video'], $_POST['img_url'])) {

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

                securetext($_POST['title']);


             if (!count($errors)){
               q(" INSERT INTO `articles` SET
                   `title`           = '".es($_POST['title'])."',
                   `text`           = '".es($_POST['text'])."',
                   `video`           = '".es($_POST['text'])."',
                   `image_url` = '".es($_POST['image_url'])."',
                   `page_id`         = '".(int)$_POST['page_id']."',

                  ");
                   $id = DB::_()->insert_id;
                   $id_p= $_POST['page_id'];
                    $_SESSION["info"]  = "Вы успешно создали статью";
                    $_SESSION["inf_class"] = $alerts["info"];
                    $staticpage['id'] = $_POST['page_id'] ;
                    header("location:/".$staticpage['module']);
                     exit();
              }

            }

    }else {
       header("Location: /404");
       exit();

    }

?>
