<?php
function myConnection()
{
    $host = "localhost";
    $user = "root";
    $pass = "";
    $data = "blog";
    $conn = mysqli_connect($host,$user,$pass,$data);
    return $conn;
}

function myClose($conn)
{
    $conn->Close();
}/**/