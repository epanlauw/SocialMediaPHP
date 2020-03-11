<?php require_once("auth.php"); 

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <title>Timeline</title>
    </head>
    <body class="bg-light">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            
                            <img class="img img-responsive rounded-circle mb-3" width="160" src="data:image/jpeg;base64,<?php echo base64_encode($_SESSION['user']['photo']) ?>" />

                            <h3><?php echo  $_SESSION['user']['fName'].' '.$_SESSION['user']['lName'];?></h3>

                            <p><a href="logout.php">Logout</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <form action="" method="POST">
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Apa yang kamu pikirkan?"></textarea>
                        </div>
                    </form>

                    <?php for($i=0; $i < 6; $i++){ ?>
                    <div class="card mb-3">
                        <div class="card-body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis veritatis nemo ad recusandae labore nihil iure qui eum consequatur, officiis facere quis sunt tempora impedit ullam reprehenderit facilis ex amet!
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </body>
</html>