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
        <title><?php echo $namalengkap?></title>
    </head>
    <style>
        #cover-img{
            height: 400px;
            width:100%;
        }
        #update_profile{
            position: relative;
            top: -33px;
            cursor: pointer;
            left: 93px;
            border-radius: 4px;
            background-color:rgba(0,0,0,0.1);
            transform:translate(-50%,-50%);
        }
        #profile-img{
            position: absolute;
            top: 160px;
            left: 40px;
        }
        #btn_profile{
            position: absolute;
            top:82%;
            left:50%;
            cursor:pointer;
            transform:translate(-50%, -50%);
        }
        #own_post{
            border:5px solid #e6e6e6;
            padding:40px 50px;
            background-color: white;
        }
        #post_img{
            height: 300px;
            width:100%;
        }

    </style>
    <body>
        <div class="row">
            <div class="col-sm-2">

            </div>
            <div class="col-sm-8">
                <?php
                    echo"
                    <div>
                        <div><img id='cover-img' src='cover/$cover' class='img-responsive' alt='cover'></div>
                        <form action='profile.php?u_id=$user_id' method='post' attribute enctype='multipart/form-data'>

                            <ul class='nav pull-left' style='position:absolute; top:10px; left:40px;'>
                                <li class='dropdown'>
                                <button class='dropdown-toggle btn btn-default' data-toggle='dropdown'>Ganti Cover</button>
                                <div class='dropdown-menu'>
                                    <center>
                                    <p>Tekan <strong>Select Cover</strong> lalu tekan <br> <strong>Update Cover</strong></p>
                                    <label class='btn btn-info'>Select Cover
                                    <input type='file' name='u_cover' size='60'/></label><br><br>
                                    <button name='submit' class='btn btn-info'>Update Cover</button>
                                    </center>
                                </div>
                                </li>
                            </ul>

                        </form>
                    </div>
                    <div id='profile-img'>
                        <img src='profil/$photo' alt='Profile' class='img-circle' width='180px' height='185px'>
                        <form action='profile.php?u_id='$user_id' method='post' enctype='multipart/form-data'>
                        <label id='update_profile' class='btn btn-info'>Select Profile<input type='file' name='u_photo' size='60'/></label><br><br>
                        <button id='btn_profile' name='update' class='btn btn-info'>Update Profile</button>
                        </form>
                    </div><br>
                    ";
                ?>
                <?php
                    if(isset($_POST['submit'])){
                        $u_cover = $_FILES['u_cover']['name'];
                        $img_temp = $_FILES['u_cover']['tmp_name'];
                        $rnd = rand(1,100);

                        if($cover == ''){
                            echo "<script>alert('Masukkan Gambar Cover')</script>";
                        }else{
                            move_uploaded_file($img_temp,"cover/$u_cover.$rnd");
                            $sql = "UPDATE users set cover='$u_cover.$rnd' where id='$user_id'";

                            $result = mysqli_query($db,$sql);
                            if($result){
                                echo "<script>alert('Gambar Covermu Sudah TerUpdate')</script>";
                                echo "<script>window.open('profile.php?u_id=$user_id' , '_self')</script>";
                            }
                        }
                    }
                    if(isset($_POST['update'])){
                        $u_photo = $_FILES['u_photo']['name'];
                        $img_temp = $_FILES['u_photo']['tmp_name'];
                        $rnd = rand(1,100);

                        if($u_photo == ''){
                            echo "<script>alert('Masukkan Gambar Profile')</script>";
                            echo "<script>window.open('profile.php?u_id=$user_id' , '_self')</script>";
                        }else{
                            move_uploaded_file($img_temp,"profil/$u_photo.$rnd");
                            $sql = "UPDATE users set photo='$u_photo.$rnd' where id='$user_id'";

                            $result = mysqli_query($db,$sql);
                            if($result){
                                echo "<script>alert('Gambar Profilemu Sudah TerUpdate')</script>";
                                echo "<script>window.open('profile.php?u_id=$user_id' , '_self')</script>";
                            }
                        }
                    }
                ?>
            <div class="col-sm-2">

            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">

            </div>
            <div class="col-sm-2" style="background-color: #e6e6e6;text-align: center;left: 0.8%;border-radius: 5px;">
            <?php
            echo"
                <center><h2><strong>About</strong></h2></center>
                <center><h4><strong>$namalengkap</strong></h4></center>
                <p><strong><i style='color:grey;'>$deskripsi</i></strong></p><br>
                <p><strong>Relationship Status: </strong> $relationship</p><br>
                <p><strong>Gender: </strong> $gender</p><br>
                <p><strong>Date of Birth: </strong> $birthday</p><br>
            ";
            ?>
            </div>
            <div id="insert_post" class="col-sm-6">
                <center>
                <form action="timeline.php?id=<?php echo $user_id; ?>" method="post" id="f" enctype="multipart/form-data">
                    <textarea class="form-control" id="body" rows="4" name="body" placeholder="Apa yang kamu pikirkan?"></textarea><br>
                    <label class="btn btn-warning" id="upload_image_btn">Pilih Gambar
                        <input type="file" name="upload_image" size="30">
                    </label>
                    <button id="btn_post" class="btn btn-success" name="submit">Post</button>
                </form>
                <?php insertPost(); ?>
                </center>
            </div>
            <div class="col-sm-6">
                <?php 
                    if(isset($_GET['u_id'])){
                        $u_id = $_GET['u_id'];
                    }
                    $getPost = "SELECT * FROM post WHERE user_id = '$u_id' ORDER BY 1 DESC";
                    $runPost = mysqli_query($db,$getPost);

                    while ($row = mysqli_fetch_array($runPost)){
                        $post_id = $row['id'];
                        $user_id = $row['user_id'];
                        $body = $row['body'];
                        $upload_image = $row['upload_img'];
                        $date = $row['post_date'];

                        $user = "SELECT * FROM users WHERE id='$user_id'  AND post='yes'";

                        $runUser = mysqli_query($db,$user);
                        $rowUser = mysqli_fetch_array($runUser);

                        $user_name = $rowUser['username'];
                        $user_img = $rowUser['photo'];

                        if($body == '' && strlen($upload_image) >= 1){
                            echo"
                                <div id='own_post'>
                                    <div class='row'>
                                        <div class='col-sm-2'>
                                            <p><img src='profil/$user_img' class='img-circle' width='100px' height='100px'></p>
                                        </div>
                                        <div class='col-sm-6'>
                                            <h3><a style='text-decoration: none; cursor: pointer; color:#3897f0;' href='profile.php?u_id=$user_id'>$user_name</a></h3>
                                            <h4><small style='color:black;'>Updated a post on <strong>$date</strong></small></h4>
                                        </div>
                                        <div class='col-sm-4'></div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-sm-12'>
                                        <img id='post-img' src='imgpost/$upload_image' style='height:350px;'>
                                        </div>
                                    </div><br>
                                    <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-primary'>Comment</button></a><br>
                                </div><br>
                            ";
                        }else if(strlen($body) >= 1 && strlen($upload_image) >= 1){
                            echo"
                                <div id='own_post'>
                                    <div class='row'>
                                        <div class='col-sm-2'>
                                            <p><img src='profil/$user_img' class='img-circle' width='100px' height='100px'></p>
                                        </div>
                                        <div class='col-sm-6'>
                                            <h3><a style='text-decoration: none; cursor: pointer; color:#3897f0;' href='profile.php?u_id=$user_id'>$user_name</a></h3>
                                            <h4><small style='color:black;'>Updated a post on <strong>$date</strong></small></h4>
                                        </div>
                                        <div class='col-sm-4'></div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-sm-12'>
                                        <p>$body</p>
                                        <img id='post-img' src='imgpost/$upload_image' style='height:350px;'>
                                        </div>
                                    </div><br>
                                    <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-primary'>Comment</button></a><br>
                                </div><br>
                            ";
                        }else{
                            echo"
                                <div id='own_post'>
                                    <div class='row'>
                                        <div class='col-sm-2'>
                                            <p><img src='profil/$user_img' class='img-circle' width='100px' height='100px'></p>
                                        </div>
                                        <div class='col-sm-6'>
                                            <h3><a style='text-decoration: none; cursor: pointer; color:#3897f0;' href='profile.php?u_id=$user_id'>$user_name</a></h3>
                                            <h4><small style='color:black;'>Updated a post on <strong>$date</strong></small></h4>
                                        </div>
                                        <div class='col-sm-4'></div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-sm-12'>
                                        <p>$body</p>
                                        </div>
                                    </div><br>
                                    <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-primary'>Comment</button></a><br>
                                </div><br>
                            ";
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>