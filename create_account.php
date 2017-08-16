<?php
    require_once 'core/init.php';
    include 'includes/head.php';
    include 'includes/navigation.php';
    include 'includes/headerfull.php';

    if(isset($_POST['add'])){
     $first_name = ((isset($_POST['first_name']))?sanitize($_POST['first_name']):'');
     $last_name = ((isset($_POST['last_name']))?sanitize($_POST['last_name']):'');
     $email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
     $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
     $confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
     $errors = array();
     if($_POST){
      $emailQuery = $db->query("SELECT * FROM customers WHERE email = '$email'");
      $emailCount = mysqli_num_rows($emailQuery);

      if($emailCount != 0){
       $errors[] = 'That email address is already registered!';
      }

      $required = array('first_name', 'last_name', 'email', 'password', 'confirm');
      foreach($required as $f){
       if(empty($_POST[$f])){
        $errors[] = 'Your must fill out all the fields!';
        break;
       }
      }
      if(strlen($password) <6){
       $errors[] = 'Your password must at least be 6 characters long!';
      }

      if($password != $confirm){
       $errors[] = 'Your passwords mismatch!';
      }

      if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
       $errors[] = 'You must enter a valid email address!';
      }

      if(!empty($errors)){
       echo display_errors($errors);
      }else{
       //add user to db
       $hashed = password_hash($password,PASSWORD_DEFAULT);
       $db->query("INSERT INTO `customers` (`id`, `first_name`, `last_name`, `email`, `password`, `join_date`, `last_login`) VALUES (NULL, '$first_name', '$last_name','$email', '$hashed', CURRENT_TIMESTAMP, '2017-05-01 00:00:00')");
       $_SESSION['success_flash'] = 'Account has been Created!' ;
       header('Location: index.php');
      }
     }
   }
?>
<div class="col-md-5">
  <h2 class="text-left">LOGIN</h2>
  <hr>
<div class="col-md-6" id="login-form">
    <form name="formLogin" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    <div class="form-group">
        <label for="inputEmail">Email Address *</label>
        <input type="email" class="form-control" id="inputEmail" placeholder="Email">
    </div>
    <div class="form-group">
        <label for="inputPassword">Password *</label>
        <input type="password" class="form-control" id="inputPassword" placeholder="Password">
    </div>
    <div class="checkbox">
        <label><input type="checkbox">Remember Me</label>
    </div>
    <button type="submit" class="btn btn-primary">SIGN IN</button>
</form>
</div>
</div>

<div class="col-md-7">
  <h2 class="text-left">CREATE NEW CUSTOMER ACCOUNT</h2>
  <hr>
<div class="col-md-4" id="login-form">
    <form method="post" action="create_account.php?add=1">
        <!-- <div class="form-group">
      <label for="gender">Please select your gender</label>
      <div class="col-s-5 inputGroupContainer">
        <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-option-vertical"></i></span>
        <select class="form-control" id="gender">
          <option>Male</option>
          <option>Female</option>
        </select>
      </div>
      </div>
      </div> -->
    <div class="form-group">
        <label for="email">Email *</label>
        <div class="col-s-5 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
        <input type="email" class="form-control" name="email" id="email" value="<?=$email;?>">
    </div>
    </div>
    </div>
    <div class="form-group">
        <label for="fName">First Name *</label>
        <div class="col-s-5 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input type="text" class="form-control" name="first_name" id="first_name" value="<?=$first_name;?>">
    </div>
    </div>
    </div>
    <div class="form-group">
        <label for="lName">Last Name *</label>
        <div class="col-s-5 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input type="text" class="form-control" name="last_name" id="last_name" value="<?=$last_name;?>">
    </div>
    </div>
    </div>
    <!-- <div class="form-group">
      <label for="inputPassword">Birthday *</label>
        <div class="form-group row">
        <div class="col-md-4">
          <input type="text" class="form-control" placeholder="dd" name="name" id="name" value="<?php if(isset($_POST['day_born'])) echo $_POST['day_born'];?>">
        </div>
        <div class="col-md-4">
          <input type="text" class="form-control" placeholder="mm" name="name" id="name" value="<?php if(isset($_POST['month_born'])) echo $_POST['month_born'];?>">
        </div>
        <div class="col-md-4">
          <input type="text" class="form-control" placeholder="yyyy" name="name" id="name" value="<?php if(isset($_POST['year'])) echo $_POST['year'];?>">
        </div>
      </div>
    </div> -->
    <div class="form-group">
        <label for="inputPassword">Password *</label>
        <div class="col-s-5 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-eye-close"></i></span>
        <input type="password" class="form-control" name="password" id="password" value="<?=$password;?>">
    </div>
    </div>
    </div>
    <div class="form-group">
        <label for="inputPassword">Confirm Password *</label>
        <div class="col-s-5 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-eye-close"></i></span>
        <input type="password" name="confirm" id="confirm" class="form-control" value="<?=$confirm;?>">
    </div>
    </div>
    </div>
    <input type="checkbox" name="terms"> I accept Terms and Conditions
    <br><br>
    <a href="index.php" class="btn btn-default">Cancel</a>
    <input type="submit" value="Create Account" class="btn btn-primary">
</form>
</div>
</div>
<?php include 'includes/footer.php'; ?>
