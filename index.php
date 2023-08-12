<?php
date_default_timezone_set("Asia/Calcutta");
error_reporting(0);
include('dbcon.php');
include('session.php');
$edit_prev = false;
$view_prev = false;
$delete_prev = false;
$set_prev = false;
$admin = false;


// Check if the user is logged in and not an administrator
$username = $_SESSION['username'];

// Query to get the user type from the database
$query = "SELECT type FROM users WHERE uname = '$username'";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $userType = $row['type'];
  // echo $userType;die();

  if ($userType === 'admin') {
    $edit_prev = true;
    $view_prev = true;
    $delete_prev = true;
    $set_prev = true;
    $admin = true;
  } else {
    // For non-admin users, set specific privileges
    $privilegeJSON = $userType;
    $privileges = json_decode($privilegeJSON, true);

    $view_prev = $privileges['view'];
    $edit_prev = $privileges['edit'];
    $delete_prev = $privileges['delete'];
    $set_prev = $privileges['set'];
  }
}
?>

<html>
<title>File|Mgr</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<link href="globe.png" rel="shortcut icon">

<head>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="screen">
  <link rel="stylesheet" type="text/css" href="css/custom.css">
  <link rel="stylesheet" href="css/jquery.dataTables.css">
</head>
<script src="js/jquery.js" type="text/javascript"></script>
</head>
<html>


<body>
  <main>
    <div id="popup">

      <div id="popup-container">
        <span class="material-symbols-outlined closebtn">
          close
        </span>
        <div class="formbold-main-wrapper">


          <div class="formbold-form-wrapper">
            <form action="./save.php" method="POST" enctype="multipart/form-data">



              <div class="formbold-mb-3">
                <label for="xdate" class="formbold-form-label"> Date of Expire </label>
                <input type="date" name="xdate" id="dob" class="formbold-form-input" />
              </div>
              <div class="formbold-mb-3">
                <label for="address" class="formbold-form-label"> File Name </label>

                <input type="text" name="fname" placeholder=" File Name " class="formbold-form-input formbold-mb-3" />

              </div>
              <div class="formbold-mb-3">
                <label for="address" class="formbold-form-label"> Type Of File </label>

                <input type="text" name="type" placeholder="Type Of File" class="formbold-form-input formbold-mb-3" />

              </div>



              <div class="formbold-mb-3">
                <label for="upload" class="formbold-form-label">
                  Upload Your File
                </label>
                <input type="file" name="photo" id="upload" class="formbold-form-input formbold-form-file" />
              </div>



              <button class="formbold-btn">Submit</button>
            </form>
          </div>
        </div>


      </div>
    </div>
    <div class="alert alert-info header">
      <b>FILE MANAGER</b>
      <div>
        <?php if ($set_prev): ?>
          <button id="addbtn" class="btn user-priv" title="Add File"><span class="material-symbols-outlined">
              add
            </span></button>
        <?php endif; ?>
        <form action="session.php" method="POST" style="display:inline-block;">
          <button id="addbtn" class="btn" title="LogOut"><span class="material-symbols-outlined">
              logout
            </span></button>
        </form>
        <?php if ($admin): ?>
          <a href="./admin/index.php"><button id="addbtn" title="Dashboard" class="btn user-priv editor-priv"><span
                class="material-symbols-outlined">
                dashboard
              </span></button>
          <?php endif; ?>
        </a>
      </div>


    </div>
    <div class="col-md-18">
      <div class="container-fluid" style="margin-top:0px;">
        <div class="row">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="table-responsive">


                <form method="post" action="delete.php">
                  <table class="table table-condensed display" style="width:100%; border-radius: 10px;" id="example">

                    <thead>

                      <tr>

                        <th>ID</th>
                        <th>FILE NAME</th>
                        <th>Date</th>
                        <th>Expire Date</th>
                        <th>Type</th>
                        <th>Button</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = mysqli_query($conn, "select * from upload ORDER BY id DESC") or die(mysqli_error($conn));
                      while ($row = mysqli_fetch_array($query)) {
                        $id = $row['id'];
                        $name = $row['name'];
                        $date = $row['date'];
                        $xdate = $row['xdate'];
                        $type = $row['type'];
                        ?>

                        <tr>

                          <td>
                            <?php echo $row['id'] ?>
                          </td>
                          <td>
                            <?php echo $row['name'] ?>
                          </td>
                          <td>
                            <?php echo $row['date'] ?>
                          </td>
                          <td class="xdate">
                            <?php echo $row['xdate'] ?>
                          </td>
                          <td>
                            <?php echo $row['type'] ?>
                          </td>
                          <td>
                            <?php if ($view_prev): ?>
                              <a href="download.php?filename=<?php echo $name; ?>" title="click to download"><span
                                  class="material-symbols-outlined">
                                  download
                                </span></a>
                            <?php endif; ?>

                            <?php if ($delete_prev): ?>
                              <a href="delete.php?del=<?php echo $row['id'] ?> " title="click to delete"
                                class="user-priv editor-priv"><span class="material-symbols-outlined">
                                  delete
                                </span></a>
                            <?php endif; ?>
                            <?php if ($edit_prev): ?>
                              <a href="form.php?editid=<?php echo $row['id'] ?>" title="click to edit"
                                class="user-priv "><span class="material-symbols-outlined">
                                  edit
                                </span></a>
                            <?php endif; ?>
                            <b data-path="./files/<?php echo $name; ?>" style="cursor: pointer;" class="view-icon" title="Preview">
                              <span class="material-symbols-outlined">
                                  visibility
                                </span></b>


                          </td>
                        </tr>

                      <?php } ?>
                    </tbody>
                  </table>
              </div>
              </form>

            </div>
          </div>
        </div>
      </div>

    </div>
  </main>
        <div class='preview-container'>
      <div class='preview-container-in'>
      
      </div>
  <script type="text/javascript" charset="utf-8" language="javascript" src="js/jquery.dataTables.js"></script>
  <script type="text/javascript" charset="utf-8" language="javascript" src="./js/custom.js"></script>
  <script type="text/javascript">new DataTable('#example', { order: [[3, 'desc']] });</script>

</body>

</html>

