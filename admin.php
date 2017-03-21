<?php
require "header.php";
$session = getUserSession();

if($session != ""){ // user logged
    if(isset($_GET['action'])){
        switch ($_GET['action']){
            case 'newEntry':
                ?>
                    <main>
                        <section>
                            <h1>Working at new entry. </h1>
                            <div class="messages">
                                <?php
                                newEntry();
                                ?>
                            </div>
                            <div class="option">
                                <form action="" method="post">
                                    <h4 class="title">Title: </h4>
                                    <input type="text" name="title" class="input">
                                    <br/>
                                    <h4 class="title">Content: </h4>
                                    <script type="text/javascript" src="js/tinymce/js/tinymce/tinymce.min.js"></script>
                                    <script type="text/javascript">
                                        tinymce.init({
                                            selector: 'textarea',
                                            height: 500,
                                            menubar: false,
                                            plugins: [
                                                'advlist autolink lists link image charmap print preview anchor',
                                                'searchreplace visualblocks code fullscreen',
                                                'insertdatetime media table contextmenu paste code'
                                            ],
                                            toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                                            content_css: '//www.tinymce.com/css/codepen.min.css'
                                        });
                                    </script>

                                    <textarea name ="content" rows="5"></textarea>
                                    <br/>
                                    <button type="submit" class="btn-r">Post</button>
                                </form>
                            </div>
                        </section>

                    </main>
                </div>
                <?php
                break;
 //edit post
            case 'editPost':
                ?>
                    <div class = "admin">
                        <h1 class="title-article">Edit post</h1>
                        <div class="messages">
                            <?php
                            updatePost();
                            ?>
                        </div>
                        <?php
                            $id_post =(int)$_GET['post'];
                            $sql = "SELECT * FROM post WHERE id_post = '$id_post'";
                            $conn = myConnection();
                            $query = mysqli_query($conn, $sql);

                            $session = getUserSession();      //get user session...
                            if($session === ""){
                                echo "<div class = 'alert'>Error, user not login</div>";
                            }else
                            while ($i = mysqli_fetch_array($query)){
                                if($session['id'] === $i['id_user']){
                                    ?>
                                    <form action="" method="post">
                                        <h4 class="title">Title: </h4>
                                        <input type="hidden" value="<?php echo $id_post;?>" name="id_post">
                                        <input type="text" name="title" class="input" value="<?php echo $i['title'];?>">
                                        <br/>
                                        <h4 class="title">Content: </h4>
                                        <script type="text/javascript" src="js/tinymce/js/tinymce/tinymce.min.js"></script>
                                        <script type="text/javascript">
                                        tinymce.init({
                                                selector: 'textarea',
                                                height: 500,
                                                menubar: false,
                                                plugins: [
                                        'advlist autolink lists link image charmap print preview anchor',
                                        'searchreplace visualblocks code fullscreen',
                                        'insertdatetime media table contextmenu paste code'
                                    ],
                                                toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                                                content_css: '//www.tinymce.com/css/codepen.min.css'
                                            });
                                        </script>

                                        <textarea name ="content"><?php echo $i['content'];?></textarea>
                                        <br/>
                                        <button type="submit" class="btn-r">UpdatePost</button>
                                    </form>
                                    <?php
                                }else{
                                    echo "<div class = 'alert'>You are not ahutoruze to edit this post.</div>";
                                }
                            }
                            myClose($conn);
                        ?>
                    </div>
                <?php
                break;
//delete post
            case 'deletePost':
                ?>
                <div class = "admin">
                <h1 class="title-article">Delete post</h1>
                <div class="messages">
                    <?php
                    deletePost();
                    ?>
                </div>
                <?php
                $id_post =(int)$_GET['post'];
                $sql = "SELECT * FROM post WHERE id_post = '$id_post'";
                $conn = myConnection();
                $query = mysqli_query($conn, $sql);


                $session = getUserSession();      //get user session...
                if($session === ""){
                    echo "<div class = 'alert'>Error, user not login</div>";
                }else{
                    $is_post = 0;
                    while ($i = mysqli_fetch_array($query)){
                                if($session['id'] === $i['id_user']){
                                    ?>
                                    <form action="" method="post">
                                    <input type="hidden" value="<?php echo $id_post;?>" name="id_post">
                                        <button type="submit" class="btn-r">Confirm Delete Post: <?php echo $id_post?></button>
                                    </form>
                                    <?php
                                    $is_post = 1;
                                }else{
                                    echo "<div class = 'alert'>You are not ahutoruze to delete this post.</div>";
                                    $is_post = 1;
                                }
                    }
                }
                myClose($conn);
                    if($is_post ===0){
                        echo "<div class = 'alert'>Post not found.</div>";
                    }
                break;

            default:
                ?>
                <div class = "admin">
                    <main>
                        <section>
                            <h1>Entry not found </h1>
                        </section>

                    </main>
                </div>
                <?php
                break;
        }
    }else{
        ?>
        <div class = "admin">
            <main>
                <section>
                    <h1>
                        <?php
                            echo ".Welcome: " . $session['user'] . " to your blog.";
                            ?>
                     </h1>
                    <div class = "option">
                        <a href="admin.php?action=newEntry"><buttom type = "button" class = "btn"> New entry </buttom></a>
                    </div>
                </section>
            </main>
        </div>
    <?php
    }
}else{
    header('Location:index.php');
}


require "footer.php";