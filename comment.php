<?php 
    $get_id = $_GET['post_id'];

    $get_com = "SELECT * FROM comments WHERE post_id='$get_id' ORDER BY 1 DESC";

    $run_com = mysqli_query($db, $get_com);
    while ($row = mysqli_fetch_array($run_com)){
        $com = $row['comment'];
        $com_name = $row['comment_author'];
        $date = $row['date'];

        echo"
            <div class='row'>
                <div class='col-md-6 col-md-offset-3'>
                    <div class='panel panel-info'>
                        <div class='panel-body'>
                            <div>
                                <h4><strong>$com_name </strong><i> commented </i>on $date</h4>
                                <p class='text-primary' style='font-size:20px;'>$com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        ";
    }
?>