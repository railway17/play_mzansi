<!DOCTYPE html>
<html lang="en">
  <head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="<?php echo base_url().'assets/libraries/jquery-toast/jquery.toast.min.css';?>" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="<?php echo base_url().'assets/styles/auth.css';?>" type="text/css"/>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url().'assets/libraries/jquery-toast/jquery.toast.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/common.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/auth.js'; ?>"></script>
    <script>
      var base_url = "<?php echo base_url();?>";
    </script>
  </head>
  
  <body>
    <!--BEGIN CONTENT-->
    <div class='content'>        
      <div class='col-sm-3 auth-form'>
        <div class="card">
        <article class="card-body">
          <h4 class="card-title text-center mb-4 mt-1">Sign up</h4>
          <hr>
          <!-- <form> -->
          <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
            </div>
            <input name="username" id="username" class="form-control" placeholder="Email or login" type="email">
          </div> <!-- input-group.// -->
          </div> <!-- form-group// -->
          <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
            </div>
              <input name="password" id="password" class="form-control" placeholder="******" type="password">
          </div> <!-- input-group.// -->
          </div> <!-- form-group// -->
          <div class="form-group">
          <button id="btn_register" class="btn btn-primary btn-block"> Sign Up  </button>
          </div> <!-- form-group// -->
          <!-- </form> -->
        </article>
        </div> <!-- card.// -->

      </div>
    </div>
  
  </body>

</html>