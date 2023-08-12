<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <title>Document</title>
</head>

<body>
  <form action="auth.php" method="POST">
    <div class='box'>
      <div class='box-form'>
        <div class='box-login-tab'></div>
        <div class='box-login-title'>
          <div class='i i-login'></div>
          <h2>LOGIN</h2>
        </div>
        <div class='box-login'>
          <div class='fieldset-body' id='login_form'>
            <p class='field'>
              <label for='user'>Username</label>
              <input type='text' id='user' name='uname' title='Username' />
              <span id='valida' class='i i-warning'></span>
            </p>
            <p class='field'>
              <label for='pass'>Password</label>
              <input type='password' id='pass' name='pass' title='Password' />
              <span id='valida' class='i i-close'></span>
            </p>

            <input type='submit' id='do_login' value='LOGIN' title='Get Started' />
          </div>
        </div>
      </div>

    </div>
  </form>
  <script src="js/login.js"></script>
</body>

</html>