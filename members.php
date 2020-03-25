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
        <title>Temukan Orang Baru</title>
    </head>
    <style>
        #find_people{
            border: 5px solid #e6e6e6;
            padding:40px 50px;
            background-color:white;
        }
        #result_post{
            border: 5px solid #e6e6e6;
            padding:40px 50px;
        }
        form.search_form input[type=text]{
            padding: 10px;
            font-size: 17px;
            border-radius: 4px;
            border: 1px solid grey;
            float: left;
            width:80%;
            background: #f1f1f1;
        }
        form.search_form button{
            float: left;
            width: 20%;
            padding: 10px;
            font-size: 17px;
            border: 1px solid grey;
            border-left: none;
            cursor: pointer;
        }
        form.search_form button:hover{
            background: #0b7dda;
        }
        form.search_form button::after{
            content: "";
            clear: both;
            display: table;
        }
    </style>
    <body>
        <div class="row">
            <div class="col-sm-12">
                <center><h2>Temukan Orang Baru</h2></center>
                <div class="row">
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-4">
                        <form class="search_form" action="">
                            <input type="text" placeholder="Cari Teman" name="search_user">
                            <button class="btn btn-info" type="submit" name="search_user_btn">Cari</button>
                        </form>
                    </div>
                    <div class="col-sm-4">
                    </div>
                </div><br><br>
                <?php searchUser(); ?>
            </div>
        </div>
    </body>
</html>