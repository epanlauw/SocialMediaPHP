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
        <title><?php echo $namalengkap?></title>
    </head>
    <style>
        #upload_image_btn{
            position:absolute;
            top: 47%;
            right: 14.2%;
            min-width: 100px;
            max-width: 100px;
            border-radius: 4px;
            transform: translate(-50%, -50%);
        }
        #body{
            width: 70%;
        }
        #btn_post{
            min-width: 25%;
            max-width: 25%;
        }
        #insert_post{
            background-color:#fff;
            border: 2px solid #e6e6e6;
            padding:40px 50px;
        }
        #post{
            border:5px solid #e6e6e6;
            padding:40px 50px;
            background-color: white;
        }
        #post-img{
            padding-top: 5px;
            padding-right:10px;
            min-width: 102%;
            max-width: 50%;
        }
        #single-post{
            border: 5px solid #e6e6e6;
            padding:40px 50px;
        }
    </style>
    <body>
        <div class="row">
            <div id="insert_post" class="col-sm-12">
                <center>
                <form action="timeline.php?id=<?php echo $user_id; ?>" method="post" id="f" enctype="multipart/form-data">
                    <textarea class="form-control" id="body" rows="4" name="body" placeholder="Apa yang kamu pikirkan?"></textarea><br>
                    <label class="btn btn-warning" id="upload_image_btn">Pilih Gambar
                        <input type="file" name="upload_image" size="30">
                    </label>
                    <button id="btn_post" class="btn btn-success" name="submit">Post</button>
                </form>
                <?php insertPost(); ?>
                </center>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
               <center><h2><strong>News Feed</strong></h2></center>
                <?php getPost();?> 
            </div>
        </div>
    </body>
</html>