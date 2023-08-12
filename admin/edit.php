<?php
include 'db/config.php';

if (isset($_POST['save'])) {
    $id = $_POST['id'];
    $uname = $_POST['uname'];
    $password = $_POST['password'];

    // Collecting privileges from checkboxes
    $privileges = array(
        'view' => isset($_POST['privileges']['view']),
        'edit' => isset($_POST['privileges']['edit']),
        'delete' => isset($_POST['privileges']['delete']),
        'set' => isset($_POST['privileges']['set'])
    );

    // Converting privileges array to JSON
    $privilegesJSON = json_encode($privileges);

    mysqli_query($conn, "UPDATE users SET uname='$uname',type='$privilegesJSON',password='$password' WHERE id=$id");

    header('location: index.php');
}

$result = mysqli_query($conn, "SELECT * FROM users WHERE id='" . $_GET['id'] . "'");
$row = mysqli_fetch_array($result);
$existingPrivileges = json_decode($row['type'], true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update Record</title>
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
            <h1>Update Record</h1>
            <form action="edit.php" method="POST" class="login-form">
                <input type="hidden" name="id" class="txtField" value="<?php echo $row['id']; ?>">
                <div class="form-group">
                    <input type="text" placeholder="User Name" class="form-control" name="uname" required=""
                        value="<?php echo $row['uname']; ?>">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Password" class="form-control" name="password" required="email"
                        value="<?php echo $row['password']; ?>">
                </div>
                <div class="form-check">
                    <label>User Privileges:</label><br>
                    <label class="form-check-label" for="view"> Download</label>
                    <input class="form-check-input" type="checkbox" name="privileges[view]" value="1" id="view" <?php if (isset($existingPrivileges['view']) && $existingPrivileges['view'])
                        echo 'checked'; ?>>
                    <label class="form-check-label" for="edit">Edit</label>
                    <input class="form-check-input" type="checkbox" name="privileges[edit]" value="1" id="edit" <?php if (isset($existingPrivileges['edit']) && $existingPrivileges['edit'])
                        echo 'checked'; ?>>
                    <label class="form-check-label" for="delete"> Delete</label>
                    <input class="form-check-input" type="checkbox" name="privileges[delete]" value="1" id="delete"
                        <?php if (isset($existingPrivileges['delete']) && $existingPrivileges['delete'])
                            echo 'checked'; ?>>
                    <label class="form-check-label" for="set"> set</label>
                    <input class="form-check-input" type="checkbox" name="privileges[set]" value="1" id="set" <?php if (isset($existingPrivileges['set']) && $existingPrivileges['set'])
                        echo 'checked'; ?>>
                </div>
                <button type="submit" class="btnsave" name="save">Save Record</button>
            </form>
        </div>
    </div>
</body>

</html>