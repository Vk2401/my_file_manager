<?php
session_start();
error_reporting(0);

// Check if the user type is not set or is not "admin"
if (!isset($_SESSION['type']) || $_SESSION['type'] !== "admin") {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Retrieve Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="../css/jquery.dataTables.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf-8" language="javascript" src="../js/jquery.dataTables.js"></script>

    <style type="text/css">

    </style>

</head>

<body>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="msg">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>
    <div class="container">
        <a href="create.php"><button type="button" class="btn btn-success" title="click to add User">
                <b><span class=" material-symbols-outlined">add</span></b></button></a>
        <a href="../index.php"><button type="button" class="btn btn-success" title="Goto Home">
                <span class=" material-symbols-outlined">home</span></button></a>
        <div class="row">
            <div class="col-12">
                <?php
                // Include config file
                include 'db/config.php';
                // Attempt select query execution
                $sql = "SELECT * FROM users WHERE uname != 'admin' and id != 1 ORDER BY id DESC;";
                if ($result = mysqli_query($conn, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        echo '<table class="table table-condensed display" style="width:100%; border-radius: 10px;" id="example">';
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>ID</th>";
                        echo "<th>User Name</th>";
                        echo "<th>Password</th>";
                        echo "<th>Action</th>";
                        echo "</tr>";
                        echo "</thead>";

                        echo "<tbody>";
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['uname'] . "</td>";
                            echo "<td> ********* </td>";
                            echo "<td>";
                            echo '<a href="edit.php?id=' . $row['id'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="material-symbols-outlined btn-warning btn">
                              edit
                            </span></a>';
                            echo " ";

                            echo '<a href="delete.php?id=' . $row['id'] . '" title="Delete Record" data-toggle="tooltip"><span class="btn btn-danger material-symbols-outlined">delete</span></a>';

                            echo "</td>";

                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        mysqli_free_result($result);
                    } else {
                        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close connection
                mysqli_close($conn);
                ?>
            </div>
        </div>
    </div>
    </div>
    <script type="text/javascript">new DataTable('#example', { order: [[0, 'desc']] });</script>

</body>

</html>