
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sign Up &middot; Social Fire</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo base_url("assets/css/bootstrap.css"); ?>" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
    <link href="<?php echo base_url("assets/css/bootstrap-responsive.css"); ?>" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form class="form-signin" name="login_input" action="<?php echo site_url("login/up"); ?>" method="post">
        <h2 class="form-signin-heading">Please sign up</h2>
        
        <input type="text" class="input-block-level" id="name" name="name" value="<?php echo set_value('name'); ?>" placeholder="Full name">
        <?php echo form_error('name');?>

        <input type="text" class="input-block-level" id="matric" name="matric" value="<?php echo set_value('matric'); ?>" placeholder="Matriculation Number">
        <?php echo form_error('matric');?>

        <input type="text" class="input-block-level" id="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="Email address">
        <?php echo form_error('email');?>
        
        <input type="password" class="input-block-level" id="password" name="password" placeholder="Password">
        <input type="password" class="input-block-level" id="c_password" name="c_password" placeholder="Confirm Password">
        <?php echo form_error('password');?>

        <button class="btn btn-large btn-primary" type="submit">Sign up</button>
      </form>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo baser_url("assets/js/jquery.js"); ?>"></script>
    <script src="<?php echo baser_url("assets/js/bootstrap.min.js"); ?>"></script>
  </body>
</html>
