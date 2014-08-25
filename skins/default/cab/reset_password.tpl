<?php if (!isset($_SESSION["reset_pass"])) { ?>
       <?php
          // wtf($_FILES,1);
          // wtf($matches,1);
          // echo count($_FILES);

         ?>
<form action="" method="POST"  class="form-signin" role="form">
        <h2 class="form-signin-heading">Введите свой email</h2>

        <input type="text" name="email" value="<?php echo @$_POST["email"];  ?>"  class="form-control" placeholder="email" >
        <?php
              echo @$errors["email"];
         ?>

        <button class="btn btn-lg btn-primary btn-block" type="submit" name=" submit_auth">Востановить пароль</button>
</form>
<?php } else {?>
<div class="jumbotron">
</php>
     <div class='alert alert-info alert-dismissable'>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Вы успешно поменяли пароль на ваш почтовый адрес прийдет письмо с инструкцией для активации нового пароля</strong>

         </div>
</div>
<?php  } ;?>
