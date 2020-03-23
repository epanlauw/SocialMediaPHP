<!DOCTYPE html>
<html>
<head>
    <title>Sosmed</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
    body{
        overflow-x:hidden;
    }
    #centered1{
        position:absolute;
        font-size:10vw;
        top:30%;
        left:30%;
        transform:translate(-50%, -50%);
    }
    #centered2{
        position:absolute;
        font-size:10vw;
        top:50%;
        left:40%;
        transform:translate(-50%, -50%);
    }
    #centered3{
        position:absolute;
        font-size:10vw;
        top:70%;
        left:30%;
        transform:translate(-50%, -50%);
    }
    #signup{
        width: 60%;
        border-radius:30px;
    }
    #login{
        width: 60%;
        border-radius:30px;
        border: 1px solid #1da1f2;
        color: #1da1f2;
        background-color: #fff;
    }
    #login:hover{
        width: 60%;
        border-radius:30px;
        border: 2px solid #1da1f2;
        color: #1da1f2;
        background-color: #fff;
    }
    .well{
        background-color: #187FAB;
    }
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
        <div class="col-sm-6" style="left:0.5%;">
            <img src="img/background-index.jpg" class="img-rounded" title="Connect" width="650px" height="565px">
            <div id="centered1" class="centered"><h3 style="color:white;"><span class="glyphicon glyphicon-search"></span>&nbsp&nbsp<strong>Follow Your Interests</strong></h3></div>
            <div id="centered2" class="centered"><h3 style="color:white;"><span class="glyphicon glyphicon-search"></span>&nbsp&nbsp<strong>Hear what People are talking about.</strong></h3></div>
            <div id="centered3" class="centered"><h3 style="color:white;"><span class="glyphicon glyphicon-search"></span>&nbsp&nbsp<strong>Join the Conversation</strong></h3></div>
        </div>
        <div class="col-sm-6" style="left:8%;">
            <img src="https://cdn4.iconfinder.com/data/icons/animals-45/755/Giraffe-512.png" class="img-rounded" title="Connect"  width="200px" height="200px">
            <h2><strong>Connect You<br>to the world</strong></h2><br><br>
            <h4><strong>Gabung Sosmed Sekarang</strong></h3>
            <a href="signup.php" class="btn btn-info btn-lg" id="signup">Sign Up</a>
            <a href="login.php"  class="btn btn-info btn-lg" id="login">Login</a>
        </div>
    </div>
</body>
</html>