<?php if (!isset($_SESSION["regok"])) { ?>
       <?php
          // wtf($_FILES,1);
          // wtf($matches,1);
          // echo count($_FILES);

         ?>
<form action="" method="POST" enctype="multipart/form-data" class="form-signin" role="form">
        <h2 class="form-signin-heading">Введите регистрационные данные</h2>
        <input type="text" name="login" value="<?php echo @$_POST["login"]; ?>" class="form-control" placeholder="login" >
        <?php
              echo @$errors["login"];
         ?>
        <input type="text" name="email" value="<?php echo @$_POST["email"];  ?>"  class="form-control" placeholder="email" >
        <?php
              echo @$errors["email"];
         ?>
        <input type="password" name="password" class="form-control" placeholder="Password">
        <?php
              echo @$errors["password"];
         ?>
        <div class="form-group ">
                      <label for="user_avatar">File input</label>
                      <input type="file" name="file" id="user_avatar">
                      <?php
                         echo @$errors["file"];
                      ?>
                      <p class="help-block">Выбирете свою картинку (в формате jpeg png gif)</p>
                </div>
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name=" submit_auth">Зарегистрироваться</button>
</form>
<?php } else {?>
<div class="jumbotron">
     <div class='alert alert-info alert-dismissable'>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Вы успешно зарегестрировались на ваш почтовый адрес прийдет письмо с инструкцией для активации вашей учетной записи</strong>

         </div>
</div>
<?php  } ;?>
