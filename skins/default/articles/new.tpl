<div class="container">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3  class="text-center">
            Zu bilden, um einen neuen Artikel erstellen <?php echo $p['module'];?>
        </h3>
      </div>
      <div class="panel-body">
        <form action="" method ='post'  enctype="multipart/form-data" class="form-horizontal col-md-8 col-md-offset-2 art_new_form" role="form">
           <div class="form-group  col-xs-8 ">
              <label for="art_title">Ihre Überschrift</label>
              <input type="text" name="title"class="form-control" value="<?php echo @$_POST['title'] ; ?>"  id="art_title" placeholder="Ваш заголовок">

              <?php echo @$errors["title"] ?>

           </div>

          <?php  if ($p['module'] == 'video') { ?>
            <div class="form-group col-xs-8  ">
               <label for="image_url">Foto</label>
               <input type="file" name="file" id="image_url">
               <?php echo @$errors["file"]; ?>
               <p class="help-block"> Bitte wählen Sie ein Bild (im Format jpeg png gif)</p>
            </div>
            <div class="form-group  col-xs-12 ">
               <label for="art_video">Ihr Video</label>
                 <input type="text" name="video"class="form-control" value="<?php echo @$_POST['video'] ; ?>"  id="art_video" placeholder="video">
                <?php echo @$errors["video"] ?>
            </div>
       <?php } elseif ($p['module'] == 'galerie') {  ?>
                  <div class="form-group col-xs-8  ">
                     <label for="image_url">Foto</label>
                     <input type="file" name="file" id="image_url">
                    <?php echo @$errors["file"]; ?>
                     <p class="help-block"> Bitte wählen Sie ein Bild (im Format jpeg png gif)</p>
                  </div>
     <?php  } ?>

            <div class="form-group   col-xs-12">
                <button type="submit" class="btn btn-default">Artikel stellen</button>
            </div>
        </form>
     </div>


  </div>
</div>

</div>

