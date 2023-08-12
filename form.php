<?php
include('dbcon.php');
include('session.php');


// Get the edit ID from the URL parameter
$editId = $_GET['editid'];

// Query to select the record with the given edit ID
$editSql = "SELECT * FROM `upload` WHERE id = ?";
$query = mysqli_prepare($conn, $editSql);
mysqli_stmt_bind_param($query, 'i', $editId);
mysqli_stmt_execute($query);
$editResult = mysqli_fetch_assoc(mysqli_stmt_get_result($query));

// Close the statement
mysqli_stmt_close($query);
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet" type="text/css" href="css/custom.css">
  <title>Document</title>
</head>

<body>
  <div class="formbold-main-wrapper">
    <a href="./index.php" id="myBtn"><span class="material-symbols-outlined">
        arrow_back_ios
      </span></a>
    <div class="formbold-form-wrapper">
      <form action="./save.php" method="POST" enctype="multipart/form-data">

        <!-- Hidden input for ID -->
        <input type="text" name="id" id="id" class="formbold-form-input" value="<?php echo $editResult['id']; ?>"
          hidden />

        <!-- Date of Expire -->
        <div class="formbold-mb-3">
          <label for="xdate" class="formbold-form-label"> Date of Expire </label>
          <input type="date" name="exdate" id="dob" class="formbold-form-input"
            value="<?php echo $editResult['xdate']; ?>" />
        </div>

        <!-- Type of File -->
        <div class="formbold-mb-3">
          <label for="address" class="formbold-form-label"> Type Of File </label>
          <input type="text" name="etype" placeholder="Type Of File" class="formbold-form-input formbold-mb-3"
            value="<?php echo $editResult['type']; ?>" />
        </div>

        <!-- Edit Button -->
        <button class="formbold-btn">Edit</button>
      </form>
    </div>
  </div>
</body>

</html>