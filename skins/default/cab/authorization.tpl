
 <div class="container">
     <div class='row'>
          <div class="alert alert-warning col-md-6 col-md-offset-3 " style="text-aling: center !important ;">
                 <?php echo $_SESSION['info']; ?>

              </div>

      <form class="form-signin" method="POST"  role="form">
        <h2 class="form-signin-heading">Bitte melden Sie sich</h2>
        <div>
          <input type="text"  name="login" class="form-control" placeholder="login" >
          <?php echo @$errors["login"]; ?>
        </div>
        <div>
          <input type="password" name="password"  class="form-control" placeholder="Password" >
           <?php echo @$errors["password"]; ?>
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox" name="save_cooce"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" name="auth"type="submit">Sign in</button>
      </form>

    </div>
</div>
