<?php
class DB {
  static public $mysqli = array();
  static public $connect = array();

  static public function _($key = 0) {
    if(!isset(self::$mysqli[$key])) {
      if(!isset(self::$connect['server']))
        self::$connect['server'] = Core::$DATABASE_HOST;
      if(!isset(self::$connect['user']))
        self::$connect['user'] = Core::$DATABASE_USERNAME ;
      if(!isset(self::$connect['pass']))
        self::$connect['pass'] = Core::$DATABASE_PASSWORD;
      if(!isset(self::$connect['db']))
        self::$connect['db'] = Core::$DATABASE_NAME;

      self::$mysqli[$key] = @new mysqli(self::$connect['server'],self::$connect['user'],self::$connect['pass'],self::$connect['db']); // WARNING
      if (mysqli_connect_errno()) {
        echo 'Не удалось подключиться к Базе Данных';
        exit;
      }
      if(!self::$mysqli[$key]->set_charset("utf8")) {
        echo 'Ошибка при загрузке набора символов utf8:'.self::$mysqli[$key]->error;
        exit;
      }
    }
    return self::$mysqli[$key];
  }
  static public function close($key = 0) {
    self::$mysqli[$key]->close();
    unset(self::$mysqli[$key]);
  }
}



////////////////////////// wtf(); ----->> ВЫВОД МАСИВА НА ЭКРАН
 function wtf($value, $stop = false)
 {
   echo "<pre>".print_r($value,1)."</pre>";
   if (!$stop) {
     exit();
   }
 }


 ////////////////////////////// q(); ------->>  ДОРАБОТАНАЯ  ФУНКЦИЯ ЗАПРОСОВ
function q($query,$key = 0) {
  $res = DB::_($key)->query($query);
  if($res === false) {
    $info = debug_backtrace();
    $error = "QUERY: ".$query."<br>\n".DB::_($key)->error."<br>\n".
             "file: ".$info[0]['file']."<br>\n".
         "line: ".$info[0]['line']."<br>\n".
         "date: ".date("Y-m-d H:i:s")."<br>\n".
         "===================================";

    file_put_contents('./logs/mysql.log',strip_tags($error)."\n\n",FILE_APPEND);
    echo $error;
    exit();
  }
  return $res;
}

 ////////////////////////////// inta(); ------->>  ДОРАБОТАНАЯ  ФУНКЦИЯ(float);
 function inta($el){
    if (!is_array($el)) {
      $el = (int)($el);
    }else {
      $el = array_map('inta', $el);
    }
    return $el;
 };

////////////////////////////// trim_ALL(); ------->>  ДОРАБОТАНАЯ  ФУНКЦИЯ trim();
 function ta($array){
    if (!is_array($array)) {
      $array = trim($array);
    }else {
      $array = array_map('ta', $array);
    }
    return $array;
 };

  ////////////////////////////// fla(); ------->>  ДОРАБОТАНАЯ  ФУНКЦИЯ(int);
 function fla($el){
    if (!is_array($el)) {
      $el = (float)($el);
    }else {
      $el = array_map('fla', $el);
    }
    return $el;
 };

  ////////////////////////////// hc(); ------->>  ДОРАБОТАНАЯ  ФУНКЦИЯ htmlspecialchars();
 function hc($el){
    if (!is_array($el)) {
      $el = htmlspecialchars($el);
    }else {
      $el = array_map('hc', $el);
    }
    return $el;
 };
  ////////////////////////////// hc(); ------->>  ДОРАБОТАНАЯ  ФУНКЦИЯ mysqli_real_escape_string($link, $el);;
 function es($el,$key = 0) {
  return DB::_($key)->real_escape_string($el);
}
 ////////////////////////////// autoload

 function __autoload($class){
   include "./libs/class_".$class.".php";
 }

////////////////////////////// myHash(); --------->> Для обработки пароля в hash
 function myHash($pass){
    $salt = "ABCD";
    $salt2 = "poert234";
    $pass = crypt(md5($pass.$salt),$salt2);
    return $pass;
 };

