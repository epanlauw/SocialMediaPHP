<?php require_once("auth.php");
      require_once("header.php");
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

                        if($cover == ''){
                            echo "<script>alert('Masukkan Gambar Profile')</script>";
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
            <div class="col-sm-2" style="background-color: #e6e6e6;text-align: center;left: 0.9%;border-radius: 5px;">
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
        </div>
    </body>
</html>