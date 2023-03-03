<?php
include("config.php");
$id = $_GET['updateid'];

$sql = "select * from `crud` where id=$id";
$execute = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($execute);

$name = $row["name"];
$email = $row["email"];
$number = $row["number"];
$password = $row["password"];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
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
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
</head>

<body class="bg-body-secondary text-black fw-bold">
    <a href="index.php" class="text-light">
        <button class="btn btn-primary my-4 mx-3 fs-4 btn-lg">
            << Go Back </button>
    </a>
    <h2 class="my-2 mx-4">Update</h2>
    <div class="container my-4 fs-5">
        <form method="post" id="updateForm">
            <div class="mb-3">
                <input type="hidden" readonly name="id" id="id" class="form-control fs-5" autocomplete="off" value="<?php echo ($id); ?>">
            </div>
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" id="name" class="form-control fs-5" autocomplete="off" value="<?php echo ($name); ?>" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" id="email" class="form-control fs-5" autocomplete="off" value="<?php echo ($email); ?>" required>
            </div>
            <div class="mb-3">
                <label>Number</label>
                <input type="number" name="number" id="number" minlength="10" maxlength="10" pattern="^[\d]+$" class="form-control fs-5" value="<?php echo ($number); ?>" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" id="password" minlength="6" maxlength="10" class="form-control fs-5" value="<?php echo ($password); ?>" autocomplete="off" required>
            </div>
            <input type="submit" id="update" name="update" class="btn btn-primary fs-4 btn-lg" value="Update">
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

    $(document).ready(function() {
        $("#updateForm").validate({
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
                    minlength: "Number should have 10 digits",
                    maxlength: "Number should have 10 digits"
                },
                password: {
                    required: "Password should not be empty",
                    maxlength: "Password should be maximum 10 characters"
                }
            },

            submitHandler: function() {
                var data = $('#updateForm').serialize();

                $.post("update.php", {
                    data
                }, function() {
                    console.log(data)
                    alert('Changed sucessfully');
                    //window.location.replace('index.php');
                });
            }
        });
    });
</script>   