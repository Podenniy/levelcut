<?php
if (isset($_SESSION['user'])) {
CORE::$META['title']="Ваш профиль";
    if (isset($_POST["login"], $_POST["email"], $_FILES['file'])) {

          $errors = array();  ////// ERRORS

    //////////////// login

        if (trim($_POST["login"]) != $_POST["login"]) {
          $errors["login"] = "<div class='alert alert-danger'>Не ставте пробелы перед и после logina</div>";
          }elseif (empty($_POST["login"])) {
            $errors["login"] = "<div class='alert alert-danger'>Заполните поле Login</div>";
          }elseif (mb_strlen($_POST["login"]) < 3) {
            $errors["login"] = "<div class='alert alert-danger'>Слишком короткий login</div>";
          }elseif (mb_strlen($_POST["login"]) >16){
            $errors["login"] = "<div class='alert alert-danger'>Слишком большой login</div>";
          }elseif (!preg_match('/^[\w*\s\_\-\&]{3,16}$/ui', $_POST["login"])) {
            $errors["login"] = "<div class='alert alert-danger'>Видимо присутствуют недопустимые символы или не правельная длинна </div>";
          }

    //////////////////////////// email
          if (empty($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "<div class='alert alert-danger'>Заполните поле email</div>";
          }


          if (!count($errors)) {
            $res = q("
                SELECT 'id'
                FROM `users`
                WHERE `login` = '".es($_POST['login'])."'
                LIMIT 1
            ");
            if ($res->num_rows &&$_SESSION['user']['login'] != $_POST['login']) {
              $errors["login"] = "<div class='alert alert-danger'>Такой логин уже занят</div>";
              $res->close();
            }
          }

          if (!count($errors)) {
             $res = q("
                SELECT 'id'
                FROM `users`
                WHERE `email` = '".es($_POST['email'])."'
                LIMIT 1
            ");

             if ($res->num_rows && $_SESSION['user']['email'] != $_POST['email']) {
                $errors["login"] = "<div class='alert alert-danger'>Пользователь с таким  email уже существует </div>";
                $res->close();
              }
          }


      /////////////////////////////////////// uploude
      $img_up_valid = array('image/jpg', 'image/jpeg', 'image/png','image/gif' );
      $img_valid = array('jpg', 'jpeg', 'png','gif' );
      $avatar = $_SESSION['user'] ['avatar'];


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
                          if (file_exists(".".$avatar) && $avatar !=  $def) {
                            unlink(".".$avatar);
                            create_thumbnail(".".$name, ".".$name, 100, 100);
                          }elseif ($avatar ==  $def){
                            create_thumbnail(".".$name, ".".$name, 100, 100);
                          }
                      }

                  }else {
                    $errors["file"] = "<div class='alert alert-danger'>Изображение не загружено! ОШИБКА!</div>";
                  }
              }
          }elseif (empty($_FILES['file']['tmp_name']) && $_FILES['file']['size'] == 0){
           $name = $avatar;
          }



   //////////////////////////////////////////////////

      if (!count($errors)) {
            $res = q( "
                     UPDATE  `users` SET
                    `login`        = '".es($_POST['login'])."',
                    `email`       = '".es($_POST['email'])."',
                    `avatar`       = '".es($name)."'
                     WHERE     `id` = '".(int)$_SESSION['user']['id']."'
                   ");

          $_SESSION["info"]  = "Вы успешно обновили данные";
          $_SESSION["inf_class"] = $alerts["info"];

      header("Location: /cab/edit");
      exit();

      }
    }
}else {
   header("Location: /404");
   exit();
}
?>
