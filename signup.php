<?php 
    require_once('config.php');

    function generateRandomString($nbLetters){
        $randString="";
        $charUniverse="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        for($i=0; $i<$nbLetters; $i++){
           $randInt=rand(0,61);
            $randChar=$charUniverse[$randInt];
            $randString=$randString.$randChar;
        }
        return $randString;
    }

    if(isset($_POST['register'])){
        // filter data yang diinputkan
        $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
        $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $gender = $_POST['gender'];
        $birthdate = $_POST['birthdate'];
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        // enkripsi password
        $salt = generateRandomString(10);
        $password = md5($_POST['password'].$salt);

        $cek_username = mysqli_num_rows(mysqli_query($db,"SELECT username FROM users WHERE username = '$username'"));
        $cek_email =  mysqli_num_rows(mysqli_query($db,"SELECT email FROM users WHERE email = '$email'"));
        if($cek_username>0){
            $usernameErr  = "Username telah digunakan";
        }else if($cek_email>0){
            $emailErr =  "Email telah digunakan";
        }else {
            // menyiapkan query
            $sql = "INSERT INTO users(fName,lName,email,password,salt,tglLahir,jenisKelamin,photo,username,post,relationship,deskripsi,cover) values('$first_name','$last_name','$email','$password','$salt','$birthdate','$gender','default.jpeg','$username','no','...','Halo Selamat Datang di Sosmed Kami Selamat Menikmati','background-cover.jpg')";
            mysqli_query($db,$sql);
            header("Location:login.php");
        }
    }
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
        <title>Sign Up - Untuk Pendaftaran</title>

        <script>
            function validate() {
                var c = document.getElementById("email").value;
                var a = document.getElementById("password").value;
                var b = document.getElementById("confirm-password").value;
                
                if(c == ""|| a == "" || b == ""){
                    alert("Please insert Username and Password");
                    return false;
                }

                if(a != b){
                    alert("Password do not match");
                    return false;
                }
            }
        </script>
    </head>
    <style>
        body {
            overflow-x: hidden;
        }
        .main-content {
            width: 50%;
            height: 40%;
            margin: 10px auto;
            background-color: #fff;
            border: 2px solid #e6e6e6;
            padding : 40px 50px;
        }
        .header{
            border: 0px solid #000;
            margin-bottom: 5px;
        }
        .well{
            background-color: #187FAB;
        }
        #signup{
            width: 60%;
            border-radius: 30px;
        }
        .error {color: #FF0000;}
    </style>
    <body>
        <div class="row">
            <div class="col-sm-12">
                <div class="well">
                    <center><h1 style="color:white;">Sosmed</h1></center>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
            <center><img src="https://cdn4.iconfinder.com/data/icons/animals-45/755/Giraffe-512.png" width="200px" height="200px" class="brand_logo" alt="Logo"></center>
                <div class="main-content">
                    <div class="header">
                        <h2 style="text-align:center;"><strong>CREATE NEW ACCOUNT</strong></h3>
                        <h5 style="text-align:center;"><strong>It's free and always be.</strong></h5><hr>
                    </div>
                    <div class="1-part">
                        <form method="post" action="" onSubmit="return validate();">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                <input type="text" name="first_name" class="form-control" placeholder="First Name" required="required">
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name">
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" name="username" class="form-control" placeholder="Username" id="username" required="required">
                            </div>
                            <span class="error"><?php if(isset($_POST['register'])) if($cek_username > 0) echo "*" . $usernameErr;?></span><br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input type="text" name="email" class="form-control" placeholder="Email" id="email" required="required">
                            </div>
                            <span class="error"><?php if(isset($_POST['register'])) if($cek_email > 0) echo "*" . $emailErr;?></span><br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Password" id="password" required="required">
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Confirmation Password" id="confirm-password" required="required">
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                <select class="form-control input-md" name="gender" required="required">
                                    <option disabled>Select your gender</option>
                                    <option value="pria">Pria</option>
                                    <option value="wanita">Wanita</option>
                                </select> 
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                <input type="date" name="birthdate" class="form-control" placeholder="Birthday" required="required">
                            </div><br>
                            <center><button type="submit" class="btn btn-primary btn-lg" name="register" id="signup">Sign Up</button></center>
                            <center><h4>Already have an account? <a style="color: #187FAB;" data-toggle="tooltip" title="Login" href="login.php">Login</a></h4></center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>