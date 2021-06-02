<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

<?php
require_once  "FileUploader.php";

$isDelete = isset($_GET['delete']) ?? false;

if($isDelete == 'true') {
  $database = new Database('localhost', 'root', 'root', 'csv_db');
  $database->query('DELETE FROM `users_1`');
  var_dump('DELETE');die();
}

$fileClass = new Data($_FILES['csv']);
$fileClass->upload();
$data = $fileClass->selectFromDatabase();
$fileClass->saveDateToDatabase();

?>

<div class="container  p-4">
<table class="table table-success table-hover table-bordered">
  <tr  class="table-warning">
    <th>uid</th>
    <th>name</th>
    <th>age</th>
    <th>email</th>
    <th>phone</th>
    <th>gender</th>
  </tr>
  <?php 
   foreach($data as $title) {
      ?>
    <tr>
      <td class="table-success"><?= $title['uid'] ?></td>
      <td class="table-success"><?= $title['name'] ?></td>
      <td class="table-success"><?= $title['age'] ?></td>
      <td class="table-success"><?= $title['email'] ?></td>
      <td class="table-success"><?= $title['phone'] ?></td>
      <td class="table-success"><?= $title['gender'] ?></td>
    </tr>
    <?php
   }
  ?>
 
</table>
   
<ul>
    <li>Sent file:<?php echo $_FILES['csv']['name'];?></li>
    <li>File size:<?php echo $_FILES['csv']['size'];?></li>
    <li>File type:<?php echo $_FILES['csv']['type'];?></li>
    <li>File type:<?php echo $_FILES['csv']['tmp_name'];?></li>
</ul>
  <div class = 'container'>
    <div >
      <a  class="btn btn-primary"  type='button'  href="./index.php">Import data</a>
    </div>
</div>
