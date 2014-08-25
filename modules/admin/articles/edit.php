<?php

if (isset($_SESSION['user']) || $_SESSION['user']['access'] = 5)  {

    if( isset($_GET['page'] ) && $_GET['page'] == "edit"){
      $res = q("
        SELECT  `title`, text , articles.id, img_url, video, module
        FROM `articles`
        LEFT JOIN pages ON pages.id = articles.page_id

        WHERE articles.id= '".$_GET['key2']."'
        LIMIT 1

      ");


      if (!$res->num_rows) {
          header("location:/404");
          exit();
      }else {
          $row = $res->fetch_assoc();
       }


      if (isset($_POST['title'], $_POST['video'],  $_FILES['file'] ) ) {
         $errors = array();  ////// ERRORS

              if (empty($_POST['title'])){
              $errors["title"] = "<div class='alert alert-danger'>Это поле не может быть пустым</div>";
             }

              //securetext($_POST['text']);
              ///securetext($_POST['desc']);
              securetext($_POST['title']);

                   $img_up_valid = array('image/jpg', 'image/jpeg', 'image/png','image/gif' );
                  $img_valid = array('jpg', 'jpeg', 'png','gif' );
               $self_img =$row['img_url'];



          if ($_FILES['file']['error'] == 0) {
              if ($_FILES['file']['size'] < 5000 || $_FILES['file']['size'] > 500000) {
                  $errors["file"] = "<div class='alert alert-danger'>Размер данного файла неподходит </div>";
              }else {
                  preg_match('/\.([a-z]+)$/ui',$_FILES['file']['name'], $matches);
                  if (isset($matches[1])) {
                      $matches[1] = mb_strtolower($matches[1]);
                      $temp = getimagesize($_FILES['file']['tmp_name']);
                      $name = '/uplouded/'.date('Ymd-His').'img'.rand(10000,99999).'.jpg';
                      if (!in_array($matches[1], $img_valid)) {
                        $errors["file"] = "<div class='alert alert-danger'> неподходит разширение изображения </div>";
                      }elseif (!in_array($temp['mime'],$img_up_valid)) {
                        $errors["file"] = "<div class='alert alert-danger'> неподходит тип файла  </div>";
                      }elseif (!move_uploaded_file($_FILES['file']['tmp_name'],'.'.$name)) {
                        $errors["file"] = "<div class='alert alert-danger'>Изображение не загружено! ОШИБКА!</div>";
                      }else {
                          $def = "/skins/default/img/default.gif";
                          if (file_exists(".".$self_img) && $self_img !=  $def) {
                            unlink(".".$self_img);
                            create_thumbnail(".".$name, ".".$name, 200, 200);
                          }elseif ($self_img ==  $def){
                            create_thumbnail(".".$name, ".".$name, 200, 200);
                          }
                      }

                  }else {
                    $errors["file"] = "<div class='alert alert-danger'>Изображение не загружено! ОШИБКА!</div>";
                  }
              }
          }elseif (empty($_FILES['file']['tmp_name']) && $_FILES['file']['size'] == 0){
           $name = $self_img;
           }

             if (!count($errors)){
                q( "
                     UPDATE  `articles` SET
                    `title`              = '".es($_POST['title'])."',

                    `video`              =  '".es($_POST['video'])."',
                    `img_url`         = '".es($name)."'
                     WHERE     `id` = '".(int)$_GET['key2']."'
                     LIMIT 1
                   ");
                     header("location:/admin/articles");
                     exit();
              }

          }elseif (isset($_POST['title'], $_FILES['file'] )){
                $errors = array();  ////// ERRORS

              if (empty($_POST['title'])){
              $errors["title"] = "<div class='alert alert-danger'>Это поле не может быть пустым</div>";
             }

              //securetext($_POST['text']);
              ///securetext($_POST['desc']);
              securetext($_POST['title']);

                   $img_up_valid = array('image/jpg', 'image/jpeg', 'image/png','image/gif' );
                  $img_valid = array('jpg', 'jpeg', 'png','gif' );
               $self_img =$row['img_url'];



          if ($_FILES['file']['error'] == 0) {
              if ($_FILES['file']['size'] < 5000 || $_FILES['file']['size'] > 500000) {
                  $errors["file"] = "<div class='alert alert-danger'>Размер данного файла неподходит </div>";
              }else {
                  preg_match('/\.([a-z]+)$/ui',$_FILES['file']['name'], $matches);
                  if (isset($matches[1])) {
                      $matches[1] = mb_strtolower($matches[1]);
                      $temp = getimagesize($_FILES['file']['tmp_name']);
                      $name = '/uplouded/'.date('Ymd-His').'img'.rand(10000,99999).'.jpg';
                      if (!in_array($matches[1], $img_valid)) {
                        $errors["file"] = "<div class='alert alert-danger'> неподходит разширение изображения </div>";
                      }elseif (!in_array($temp['mime'],$img_up_valid)) {
                        $errors["file"] = "<div class='alert alert-danger'> неподходит тип файла  </div>";
                      }elseif (!move_uploaded_file($_FILES['file']['tmp_name'],'.'.$name)) {
                        $errors["file"] = "<div class='alert alert-danger'>Изображение не загружено! ОШИБКА!</div>";
                      }else {
                          $def = "/skins/default/img/default.gif";
                          if (file_exists(".".$self_img) && $self_img !=  $def) {
                            unlink(".".$self_img);
                            create_thumbnail(".".$name, ".".$name, 114, 140);
                          }elseif ($self_img ==  $def){
                            create_thumbnail(".".$name, ".".$name, 114, 140);
                          }
                      }

                  }else {
                    $errors["file"] = "<div class='alert alert-danger'>Изображение не загружено! ОШИБКА!</div>";
                  }
              }
          }elseif (empty($_FILES['file']['tmp_name']) && $_FILES['file']['size'] == 0){
           $name = $self_img;
           }

             if (!count($errors)){
                q( "
                     UPDATE  `articles` SET
                    `title`              = '".es($_POST['title'])."',
                    `img_url`         = '".es($name)."'
                     WHERE     `id` = '".(int)$_GET['key2']."'
                     LIMIT 1
                   ");
                     header("location:/admin/articles");
                     exit();
              }

          }
     }
}else{
    header("location:/404");
    exit();
}

?>
