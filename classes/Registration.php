<?php

/**
 * Class registration
 * handles the user registration
 */
class Registration
{
    /**
     * @var object $db_connection The database connection
     */
    private $db_connection = null;
    /**
     * @var array $errors Collection of error messages
     */
    public $errors = array();
    /**
     * @var array $messages Collection of success / neutral messages
     */
    public $messages = array();

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$registration = new Registration();"
     */
    public function __construct()
    {
        if (isset($_POST["register"])) {
            $this->registerNewUser();
        }
    }

    /**
     * handles the entire registration process. checks all error possibilities
     * and creates a new user in the database if everything is fine
     */
    private function registerNewUser()
    {
        if (empty($_POST['user_name'])) {
            $this->errors[] = "Empty Username";
        } 
        elseif (empty($_POST['user_password_new']) || empty($_POST['user_password_repeat'])) {
            $this->errors[] = "Empty Password";
        } 
        elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
            $this->errors[] = "Passwords do not match!";
        } 
        elseif (strlen($_POST['user_password_new']) < 5) {
            $this->errors[] = "Password has a minimum length of 6 characters";
        } 
        elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])) {
            $this->errors[] = "Username does not fit the name scheme: only a-Z and numbers are allowed, 2 to 64 characters";
        } 
        elseif (empty($_POST['user_email'])) {
            $this->errors[] = "Email cannot be empty";
        } 
        elseif (strlen($_POST['user_email']) > 64) {
            $this->errors[] = "Email cannot be longer than 64 characters";
        } 
        elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Your email address is not in a valid email format";
        } 
        else {
            // create a database connection
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {

                // escaping, additionally removing everything that could be (html/javascript-) code
                $user_name = $this->db_connection->real_escape_string(strip_tags($_POST['user_name'], ENT_QUOTES));
                $user_email = $this->db_connection->real_escape_string(strip_tags($_POST['user_email'], ENT_QUOTES));

                $user_password = $_POST['user_password_new'];

                // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
                // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
                // PHP 5.3/5.4, by the password hashing compatibility library
                $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);

                // check if user or email address already exists
                $sql = "SELECT * FROM customer WHERE CUserName = '" . $user_name . "' OR CEmail = '" . $user_email . "';";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) {
                    $this->errors[] = "Sorry, that username / email address is already taken.";
                } else {

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "isdm";
                    $con = mysqli_connect($servername, $username, $password, $dbname);
                    
                    $name = $_POST['name'];
                    $gender = $_POST['gender'];
                    $dob = $_POST['dob'];
                    $mobileno = $_POST['mobileno'];
                    $street = $_POST['street'];
                    $city = $_POST['city'];
                    $state = $_POST['state'];
                    $zipcode = $_POST['zipcode'];
                    $dstreet = $_POST['dstreet'];
                    $dcity = $_POST['dcity'];
                    $dstate = $_POST['dstate'];
                    $dzipcode = $_POST['dzipcode'];

                    $r1 = mysqli_query($con, "insert into address(street,city,state,zipcode) values('$street','$city','$state',$zipcode)");
                    $billid = mysqli_insert_id($con);

                    $r1 = mysqli_query($con, "insert into address(street,city,state,zipcode) values('$dstreet','$dcity','$dstate',$dzipcode)"); 
                    $deliverid = mysqli_insert_id($con);

                    // write new user's data into database
                    $sql = "INSERT INTO customer (CUserName, CPass, CEmail, CName, CGender, CDOB, CMobileno, BillingAddID, DeliveryAddID)
                            VALUES('$user_name', '$user_password_hash', '$user_email', '$name', '$gender', '$dob', '$mobileno', $billid, $deliverid);";
                    $query_new_user_insert = mysqli_query($con, $sql) or die("reg error");
                    $cid = mysqli_insert_id($con);

                    $r3 = mysqli_query($con, "insert into basket(cid,numprods,totalcost) values($cid,0,0)") or die("q3 error");
        
                    // if user has been added successfully
                    if ($query_new_user_insert) {
                        $this->messages[] = "Your account has been created successfully. You can now log in.";
                    } else {
                        $this->errors[] = "Sorry, your registration failed. Please go back and try again.";
                    }
                }
            } else {
                $this->errors[] = "Sorry, no database connection.";
            }
        }
    }
}
