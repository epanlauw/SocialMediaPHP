<?php require_once("auth.php");
      require_once("config.php");
?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" aria-expanded="false"></button>
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <a href="#" class="navbar-brand">Sosmed</a> 
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <?php 
                    $user_id = $_SESSION['user']['id'];
                    $query = "SELECT * FROM users WHERE id =$user_id";
                    $result = mysqli_query($db,$query);
                    $row = mysqli_fetch_array($result);
                    $namalengkap = $_SESSION['user']['fName'] . " " . $_SESSION['user']['lName'];
                    $gender = $_SESSION['user']['jenisKelamin'];
                    $email = $_SESSION['user']['email'];
                    $username = $_SESSION['user']['username'];
                    $birthday = $_SESSION['user']['tglLahir'];
                    $photo = $row['photo'];
                    $deskripsi = $row['deskripsi'];
                    $relationship = $row['relationship'];
                    $cover = $row['cover'];

                    $user_posts = "Select * from post where user_id ='$user_id'";
                    $run_posts = mysqli_query($db, $user_posts);
                    $post = mysqli_num_rows($run_posts);
                ?>
                <li><a href='profile.php?<?php echo "u_id=$user_id" ?>'><?php echo $namalengkap ?></a></li>
                <li><a href="timeline.php">Home</a></li>
                <li><a href="members.php">Find People</a></li>
                <!-- <li><a href="messages.php?u_id=new">Messages</a></li> -->
                <?php 
                    echo"
                    <li class='dropdown'>
                    <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><span><i class='glyphicon glyphicon-chevron-down'></i></span></a>
                    <ul class='dropdown-menu'>
                        <li>
                            <a href='my_post.php?u_id=$user_id'>My Posts <span class='badge badge-secondary'>$post</span></a>
                        </li>
                        <li>
                            <a href='edit_profile.php?u_id=$user_id'>Edit Account</a>
                        </li>
                        <li role='separator' class='divider'></li>
                        <li>
                            <a href='logout.php'>Logout</a>
                            </li>
                        </ul>
                    </li>
                    ";
                ?>
            </ul>
            <!-- <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <form class="navbar-form navbar-left" method="post" action="results.php">
                        <div class="form-group">
                            <input class="form-control" type="text" name="user-query" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-info">Search</button>
                    </form>
                </li>
            </ul> -->
        </div>
    </div>
</nav>