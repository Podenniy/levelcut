<?php
    /**
    * Mail
    */


    class Mail {
        static $subject = "Вы зарегестрировались на нашем сайте" ;
        static $from = "buka@podenniy.w.pw" ;
        static $to = "budyachocheck@gmail.com" ;
        static $message = "Шаблонное письмо" ;
        static $headers = " ";


        static function send(){
            self::$subject  = '=?utf-8?b?'. base64_encode(self::$subject) .'?=';
            self::$headers  = "Content-type:text/plain;Charset=utf8\r\n";
            self::$headers .= "From: " .self::$from." \r\n";
            self::$headers .= "MIME-Version: 1.0\r\n";
            self::$headers .= "Date: " .date('D, d M Y h:i:s O') ."\r\n";
            self::$headers .= "Precedence: bulk\r\n";

            return mail(self::$to, self::$subject, self::$message, self::$headers);
        }

        static function tesTsend(){
            if(mail(self::$to, " English world", "English world")){
               echo "Письмо отправилось";
            } else {
               echo "Письмо не пришло";
            }
            exit();
        }

    }
?>