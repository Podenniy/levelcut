<?php
if (isset($_SESSION['user'])){
   unset($_SESSION['info']);


}
   CORE::$META['title']="Статьи";
/////////////////// Paginator
$limit = 5;

////////////////////////////////
if ($_GET['module']== 'articles' &&  $_GET['page'] =='main' ) {

  //  ССЫЛКИ ДЛЯ СОРТИРОВКИ
    $sort_art = array('date' => '/articles/main/from_date' , 'rating' => '/articles/main/from_rating');

    $art = "WHERE articles.id";
    $view_from = "ORDER BY `rating` DESC";

      if (isset($_GET['key1']) && $_GET['key1'] == 'from_rating' ) {
          $view_from = "ORDER BY `rating` DESC";
       }elseif (isset($_GET['key1']) && $_GET['key1'] == 'from_date'){
          $view_from = "ORDER BY `date` DESC";
       }
    if (isset($_GET['key1'] ) && $_GET['key1'] == "category"){

       $sort_art['rating']= "/articles/main/category/".(int)$_GET['key2']."/from_rating" ;
       $sort_art['date']= "/articles/main/category/".(int)$_GET['key2']."/from_date" ;

       $art = "WHERE category.id = ";
       $art = $art.(int)$_GET['key2'];

       if (isset($_GET['key3']) && $_GET['key3'] == 'from_rating' ) {
          $view_from = "ORDER BY `rating` DESC";
       }elseif (isset($_GET['key3']) && $_GET['key3'] == 'from_date'){
          $view_from = "ORDER BY `date` DESC";
       }elseif (isset($_GET['key3']) && $_GET['key3'] != 'from_rating' ||  isset($_GET['key3']) && $_GET['key3'] != 'from_date') {
          header("location:/404");
          exit();
       }
     }elseif ((isset($_GET['key1'] ) && $_GET['key1'] == "author_id") ) {
            $sort_art['rating']= "/articles/main/author_id/".(int)$_GET['key2']."/from_rating" ;
            $sort_art['date']= "/articles/main/author_id/".(int)$_GET['key2']."/from_date";

             if (isset($_GET['key3']) && $_GET['key3'] == 'from_rating' ) {
              $view_from = "ORDER BY `rating` DESC";
             }elseif (isset($_GET['key3']) && $_GET['key3'] == 'from_date'){
             $view_from = "ORDER BY `date` DESC";
             }elseif (isset($_GET['key3']) && $_GET['key3'] != 'from_rating' ||  isset($_GET['key3']) && $_GET['key3'] != 'from_date') {
          header("location:/404");
          exit();
        }
        $art = "WHERE users.id = ";
        $art = $art.(int)$_GET['key2'];
     }
    $limit = 4;
    $ct=count($_GET)-2;
    $n =$ct+1;
    $_GET['key'.$ct.''] ='page';

   $_GET['key'.$n.''] = 1;
   $page_view =  (int)$_GET['key'.$n.''] * ($limit -1);
 //$res = q("
 //  SELECT  `login`, `avatar`, `name`, `title`, `text`, `description`, articles.date, articles.id , `cat_id`, articles.user_id, articles.rating,
 //        (SELECT COUNT( votes.vote_like) FROM votes WHERE votes.article_vid = articles.id) AS `count_like`,
 //         (SELECT COUNT( votes.vote_unlike)FROM votes WHERE votes.article_vid = articles.id) AS `count_unlike`
 //  FROM `articles`
 //  LEFT JOIN users ON users.id = articles.user_id
 //  LEFT JOIN category ON category.id = articles.cat_id
 //   ".$art."
  // ".$view_from."
  // LIMIT ".$page_view." , ".$limit."
//
  //");
  //if (!$res->num_rows) {
  //   if (isset($_GET['key1'] ) && $_GET['key1'] == "author_id") {
  //      $_SESSION["info"]  = "У вас пока нет ни одной статьи";
  //       $_SESSION["inf_class"] = $alerts["info"];
    ////  }else {
    ////      header("location:/404");
    ////      exit();
    ////}
}

$rpg =  q( "
      SELECT   *
      FROM    `pages`
      WHERE   `static` = 1
    ");
////////////////////////////////////////

?>