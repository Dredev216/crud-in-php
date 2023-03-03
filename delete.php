<?php
include("config.php");
if (isset($_GET['dieid'])) {
    $id = $_GET['dieid'];

    $sql = "delete from `crud` where id = $id";
    $execute = mysqli_query($connect, $sql);
    if($execute){
        header("location: index.php");
    }else{
        die(mysqli_error($connect));
    }
}
?>