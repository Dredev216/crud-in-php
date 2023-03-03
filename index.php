<?php include("config.php"); ?>
<!DOCTYPE html>
<html>

<head>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>

    <title>Display Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>

<body class="bg-body-secondary text-black">
    <a href="user.php" class="text-light">
        <button class="btn btn-primary fs-5 btn-lg my-5 mx-4"> Add user </button>
    </a>

    <div class="input-group mb-4 w-50 mx-4">
        <button class="btn btn-primary text-light sm-4 btn-lg t" type="button" id="searchbtn">Search</button>
        <input id="search" type="text" class="form-control" placeholder="Search..." aria-describedby="search">
    </div>

    <table class="table mx-4 fs-5">
        <thead class="fw-bold">
            <tr>
                <th scope="col">Serial</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Number</th>
                <th scope="col">Operations</th>
            </tr>
        </thead>
        <tbody id="tableSearch">
            <?php
            /*   */
            $sql = "select * from `crud`";
            $execute = mysqli_query($connect, $sql);
            if ($execute) {
                while ($row = mysqli_fetch_assoc($execute)) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $email = $row['email'];
                    $number = $row['number'];

                    echo "
                    <tr>
                        <td>" . $id . "</td>
                        <td>" . $name . "</td>
                        <td>" . $email . "</td>
                        <td>" . $number . "</td>
                        <td>
                        
                        <a class='text-light' href='alter.php?updateid=" . $id . "'> 
                            <button class='btn btn-primary'> Update  </button>
                        </a>
                        <button class='btn btn-danger text-light' onclick='myDelete(" . $id . ")'> 
                            Delete
                        </button>
                        </td>
                    </tr>
                    ";
                }
            }
            ?>
        </tbody>
    </table>

</body>

</html>

<script>
    function myDelete(id) {
        let yes = window.confirm('This will delete User: ' + id + ' permanetly')
        if (yes) {
            window.location.replace("delete.php?dieid=" + id)
        }
    }

    $(document).ready(function() {
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tableSearch tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>