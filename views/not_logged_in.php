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
    <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required />
</br>
    <input type="submit"  name="login" value="Log in" />

</form>

<a href="register.php">Register new account</a>
</br></br>
<a href="searchProd.php">Back to Home</a> 

