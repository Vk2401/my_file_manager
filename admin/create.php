<?php
include 'db/config.php';

if (isset($_POST['save'])) {
    // Escape user inputs for security
    $uname = mysqli_real_escape_string($conn, $_POST['uname']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);

    // Creating an associative array for privileges
    $privileges = array(
        'view' => isset($_POST['privileges']['view']),
        'edit' => isset($_POST['privileges']['edit']),
        'delete' => isset($_POST['privileges']['delete']),
        'set' => isset($_POST['privileges']['set'])
    );

    // Convert privileges array to JSON
    $privilegesJSON = json_encode($privileges);

    $sql = "INSERT INTO users (uname, type, password) VALUES ('$uname', '$privilegesJSON', '$password')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Record has been added successfully";
        header('location: index.php');
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Create Record</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <style type="text/css">
        * {
            margin: 0px;
            padding: 0px;
        }
    </style>
</head>

<body>
    <div class="login">
        <div class="account-login">
            <h1>Create New User</h1>
            <form action="create.php" method="POST" class="login-form">
                <div class="form-group">
                    <input type="text" placeholder="User Name" class="form-control" name="uname" required="">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Password" class="form-control" name="pass" required="">
                </div>
                <div class="form-check">
                    <label>User Privileges:</label><br>
                    <label class="form-check-label" for="view"> Download</label>
                    <input class="form-check-input" type="checkbox" name="privileges[view]" value="1" id="view">
                    <label class="form-check-label" for="edit">Edit</label>
                    <input class="form-check-input" type="checkbox" name="privileges[edit]" value="1" id="edit">
                    <label class="form-check-label" for="delete"> Delete</label>
                    <input class="form-check-input" type="checkbox" name="privileges[delete]" value="1" id="delete">
                    <label class="form-check-label" for="set"> set</label>
                    <input class="form-check-input" type="checkbox" name="privileges[set]" value="1" id="set">
                </div>

                <button type="submit" class="btnsave" name="save">Save Record</button>
            </form>
        </div>
    </div>
</body>

</html>