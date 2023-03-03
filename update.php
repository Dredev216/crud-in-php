<?php
    include("config.php");

    if (!empty($_POST['data'])) {
        parse_str($_POST['data'], $arrPOST);
        $id = $arrPOST['id'];
        $name = $arrPOST['name'];
        $email = $arrPOST['email'];
        $number = $arrPOST['number'];
        $password = $arrPOST['password'];

        $sql = "update `crud` set id=$id, name='$name',
    email='$email', number='$number', password='$password' where id=$id";

        $execute = mysqli_query($connect, $sql);

        if ($execute) {
            header("location:index.php");
            exit;
        } else {
            die(mysqli_error($connect));
        }
    }
?>