<?php
require "header.php";

    $id_post =(int)$_GET['post'];
?>
    <div class="main">
        <div class="section">
            <section class ="article">
                <?php
                //$sql = "SELECT * FROM post INNER JOIN user ON post.id_user = user.id_user ORDER BY post.id_post DESC";
                $sql = "SELECT post.id_post as 'id_post', user.id_user as 'id_user', post.title as 'title', post.date as 'date',
                        user.name as 'user', post.content as 'content' FROM post INNER JOIN user ON 
                        post.id_user = user.id_user WHERE post.id_post = '$id_post'";
                $conn = myConnection();
                $query = mysqli_query($conn,$sql);
                while($i = mysqli_fetch_array($query)){
                    //print_r($i);
                    ?>
                    <article class="feed">
                        <h1 class="title-article"><a href="single.php?post=<?php echo $i['id_post'];?>">
                                <?php echo $i['title'];?><a/></h1>
                        <time><?php echo $i['date'];?></time> / <span>Autor: <?php echo $i['user'];?></span>
                        <?php
                        $session = getUserSession();
                        if(!($session ==="")){
                            if($session['id'] === $i['id_user']){
                                ?>
                                <a href="admin.php?action=editPost&post=<?php echo $i['id_post'];?>"> / Edit</a>
                                <a href="admin.php?action=deletePost&post=<?php echo $i['id_post'];?>"> / Delete</a>
                                <?php
                            }
                        }?>
                        <p><?php echo htmlspecialchars_decode($i['content']);?></p>
                    </article>
                    <article class="feed">
                        <form method="post" action="functions.php?action=comment">
                            <input type="hidden" name="post" value="<?php echo $i['id_post']; ?>">
                            <input type="hidden" name="user" value="<?php echo $session['id']; ?>">
                            <textarea class="textarea" name="comment" placeholder="New comment"></textarea><br>
                            <button type="submit" class="btn">Coment</button>
                        </form>
                    </article>
                    <?php
                }
                myClose($conn);
                ?>
            </section>
        </div>
<!-- to generate comment list-->
    <div class="section-coment">
        <section class ="article">
            <?php
            $sql = "SELECT user.name as 'user', coment.coment as 'coment'  FROM user INNER JOIN coment ON
            user.id_user = coment.id_user WHERE coment.id_post = '$id_post'";
            $conn = myConnection();
            $query = mysqli_query($conn,$sql);
            while($i = mysqli_fetch_array($query)){
            //print_r($i);
            ?>
            <article class="feed-comment">
                <h2 class="article"><?php echo $i['user'];?></h2>

                <p><?php echo htmlspecialchars_decode($i['coment']);?></p>
            </article>

            <?php
            }
            myClose($conn);
            ?>
        </section>
        </div>


    </div>

<?php
require "footer.php";