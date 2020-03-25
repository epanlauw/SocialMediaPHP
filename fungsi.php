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
?>