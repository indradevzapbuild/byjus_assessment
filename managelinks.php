<?php 
include_once("app.php");
$collegeMdl = new CollegeModel();
  
  if(isset($_POST) && !empty($_POST['submit'])) {
       $res = $collegeMdl->create($_POST);
       if(!$res) {
          echo $collegeMdl->errorInfo;
       }
  }
    if(isset($_POST) && !empty($_POST['update'])) {
       $res = $collegeMdl->updateDeadLink();
       $collegeMdl->createCSV();
  }
  $record = $collegeMdl->get();
  //print_r($record);

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Manage basic info</title>
    <link rel="stylesheet" href="css/style.css"/>
</head>

<body>
	  
<div class="top-form">
  <form action="" method="post">
    <label for="fname">College Name</label>
    <input type="text" id="college_name" name="college_name" placeholder="College name.." required>

    <label for="lname">college Location</label>
    <input type="text" id="college_location" name="college_location" placeholder="College location.." required>

    <label for="country">URL</label>
     <input type="text" id="url" name="url" pattern="https?://.+" placeholder="URL.." >
  
    <input type="submit" value="Submit" name="submit">
  </form>
</div>
 <div class="basic-table">
 <h2 class="table-heading">College List</h2>
 <form action="" method="post"> <input type="submit" class="button" style="float: right;" value="Update Dead Links" name="update"></form>

<table>
  <tr>
    <th>College Name</th>
    <th>College Location</th>
    <th>URL</th>
  </tr>
  <?php
       if(!empty($record)) {
        foreach ($record as $key => $row) {
        ?>
        <tr>
    <td><?php echo $row['college_name']; ?></td>
    <td><?php echo $row['college_location']; ?></td>
    <td><?php echo $row['url']; ?></td>
    </tr>
        <?php 
           }
       } else{
   ?>
          <tr>
    <td colspan="3">No Record Found</td>
  </tr>
<?php } ?>
</table>
</div>
</body>

</html>