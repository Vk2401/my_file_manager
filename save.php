<?php
include('dbcon.php'); 

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Common form data

    // If an ID is provided, it's an update
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
        $xdate = $_POST['exdate'];
        $selectedType = $_POST['etype'];

        // Update the record with the edited data
        $updateSql = "UPDATE upload SET xdate = '$xdate', type = '$selectedType' WHERE id = $id";
        $updateResult = mysqli_query($conn, $updateSql);

        if ($updateResult) {
            header("location: index.php");
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else { // It's an insert
        $fname = $_POST['fname'];
        $fileExtension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $size = $_FILES['photo']['size'];
        $type = $_FILES['photo']['type'];
        $temp = $_FILES['photo']['tmp_name'];
        $date = date('Y-m-d H:i:s');
        $caption = $_POST['caption'];
        $link = $_POST['link'];
        $xdate = $_POST['xdate'];
        $selectedType = $_POST['type'];

        $newName = $fname . '.' . $fileExtension;
        $uploadDirectory = realpath("files/") . DIRECTORY_SEPARATOR . $newName;

        if (file_exists($uploadDirectory)) {
            echo "<script>alert('File with the same name already exists. Please choose a different name.');</script>";
        } else {
            // Move the uploaded file to the destination directory
            move_uploaded_file($temp, $uploadDirectory);

            // Insert new record
            $insertSql = "INSERT INTO upload (name, date, xdate, type) VALUES ('$newName', '$date', '$xdate', '$selectedType')";
            $insertResult = mysqli_query($conn, $insertSql);

            if ($insertResult) {
                header("location: index.php");
            } else {
                echo "Error inserting record: " . mysqli_error($conn);
            }
        }
    }
}
?>
