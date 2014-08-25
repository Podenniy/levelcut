<?php
if(isset($_SESSION['user']) && $_SESSION['user']['access'] = 5) {
       $res = q( "
              SELECT *
              FROM `pages`
              WHERE id = '".(int)$_GET['key2']."'
              LIMIT 1
            ");
     $p = $res->fetch_assoc() ;
     $res->close();


$errors = array();

      if (isset($_POST['title'],$_POST['text'])) {


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
                   `page_id`         = '".(int)$p['id']."',

                  ");
                   $id = DB::_()->insert_id;
                   $id_p= $_POST['page_id'];
                    $_SESSION["info"]  = "Вы успешно создали статью";
                    $_SESSION["inf_class"] = $alerts["info"];
                    $staticpage['id'] = $_POST['page_id'] ;
                    header("location:/".$staticpage['module']);
                     exit();
              }

            } elseif (isset($_POST['title'], $_POST['video'], $_FILES['file'])) {
                    if (empty($_POST['video'])) {
                       $errors["text"] = "<div class='alert alert-danger'>Это поле не может быть пустым</div>";
                      }

                     if (empty($_POST['title'])){
                     $errors["title"] = "<div class='alert alert-danger'>Это поле не может быть пустым</div>";
                    }
                       //securetext($_POST['text']);

                       securetext($_POST['title']);

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
                                 $errors["file"] = "<div class='alert alert-danger'> неподходит разширение             изображения </div>";
                              }elseif (!in_array($temp['mime'],$img_up_valid)) {
                                $errors["file"] = "<div class='alert alert-danger'> неподходит тип файла  </div>";
                              }elseif (!move_uploaded_file($_FILES['file']['tmp_name'],'.'.$name)) {
                                $errors["file"] = "<div class='alert alert-danger'>Изображение не загружено!             ОШИБКА!</div>";
                              }else {
                                 create_thumbnail(".".$name, ".".$name, 200, 200);

                              }

                          }else {
                            $errors["file"] = "<div class='alert alert-danger'>Изображение не загружено! ОШИБКА!</            div>";
                          }
                      }
                  }elseif (empty($_FILES['file']['tmp_name']) && $_FILES['file']['size'] == 0){
                       $name = "/skins/default/img/default.gif";
                  }else{
                     $errors["file"] = "<div class='alert alert-danger'>Изображение не загружено! ОШИБКА!</div>";
                  }

                        if (!count($errors)){
                          q(" INSERT INTO `articles` SET
                              `title`           = '".es($_POST['title'])."',
                              `video`           = '".es($_POST['video'])."',
                              `page_id`         = '".(int)$p['id']."',
                               `img_url` = '".es($name)."'
                             ");
                              $id = DB::_()->insert_id;
                              $id_p= $_POST['page_id'];
                               $_SESSION["info"]  = "Вы успешно создали статью";
                               $_SESSION["inf_class"] = $alerts["info"];
                               $staticpage['id'] = $_POST['page_id'] ;
                               header("location:/".$p['module']);
                                exit();
                         }

            } elseif (isset($_POST['title'], $_FILES['file'])) {

                 if (empty($_POST['title'])){
                     $errors["title"] = "<div class='alert alert-danger'>Это поле не может быть пустым</div>";
                    }
                       //securetext($_POST['text']);

                       securetext($_POST['title']);

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
                                 $errors["file"] = "<div class='alert alert-danger'> неподходит разширение             изображения </div>";
                              }elseif (!in_array($temp['mime'],$img_up_valid)) {
                                $errors["file"] = "<div class='alert alert-danger'> неподходит тип файла  </div>";
                              }elseif (!move_uploaded_file($_FILES['file']['tmp_name'],'.'.$name)) {
                                $errors["file"] = "<div class='alert alert-danger'>Изображение не загружено!             ОШИБКА!</div>";
                              }else {
                                 create_thumbnail(".".$name, ".".$name, 114, 140);

                              }

                          }else {
                            $errors["file"] = "<div class='alert alert-danger'>Изображение не загружено! ОШИБКА!</            div>";
                          }
                      }
                  }elseif (empty($_FILES['file']['tmp_name']) && $_FILES['file']['size'] == 0){
                       $name = "/skins/default/img/default.gif";
                  }else{
                     $errors["file"] = "<div class='alert alert-danger'>Изображение не загружено! ОШИБКА!</div>";
                  }

                        if (!count($errors)){
                          q(" INSERT INTO `articles` SET
                              `title`           = '".es($_POST['title'])."',
                              `page_id`         = '".(int)$p['id']."',
                               `img_url` = '".es($name)."'
                             ");
                              $id = DB::_()->insert_id;
                              $id_p= $_POST['page_id'];
                               $_SESSION["info"]  = "Вы успешно создали статью";
                               $_SESSION["inf_class"] = $alerts["info"];
                               $staticpage['id'] = $_POST['page_id'] ;
                               header("location:/".$p['module']);
                                exit();
                         }
            }

    }else {
       header("Location: /404");
       exit();

    }


?>

