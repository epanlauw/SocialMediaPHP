<?php 
    require_once("config.php");  
	if(isset($_POST['login'])){ 
		$fail = false; 
        session_start();
        if($_SESSION["code"] != $_POST["kodecaptcha"]){
            $capthaError = "Kode Captcha Salah";
        }else{
			$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
			$password = $_POST['password'];
			
            $login = mysqli_query($db,"select * from users where email = '$email' or username ='$email' and password = MD5(CONCAT('$password',users.salt))");

            $query = "select * from users where email = '$email' and password = MD5(CONCAT('$password',users.salt))  or username ='$email' and password = MD5(CONCAT('$password',users.salt))";
            
            $cek = mysqli_num_rows($login);
            $result = $db->query($query);
            $row = $result -> fetch_assoc();
            if($cek >0){
                session_start();
                $_SESSION['user'] = $row;
                $_SESSION['status'] = $login;
                header("Location:timeline.php");
            }else{
				$fail = true;
            }
		}
        
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<style>.error {color: #FF0000;}</style>
<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="https://cdn4.iconfinder.com/data/icons/animals-45/755/Giraffe-512.png" width="200px" height="200px" class="brand_logo" alt="Logo">
					</div>
				</div>
				</br>
				<h3> USER LOGIN </h3>
				<div class="d-flex justify-content-center form_container">
					<form action="" method="POST" >
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input required="required" type="text" name="email" class="form-control input_user" value="" placeholder="Username/Email">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input required="required" type="password" name="password" class="form-control input_pass" value="" placeholder="password">
						</div>
						<div class="d-flex justify-content-center">
								<img src="captcha.php" alt="gambar">
						</div>
						<div class="input-group mb-2">
							<input name="kodecaptcha" class="form-control input_captcha" value="" placeholder="captcha" maxlength="5">
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customControlInline">
								<label class="custom-control-label" for="customControlInline">Remember me</label>
							</div>
						</div>
							<div class="d-flex justify-content-center mt-3 login_container">
						 <input type="submit" class="btn btn-success btn-block" name="login" value="Masuk"/>
				   </div>
				   <span class="error"><?php if(isset($_POST['login']))  if($_SESSION["code"] != $_POST["kodecaptcha"]) echo "*" . $capthaError;?></span>
				   <span class="error"><?php if(isset($_POST['login']))  if($fail == true) echo "*ID atau Password Salah";?></span>
					</form>
				</div>
				<div class="mt-2">
					<div class="d-flex justify-content-center links">
						Don't have an account? <a href="signup.php" class="ml-2">Sign Up</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>