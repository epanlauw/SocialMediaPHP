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
            echo $upload_image;
            if(strlen($body) > 250){
                echo "<script>alert('Please Use 250 or less than 250 words!')</script>";
			    echo "<script>window.open('timeline.php', '_self')</script>";
            }else{
                if(strlen($body) >= 1 && strlen($upload_image) >= 1){
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
                            $rnd=null;
                            $queryLain = "INSERT INTO post (user_id, body,post_date) values ('$user_id','$body',NOW())";
                            $result = mysqli_query($db,$queryLain);
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
                                <h3><a style='text-decoration: none; cursor: pointer; color:#3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
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
                                <h3><a style='text-decoration: none; cursor: pointer; color:#3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
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
                                <h3><a style='text-decoration: none; cursor: pointer; color:#3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
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
                    </div>
                    <div class='col-sm-3'></div>
                </div><br><br>
                ";
            }
        }
        require_once("pagination.php");
    }

    function singlePost(){
        if(isset($_GET['post_id'])){
            global $db;

            $id = $_GET['post_id'];
            $sql = "SELECT * FROM post WHERE id='$id'";
            $query =  mysqli_query($db,$sql);
            $row = mysqli_fetch_array($query);

            $post_id = $row['id'];
            $user_id = $row['user_id'];
            $body = $row['body'];
            $upload_image = $row['upload_img'];
            $date = $row['post_date'];

            $user = "SELECT * FROM users WHERE id='$user_id'  AND post='yes'";

            $queryUser = mysqli_query($db,$user);
            $rowUser = mysqli_fetch_array($queryUser);

            $user_name = $rowUser['username'];
            $user_img = $rowUser['photo'];
            $user_com = $_SESSION['user']['id'];

            $get_com = "SELECT * FROM users WHERE id='$user_com'";
            $run_com = mysqli_query($db,$get_com);
            $row_com = mysqli_fetch_array($run_com);

            $user_com_id = $row_com['id'];
            $user_com_name = $row_com['username'];

            if(isset($_GET['post_id'])){
                $post_id = $_GET['post_id'];
            }
            $get_post = "SELECT * FROM users WHERE id='$post_id'";
            $run_user = mysqli_query($db,$get_post);

            $post = $_GET['post_id'];
            $get_user = "SELECT * FROM post WHERE id=$post";
            $run_user = mysqli_query($db,$get_user);
            $row = mysqli_fetch_array($run_user);

            $p_id = $row['id'];
            if($p_id != $post_id){
                echo "<script>alert('ERROR')</script>";
                echo "<script>window.open('timeline.php', '_self')</script>";
            }else{
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
                                    <h3><a style='text-decoration: none; cursor: pointer; color:#3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
                                    <h4><small style='color:black;'>Updated a post on <strong>$date</strong></small></h4>
                                </div>
                                <div class='col-sm-4'></div>
                            </div>
                            <div class='row'>
                                <div class='col-sm-12'>
                                    <img id='post-img' src='imgpost/$upload_image' style='height:350px;'>
                                </div>
                            </div><br>
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
                                    <h3><a style='text-decoration: none; cursor: pointer; color:#3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
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
                                    <h3><a style='text-decoration: none; cursor: pointer; color:#3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
                                    <h4><small style='color:black;'>Updated a post on <strong>$date</strong></small></h4>
                                </div>
                                <div class='col-sm-4'></div>
                            </div>
                            <div class='row'>
                                <div class='col-sm-12'>
                                    <p>$body</p>
                                </div>
                            </div><br>
                        </div>
                        <div class='col-sm-3'></div>
                    </div><br><br>
                    ";
                }
                require_once("comment.php");
                echo"
                <div class='form-group'>
                    <div class='col-md-6 col-md-offset-3'>
                        <div class='panel panel-info'>
                            <div class='panel-body'>
                                <form class='form-inline' action='' method='post'>
                                <textarea placeholder='Tulis commentmu disini!' class='pb-cmnt-textarea' name='comment'></textarea>
                                <button class='btn btn-info pull-right' name='reply'>Comment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                ";
                if(isset($_POST['reply'])){
                    $comment = $_POST['comment'];

                    if($comment == ""){
                        echo "<script>alert('Masukkan commentmu');</script>";
                        echo "<script>window.open('single.php?post_id=$post_id', '_self')</script>";
                    }else{
                        $insert = "INSERT INTO comments (post_id, user_id,comment,comment_author,date) values('$post_id','$user_com_id','$comment','$user_com_name',NOW())";

                        $run = mysqli_query($db,$insert);
                        echo "<script>alert('Commentmu telah dimasukkan');</script>";
                        echo "<script>window.open('single.php?post_id=$post_id', '_self')</script>";
                    }
                }
            }
        }
    }

    function searchUser() {
        global $db;
        if(isset($_GET['search_user_btn'])) {
            $search_query = $_GET['search_user'];
            $get_user = "SELECT * FROM users WHERE fName LIKE '%$search_query%' OR lName LIKE '%$search_query%' OR username LIKE '%$search_query%'";
        }else{
            $get_user = "SELECT * FROM users";
        }
        $run_user = mysqli_query($db,$get_user);
        while($row_user = mysqli_fetch_array($run_user)){
            $user_id = $row_user['id'];
            $fName = $row_user['fName'];
            $lName = $row_user['lName'];
            $username = $row_user['username'];
            $user_image = $row_user['photo'];

            echo"
            <div class='row'>
                <div class='col-sm-3'>
                </div>
                <div class='col-sm-6'>
                    <div class='row' id='find_people'>
                        <div class='col-sm-4'>
                            <a href='user_profile.php?u_id=$user_id'>
                                <img src='profil/$user_image' width='150px' height='140px' title='$username' style='float:left; margin:1px'>
                            </a>
                        </div><br><br>
                        <div class='col-sm-6'>
                            <a style='text-decoration:none;cursor: pointer;color:#3897f0;' href='user_profile.php?u_id=$user_id'><strong><h2>$fName $lName</h2></strong></a>
                        </div>
                        <div class='col-sm-3'></div>
                    </div>
                </div>
                <div class='col-sm-4'>
                </div>
            </div><br>
            ";
        }
    }
?>