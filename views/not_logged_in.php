<html>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
</html>

<?php
// show potential errors / feedback (from login object)
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo $error;
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
            echo $message;
        }
    }
}
?>



<!-- login form box -->
<form method="post" action="searchProd.php" name="loginform">
    <label for="login_input_username">Username/Email</label>
    <input id="login_input_username" class="login_input" type="text" name="user_name" required />
</br>
    <label for="login_input_password">Password</label>
    <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required style="margin-left:43px"/>
</br>
    <input type="submit"  name="login" value="Log in" />

</form>

<button><a href="register.php" style="color: black">Register new account</a></button>
</br></br>
<button><a href="searchProd.php" style="color: black">Back to Home</a></button>
