<?php

//wtf($_pgs);
?>

<div class="container">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3  class="text-center">
           bat um eine Web-Seite mit <?php echo $pgs['module'];?>-Artikel
        </h3>
      </div>
      <div class="panel-body">
      <h3  class="text-center"> Seitentite  <?php echo $_all['title'] ?> </h3>
            <div class="content" >
              <div class="video_wrap">
                <div class="video-left">
                    <img src="<?php echo $_all['img_url'] ?>" alt="">

                </div>
                <div class="video-right">
                    <div class="self_video"><?php echo $_all['video'] ; $b="";//wtf($res,1 ) ; ?></div>
                </div>
              </div>


            </div>



      </div>
                 <a href=" <?php echo '/admin/articles/edit/'.$_all['id']; ?>" class=" btn btn-primary btn-sm">bearbeiten
                                </a>
                <button class="btn  btn-danger btn-sm" data-toggle="modal" data-target="#myModal">zu entfernen</button>
           <?php  include './skins/admin/articles/modale.tpl'; ?>
     </div>

  </div>
 </div>
