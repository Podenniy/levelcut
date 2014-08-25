
<div class="row">
<div class="panel panel-default">
  <div class="panel-heading"><h3  class="text-center">Форма для редактирования вашей статьи статьи</h3></div>
  <div class="panel-body">

    <form action="" method = 'post' class="form-horizontal col-md-6 col-md-offset-4" role="form">

     <div class="form-group  col-xs-8 ">
        <label for="art_title">Ваш заголовок</label>
        <input type="text" name="title"class="form-control" value="<?php
        if (!isset($_POST['title'])){echo $row['title'];} else{echo $_POST['title'];}?>"  id="art_title" placeholder="Ваш заголовок">
       <?php echo @$errors["title"] ?>
     </div>
     <div class="form-group   col-xs-8">
        <label for="art_desc">Ваше описание</label>
        <textarea class="form-control"   name='desc'   id="art_desc"  rows="3"><?php
         if (!isset($_POST['desc'])){echo $row['description'];} else{echo $_POST['desc'];}?></textarea>
        <?php if (!isset($errors["desc"]) ){; ?>
           <p class="help-block">Не больше 255 символов</p>
        <?php } else {;
              echo @$errors["desc"] ;
         } ?>
     </div>
     <div class="form-group   col-xs-12">
        <label for="art_text">Ваша статья</label>
        <textarea class="form-control" name='text'  id="art_text" rows="8"><?php
        if (!isset($_POST['text'])){echo $row['text'];} else{echo $_POST['text'];}?></textarea>
         <?php echo @$errors["text"] ; ?>
     </div>

     <div class="form-group   col-xs-4">
       <label >Выбор категории</label>
        <select name='cat' class="form-control">
        selected="selected">
        <?php while ($row2 = $res2->fetch_assoc()) {

           if ($row['cat_id'] == $row2['id']) {
               echo "<option value=".$row2['id']." selected >".$row2['name']."</option>";
           }else {
              echo "<option value=".$row2['id'].">".$row2['name']."</option>";
           }
          ?>
        <?php }

        ?>

        </select>
<p></p>
     </div>
     <div class="form-group   col-xs-12">
     <button type="submit" class="btn btn-default">Submit</button>
     <a href="/admin/articles">Back</a>
      </div>
  </form>

  </div>
</div>

</div>
