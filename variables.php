<?php
/// $_GET[page]

if (isset($_GET['route'])) {
  $staticpage  = array( );
    $temp =  explode('/', $_GET['route']);
    if ($temp[0] == 'admin') {
      Core::$CONT = Core::$CONT.'/admin';
      Core::$SKIN = "admin";
      unset($temp[0]);
    }

    $i = 0;
    foreach ($temp as $k => $v) {
        if ($i== 0) {
            $_GET["module"] = $v;
        }elseif ($i == 1) {

            if (!empty($v) ){
                $_GET["page"] = $v;
            }

        } else {
            $_GET["key".($k-1)] = $v;
        }
        ++$i;
     }
   unset($_GET['route']);
}

if(!isset($_GET['module'])) {
    $_GET['module'] = 'static';

}else{
   $res = q("
      SELECT   *
      FROM    `pages`
      WHERE   `module` = '".es($_GET['module'])."'
      LIMIT 1
    ");
   $res_all = q("
      SELECT   *
      FROM    `pages`
      WHERE   `module` = '".es($_GET['module'])."'

    ");

   if (!$res->num_rows) {
      header("Location: /errors/404");
       exit();
   }else {
     $staticpage_all = $res_all->fetch_assoc();
     $staticpage = $res->fetch_assoc();
     $res->close();
     $res_all->close();
     if($staticpage['static'] == 1){
       $_GET['module'] = 'staticpage';
       $_GET['page'] = 'main';

        $art_res  = q("
           SELECT *
           FROM `articles`
           WHERE `page_id` = ".$staticpage['id']."
       ");
     }
   }

}



if(!isset($_GET['page'])) {

    $_GET['page'] = 'main';

}

if (!preg_match('/^[a-z_-]*$/iu', $_GET['page'])) {
  header("Location: /404");
  exit();
}

//////////////////////////// category
       /// $res_cat = q( "
       ///      SELECT *
       ///         FROM `category`
       ///         ORDER BY `name` DESC
       ///    ");


//////////////////////////////////////////////////////////////////




//////////////// bootstrap allert
$alerts =  array(
   'info' => "alert alert-info alert-dismissable",
   'warning' => "alert alert-warning alert-dismissable"
    ) ;
if(!isset($_SESSION['user']) ){
  $_SESSION['info'] = "Sie noch nicht registriert sind, bitte registrieren oder anmelden, um Ihr Profil !!!!!";
  $_SESSION["inf_class"] = $alerts["warning"];
}

/////////////////////////////////////// $_GET[page] = registration
   // if (isset($_SESSION['regok'])) {
   //
   //  header("location:index.php");
   //   exit();
   // }
////////////////////////////////////////////////////////////////////

///////////////////////






/////////////////////////
?>