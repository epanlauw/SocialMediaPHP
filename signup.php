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
        // enkripsi password
        $salt = generateRandomString(10);
        $password = md5($_POST['password'].$salt);

        // menyiapkan query
        $sql = "INSERT INTO users values('$first_name','$last_name','$email','$password','$salt','$birthdate','$gender')";

        mysqli_query($db,$sql);

        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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
    <body class="bg-light">
        <div class="container mt-5">
            <h2>CREATE NEW ACCOUNT</h2>
            <h5>It's free and always be.</h5>
            <form action="" method="post" onSubmit="return validate();">
                <div class="form-group">
                    <div class="col-md-4">
                        <input type="text" name="first_name" class="form-control" placeholder="First Name">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="last_name" class="form-control" placeholder="Last Name">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8">
                        <br/>
                        <input type="text" name="email" class="form-control" placeholder="Email" id="email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8">
                        <br/>
                        <input type="password" name="password" class="form-control" placeholder="Password" id="password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8">
                        <br/>
                        <input type="password" name="password" class="form-control" placeholder="Confirmation Password" id="confirm-password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8">
                        <br/>
                        <input type="date" name="birthdate" class="form-control" placeholder="Birthday">
                    </div>
                </div>
                <div class="form-group">
                   <div class="col-md-8">
                    <br/>
                        <h4>Jenis Kelamin</h4>
                        <input type="radio" name="gender" value="pria"> Male
                        <input type="radio" name="gender" value="wanita"> Female
                   </div>
                </div>
                <button type="submit" class="btn btn-primary" name="register">Sign Up</button>
            </form>
        </div>
        <div class="col-md-6">
            <img class="img img-responsive" src="img/connect.png" />
        </div>
    </body>
</html>