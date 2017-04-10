<?php
// show potential errors / feedback (from registration object)
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo $error;
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo $message;
        }
    }
}
?>
<!-- 
<head>
    <script>
        function fun(a,b,c,d) {
            var a1 = document.getElementsByName(a)[0].value;
            var b1 = document.getElementsByName(b)[0].value;
            var c1 = document.getElementsByName(c)[0].value;
            var d1 = document.getElementsByName(d)[0].value;
            document.getElementById("dstreet").innerHTML = a1;
        }
    </script>
</head>
 -->
<!-- register form -->
<form method="post" action="register.php" name="registerform">
    <table>
    <col width="200">
    <tr><td><label >Name</label></td>
    <td><input type="text" name="name" ></td></tr>

    <tr><td><label>Username (only letters and numbers)</label></td>
    <td><input type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" ></td></tr>

    <tr><td><label>User's email</label></td>
    <td><input type="email" name="user_email" ></td></tr>
    
    <tr><td><label>Password (min. 5 characters)</label></td>
    <td><input type="password" name="user_password_new" pattern=".{5,}" autocomplete="off" /></td></tr>
    
    <tr><td><label>Repeat password</label></td>
    <td><input type="password" name="user_password_repeat" pattern=".{5,}" autocomplete="off" /></td></tr>
    
    <tr><td><label >Male(M)/Female(F)</label></td>
    <td><input type="text" name="gender" ></td></tr>

    <tr><td><label >DOB</label></td>
    <td><input type="date" name="dob" ></td></tr>

    <tr><td><label >Mobile No(10 digits)</label></td>
    <td><input type="text" name="mobileno" pattern=".{10,}"></td></tr>

</table>
    <hr>   

<font size="5">BILLING ADDRESS</font></br>
<table>
    <col width="200">
    
    <tr><td><label >Street</label></td>
    <td><input type="text" name="street"></td></tr>

    <tr><td><label >City</label></td>
    <td><input type="text" name="city"></td></tr>

    <tr><td><label >State</label></td>
    <td><input type="text" name="state"></td></tr>

    <tr><td><label >ZipCode</label></td>
    <td><input type="text" name="zipcode" required /></td></tr>
</table>
    <font size="5">DELIVERY ADDRESS</font></br>
    <!-- <input type="checkbox" name="add" onclick="fun('street', 'city', 'state', 'zipcode')">Delivery address same as billing address?</input> -->
<table>
    <col width="200">

    <tr><td><label >Street</label></td>
    <td><input type="text" name="dstreet"></td></tr>

    <tr><td><label >City</label></td>
    <td><input type="text" name="dcity"></td></tr>

    <tr><td><label >State</label></td>
    <td><input type="text" name="dstate"></td></tr>

    <tr><td><label >ZipCode</label></td>
    <td><input type="text" name="dzipcode" required /></td></tr>
</table>
    </br>
    <input type="submit"  name="register" value="Register" />
    </br>
</form>

<!-- backlink -->
<a href="index.php">Back to Login Page</a>
</br></br>
<a href="searchProd.php">Back to Home</a>