/////////////////////////////////////resize

 function create_thumbnail($path, $save, $width, $height) {
    $info = getimagesize($path); //получаем размеры картинки и ее тип
    $size = array($info[0], $info[1]); //закидываем размеры в массив

        //В зависимости от расширения картинки вызываем соответствующую функцию
    if ($info['mime'] == 'image/png') {
        $src = imagecreatefrompng($path); //создаём новое изображение из файла
    } else if ($info['mime'] == 'image/jpg') {
        $src = imagecreatefromjpeg($path);
    } else if ($info['mime'] == 'image/gif') {
        $src = imagecreatefromgif($path);
    }else if ($info['mime'] == 'image/jpeg') {
        $src = imagecreatefromjpeg($path);
    } else {
        return false;
    }

    $thumb = imagecreatetruecolor($width, $height); //возвращает идентификатор изображения, представляющий черное изображение заданного размера
    $src_aspect = $size[0] / $size[1]; //отношение ширины к высоте исходника
    $thumb_aspect = $width / $height; //отношение ширины к высоте аватарки

    if($src_aspect < $thumb_aspect) {        //узкий вариант (фиксированная ширина)      $scale = $width / $size[0];         $new_size = array($width, $width / $src_aspect);        $src_pos = array(0, ($size[1] * $scale - $height) / $scale / 2); //Ищем расстояние по высоте от края картинки до начала картины после обрезки   } else if ($src_aspect > $thumb_aspect) {
        //широкий вариант (фиксированная высота)
        $scale = $height / $size[1];
        $new_size = array($height * $src_aspect, $height);
        $src_pos = array(($size[0] * $scale - $width) / $scale / 2, 0); //Ищем расстояние по ширине от края картинки до начала картины после обрезки
    } else {
        //другое
        $new_size = array($width, $height);
        $src_pos = array(0,0);
    }

    $new_size[0] = max($new_size[0], 1);
    $new_size[1] = max($new_size[1], 1);

    imagecopyresampled($thumb, $src, 0, 0, $src_pos[0], $src_pos[1], $new_size[0], $new_size[1], $size[0], $size[1]);
    //Копирование и изменение размера изображения с ресемплированием

    if($save === false) {
        return imagepng($thumb); //Выводит JPEG/PNG/GIF изображение
    } else {
        return imagepng($thumb, $save);//Сохраняет JPEG/PNG/GIF изображение
    }

}
 function securetext($text){

 $pattern = "#([-0-9a-z_\.]+@[-0-9a-z_\.]+\.[a-z]{2,6})#i";
 $text = preg_replace($pattern, "[контактная информация запрещена]", $text);
 $pattern = "#http://[^\s]+#i";
 $text = preg_replace($pattern, "[ссылки запрещены]", $text);
 $pattern = "#www\.[-\d\w\._&\?=%]+#i";
 $text = preg_replace($pattern, "[ссылки запрещены]", $text);
 return  $text;

}
///////////////// генерируем пароль
function genpass($pass){
  $chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
  $max=10;
  $size=strlen($chars)-1;
  $password=null;
  while($max--)
    $password.=$chars[rand(0,$size)];
  $pass = $password;
  return $pass;
}


function show($arr,$exit=0)                                                     {
    print "<div style=\"border:3px solid green;background-color:white;padding:10px;\">";
    print "<pre>";
    print_r($arr);
    print "</pre>";
    print "</div>";
    if($exit)exit;
}

function sys_parse($region,$file,$data=array()){

  global $template;

  ob_start();

  foreach ($data as $key => $value) {
    $$key = $value;
  }

  if(!file_exists("views/$file.php")){
    show("File not exists: views/$file.php",1);
  }

  include"views/$file.php";

  $r  =ob_get_contents();
  ob_clean();

  if($region===false) return $r;
  else $template[$region]=$r;



}
function sys_render(){
  global $template;

  sys_parse('head','head');
  print sys_parse(false ,'tpl',$template);
  die();
}

function sys_current_script(){
  $url = (!empty($_SERVER['HTTPS']))
    ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']
    : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];


    $url= explode("/", $url);
    return $url[count($url)-1];

}

function sys_redirect($loc){
  header("location: $loc");
  die('0');
}


function db_table_info($table){

  $r = db_query("DESCRIBE `$table`");
  $r = db_result($r);


  foreach ($r as $k => &$v) {
    $vn=array();
    foreach ($v as $k1 => $v1) {$vn[strtolower($k1)]=$v1;}
    $v=$vn;


    $t = explode("(", $v['type']);
    $v['type']=$t[0];
    $v['size']=( count($t)>1 ? str_replace(")", "", $t[1]) : 0 ) ;



  }

  return $r;

}
function db_query($query){
  $r = mysql_query($query);


  if(mysql_error()){
    show(mysql_error());
    show($query,1);
  }


    return $r;
}
function db_insert($table,$data=array()){

  $keys=array('`id`');
  $values=array('NULL',);

  foreach ($data as $key => $value) {
    $keys[]="`$key`";
    $values[]=($value!=null ? "'$value'" : "NULL");

  }
    $keys = implode(',', $keys);
    $values = implode(',', $values);



$sql = " INSERT INTO `$table` ($keys) VALUES ($values);";
// show($sql,1);
  $r = db_query($sql);


}

function db_update($table,$where=array(),$data=array()){

  $set=array();


  if(count($where)){
    $where1=array();
    foreach ($where as $key => $value) $where1[]="`$key`='$value'";
    $where = "WHERE ".implode(' AND ', $where1);
  } else $where='';



  foreach ($data as $key => $value) {
    $set[]="`$key`='$value'";

  }
    $set = implode(',', $set);

$sql = " UPDATE `$table` SET $set $where ";

  $r = db_query($sql);


}


function db_get($table,$where=array(),$limit=array()){


  if($where && count($where)){
    $where1=array();
    foreach ($where as $key => $value) $where1[]="`$key`='$value'";

    $where = " WHERE ".implode(' AND ', $where1);
  } else $where='';

  $qlimit='';
  if(!is_array($limit) && $limit) $qlimit=" LIMIT $limit";
  else if(is_array($limit) && count($limit)==2){
    if(count($limit)==1) $qlimit=" LIMIT {$limit[0]},{$limit[1]}";
  }
  $sql = " SELECT * FROM `$table` $where $qlimit";


  $r = db_query($sql);

  $ret = db_result($r);

  if($limit===1 && count($ret)>0) $ret = $ret = $ret[0];

  return $ret;
}

function db_result($r){

  $ret = array();

  while ($all = mysql_fetch_assoc($r)) {
    $ret[]=$all;
  }

  return $ret;
}




  function character_limiter($str, $n = 500, $end_char = '&#8230;')
  {
    if (strlen($str) < $n)
    {
      return $str;
    }

    $str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));

    if (strlen($str) <= $n)
    {
      return $str;
    }

    $out = "";
    foreach (explode(' ', trim($str)) as $val)
    {
      $out .= $val.' ';

      if (strlen($out) >= $n)
      {
        $out = trim($out);
        return (strlen($out) == strlen($str)) ? $out : $out.$end_char;
      }
    }
  }

