<?php
include "config.php";
if (!empty($_POST['formData'])) {
    parse_str($_POST['formData'], $arrPOST);
    $name = $arrPOST["name"];
    $email = $arrPOST["email"];
    $number = $arrPOST["number"];
    $password = $arrPOST["password"];

    $sql = "insert into `crud`(name, email, number, password)
    values('$name','$email','$number','$password')";

    $execute = mysqli_query($connect, $sql);

    if ($execute) {
        header('location: index.php');
    } else {
        die(mysqli_error($connect));
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD in PHP</title>
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0;
        }

        label.error {
            color: red;
            display: block;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
</head>

<body class="bg-body-secondary text-black fw-bold">


    <a href="index.php" class="text-light">
        <button class="btn btn-primary fs-5 btn-lg my-4 mx-3">
            << Go Back </button>
    </a>
    <h2 class="mx-4">Sign Up </h2>
    <div class="container my-5 fs-5">
        <form method="post" id="valform">
            <div class="mb-5">
                <label>Name</label>
                <input type="text" name="name" id="name" class="form-control fs-5" placeholder="Enter your first name" autocomplete="off" required>
            </div>
            <div class="mb-5">
                <label>Email</label>
                <input type="email" name="email" id="email" class="form-control fs-5" placeholder="Enter your email" autocomplete="off" required>
            </div>
            <div class="mb-5">
                <label>Number</label>
                <input type="number" name="number" id="number" minlength="10" maxlength="10" pattern="^[\d]+$" class="form-control fs-5" placeholder="123 456 7890" autocomplete="off" required>
            </div>
            <div class="mb-5">
                <label>Password</label>
                <input type="password" name="password" id="password" minlength="6" maxlength="10" class="form-control fs-5" placeholder="Enter a password" autocomplete="off" required>
            </div>
            <input type="hidden" name="save" value="contact" />
            <input type="submit" id="submit" class="btn btn-primary fs-4 btn-lg" name="submit" value="Submit" />
        </form>
    </div>

</body>

</html>

<script>
    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
    }, "No special characters allowed");

    jQuery.validator.addMethod("emailvalid", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9]+@[a-z]+\.[a-z]+$/i.test(value);
    }, "This email is not valid");

    $("#valform").validate({
        rules: {
            name: {
                lettersonly: true,
                minlength: 3,
                maxlength: 8
            },
            email: {
                emailvalid: true,
                email: true
            },
            number: {
                minlength: 10,
                maxlength: 10
            }
        },
        messages: {
            name: {
                required: "Please enter your name",
                lettersonly: "No special characters allowed",
                minlength: "Name is too short",
                maxlength: "Name is too long"
            },
            email: {
                required: "Please enter your email",
                emailvalid: "This email is not valid"
            },
            number: {
                required: "Number should not be empty",
                minlength: "Number should be 10 digits",
                maxlength: "Number should be 10 digits"
            },
            password: {
                required: "Password should not be empty"
            }
        },
        submitHandler: function() {
            var formData = $('#valform').serialize();
            $.post('user.php', {
                formData
            }, function() {
                alert('User saved succesfully');
                window.location.replace("index.php");
            });
        }
    });
</script>