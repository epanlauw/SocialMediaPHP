<?php 
    require_once("config.php");

    function insertPost(){
        if(isset($_POST["submit"])) {
            global $db;
            global $user_id;

            $body = $_POST["body"];
            $upload_image = $_FILES["upload_image"]["name"];
            $image_tmp = $_FILES["upload_image"]["tmp_name"];
            $rnd = rand(1,100);

            if(strlen($body) > 250){
                echo "<script>alert('Please Use 250 or less than 250 words!')</script>";
			    echo "<script>window.open('timeline.php', '_self')</script>";
            }else{
                if(strlen($body) >= 1 && strlen($body) >= 1){
                    move_uploaded_file($image_tmp, "imgpost/$upload_image.$rnd");
                    $query = "INSERT INTO post (user_id,body, upload_img,post_date) values('$user_id', '$body', '$upload_image.$rnd',NOW())";

                    $result = mysqli_query($db,$query);
                    if($result){
                        echo "<script>alert('Your Post updated a moment ago!')</script>";
                        echo "<script>window.open('timeline.php', '_self')</script>";
                        
                        $update = "UPDATE users SET post='yes' WHERE id='$user_id'";
                        $run = mysqli_query($db,$update);
                    }
                    exit();
                }else{
                    if($body == '' && $upload_image == ''){
                        echo "<script>alert('Error Occured while uploading!')</script>";
					    echo "<script>window.open('timeline.php', '_self')</script>";
                    }else{
                        if($body == ''){
                            move_uploaded_file($image_tmp, "imgpost/$upload_image.$rnd");
                            $query = "INSERT INTO post (user_id, upload_img,post_date) values ('$user_id','$upload_image.$rnd',NOW())";
                            $result = mysqli_query($db,$query);
                            if($result){
                                echo "<script>alert('Your Post updated a moment ago!')</script>";
                                echo "<script>window.open('timeline.php', '_self')</script>";
                                
                                $update = "UPDATE users SET post='yes' WHERE id='$user_id'";
                                $run = mysqli_query($db,$update);
                            }
                            exit();
                        }else{
                            $query = "INSERT INTO post (user_id, body,post_date) values ('$user_id','$body',NOW())";
                            $result = mysqli_query($db,$query);
                            if($result){
                                echo "<script>alert('Your Post updated a moment ago!')</script>";
                                echo "<script>window.open('timeline.php', '_self')</script>";
                                
                                $update = "UPDATE users SET post='yes' WHERE id='$user_id'";
                                $run = mysqli_query($db,$update);
                            }
                            exit();
                        }
                    }
                }
            }
        }
    }

    function getPost(){
        global $db;
        $per_page = 4;

        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page = 1;
        }
        $startFrom = ($page-1) * $per_page;
        $query = "SELECT * FROM post ORDER by 1 DESC LIMIT $startFrom, $per_page";
        $result = mysqli_query($db,$query);
        
        while($row = mysqli_fetch_array($result)){
            $post_id = $row['id'];
            $user_id = $row['user_id'];
            $body = substr($row['body'],0,40);
            $upload_image = $row['upload_img'];
            $date = $row['post_date'];

            $user = "SELECT * FROM users WHERE id='$user_id' AND post='yes'";
            $result_user = mysqli_query($db,$user);
            $row_user = mysqli_fetch_array($result_user);

            $user_name = $row_user['username'];
            $user_img = $row_user['photo'];

            if($body == '' && strlen($upload_image) >= 1){
                echo "
                <div class='row'>
                    <div class='col-sm-3'></div>
                    <div id='post' class='col-sm-6'>
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
                                <img id='post-img' src='imgpost/$upload_image' height:'350px'>
                            </div>
                        </div><br>
                        <a href='single.php?post_id=$post_id' style='float:right;'><button>Comment</button></a><br>
                    </div>
                    <div class='col-sm-3'></div>
                </div><br><br>
                ";
            }
            else if(strlen($body) >= 1 && strlen($upload_image) >= 1){
                echo "
                <div class='row'>
                    <div class='col-sm-3'></div>
                    <div id='post' class='col-sm-6'>
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
                                <img id='post-img' src='imgpost/$upload_image' height:'350px'>
                            </div>
                        </div><br>
                        <a href='single.php?post_id=$post_id' style='float:right;'><button>Comment</button></a><br>
                    </div>
                    <div class='col-sm-3'></div>
                </div><br><br>
                ";
            }else{
                echo "
                <div class='row'>
                    <div class='col-sm-3'></div>
                    <div id='post' class='col-sm-6'>
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
                        <a href='single.php?post_id=$post_id' style='float:right;'><button>Comment</button></a><br>
                    </div>
                    <div class='col-sm-3'></div>
                </div><br><br>
                ";
            }
        }
        require_once("pagination.php");
    }
?>