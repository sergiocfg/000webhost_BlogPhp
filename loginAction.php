<?php
//require "myConnection.php";
require "userAction.php";

//to encrypt the password
class Encrypter{
    //private static $key = "sergio";

    public static function encrypt($input){
        $output = base64_encode($input);
        return $output;
    }

    public static function dencrypt($input){
        $output = base64_decode($input);
        return $output;
    }
}

/**
 *
 */
function login(){
    if(isset($_POST['user']) && isset($_POST['pass'])){ //if exit data
        $user = htmlentities($_POST['user'],ENT_QUOTES);
        $pass = htmlentities($_POST['pass'],ENT_QUOTES);
        $pass = Encrypter::encrypt($pass);

        if($user ===''){
            echo "<div class = 'alert'> User is required</div>";
        }elseif($pass ===''){
            echo "<div class = 'alert'> Password is required</div>";
        }else{
            $sql = "SELECT * FROM user WHERE name = '$user' AND pass = '$pass'";
            $conn = myConnection();

            $query = mysqli_query($conn, $sql);
            $rows = mysqli_num_rows($query);//$rows > 0

                if($rows > 0)
                {
                    openUserSession($user);           //variable session ******
                    echo "<div class = 'alert'> Sussefully login</div>";
                }else{
                    echo "<div class = 'alert'>Incorrect User or Password</div>";
                }

            myClose($conn);     //close connection
        }
}
}

function register(){
    if(isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['rePass']) && isset($_POST['email']))
    { //if exit data
        $user = htmlentities($_POST['user'],ENT_QUOTES);
        $pass = htmlentities($_POST['pass'],ENT_QUOTES);
        $rePa = htmlentities($_POST['rePass'],ENT_QUOTES);
        $emai = htmlentities($_POST['email'],ENT_QUOTES);

        if($user ===''){
            echo "<div class = 'alert'> User is required</div>";
        }elseif($pass ===''){
            echo "<div class = 'alert'> Password is required</div>";
        }elseif($rePa ===''){
            echo "<div class = 'alert'> Retry - Password is required</div>";
        }elseif($emai ===''){
            echo "<div class = 'alert'> Email is required</div>";
        }else{
            $conn = myConnection();
            if($pass != $rePa){
                echo "<div class = 'alert'> Passworh and Retry Pasword are different</div>";
            }else{
                if(isUser($user,$emai) == 0) {      //valid if the user is already at DB
                    $pass = Encrypter::encrypt($pass);
                    $sql = "INSERT INTO user (name, pass, email) VALUES ('$user','$pass','$emai')";

                    $query = mysqli_query($conn, $sql);
                    if ($query) {
                        echo "<div class = 'alert'> User successfully Registered</div>";
                        openUserSession($user);           //variable session ******
                    } else {
                        echo "<div class = 'alert'>Error at Register</div>";
                    }
                    myClose($conn);     //close connection
                }else{
                    echo "<div class = 'alert'> User already register</div>";
                }
            }
        }
    }
}

