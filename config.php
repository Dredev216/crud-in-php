<?php 

$connect = new mysqli("localhost", "root", "", "crudinphp");

if(!$connect){
    die(mysqli_error($connect));
}

?>