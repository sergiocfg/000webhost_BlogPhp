<?php
session_start();
require "userAction.php";
/* $session = getUserSession();      //get user session...
 *  if($session === "") {
        echo "<div class = 'alert'>Error, user not login</div>";
    }
   print_r($session);/**/

if($_GET['action']) {
    echo "<div class = 'alert'>good</div>";
    switch ($_GET['action']) {
        case 'comment':
            if (isset($_POST['post']) && isset($_POST['user']) && isset($_POST['comment'])) {//
                $id_post = $_POST['post'];
                $id_user = $_POST['user'];
                $comment = $_POST['comment'];
                echo $id_user . "<br/>";

                //$session = getUserSession();      //get user session...
                //print_r($session);
               /* if ($session === "") {
                    echo "<div class = 'alert'>Error, user not login</div>";
                } elseif ($id_post === '') {
                    echo "<div class = 'alert'>Error, post not found</div>";
                } else {
                    $idUser = $session['id'];*/
                    $sql = "INSERT INTO coment (id_post, id_user, coment) VALUES ('$id_post','$id_user','$comment')";
                    $conn = myConnection();
                    $query = mysqli_query($conn, $sql);
                    if ($query) {
                        echo "<div class = 'alert'>Coment sussefully added.</div>";
                    } else {
                        echo "<div class = 'alert'>Error at Register coment</div>";
                    }
                    myClose($conn);
                    header('Location:single.php?post=' . $id_post);
                }
            else{
                    echo "<div class = 'alert'>Error,</div>";
                }
            break;

        default:
            break;
    }
}