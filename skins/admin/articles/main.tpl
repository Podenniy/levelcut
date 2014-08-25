<div class="container">
    <?php //echo $_SESSION['info']; ?>
   <div class="row">
   <div class="panel panel-info">
      <div class="panel-heading "><h3 class="text-center bg-info">Zu bilden, um einen neuen Artikel für die Seite zu erstellen </h3></div>
      <div class="panel-body">

          <div class="panel-group" id="accordion">


            <?php
                $i = 0 ;
                $b = 0;
                $m  = array();
                $m_result = array();

                while ($p_all =$all_p->fetch_assoc()){
              ?>
            <?php
                $ar = q( "
                   SELECT title, id , page_id
                   FROM  `articles`
                   WHERE  page_id = ".$p_all['id']."
                ");
               ?>
               <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <button type="button" class="center-block   btn-lg btn-block btn-success" data-toggle="collapse" data-target="<?php  echo '#collapse'.$i ; ?>" style="width:150px" >Seite <?php echo $p_all['module'] ;?><br>

                      </button>

                    </h4>
                  </div>

               <div id="<?php  echo 'collapse'.$i ; ?>" class="panel-collapse collapse">
                 <div class="panel-body">
                    <ul>
                        <?php
                            while ($_all = $ar->fetch_assoc() ){
                                //wtf($_all,1);
                        ?>
                            <li   style="margin: 0 0 5px 0 ;">
                                <span><?php echo $_all['title'] ?></span>
                                <a href=" <?php echo '/admin/articles/show/'.$_all['id']; ?>" class=" btn btn-info btn-sm">Show
                                </a>
                               <a href=" <?php echo '/admin/articles/edit/'.$_all['id']; ?>" class=" btn btn-primary btn-sm">bearbeiten
                                </a>
                                 <button class="btn  btn-danger btn-sm" data-toggle="modal" data-target="<?php echo '#myModal'.$b ;?> ">zu entfernen</button>

                               <?php   include './skins/admin/articles/modale.tpl';


                                ?>


                            </li>


                        <?php
                          ++$b ;
                             };
                         ?>
                         <li>
                            <a href= <?php echo "/admin/articles/new/".$p_all['id']?> class = "center-block btn btn-default btn-small btn-warning">einen neuen Artikel erstellen</a>
                         </li>
                     </ul>
                </div>
               </div>
             </div>
      <?php
       ++$i;
          }
        ?>

    </div>

    <?php
       $all_p ->close();
    ?>



< ? php

?>

       </div>
      </div>
    </div>
  </div>