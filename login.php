<?php 
    require_once("config.php");
    if(isset($_POST['login'])){      
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'];

        $login = mysqli_query($db,"select * from users where email = '$email' and password = MD5(CONCAT('$password',users.salt))");

        $query = "select * from users where email = '$email' and password = MD5(CONCAT('$password',users.salt))";
        
        $cek = mysqli_num_rows($login);
        $result = $db->query($query);
        $row = $result -> fetch_assoc();
        if($cek >0){
            session_start();
            $_SESSION['user'] = $row;
            $_SESSION['status'] = $login;
            header("Location:timeline.php");
        }else{
            echo "false";
        }
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
        <title>Login Cuy</title>
    </head>
    <body class="bg-light">
        <div class="container mt-5">
        <div class="row">
            <p>&larr; <a href="index.php">Home</a>
            <h4>Masuk ke Sosmed</h4>
            <p>Belum punya akun?<a href="signup.php">Registration</a>

            <form action="" method="POST">
                <div class="form-group">
                    <div class="col-md-8">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Email"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8">
                        <br/>
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8">
                    <br />
                    <input type="submit" class="btn btn-success btn-block" name="login" value="Masuk"/>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>