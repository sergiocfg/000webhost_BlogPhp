<?php
require "header.php";
    if(isset($_GET['action'])){
switch ($_GET['action']){
    case 'sigUp':
            ?>
        <div class = "login">
        <div class = "messages">
            <?php
            register();
            ?>
        </div>
            <div class = "formLogin">
                <form class = "form" action="" method="post">
                    <h2>New User:</h2>
                    <label>User:</label><br/>
                    <input type="text" class = "inputs" name="user" required = "required"><br/>
                    <label>Password:</label><br/>
                    <input type="password" class = "inputs" name="pass" required = "required"><br/>
                    <label>Repeat Password:</label><br/>
                    <input type="password" class = "inputs" name="rePass" required = "required"><br/>
                    <label>Email:</label><br/>
                    <input type="email" class = "inputs" name="email" required = "required"><br/>
                    <div class = btn>
                        <button type="submit" class="btn" actio>Register</button>
                    </div>
                    <a href="login.php">Login</a> <!-- ? quiere decir get...-->
                </form>
            </div>
        </div>
            <?php
        break;
    default:
            ?>
            <div class="login">
            <h2>Action not found</h2>
            </div>
            <?php
        break;
}
    }else{
        ?>
        <div class = "login">
            <div class = "messages">
                <?php
                login();
                    ?>
            </div>
            <div class = "formLogin">
                <form class = "form" action="" method="post">
                    <h2>Login:</h2>
                    <label>User:</label><br/>
                    <input type="text" class = "inputs" name="user" required = "required"><br/>
                    <label>Password:</label><br/>
                    <input type="password" class = "inputs" name="pass" required = "required"><br/>
                    <div class = btn>
                    <button type="submit" class="btn" actio>Login</button>
                    </div>
                <a href="login.php?action=sigUp">Sig Up</a> <!-- ? quiere decir get...-->
                </form>
            </div>
        </div>
        <?php
        }


require "footer.php";
?>