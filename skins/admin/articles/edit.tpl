 <div class="container">
    <div class="row">
       <div class="panel panel-default">
         <div class="panel-heading bg-danger"><h3  class="text-center">Zu bilden, um Ihren Artikel bearbeiten</h3></div>
           <div class="panel-body">
            <form action="" method = 'post'  enctype="multipart/form-data" class="form-horizontal col-md-8 col-md-offset-2" role="form">
                <div class="form-group  col-xs-8 ">
                   <label for="art_title">Ihre Überschrift</label>
                   <input type="text" name="title"class="form-control" value="<?php
                    if (!isset($_POST['title'])) { echo $row['title'] ; } else { echo $_POST['title'] ; }?> "  id="art_title"    placeholder="Ваш заголовок">
                     <?php echo @$errors["title"] ?>
                 </div>

        <?php if ($row['module'] == 'video' && $row['id'] == $_GET['key2']) { ?>
            <?php //wtf($_GET) ;?>


           <div class="form-group  col-xs-12 ">
             <label for="art_video">Video</label>
             <textarea class="form-control" name='video'  id="art_text" rows="8">

            <?php if (!isset($_POST['video'])) { echo $row['video'] ; } else { echo $_POST['video'] ; }?>
            </textarea>
              <?php echo @$errors["video"] ; ?>
            </div>
              <div class="form-group col-xs-12 ">
                      <label for="image_url">FOTO</label>
                      <input type="file" name="file" id="image_url">
                      <?php echo @$errors["file"] ; ?>
                      <p class="help-block"> Bitte wählen Sie ein Bild (im Format jpeg png gif)</p>
             </div>
      <?php } elseif ( $row['module'] != 'galerie' && $row['module'] != 'video'){ ?>
           <div class="form-group   col-xs-12">
             <label for="art_text">Ваша статья</label>
             <textarea class="form-control" name='text'  id="art_text" rows="8">
             <?php if (!isset($_POST['text'])){echo $row['text'] ; } else {echo $_POST['text'] ; }?></textarea>
              <?php echo @$errors["text"] ; ?>
           </div>

   <?php }elseif ( $row['module'] == 'galerie' ) {  ?>
              <div class="form-group col-xs-12 ">
                      <label for="image_url">File input</label>
                      <input type="file" name="file" id="image_url">
                      <?php echo @$errors["file"] ; ?>
                      <p class="help-block"> Bitte wählen Sie ein Bild (im Format jpeg png gif)</p>
             </div>
   <?php } ?>

       </div>



       <div class="form-group   ">
       <button type="submit" class="btn btn-warning  btn-lg center-block " style= "width: 150px">Update</button>
       <a href="/admin/articles" class="btn btn-info btn-sm">Back</a>
        </div>
    </form>

    </div>
  </div>

  </div>
 </div>