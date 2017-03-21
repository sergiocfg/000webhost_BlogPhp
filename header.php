<?php
//require "includes/loginAction.php";
require "entryPost.php";
session_start();
?>
<link rel = "stylesheet"
      type = "text/css"
      href = "style.css" />
<div class = "title">

<div class = "navigation">
    <nav class = "mp">
        <ul>
            <li><a href="index.php">Index</a></li>
            <li><a href="blog.php">Blog</a> </li>
           <!-- <li><a href="/">Pending</a> </li>-->
            <?php               // get session
                $session = getUserSession();
                if($session != ""){
                    ?>
                        <li><a href="admin.php">Admin</a> </li>
                        <li><a href="closeSession.php">Log Off</a> </li>

                    <?php
                }else{
                    ?>
                    <li><a href="login.php">Login</a> </li>
                    <?php
                }
            ?>
        </ul>
    </nav>
</div>
