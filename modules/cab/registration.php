<?php
 unset($_SESSION['info']);
 CORE::$META['title']="Регистрация";
//////////////Обработка регистрации

if (isset($_POST["login"], $_POST["email"], $_POST["password"])) {


      $errors = array();  ////// ERRORS

//////////////// login
  //if (empty($_POST["login"])) {
  //    $errors["login"] = "<div class='alert alert-danger'>Заполните поле Login</div>";
  //}elseif (mb_strlen($_POST["login"]) < 3) {
  //  $errors["login"] = "<div class='alert alert-danger'>Слишком короткий login</div>";
  //}elseif (mb_strlen($_POST["login"]) >16){
  //  "<div class='alert alert-danger'>Слишком большой login</div>";
  //}

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

   if (mb_strlen($_POST["password"]) < 3) {
      $errors['password'] = "<div class='alert alert-danger'>Пароль должен быть длиннее 4-х символов</div>";
   }

   if (!count($errors)) {
     $res = q("
          SELECT 'id'
          FROM `users`
          WHERE `login` = '".es($_POST['login'])."'
          LIMIT 1
      ");
     if ($res->num_rows) {
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
     if ($res->num_rows) {
        $errors["login"] = "<div class='alert alert-danger'>Пользователь с таким  email уже существует </div>";
        $res->close();
     }
   }
    /////////////////////////////////////// uploude
   $img_up_valid = array('image/jpg', 'image/jpeg', 'image/png','image/gif' );
   $img_valid = array('jpg', 'jpeg', 'png','gif' );
   //$avatar = $_SESSION['user'] ['avatar'];


      if ($_FILES['file']['error'] == 0 && !empty($_FILES['file']['tmp_name'])){
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
                     create_thumbnail(".".$name, ".".$name, 100, 100);

                  }

              }else {
                $errors["file"] = "<div class='alert alert-danger'>Изображение не загружено! ОШИБКА!</div>";
              }
          }
      }elseif (empty($_FILES['file']['tmp_name']) && $_FILES['file']['size'] == 0){
           $name = "/skins/default/img/default.gif";
      }else{
         $errors["file"] = "<div class='alert alert-danger'>Изображение не загружено! ОШИБКА!</div>";
      }

   if (!count($errors)) {
      q(" INSERT INTO `users` SET
            `login`        = '".es($_POST['login'])."',
            `email`       = '".es($_POST['email'])."',
            `avatar`       = '".es($name)."',
            `password` = '".myHash($_POST['password'])."',
            `hash`        = '".myHash($_POST['login'].$_POST['email'] )."'
            ");

      $id = DB::_()->insert_id;

      $_SESSION["regok"] = "ok";
      Mail::$to           = $_POST['email'];
      Mail::$subject   = "Вы зарегестрировались на сайте";
      Mail::$message = 'пройдите по ссылке для активации вашего аккаунта http// '.Core::$DOMAIN.'cab/activate&id='.$id.'&hash='.myHash($_POST['login'].$_POST['email']).' ';
      Mail::send();


      header("Location: /cab/registration");
      exit();

   }
}
?>