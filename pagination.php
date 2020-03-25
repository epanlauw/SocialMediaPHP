<style>
    .pagination a{
        color:black;
        float:left;
        padding:8px 16px;
        text-decoration:none;
        transition: background-color .3s;
    }
    .pagination a:hover:not(.active){background-color:#ddd;}
</style>
<?php 
    $query = "SELECT * FROM post";
    $result =  mysqli_query($db,$query);

    $total_post = mysqli_num_rows($result);
    $total_page = ceil($total_post/ $per_page);

    echo "<center>
          <div class='pagination'>
            <a href='timeline.php?page=1'>First Page</a>
    ";

    for($i=1; $i <= $total_page; $i++){
       echo"<a href='timeline.php?page=$i'>$i</a>";
    }
    echo "<a href='timeline.php?page=$total_page'>Last Page</a></div>";
?>