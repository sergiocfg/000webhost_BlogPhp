<?php
/**
 * Created by PhpStorm.
 * User: SelloDell
 * Date: 2/27/2017
 * Time: 8:58 PM
 */
$session = getUserSession();
?>
<article class="feed" align='center'>
    <?php
    if($session != ""){
        $last_login = $_SESSION['last_login'];
        $date = new DateTime();
        $date->setTimestamp($last_login);
        $dateS = $date->format('Y-m-d H:i:s');
        ?>
        <span>Last Login: </span><time><?php echo $dateS;?></time>
    <?php
    }
echo "<br/><div >Created by Sergio</div>";
?>
</article>