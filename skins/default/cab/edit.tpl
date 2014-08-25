<div class="row  edit_user" >
     <div class="col-md-3 pull-left user_ava">

         <img src="<?php echo $_SESSION['user']['avatar'] ;?>" alt="...">
     </div>
     <div class="col-md-9  pull-right">
        <?php
            //wtf($_FILES,1);
            //wtf($matches,1);
            //echo count($_FILES);
            //echo $view;
         ?>
      <div class="row">
           <form action="" method="post" enctype="multipart/form-data" role="form" class="col-md-4 col-md-offset-2" >
                <h3>Ваши данные</h3>

                <div class="form-group ">
                      <label for="user_email">Ваш email</label>
                      <input type="text" name="email" value="<?php echo $_SESSION['user']['email']; ?>" class="form-control" id="user_email" >
                      <?php
                         echo @$errors["email"];
                      ?>
                </div>

                <div class="form-group ">
                      <label for="user_login">Ваш логин</label>
                      <input type="text" name="login" value="<?php echo $_SESSION['user']['login']; ?>" class="form-control" id="user_login" >
                      <?php
                         echo @$errors["login"];
                      ?>
                </div>

                <div class="form-group ">
                      <label for="user_avatar">File input</label>
                      <input type="file" name="file" id="user_avatar">
                      <?php
                         echo @$errors["file"];
                      ?>
                      <p class="help-block">Выбирете свою картинку (в формате jpeg png gif)</p>
                </div>

              <input type="submit"  name="submit" class="btn btn-default">
           </form>
      </div>
    </div>
</div>