<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title><?php echo hc(Core::$META['title']); ?></title>

    <!-- Bootstrap core CSS -->
    <link href="/skins/<?php echo Core::$SKIN ; ?>/css/bootstrap.min.css"  rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href='/skins/<?php echo Core::$SKIN ; ?>/css/style.css' rel="stylesheet">
     <?php
      //switch (Core::$JS) {
      //  case 'value':
      //    # code...
      //    break;
      //
      //  default:
      //    # code...
      //    break;
      //}
     ?>
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>




        <?php echo $content ;?>

         <footer>
          <p>
            <?php
               if(date("Y") > Core::$YER_NOW){
                     echo "&copy; Company". Core::$YER_NOW."-".date("Y");
                }else{
                     echo "&copy; Company". Core::$YER_NOW;
                }
            ?>
          </p>
         </footer>
      </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

    <script src="/skins/<?php echo Core::$SKIN ; ?>/js/bootbox.min.js"></script>
     <script type="text/javascript">
  (document).ready(function(){
    $(".ppp").click(function(){
        $("#myModal").modal('show');
    });
});
</script>

  </body>
</html>
