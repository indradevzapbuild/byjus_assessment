<?php 
include_once("app.php");
$basicMdl = new BasicInfoModel();
  
  if(isset($_POST) && !empty($_POST['submit'])) {
       $res = $basicMdl->create($_POST);
       if(!$res) {
          echo $basicMdl->errorInfo;
       }
  }
  $record = $basicMdl->get();
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
    <label for="fname">First Name</label>
    <input type="text" id="fname" name="first_name" placeholder="Your name.." required>

    <label for="lname">Last Name</label>
    <input type="text" id="lname" name="last_name" placeholder="Your last name.." required>

    <label for="country">Email</label>
     <input type="text" id="lname" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Your email.." >
  
    <input type="submit" value="Submit" name="submit">
  </form>
</div>
 <div class="basic-table">
 <h2 class="table-heading">Added basic Information</h2>

<table>
  <tr>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email</th>
  </tr>
  <?php
       if(!empty($record)) {
        foreach ($record as $key => $row) {
        ?>
        <tr>
    <td><?php echo $row['first_name']; ?></td>
    <td><?php echo $row['last_name']; ?></td>
    <td><?php echo $row['email']; ?></td>
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