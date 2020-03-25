<?php require_once("auth.php");
      require_once("header.php");
      require_once("fungsi.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/home_style.css">
        <title>Temukan Orang Baru</title>
    </head>
    <style>
        #own_post{
            border:5px solid #e6e6e6;
            padding:40px 50px;
            width: 90%;
            background-color:white;
        }
        #post_img{
            height:300px;
            width:100%;
        }
    </style>
    <body>
        <div class="row">
            <?php 
                if(isset($_GET['u_id'])){
                    $u_id = $_GET['u_id'];
                }
                if($u_id <= 0 || $u_id == ""){
                    echo "<script>window.open('timeline.php', _self)</script>";
                }else{
            ?>
            <div class="col-sm-12">
                <?php 
                    if(isset($_GET['u_id'])){
                        global $db;

                        $user_id = $_GET['u_id'];

                        $sql = "SELECT * FROM users WHERE id = '$user_id'";
                        $query = mysqli_query($db,$sql);
                        $row = mysqli_fetch_array($query);

                        $name = $row['username'];
                    }
                ?>

                <?php 
                    if(isset($_GET['u_id'])){
                        global $db;

                        $user_id = $_GET['u_id'];

                        $sql = "SELECT * FROM users WHERE id = '$user_id'";
                        $query = mysqli_query($db,$sql);
                        $row = mysqli_fetch_array($query);

                        $id = $row['id'];
                        $image = $row['photo'];
                        $name = $row['username'];
                        $fName = $row['fName'];
                        $lName = $row['lName'];
                        $birthdate = $row['tglLahir'];
                        $gender = $row['jenisKelamin'];
                        $deskripsi = $row['deskripsi'];
                        $relationship = $row['relationship'];
                        echo"
                            <div class='row'>
                                <div class='col-sm-1'></div>
                                <center>
                                    <div style='background-color: #e6e6e6;' class='col-sm-3'>
                                        <h2>Information About</h2>
                                        <img class='img-circle' src='profil/$image' width='150' height='150'><br><br>
                                        <ul class='list-group'>
                                            <li class='list-group-item' title='Username'><strong>$fName $lName</strong></li>
                                            <li class='list-group-item' title='Username'><strong>$deskripsi</strong></li>
                                            <li class='list-group-item' title='Username'><strong>$birthdate</strong></li>
                                            <li class='list-group-item' title='Username'><strong>$gender</strong></li>
                                        </ul>
                                    </div>
                        ";
                        $user = $_SESSION['user']['email'];
                        $get_user = "SELECT * FROM users WHERE email = '$user'";
                        $run_user = mysqli_query($db, $get_user);
                        $row = mysqli_fetch_array($run_user);

                        $userown_id = $row['id'];

                        if($user_id == $userown_id){
                            echo "";
                        }
                        echo "</di>
                        </center>";
                    }
                ?>
                <div class="col-sm-8">
                    <center><h1><strong><?php echo "$fName $lName";?></strong> Posts</h1></center>
                    <?php 
                        global $con;

                        if(isset($_GET['u_id'])){
                            $u_id = $_GET['u_id'];
                        }

                        $get_post = "SELECT * FROM post WHERE user_id='$u_id' ORDER BY 1 DESC LIMIT 5";
                        $run_posts = mysqli_query($db,$get_post);
                        while ($row = mysqli_fetch_array($run_posts)){
                            $post_id = $row['id'];
                            $user_id = $row['user_id'];
                            $body = $row['body'];
                            $upload_image = $row['upload_img'];
                            $post_date = $row['post_date'];

                            $user = "SELECT * FROM users WHERE id='$user_id' AND post='yes'";

                            $run_user = mysqli_query($db,$user);
                            $row_user = mysqli_fetch_array($run_user);

                            $user_name = $row_user['username'];
                            $fName = $row_user['fName'];
                            $lName = $row_user['lName'];
                            $user_img = $row_user['photo'];

                            if($body == '' && strlen($upload_image) >= 1){
                                echo"
                                    <div id='own_post'>
                                        <div class='row'>
                                            <div class='col-sm-2'>
                                                <p><img src='profil/$user_img' class='img-circle' width='100px' height='100px'></p>
                                            </div>
                                            <div class='col-sm-6'>
                                                <h3><a style='text-decoration: none; cursor: pointer; color:#3897f0;'href='user_profile.php?u_id=$user_id'>$user_name</h3>
                                                <h4><small style='color : black;'>Updated a post on <strong>$post_date</strong></small></h4>
                                            </div>
                                            <div class='col-sm-4'></div>
                                        </div>
                                        <div class='row'>
                                            <div class='col-sm-12'>
                                                <img id='post-img'src='imgpost/$upload_image' style='height:350px;'>
                                            </div>
                                        </div><br>
                                        <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-primary'>Comment</button></a><br>
                                    </div><br><br>
                                ";
                            }else if(strlen($body) >= 1 && strlen($upload_image) >= 1){
                                echo"
                                    <div id='own_post'>
                                        <div class='row'>
                                            <div class='col-sm-2'>
                                                <p><img src='profil/$user_img' class='img-circle' width='100px' height='100px'></p>
                                            </div>
                                            <div class='col-sm-6'>
                                                <h3><a style='text-decoration: none; cursor: pointer; color:#3897f0;'href='user_profile.php?u_id=$user_id'>$user_name</h3>
                                                <h4><small style='color : black;'>Updated a post on <strong>$post_date</strong></small></h4>
                                            </div>
                                            <div class='col-sm-4'></div>
                                        </div>
                                        <div class='row'>
                                            <div class='col-sm-12'>
                                                <p>$body</p>
                                                <img id='post-img'src='imgpost/$upload_image' style='height:350px;'>
                                            </div>
                                        </div><br>
                                        <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-primary'>Comment</button></a><br>
                                    </div><br><br>
                                ";
                            }else{
                                echo"
                                    <div id='own_post'>
                                        <div class='row'>
                                            <div class='col-sm-2'>
                                                <p><img src='profil/$user_img' class='img-circle' width='100px' height='100px'></p>
                                            </div>
                                            <div class='col-sm-6'>
                                                <h3><a style='text-decoration: none; cursor: pointer; color:#3897f0;'href='user_profile.php?u_id=$user_id'>$user_name</h3>
                                                <h4><small style='color : black;'>Updated a post on <strong>$post_date</strong></small></h4>
                                            </div>
                                            <div class='col-sm-4'></div>
                                        </div>
                                        <div class='row'>
                                            <div class='col-sm-12'>
                                                <p>$body</p>
                                            </div>
                                        </div><br>
                                        <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-primary'>Comment</button></a><br>
                                    </div><br><br>
                                ";
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php }?>
    </body>
</html>