<?php
require "myConnection.php";

/** check if the user exist at DB
 * @param $user
 * @param $email
 * @return bool
 */
function isUser($user, $email){
    $sql = "SELECT * FROM user where  name = '$user' OR email = '$email'";
    $conn = myConnection();

    $query = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($query);//$rows > 0

   myClose($conn);
    if($rows > 0){
        return 1;
    }
    return 0;
}

/** open session
 * @param $user
 */
function openUserSession($user){
    $sql = "SELECT * FROM user where  name = '$user'";
    $conn = myConnection();

    $query = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($query);//$rows > 0
    myClose($conn);
        //print_r(openUserSession($user));
    if($row == 1){      // to make sure if only one user...
        $session=mysqli_fetch_row($query);

            if(session_status() != 1)   //close session if opened
                session_destroy();
            session_start();
        $_SESSION['id'] = $session[0];//'id_user'
        $_SESSION['user'] = $session[1];//'name'
        $_SESSION['login'] = 'yes';
        $_SESSION['last_login'] = time();
       header('Location:admin.php');    //junp to admin page
    }elseif($row > 1){
        echo "<div class = 'alert'> Unable to open user session > 1</div>";
    }else{
        echo "<div class = 'alert'> Unable to open user session < 1</div>";
    }
}

function getUserSession(){
    if(isset($_SESSION['login'])){
        if((time() - $_SESSION['last_login']) > 60){    //900 = 15 min
            header('Location:closeSession.php');
        }else {
            $_SESSION['last_login'] = time();
            return array('id' => $_SESSION['id'], 'user' => $_SESSION['user'], 'login' => $_SESSION['login'], 'last_login' => $_SESSION['last_login']);
        }
    }
        return "";
}