<?php

if(isset($_FILES['csv'])) {
    $errors = array();
    $file_name = $_FILES['csv']['name'];
    $file_size = $_FILES['csv']['size'];
    $file_tmp = $_FILES['csv']['tmp_name'];
    $file_type = $_FILES['csv']['type'];
    $file_ext = strtolower(end(explode('.', $_FILES['csv']['name'])));

    $expensions = array ('csv');

    if( $file_size > 1048576) { // размер в байтах
        $errors[] = 'Файл должен быть 1 мб';
    }

    if(empty($errors) == true) {
        move_uploaded_file($file_tmp, "csv/".$file_name);
        echo "Success";
    }else {
        print $errors;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Document</title>
</head>
<body  class="container ">
    <div>
        <form class="mt-4" action="/file-loader.php" method="post" enctype="multipart/form-data">
            <input  type="file" name="csv" >
            <input  type="submit">
            <div class="mt-4">
                <button class="btn btn-success">View results</button>
            </div>
        </form>
        <div class="mt-4">
            <a type="submit" class=" btn btn-danger" href="/file-loader.php?delete=true">DELETE</a>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>