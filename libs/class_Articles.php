<?


  class articles {


    function __construct(){


     if (isset($_SESSION['user']) || $_SESSION['user']['access'] = 5{
        $this->edit_page();
      }
      else if(isset($_GET['subscription_del'])){
        $this->init_del();
      }


    }

    function edit_page($p) {

         if( isset($_GET['page'] ) && $_GET['page'] == "edit"){
              $res = q("
                SELECT  *
                FROM `articles`
                LEFT OUTER JOIN  `pages`
                ON articles.page_id = pages.id
                WHERE `id`= '".$p."'
              ");

          if (!$res->num_rows) {
               header("location:/404");
               exit();
          }else {
              $row = $res->fetch_assoc();
          }

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

                    `text`       =  '".es($_POST['text'])."',

                     WHERE     `id` = '".(int)$row['id']."'
                     LIMIT 1
                   ");
                     header("location:/articles/show/id/".$row['id']);
                     exit();
              }

          }



        }

      return $row ;
    }else {
        header("location:/404");
      exit();
      }
           function init_del(){
                  $mail = $_GET['subscription_del'];
                   $res = TD::getUserMail($mail);
                   if ($res['name'] != $mail) {
                     header("Location: http://xn----7sbbpsl8c.xn--j1amh/menu/subscriptionfoodel");
                   }else {
                     TD::deleteMail($res['name']);
                     header("Location: http://xn----7sbbpsl8c.xn--j1amh/menu/subscriptiongodel");
                     return TD::deleteMail($res['name']);
                   }


                }

  }

  $_subscription = new subscription();
