<?php
require "loginAction.php";
function newEntry(){
    if(isset($_POST['title']) && isset($_POST['content'])){
        $title = htmlentities($_POST['title'],ENT_QUOTES);
        $content = htmlentities($_POST['content'],ENT_QUOTES);
        $session = getUserSession();      //get user session...

        if($session === ""){
            echo "<div class = 'alert'>Error, user not login</div>";
        }else {
            if ($title === '') {
                echo "<div class = 'alert'>Title can't be empty</div>";
            } elseif ($content === '') {
                echo "<div class = 'alert'>Content can't be empty</div>";
            } else{        // to make sure id_user is not empty
                $idUser = $session['id'];
                $date = date('Y-m-d', time());
                $sql = "INSERT INTO post (id_user, title, content, date) VALUES ('$idUser','$title','$content','$date')";
                $conn = myConnection();
                $query = mysqli_query($conn,$sql);
                if($query){
                    echo "<div class = 'alert'>Post sussefully added.</div>";
                }else{
                    echo "<div class = 'alert'>Error at Register Post</div>";
                }
                myClose($conn);
            }
        }
    }
}

function updatePost(){
    if(isset($_POST['title']) && isset($_POST['content']) && isset($_POST['id_post'])){
        $title = htmlentities($_POST['title'],ENT_QUOTES);
        $content = htmlentities($_POST['content'],ENT_QUOTES);
        $id_post = (int)$_POST['id_post'];//htmlentities($_GET['id_post'],ENT_QUOTES);
        $session = getUserSession();      //get user session...

        if($session === ""){
            echo "<div class = 'alert'>Error, user not login</div>";
        }else {
            if ($title === '') {
                echo "<div class = 'alert'>Title can't be empty</div>";
            } elseif ($content === '') {
                echo "<div class = 'alert'>Content can't be empty</div>";
            } elseif($id_post ===''){
                echo "<div class = 'alert'>Error, post not found</div>";
            }else {
                    $idUser = $session['id'];
                    $date = date('Y-m-d', time());
                    //UPDATE `post` SET `id_post`=[value-1],`id_user`=[value-2],`title`=[value-3],`content`=[value-4],`date`=[value-5] WHERE 1
                    $sql = "UPDATE  post SET title='$title', content='$content', date='$date' WHERE id_post = '$id_post'";
                    $conn = myConnection();
                    $query = mysqli_query($conn,$sql);
                    if($query){
                        echo "<div class = 'alert'>Post sussefully edited.</div>";
                    }else{
                        echo "<div class = 'alert'>Error at Update Post</div>";
                    }
                    myClose($conn);
            }
        }
    }
}

function deletePost(){
    if(isset($_POST['id_post'])){
        $id_post = (int)$_POST['id_post'];//htmlentities($_GET['id_post'],ENT_QUOTES);
        $session = getUserSession();      //get user session...
            //print_r($session);
        if($session === ""){
            echo "<div class = 'alert'>Error, user not login</div>";
        }elseif($id_post ===''){
                echo "<div class = 'alert'>Error, post not found</div>";
            }else {
                $sql = "DELETE FROM `post` WHERE id_post = '$id_post'";
                $conn = myConnection();
                $query = mysqli_query($conn,$sql);
                if($query){
                    //echo "<div class = 'alert'>Post sussefully deleted.</div>";
                    header('Location:blog.php');
                }else{
                    echo "<div class = 'alert'>Error at Delete Post</div>";
                }
                myClose($conn);
            }
        }
    }